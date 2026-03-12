<?php
/**
 * includes/auth.php
 *
 * Funciones de autenticación y control de acceso.
 * Requiere que APP_URL esté definida (via bootstrap.php → app.php).
 */

/**
 * Asegura que existe una sesión activa.
 * Si no hay usuario logueado, redirige al login y detiene la ejecución.
 */
function requerir_sesion(): void
{
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: ' . APP_URL . '/iniciar_sesion.php');
        exit;
    }
}

/**
 * Asegura que el usuario tiene un rol concreto.
 * Si el rol no coincide, redirige al panel general.
 *
 * @param string $rol_requerido Rol que debe tener el usuario ('admin', 'profesor', 'estudiante').
 */
function requerir_rol(string $rol_requerido): void
{
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== $rol_requerido) {
        header('Location: ' . APP_URL . '/panel.php');
        exit;
    }
}

/**
 * Devuelve verdadero si el usuario tiene el rol indicado.
 *
 * @param string $rol Rol a comprobar.
 */
function tiene_rol(string $rol): bool
{
    return isset($_SESSION['rol']) && $_SESSION['rol'] === $rol;
}
