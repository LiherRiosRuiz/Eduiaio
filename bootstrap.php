<?php
/**
 * bootstrap.php
 *
 * Punto de entrada central. Toda página PHP incluye este archivo.
 * Carga constantes, sesión, conexión PDO y helpers en el orden correcto.
 *
 * Uso desde raíz:         require_once __DIR__ . '/bootstrap.php';
 * Uso desde operaciones/: require_once __DIR__ . '/../bootstrap.php';
 * Uso desde tutoriales/:  require_once __DIR__ . '/../bootstrap.php';
 */

// Raíz absoluta del proyecto, disponible globalmente
define('ROOT', __DIR__);

// 1. Constantes de aplicación (APP_URL, DB_*, APP_ENV, etc.)
require_once ROOT . '/configuracion/app.php';

// 2. Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,          // Hasta que el navegador se cierre
        'path'     => '/',
        'secure'   => false,      // Cambiar a true cuando haya HTTPS
        'httponly' => true,       // Inaccesible desde JavaScript
        'samesite' => 'Lax',      // Protección CSRF básica a nivel de cookie
    ]);
    session_start();
}

// 3. Conexión PDO (crea $conexion en scope global)
require_once ROOT . '/configuracion/conexion.php';

// 4. Funciones de autenticación y control de acceso
require_once ROOT . '/includes/auth.php';

// 5. Funciones de utilidad generales
require_once ROOT . '/includes/funciones.php';

// 6. Funciones de protección CSRF
require_once ROOT . '/includes/csrf.php';
