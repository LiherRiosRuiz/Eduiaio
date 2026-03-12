<?php
/**
 * panel.php
 *
 * Panel de control de la aplicación.
 * Redirige al panel correcto según el rol del usuario:
 *   - estudiante → incluye panel_estudiante.php
 *   - admin/profesor → muestra el dashboard de administración con métricas reales
 */

require_once __DIR__ . '/bootstrap.php';
requerir_sesion();

// Redirigir a la vista de alumno si corresponde
if (tiene_rol('estudiante')) {
    include 'panel_estudiante.php';
    exit;
}

// ── Métricas reales de la base de datos ──────────────────────────────
$total_cursos     = (int) $conexion->query("SELECT COUNT(*) FROM cursos")->fetchColumn();
$total_usuarios   = (int) $conexion->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
$total_categorias = (int) $conexion->query("SELECT COUNT(*) FROM categorias")->fetchColumn();
$total_inscritos  = (int) $conexion->query("SELECT COUNT(*) FROM inscripciones")->fetchColumn();

// Actividad reciente (últimas 8 entradas del log de auditoría)
$stmt_actividad = $conexion->query(
    "SELECT tabla, accion, detalles, fecha_creacion
     FROM auditoria
     ORDER BY fecha_creacion DESC
     LIMIT 8"
);
$actividad = $stmt_actividad ? $stmt_actividad->fetchAll() : [];

// Últimos 5 cursos creados
$stmt_cursos = $conexion->query(
    "SELECT c.titulo, cat.nombre AS categoria, c.fecha_creacion, c.id
     FROM cursos c
     LEFT JOIN categorias cat ON c.categoria_id = cat.id
     ORDER BY c.fecha_creacion DESC
     LIMIT 5"
);
$ultimos_cursos = $stmt_cursos ? $stmt_cursos->fetchAll() : [];

// ── Variables para el fragmento <head> ───────────────────────────────
$titulo_pagina = 'Dashboard';

/**
 * Mapea la acción de auditoría a clases CSS y etiquetas legibles.
 */
