<?php
/**
 * operaciones/eliminar.php
 *
 * Elimina un curso de la base de datos y redirige al listado.
 * Solo acepta peticiones POST con token CSRF válido.
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

// Rechazar peticiones que no sean POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar.php');
    exit;
}

csrf_verificar();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id) {
    // La BD eliminará las relaciones en cascada si están configuradas
    $consulta = $conexion->prepare("DELETE FROM cursos WHERE id = ?");
    $consulta->execute([$id]);
}

header('Location: listar.php');
exit;
