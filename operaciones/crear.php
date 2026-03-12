<?php
/**
 * operaciones/crear.php
 *
 * Formulario para crear un nuevo curso.
 * Carga las categorías disponibles para el desplegable (FK).
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

$consulta  = $conexion->query("SELECT * FROM categorias ORDER BY nombre ASC");
$categorias = $consulta->fetchAll();

$consulta_niveles = $conexion->query("SELECT * FROM niveles ORDER BY id ASC");
$niveles = $consulta_niveles->fetchAll();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $titulo       = trim(filter_input(INPUT_POST, 'titulo',      FILTER_DEFAULT));
    $descripcion  = trim(filter_input(INPUT_POST, 'descripcion', FILTER_DEFAULT));
    $precio       = filter_input(INPUT_POST, 'precio',      FILTER_VALIDATE_FLOAT);
    $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);
    $id_nivel     = filter_input(INPUT_POST, 'id_nivel',     FILTER_VALIDATE_INT);

    if ($titulo && $precio !== false && $id_categoria && $id_nivel) {
        try {
            $consulta = $conexion->prepare(
                "INSERT INTO cursos (titulo, descripcion, precio, categoria_id, id_nivel, creado_por)
                 VALUES (?, ?, ?, ?, ?, ?)"
            );
            $consulta->execute([$titulo, $descripcion, $precio, $id_categoria, $id_nivel, $_SESSION['id_usuario']]);

            header('Location: listar.php');
            exit;
        } catch (PDOException $e) {
            $error = 'Error al guardar el curso. Inténtalo de nuevo.';
        }
    } else {
        $error = 'El título, precio, categoría y nivel son obligatorios.';
    }
}

$titulo_pagina = 'Nuevo Curso';
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
                <a href="listar.php">Cursos</a>
                <span class="breadcrumb-sep">›</span>
                <span class="breadcrumb-actual">Nuevo Curso</span>
            </nav>
        </div>

        <main class="admin-main">
            <div class="contenedor-form">
                <div class="form-card">
                    <h2 class="form-titulo">Añadir Nuevo Curso</h2>

                    <?php if ($error): ?>
                        <div class="alerta-admin-error"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <?= csrf_campo() ?>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario">Título del Curso</label>
                            <input type="text" name="titulo" class="control-formulario"
                                   placeholder="Ej: Iniciación al Móvil" required>
                        </div>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario">Descripción</label>
                            <textarea name="descripcion" class="control-formulario" rows="3"
                                      placeholder="Detalles del contenido del curso..."></textarea>
                        </div>

                        <div class="grid-2-col">
                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario">Precio (€)</label>
                                <input type="number" step="0.01" name="precio" class="control-formulario"
                                       placeholder="0.00" required>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario">Categoría</label>
                                <select name="id_categoria" class="control-formulario" required>
                                    <option value="">Seleccione una categoría...</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?= $categoria['id'] ?>">
                                            <?= htmlspecialchars($categoria['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario">Nivel</label>
                                <select name="id_nivel" class="control-formulario" required>
                                    <option value="">Seleccione un nivel...</option>
                                    <?php foreach ($niveles as $nivel): ?>
                                        <option value="<?= $nivel['id'] ?>">
                                            <?= htmlspecialchars($nivel['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="botones-accion">
                            <button type="submit" class="btn btn-primario">Guardar Curso</button>
                            <a href="listar.php" class="btn btn-secundario">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
