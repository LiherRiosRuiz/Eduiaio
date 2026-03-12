<?php
/**
 * operaciones/crear_categoria.php
 *
 * Formulario para crear una nueva categoría de cursos.
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

$error   = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $nombre      = trim(filter_input(INPUT_POST, 'nombre',      FILTER_DEFAULT));
    $descripcion = trim(filter_input(INPUT_POST, 'descripcion', FILTER_DEFAULT));

    if ($nombre) {
        try {
            $check = $conexion->prepare("SELECT id FROM categorias WHERE nombre = :nombre");
            $check->execute(['nombre' => $nombre]);

            if ($check->rowCount() > 0) {
                $error = "La categoría '$nombre' ya existe.";
            } else {
                $stmt = $conexion->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (:nombre, :descripcion)");
                $stmt->execute(['nombre' => $nombre, 'descripcion' => $descripcion]);
                $mensaje = 'Categoría creada exitosamente.';
            }
        } catch (PDOException $e) {
            $error = 'Error al crear la categoría.';
        }
    } else {
        $error = 'El nombre es obligatorio.';
    }
}

$titulo_pagina = 'Nueva Categoría';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include ROOT . '/vistas/fragmentos/head.php'; ?>
    <link rel="stylesheet" href="<?= APP_URL ?>/recursos/estilos/paginas/panel.css">
</head>

<body class="panel-admin">

    <?php include ROOT . '/vistas/fragmentos/nav_admin.php'; ?>

    <div class="admin-contenido">

        <div class="admin-topbar">
            <nav class="breadcrumb">
                <a href="<?= APP_URL ?>/panel.php">Dashboard</a>
                <span class="breadcrumb-sep">›</span>
                <a href="listar_categorias.php">Categorías</a>
                <span class="breadcrumb-sep">›</span>
                <span class="breadcrumb-actual">Nueva Categoría</span>
            </nav>
        </div>

        <main class="admin-main">
            <div class="contenedor-form">
                <div class="form-card">
                    <h2 class="form-titulo">Nueva Categoría</h2>

                    <?php if ($error): ?>
                        <div class="alerta-admin-error"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <?php if ($mensaje): ?>
                        <div class="alerta-admin-exito"><?= htmlspecialchars($mensaje) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <?= csrf_campo() ?>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario" for="nombre">Nombre de la Categoría</label>
                            <input type="text" id="nombre" name="nombre" class="control-formulario" required>
                        </div>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario" for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion" class="control-formulario" rows="3"></textarea>
                        </div>

                        <div class="botones-accion">
                            <button type="submit" class="btn btn-primario">Guardar Categoría</button>
                            <a href="listar_categorias.php" class="btn btn-secundario">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