function badge_accion(string $accion): array {
    return match (strtoupper($accion)) {
        'INSERTAR' => ['clase' => 'badge-insertar', 'texto' => 'Nuevo'],
        'ACTUALIZAR' => ['clase' => 'badge-actualizar', 'texto' => 'Editado'],
        'ELIMINAR'  => ['clase' => 'badge-eliminar', 'texto' => 'Eliminado'],
        default     => ['clase' => 'badge-actualizar', 'texto' => $accion],
    };
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include ROOT . '/vistas/fragmentos/head.php'; ?>
    <link rel="stylesheet" href="<?= APP_URL ?>/recursos/estilos/paginas/panel.css">
</head>

<body class="panel-admin">

    <?php include ROOT . '/vistas/fragmentos/nav_admin.php'; ?>

    <div class="admin-contenido">

        <!-- Topbar -->
        <div class="admin-topbar">
            <div>
                <h1 class="dashboard-titulo">Dashboard</h1>
                <p class="dashboard-subtitulo">Bienvenido de vuelta, <strong><?= htmlspecialchars($_SESSION['nombre_usuario']) ?></strong></p>
            </div>
            <div class="topbar-acciones">
                <a href="<?= APP_URL ?>/operaciones/crear.php" class="btn-nuevo-admin">
                    + Nuevo Curso
                </a>
            </div>
        </div>

        <main class="admin-main">

            <!-- ── Métricas ──────────────────────────────────────────── -->
            <div class="grid-metricas">

                <div class="tarjeta-metrica metrica-cursos">
                    <span class="metrica-icono">▤</span>
                    <div class="metrica-valor"><?= $total_cursos ?></div>
                    <div class="metrica-label">Cursos</div>
                    <a href="<?= APP_URL ?>/operaciones/listar.php" class="metrica-enlace">Ver todos →</a>
                </div>

                <div class="tarjeta-metrica metrica-usuarios">
                    <span class="metrica-icono">◉</span>
                    <div class="metrica-valor"><?= $total_usuarios ?></div>
                    <div class="metrica-label">Usuarios</div>
                    <a href="<?= APP_URL ?>/operaciones/listar_usuarios.php" class="metrica-enlace">Ver todos →</a>
                </div>

                <div class="tarjeta-metrica metrica-categorias">
                    <span class="metrica-icono">◈</span>
                    <div class="metrica-valor"><?= $total_categorias ?></div>
                    <div class="metrica-label">Categorías</div>
                    <a href="<?= APP_URL ?>/operaciones/listar_categorias.php" class="metrica-enlace">Ver todas →</a>
                </div>

                <div class="tarjeta-metrica metrica-inscritos">
                    <span class="metrica-icono">★</span>
                    <div class="metrica-valor"><?= $total_inscritos ?></div>
                    <div class="metrica-label">Inscripciones</div>
                </div>

            </div>

            <!-- ── Sección inferior: actividad + cursos recientes ────── -->
            <div class="seccion-dashboard">

                <!-- Actividad reciente -->
                <div class="card-dashboard">
                    <div class="card-dashboard-header">
                        <span class="card-dashboard-titulo">Actividad Reciente</span>
                        <span class="card-dashboard-meta"><?= count($actividad) ?> registros</span>
                    </div>
                    <div class="card-dashboard-body">
                        <?php if (empty($actividad)): ?>
                            <p class="card-vacio">Sin actividad reciente.</p>
                        <?php else: ?>
                            <?php foreach ($actividad as $log):
                                $badge = badge_accion($log['accion']);
                            ?>
                            <div class="actividad-item">
                                <span class="actividad-badge <?= $badge['clase'] ?>">
                                    <?= $badge['texto'] ?>
                                </span>
                                <div class="actividad-detalle">
                                    <span class="actividad-tabla"><?= htmlspecialchars(ucfirst($log['tabla'])) ?></span>
                                    <span class="actividad-desc"><?= htmlspecialchars($log['detalles']) ?></span>
                                </div>
                                <span class="actividad-fecha" title="<?= htmlspecialchars($log['fecha_creacion']) ?>">
                                    <?= date('d/m H:i', strtotime($log['fecha_creacion'])) ?>
                                </span>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Últimos cursos -->
                <div class="card-dashboard">
                    <div class="card-dashboard-header">
                        <span class="card-dashboard-titulo">Últimos Cursos</span>
                        <a href="<?= APP_URL ?>/operaciones/listar.php" class="card-dashboard-meta card-dashboard-link">Ver todos →</a>
                    </div>
                    <div class="card-dashboard-body">
                        <?php if (empty($ultimos_cursos)): ?>
                            <p class="card-vacio">No hay cursos todavía.</p>
                        <?php else: ?>
                            <?php foreach ($ultimos_cursos as $curso): ?>
                            <div class="actividad-item">
                                <div class="actividad-detalle">
                                    <span class="actividad-tabla"><?= htmlspecialchars($curso['titulo']) ?></span>
                                    <span class="actividad-desc"><?= htmlspecialchars($curso['categoria'] ?? 'Sin categoría') ?></span>
                                </div>
                                <div class="actividad-acciones">
                                    <a href="<?= APP_URL ?>/operaciones/editar.php?id=<?= $curso['id'] ?>"
                                       class="link-editar-mini">Editar</a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- ── Accesos rápidos ────────────────────────────────────── -->
            <div class="grid-accesos">

                <a href="<?= APP_URL ?>/operaciones/crear.php" class="tarjeta-acceso acceso-curso">
                    <span class="acceso-icono">▤</span>
                    <div>
                        <div class="acceso-titulo">Nuevo Curso</div>
                        <div class="acceso-desc">Crear un curso nuevo</div>
                    </div>
                </a>

                <a href="<?= APP_URL ?>/operaciones/crear_categoria.php" class="tarjeta-acceso acceso-categoria">
                    <span class="acceso-icono">◈</span>
                    <div>
                        <div class="acceso-titulo">Nueva Categoría</div>
                        <div class="acceso-desc">Organizar el contenido</div>
                    </div>
                </a>

                <a href="<?= APP_URL ?>/operaciones/crear_usuario.php" class="tarjeta-acceso acceso-usuario">
                    <span class="acceso-icono">◉</span>
                    <div>
                        <div class="acceso-titulo">Nuevo Usuario</div>
                        <div class="acceso-desc">Registrar estudiante o admin</div>
                    </div>
                </a>

            </div>

        </main>
    </div>

</body>
</html>
