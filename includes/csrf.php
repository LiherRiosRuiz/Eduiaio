<?php
/**
 * includes/csrf.php
 *
 * Protección CSRF mediante el patrón de token sincronizador.
 * La sesión debe estar activa antes de llamar a estas funciones.
 * bootstrap.php garantiza que la sesión esté iniciada antes de cargar este archivo.
 */

/**
 * Genera (o reutiliza) el token CSRF de la sesión actual.
 */
function csrf_token(): string
{
    if (empty($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

/**
 * Devuelve un campo <input> oculto listo para insertar en cualquier <form method="POST">.
 */
function csrf_campo(): string
{
    return '<input type="hidden" name="' . CSRF_TOKEN_NAME . '" value="' . csrf_token() . '">';
}

/**
 * Verifica el token CSRF del POST actual.
 * Si no coincide, devuelve 403 y detiene la ejecución.
 */
function csrf_verificar(): void
{
    $token_enviado = $_POST[CSRF_TOKEN_NAME] ?? '';
    $token_sesion  = $_SESSION[CSRF_TOKEN_NAME] ?? '';

    if (!$token_sesion || !hash_equals($token_sesion, $token_enviado)) {
        http_response_code(403);
        // Redirigir a la página anterior o al panel si no hay referrer
        $destino = $_SERVER['HTTP_REFERER'] ?? APP_URL . '/panel.php';
        header('Location: ' . $destino);
        exit;
    }
}
