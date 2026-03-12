<?php
/**
 * operaciones/eliminar_usuario.php
 *
 * Elimina un usuario de la base de datos y redirige al listado.
 * Solo acepta peticiones POST con token CSRF válido.
 * Medida de seguridad: un administrador no puede eliminarse a sí mismo.
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

// Rechazar peticiones que no sean POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar_usuarios.php');
    exit;
}

csrf_verificar();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id) {
    // Impedir auto-eliminación
    if ($id == $_SESSION['id_usuario']) {
        $_SESSION['alerta'] = [
            'tipo'    => 'error',
            'mensaje' => 'No puedes eliminar tu propio usuario.',
        ];
        header('Location: listar_usuarios.php');
        exit;
    }

    try {
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        $_SESSION['alerta'] = [
            'tipo'    => 'error',
            'mensaje' => 'Error: Es posible que este usuario tenga cursos asociados.',
        ];
        header('Location: listar_usuarios.php');
        exit;
    }
}

header('Location: listar_usuarios.php');
exit;
