<?php
/**
 * operaciones/listar.php
 *
 * Lista todos los cursos de la plataforma en una tabla.
 * Acceso restringido: solo usuarios con sesión activa (admin/profesor).
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

// ── Obtener todos los cursos con datos relacionados ───────────────────
$consulta = $conexion->query("
    SELECT
        cursos.*,
        categorias.nombre AS nombre_categoria,
        niveles.nombre    AS nombre_nivel,
        usuarios.usuario  AS instructor
    FROM cursos
    LEFT JOIN categorias ON cursos.categoria_id = categorias.id
    LEFT JOIN niveles    ON cursos.id_nivel     = niveles.id
    LEFT JOIN usuarios   ON cursos.creado_por   = usuarios.id
    ORDER BY cursos.fecha_creacion DESC
");
$cursos = $consulta->fetchAll();

// Mostrar alerta flash si existe
$alerta = $_SESSION['alerta'] ?? null;
unset($_SESSION['alerta']);

$titulo_pagina = 'Gestión de Cursos';
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

        <div class="admin-topbar">
            <div>
                <nav class="breadcrumb">
                    <a href="<?= APP_URL ?>/panel.php">Dashboard</a>
                    <span class="breadcrumb-sep">›</span>
                    <span class="breadcrumb-actual">Cursos</span>
                </nav>
                <h1 class="form-titulo" style="margin-top:0.35rem;">Lista de Cursos</h1>
            </div>
            <a href="crear.php" class="btn-nuevo-admin">+ Nuevo Curso</a>
        </div>

        <main class="admin-main">

            <?php if ($alerta): ?>
                <div class="alerta-admin-<?= $alerta['tipo'] === 'exito' ? 'exito' : 'error' ?>">
                    <?= htmlspecialchars($alerta['mensaje']) ?>
                </div>
            <?php endif; ?>

            <div class="tabla-admin-wrapper">
                <table class="tabla-base" id="tabla-cursos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Curso</th>
                            <th>Categoría</th>
                            <th>Nivel</th>
                            <th>Precio</th>
                            <th>Creado Por</th>
                            <th class="td-derecha">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cursos as $curso): ?>
                            <tr class="fila-tabla">
                                <td style="font-weight:500;">#<?= $curso['id'] ?></td>

                                <td class="celda-curso">
                                    <div class="titulo-curso">
                                        <?= htmlspecialchars($curso['titulo'], ENT_QUOTES, 'UTF-8') ?>
                                    </div>
                                    <small class="descripcion-curso">
                                        <?= htmlspecialchars(substr($curso['descripcion'], 0, 50), ENT_QUOTES, 'UTF-8') ?>...
                                    </small>
                                </td>

                                <td>
                                    <span class="badge-categoria">
                                        <?= htmlspecialchars($curso['nombre_categoria'] ?? 'Sin Categoría', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="badge-nivel">
                                        <?= htmlspecialchars($curso['nombre_nivel'] ?? 'Sin Nivel', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>

                                <td class="precio-curso">
                                    <?= number_format($curso['precio'], 2) ?> €
                                </td>

                                <td style="color:var(--texto-secundario);">
                                    <?= htmlspecialchars($curso['instructor'] ?? 'Sistema', ENT_QUOTES, 'UTF-8') ?>
                                </td>

                                <td class="td-derecha">
                                    <a href="editar.php?id=<?= $curso['id'] ?>" class="btn-tabla-editar">
                                        Editar
                                    </a>
                                    <form method="POST" action="eliminar.php" style="display:inline;"
                                          onsubmit="return confirm('¿Seguro que quieres eliminar este curso?');">
                                        <?= csrf_campo() ?>
                                        <input type="hidden" name="id" value="<?= $curso['id'] ?>">
                                        <button type="submit" class="btn-tabla-eliminar">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if (empty($cursos)): ?>
                    <div class="mensaje-vacio">No hay cursos registrados. ¡Crea el primero!</div>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-cursos').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' },
                order: [[0, 'desc']],
                columnDefs: [{ orderable: false, targets: 6 }],
                pageLength: 10,
                responsive: true
            });
        });
    </script>
</body>
</html>
