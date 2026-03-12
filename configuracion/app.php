<?php
/**
 * configuracion/app.php
 *
 * Constantes globales de la aplicación.
 * No exponer directamente: protegido por configuracion/.htaccess
 */

// ── Entorno ───────────────────────────────────────────────────────────────
define('APP_ENV',  'development');   // 'development' | 'production'
define('APP_NAME', 'EDUIAIO');
define('APP_URL',  'http://localhost/eduiaio');  // Sin barra final

// ── Base de datos ─────────────────────────────────────────────────────────
define('DB_HOST',    'localhost');
define('DB_NAME',    'eduiaio');
define('DB_USER',    'root');
define('DB_PASS',    '');
define('DB_CHARSET', 'utf8mb4');

// ── Seguridad ─────────────────────────────────────────────────────────────
define('CSRF_TOKEN_NAME', '_csrf_token');
