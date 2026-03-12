<?php
/**
 * configuracion/conexion.php
 *
 * Conexión PDO a la base de datos.
 * Requiere que app.php haya sido cargado primero (via bootstrap.php).
 */

try {
    $conexion = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS
    );

    // Forzar UTF-8 en todas las consultas
    $conexion->exec("SET NAMES " . DB_CHARSET);

    // Lanzar excepciones en caso de error SQL
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Devolver arrays asociativos por defecto
    $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    if (APP_ENV === 'development') {
        die("Error de conexión: " . $e->getMessage());
    }
    die("Error de conexión. Por favor contacta al administrador.");
}
