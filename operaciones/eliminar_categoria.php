<?php
/**
 * operaciones/eliminar_categoria.php
 *
 * Elimina una categoría de la base de datos y redirige al listado.
 * Solo acepta peticiones POST con token CSRF válido.
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

// Rechazar peticiones que no sean POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar_categorias.php');
    exit;
}

csrf_verificar();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: listar_categorias.php');
    exit;
}

// Obtener los datos de la categoría
$consulta = $conexion->prepare("SELECT * FROM categorias WHERE id = ?");
$consulta->execute([$id]);
$categoria = $consulta->fetch();

if (!$categoria) {
    header('Location: listar_categorias.php');
    exit;
}

try {
    // Verificar si hay cursos asociados a esta categoría
    $check = $conexion->prepare("SELECT COUNT(*) as cantidad FROM cursos WHERE categoria_id = ?");
    $check->execute([$id]);
    $result = $check->fetch();

    if ($result['cantidad'] > 0) {
        $_SESSION['alerta'] = [
            'tipo'    => 'error',
            'mensaje' => "No puede eliminar la categoría porque tiene {$result['cantidad']} curso(s) asociado(s).",
        ];
    } else {
        $stmt = $conexion->prepare("DELETE FROM categorias WHERE id = ?");
        $stmt->execute([$id]);

        $_SESSION['alerta'] = [
            'tipo'    => 'exito',
            'mensaje' => 'Categoría eliminada exitosamente.',
        ];
    }
} catch (PDOException $e) {
    $_SESSION['alerta'] = [
        'tipo'    => 'error',
        'mensaje' => 'Error al eliminar la categoría.',
    ];
}

header('Location: listar_categorias.php');
exit;
