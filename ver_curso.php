<?php
/**
 * ver_curso.php
 *
 * Vista de contenido de un curso para el alumno.
 * Muestra los módulos y lecciones del curso con el progreso del usuario.
 */

require_once __DIR__ . '/bootstrap.php';

// Solo los estudiantes pueden ver los cursos
requerir_sesion();
requerir_rol('estudiante');

// ── Validar parámetro de URL ──────────────────────────────────────────
$id_curso  = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$id_usuario = $_SESSION['id_usuario'];

if (!$id_curso) {
    header('Location: panel.php');
    exit;
}

// ── Obtener datos del curso ───────────────────────────────────────────
$stmt = $conexion->prepare("SELECT * FROM cursos WHERE id = ?");
$stmt->execute([$id_curso]);
$curso = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$curso) {
    header('Location: panel.php');
    exit;
}

// ── Obtener módulos, lecciones y progreso en una sola consulta ────────
$stmt = $conexion->prepare("
    SELECT
        m.id   AS modulo_id,
        m.titulo AS modulo_titulo,
        m.descripcion AS modulo_desc,
        l.id   AS leccion_id,
        l.titulo AS leccion_titulo,
        l.duracion_estimada,
        p.completado
    FROM modulos m
    LEFT JOIN lecciones l ON m.id = l.modulo_id
    LEFT JOIN progreso  p ON l.id = p.leccion_id AND p.usuario_id = ?
    WHERE m.curso_id = ?
    ORDER BY m.orden ASC, l.orden ASC
");
$stmt->execute([$id_usuario, $id_curso]);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ── Estructurar los resultados en un array por módulo ─────────────────
$modulos            = [];
$total_lecciones    = 0;
$lecciones_completadas = 0;

foreach ($resultados as $fila) {
    $mod_id = $fila['modulo_id'];

    // Crear entrada de módulo si no existe todavía
    if (!isset($modulos[$mod_id])) {
        $modulos[$mod_id] = [
            'titulo'      => $fila['modulo_titulo'],
            'descripcion' => $fila['modulo_desc'],
            'lecciones'   => [],
        ];
    }

    // Agregar la lección si existe (LEFT JOIN puede devolver NULL si no hay lecciones)
    if ($fila['leccion_id']) {
        $modulos[$mod_id]['lecciones'][] = [
            'id'         => $fila['leccion_id'],
            'titulo'     => $fila['leccion_titulo'],
            'duracion'   => $fila['duracion_estimada'],
            'completado' => $fila['completado'],
        ];
        $total_lecciones++;
        if ($fila['completado']) {
            $lecciones_completadas++;
        }
    }
}

// Calcular porcentaje global del curso
$progreso_porcentaje = calcular_porcentaje($lecciones_completadas, $total_lecciones);

// ── Variables para el fragmento <head> ───────────────────────────────
$titulo_pagina = htmlspecialchars($curso['titulo']);
$fuente        = 'Outfit';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'vistas/fragmentos/head.php'; ?>
</head>

<body>

    <!-- ── Cabecera del curso (hero con gradiente) ────────────── -->
    <div class="curso-header">
        <div class="contenedor">

            <!-- Botón volver al panel -->
            <a href="panel.php" class="btn btn-claro"
               style="margin-bottom: 1rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                ← Volver al Panel
            </a>

            <h1><?= htmlspecialchars($curso['titulo']) ?></h1>
            <p class="texto-lg" style="opacity: 0.9; max-width: 800px;">
                <?= htmlspecialchars($curso['descripcion']) ?>
            </p>

            <!-- Barra de progreso global -->
            <div style="margin-top: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 0.5rem;">
                    <span style="font-weight: 500;">Tu Progreso</span>
                    <span><?= $progreso_porcentaje ?>% completado</span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: <?= $progreso_porcentaje ?>%"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- ── Contenido principal: módulos y sidebar ─────────────── -->
    <div class="contenedor">
        <div class="grid-layout" style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">

            <!-- Columna principal: lista de módulos y lecciones -->
            <div class="contenido-principal">
                <?php foreach ($modulos as $mod): ?>
                <div class="modulo-card">

                    <!-- Cabecera del módulo -->
                    <div class="modulo-header">
                        <h3 style="margin: 0; color: var(--color-primario);">
                            <?= htmlspecialchars($mod['titulo']) ?>
                        </h3>
                        <?php if ($mod['descripcion']): ?>
                            <p style="margin: 0.5rem 0 0 0; color: var(--texto-secundario); font-size: 0.9rem;">
                                <?= htmlspecialchars($mod['descripcion']) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Lista de lecciones del módulo -->
                    <div>
                        <?php foreach ($mod['lecciones'] as $leccion): ?>
                        <a href="ver_leccion.php?id=<?= $leccion['id'] ?>"
                           class="leccion-item <?= $leccion['completado'] ? 'completada' : '' ?>">

                            <!-- Indicador de completada -->
                            <div class="leccion-status">
                                <?= $leccion['completado'] ? '✓' : '' ?>
                            </div>

                            <!-- Título y duración -->
                            <div style="flex: 1;">
                                <div style="font-weight: 500;">
                                    <?= htmlspecialchars($leccion['titulo']) ?>
                                </div>
                                <div style="font-size: 0.8rem; color: var(--texto-secundario); margin-top: 0.2rem;">
                                    ⏱ <?= $leccion['duracion'] ?> min de lectura
                                </div>
                            </div>

                            <!-- Texto de acción -->
                            <div style="color: var(--color-acento);">
                                <?= $leccion['completado'] ? 'Repasar' : 'Comenzar' ?> →
                            </div>

                        </a>
                        <?php endforeach; ?>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>

            <!-- Sidebar: resumen del curso -->
            <div class="sidebar">
                <div class="tarjeta">
                    <h3>Sobre este curso</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                            <strong>Lecciones:</strong> <?= $total_lecciones ?>
                        </li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                            <strong>Duración total:</strong>
                            ~<?= calcular_duracion_total($modulos) ?> min
                        </li>
                        <li style="padding: 0.5rem 0;">
                            <strong>Nivel:</strong> Iniciación
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
