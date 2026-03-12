<?php
/**
 * ver_leccion.php
 *
 * Vista de una lección individual para el alumno.
 * Muestra el contenido rico de la lección y permite marcarla como completada.
 * También ofrece navegación anterior/siguiente entre lecciones del mismo curso.
 */

require_once __DIR__ . '/bootstrap.php';

// Solo los estudiantes pueden leer lecciones
requerir_sesion();
requerir_rol('estudiante');

// ── Validar parámetro de URL ──────────────────────────────────────────
$id_leccion = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$id_usuario = $_SESSION['id_usuario'];

if (!$id_leccion) {
    header('Location: panel.php');
    exit;
}

// ── Gestionar el marcado de lección como completada (POST) ────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marcar_completada'])) {
    csrf_verificar();
    // Insertar o actualizar el registro de progreso (ON DUPLICATE KEY UPDATE)
    $stmt = $conexion->prepare(
        "INSERT INTO progreso (usuario_id, leccion_id, completado, fecha_completado)
         VALUES (?, ?, 1, NOW())
         ON DUPLICATE KEY UPDATE completado = 1, fecha_completado = NOW()"
    );
    $stmt->execute([$id_usuario, $id_leccion]);

    // Redirigir a la siguiente lección o al curso si no hay más
    if (!empty($_POST['siguiente_leccion'])) {
        header('Location: ver_leccion.php?id=' . (int) $_POST['siguiente_leccion']);
    } else {
        header('Location: ver_curso.php?id=' . (int) $_POST['id_curso']);
    }
    exit;
}

// ── Obtener datos de la lección junto con módulo y curso ──────────────
$stmt = $conexion->prepare("
    SELECT
        l.*,
        m.titulo   AS modulo_titulo,
        m.curso_id,
        c.titulo   AS curso_titulo
    FROM lecciones l
    JOIN modulos m ON l.modulo_id = m.id
    JOIN cursos  c ON m.curso_id  = c.id
    WHERE l.id = ?
");
$stmt->execute([$id_leccion]);
$leccion = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$leccion) {
    header('Location: panel.php');
    exit;
}

// ── Comprobar si el alumno ya completó esta lección ───────────────────
$stmt = $conexion->prepare(
    "SELECT completado FROM progreso WHERE usuario_id = ? AND leccion_id = ?"
);
$stmt->execute([$id_usuario, $id_leccion]);
$progreso       = $stmt->fetch(PDO::FETCH_ASSOC);
$esta_completada = $progreso && $progreso['completado'];

// ── Obtener el orden de todas las lecciones del curso ─────────────────
// Permite calcular la lección anterior y siguiente.
$stmt = $conexion->prepare("
    SELECT l.id
    FROM lecciones l
    JOIN modulos m ON l.modulo_id = m.id
    WHERE m.curso_id = ?
    ORDER BY m.orden ASC, l.orden ASC
");
$stmt->execute([$leccion['curso_id']]);
$todas_lecciones = $stmt->fetchAll(PDO::FETCH_COLUMN);

$posicion_actual = array_search($id_leccion, $todas_lecciones);
$id_anterior     = ($posicion_actual > 0) ? $todas_lecciones[$posicion_actual - 1] : null;
$id_siguiente    = ($posicion_actual < count($todas_lecciones) - 1) ? $todas_lecciones[$posicion_actual + 1] : null;

// ── Variables para el fragmento <head> ───────────────────────────────
$titulo_pagina = htmlspecialchars($leccion['titulo']);
$fuente        = 'Outfit';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'vistas/fragmentos/head.php'; ?>
</head>

<body>

    <!-- ── Barra superior de navegación del curso ─────────────── -->
    <div style="background: white; border-bottom: 1px solid #e2e8f0; padding: 1rem 0;">
        <div class="contenedor" style="display: flex; justify-content: space-between; align-items: center;">

            <!-- Botón para volver al índice del curso -->
            <a href="ver_curso.php?id=<?= $leccion['curso_id'] ?>" class="btn btn-texto-primario">
                ← Volver al Curso
            </a>

            <!-- Nombre del módulo actual -->
            <div class="texto-chico color-secundario">
                <?= htmlspecialchars($leccion['modulo_titulo']) ?>
            </div>

        </div>
    </div>

    <!-- ── Contenido de la lección ───────────────────────────── -->
    <div class="leccion-container">

        <h1 style="color: var(--color-primario); margin-bottom: 1.5rem;">
            <?= htmlspecialchars($leccion['titulo']) ?>
        </h1>

        <!-- Cuerpo de la lección (puede contener HTML enriquecido) -->
        <div class="leccion-content">
            <?= $leccion['contenido'] ?>
        </div>

        <!-- ── Navegación entre lecciones ────────────────────── -->
        <div class="nav-bar">

            <!-- Lección anterior -->
            <?php if ($id_anterior): ?>
                <a href="ver_leccion.php?id=<?= $id_anterior ?>" class="btn btn-secundario">
                    ← Anterior
                </a>
            <?php else: ?>
                <div></div> <!-- placeholder para mantener el flex layout -->
            <?php endif; ?>

            <!-- Formulario de marcar como completada / siguiente lección -->
            <form method="POST">
                <?= csrf_campo() ?>
                <input type="hidden" name="id_curso"         value="<?= $leccion['curso_id'] ?>">
                <input type="hidden" name="siguiente_leccion" value="<?= $id_siguiente ?>">

                <?php if (!$esta_completada): ?>
                    <!-- Botón de completar: registra el progreso y avanza -->
                    <button type="submit" name="marcar_completada" class="btn btn-primario">
                        Completar y Continuar →
                    </button>
                <?php else: ?>
                    <!-- Ya completada: solo navegar -->
                    <?php if ($id_siguiente): ?>
                        <a href="ver_leccion.php?id=<?= $id_siguiente ?>" class="btn btn-primario">
                            Siguiente Lección →
                        </a>
                    <?php else: ?>
                        <a href="ver_curso.php?id=<?= $leccion['curso_id'] ?>" class="btn btn-primario">
                            Finalizar Curso
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </form>

        </div>
    </div>

</body>
</html>
