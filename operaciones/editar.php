<?php
/**
 * operaciones/editar.php
 *
 * Formulario para editar un curso existente.
 * Al guardar, el trigger de auditoría 'despues_actualizacion_curso' se ejecuta automáticamente en la BD.
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: listar.php');
    exit;
}

$categorias = $conexion->query("SELECT * FROM categorias ORDER BY nombre ASC")->fetchAll();
$niveles    = $conexion->query("SELECT * FROM niveles ORDER BY id ASC")->fetchAll();

$consulta = $conexion->prepare("SELECT * FROM cursos WHERE id = ?");
$consulta->execute([$id]);
$curso = $consulta->fetch();

if (!$curso) {
    header('Location: listar.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $titulo       = trim(filter_input(INPUT_POST, 'titulo',      FILTER_DEFAULT));
    $descripcion  = trim(filter_input(INPUT_POST, 'descripcion', FILTER_DEFAULT));
    $precio       = filter_input(INPUT_POST, 'precio',      FILTER_VALIDATE_FLOAT);
    $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);
    $id_nivel     = filter_input(INPUT_POST, 'id_nivel',     FILTER_VALIDATE_INT);

    if ($titulo && $precio !== false && $id_categoria && $id_nivel) {
        $consulta = $conexion->prepare(
            "UPDATE cursos SET titulo=?, descripcion=?, precio=?, categoria_id=?, id_nivel=? WHERE id=?"
        );
        $consulta->execute([$titulo, $descripcion, $precio, $id_categoria, $id_nivel, $id]);

        header('Location: listar.php');
        exit;
    } else {
        $error = 'Revisa los campos. Título, precio, categoría y nivel son obligatorios.';
    }
}

$titulo_pagina = 'Editar Curso';
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
                <span class="breadcrumb-actual">Editar Curso</span>
            </nav>
        </div>

        <main class="admin-main">
            <div class="contenedor-form">
                <div class="form-card">
                    <h2 class="form-titulo">Editar: <?= htmlspecialchars($curso['titulo'], ENT_QUOTES, 'UTF-8') ?></h2>

                    <?php if ($error): ?>
                        <div class="alerta-admin-error"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <?= csrf_campo() ?>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario">Título</label>
                            <input type="text" name="titulo"
                                   value="<?= htmlspecialchars($curso['titulo'], ENT_QUOTES, 'UTF-8') ?>"
                                   class="control-formulario" required>
                        </div>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario">Descripción</label>
                            <textarea name="descripcion" class="control-formulario" rows="3"><?= htmlspecialchars($curso['descripcion'], ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>

                        <div class="grid-2-col">
                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario">Precio (€)</label>
                                <input type="number" step="0.01" name="precio"
                                       value="<?= $curso['precio'] ?>"
                                       class="control-formulario" required>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario">Categoría</label>
                                <select name="id_categoria" class="control-formulario" required>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?= $categoria['id'] ?>"
                                            <?= $categoria['id'] == $curso['categoria_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($categoria['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario">Nivel</label>
                                <select name="id_nivel" class="control-formulario" required>
                                    <?php foreach ($niveles as $nivel): ?>
                                        <option value="<?= $nivel['id'] ?>"
                                            <?= $nivel['id'] == $curso['id_nivel'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($nivel['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="botones-accion">
                            <button type="submit" class="btn btn-primario">Actualizar Curso</button>
                            <a href="listar.php" class="btn btn-secundario">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
