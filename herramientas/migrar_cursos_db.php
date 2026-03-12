<?php
require_once '../configuracion/conexion.php';

try {
    $sql = file_get_contents('../base_de_datos/actualizacion_cursos.sql');
    $conexion->exec($sql);
    echo "Tablas de cursos, módulos y lecciones creadas correctamente.";
} catch (PDOException $e) {
    echo "Error al migrar la base de datos: " . $e->getMessage();
}
?>
