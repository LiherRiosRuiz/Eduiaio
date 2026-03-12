<?php
/**
 * panel_estudiante.php
 *
 * Panel de inicio del alumno.
 * Muestra estadísticas personales y el catálogo de cursos con progreso.
 *
 * Puede ser llamado directamente o incluido desde panel.php
 * cuando el rol de la sesión es 'estudiante'.
 */

// Puede ser incluido desde panel.php (que ya cargó bootstrap) o cargarse directamente
if (!defined('ROOT')) {
    require_once __DIR__ . '/bootstrap.php';
}

// Verificar acceso
requerir_sesion();

$id_usuario = $_SESSION['id_usuario'];

// ── Consulta: cursos con progreso del alumno ──────────────────────────
// Combina cursos, módulos, lecciones y la tabla de progreso del usuario.
$stmt = $conexion->prepare("
    SELECT
        c.id,
        c.titulo,
        c.descripcion,
        COUNT(DISTINCT l.id)  AS total_lecciones,
        COUNT(DISTINCT p.leccion_id) AS lecciones_completadas
    FROM cursos c
    LEFT JOIN modulos  m ON c.id = m.curso_id
    LEFT JOIN lecciones l ON m.id = l.modulo_id
    LEFT JOIN progreso  p ON l.id = p.leccion_id AND p.usuario_id = ?
    GROUP BY c.id
    ORDER BY c.titulo ASC
");
$stmt->execute([$id_usuario]);
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ── Calcular estadísticas globales del alumno ─────────────────────────
$cursos_iniciados = 0;
$total_puntos     = 0; // Sistema de puntos: 10 pts por lección completada

foreach ($cursos as $c) {
    if ($c['lecciones_completadas'] > 0) {
        $cursos_iniciados++;
    }
    $total_puntos += $c['lecciones_completadas'] * 10;
}

// ── Variables para el fragmento <head> ───────────────────────────────
$titulo_pagina = 'Mi Panel';
$fuente        = 'Outfit';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'vistas/fragmentos/head.php'; ?>

    <style>
        /**
         * Estilos locales del panel de estudiante.
         * TODO: mover a recursos/estilos/paginas/panel_estudiante.css
         *       si la hoja crece demasiado.
         */
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
        }

        /* Cabecera azul-morada de alumno */
        .cabecera-estudiante {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            padding: 1.5rem 0;
        }

        /* Cuadrícula de tarjetas de cursos */
        .grid-cursos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        /* Tarjeta individual de curso */
        .tarjeta-curso {
            background: white;
            border-radius: var(--radio-lg);
            box-shadow: var(--sombra-md);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
        }

        .tarjeta-curso:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Imagen / icono decorativo de la tarjeta */
        .curso-imagen {
            height: 140px;
            background: linear-gradient(45deg, #cbd5e1, #e2e8f0);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        /* Contenido de texto de la tarjeta */
        .curso-contenido {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .curso-titulo {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--texto-principal);
            margin: 0 0 0.5rem 0;
        }

        .curso-desc {
            color: var(--texto-secundario);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Barra de progreso de la tarjeta */
        .curso-barra {
            height: 8px;
            background-color: #f1f5f9;
            border-radius: 4px;
            margin-bottom: 0.5rem;
            overflow: hidden;
        }

        .curso-progreso {
            height: 100%;
            background-color: #10b981;
            border-radius: 4px;
            transition: width 0.5s ease;
        }
    </style>
</head>

<body>

    <!-- Barra de navegación del alumno -->
    <?php include 'vistas/fragmentos/nav_estudiante.php'; ?>

    <main class="contenedor">

        <!-- ── Saludo de bienvenida ────────────────────────────── -->
        <div class="bienvenida" style="margin: 3rem 0 2rem 0;">
            <h1 style="color: var(--color-primario);">¡Hola de nuevo! 👋</h1>
            <p class="texto-lg" style="color: var(--texto-secundario);">
                Aquí tienes tus cursos y progresos actualizados.
            </p>
        </div>

        <!-- ── Estadísticas del alumno ────────────────────────── -->
        <div class="cuadricula-estadisticas">
            <div class="tarjeta-estadistica">
                <div class="etiqueta-estadistica">Cursos Iniciados</div>
                <div class="valor-estadistica"><?= $cursos_iniciados ?></div>
            </div>
            <div class="tarjeta-estadistica">
                <div class="etiqueta-estadistica">Puntos de Conocimiento</div>
                <div class="valor-estadistica valor-estadistica-acento"><?= $total_puntos ?></div>
            </div>
        </div>

        <!-- ── Catálogo de cursos ─────────────────────────────── -->
        <div style="margin-top: 3rem;">
            <h2 style="border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 2rem;">
                Catálogo de Cursos
            </h2>

            <!-- ── Acciones de cuenta ──────────────────────────────── -->
            <div class="cuadricula-estadisticas" style="margin-bottom: 3rem; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                <div class="tarjeta-accion" style="padding: 1.5rem; text-align: center; border-radius: 12px; background: white; border: 1px solid #e2e8f0;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">👤</div>
                    <h3>Mi Perfil</h3>
                    <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1.5rem;">Gestiona tus datos personales y foto.</p>
                    <a href="mi_perfil.php" class="btn btn-primario" style="width: 100%;">Ver Perfil</a>
                </div>
                <div class="tarjeta-accion" style="padding: 1.5rem; text-align: center; border-radius: 12px; background: white; border: 1px solid #e2e8f0;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">📜</div>
                    <h3>Certificados</h3>
                    <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1.5rem;">Descarga tus títulos al completar cursos.</p>
                    <a href="mis_certificados.php" class="btn btn-primario" style="width: 100%;">Ver Títulos</a>
                </div>
                <div class="tarjeta-accion" style="padding: 1.5rem; text-align: center; border-radius: 12px; background: white; border: 1px solid #e2e8f0;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">⚙️</div>
                    <h3>Ajustes</h3>
                    <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1.5rem;">Cambia tu contraseña y configuración.</p>
                    <a href="configuracion.php" class="btn btn-primario" style="width: 100%;">Configuración</a>
                </div>
            </div>

            <?php if (empty($cursos)): ?>
                <!-- Sin cursos -->
                <div class="tarjeta-accion">
                    <h3>No hay cursos disponibles en este momento.</h3>
                    <p>Vuelve más tarde para ver nuevo contenido.</p>
                </div>
            <?php else: ?>
                <div class="grid-cursos">
                    <?php foreach ($cursos as $curso):
                        // Calcular porcentaje con la función centralizada
                        $porcentaje = calcular_porcentaje(
                            (int) $curso['lecciones_completadas'],
                            (int) $curso['total_lecciones']
                        );
                        // Obtener el icono según el título
                        $icono = obtener_icono_curso($curso['titulo']);
                    ?>
                        <div class="tarjeta-curso">

                            <!-- Icono representativo -->
                            <div class="curso-imagen"><?= $icono ?></div>

                            <div class="curso-contenido">
                                <h3 class="curso-titulo">
                                    <?= htmlspecialchars($curso['titulo']) ?>
                                </h3>
                                <p class="curso-desc">
                                    <?= htmlspecialchars($curso['descripcion']) ?>
                                </p>

                                <!-- Barra de progreso -->
                                <div class="curso-meta">
                                    <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: #64748b; margin-bottom: 0.25rem;">
                                        <span>Progreso</span>
                                        <span><?= $porcentaje ?>%</span>
                                    </div>
                                    <div class="curso-barra">
                                        <div class="curso-progreso" style="width: <?= $porcentaje ?>%"></div>
                                    </div>
                                </div>

                                <!-- Botón de acción -->
                                <a href="ver_curso.php?id=<?= $curso['id'] ?>"
                                   class="btn <?= $porcentaje > 0 ? 'btn-primario' : 'btn-borde' ?>"
                                   style="width: 100%; text-align: center; margin-top: 1rem;">
                                    <?= $porcentaje > 0 ? 'Continuar Aprendiendo' : 'Empezar Curso' ?>
                                </a>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </main>
</body>

</html>
