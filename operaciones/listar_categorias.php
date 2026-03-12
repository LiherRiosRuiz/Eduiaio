<?php
/**
 * operaciones/listar_categorias.php
 *
 * Lista todas las categorías de la plataforma en una tabla.
 * Permite crear, editar y eliminar categorías.
 * Acceso restringido: solo usuarios con sesión activa (admin).
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

$consulta   = $conexion->query("SELECT * FROM categorias ORDER BY nombre ASC");
$categorias = $consulta->fetchAll();

$alerta = $_SESSION['alerta'] ?? null;
unset($_SESSION['alerta']);

$titulo_pagina = 'Gestión de Categorías';
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
            <div>
                <nav class="breadcrumb">
                    <a href="<?= APP_URL ?>/panel.php">Dashboard</a>
                    <span class="breadcrumb-sep">›</span>
                    <span class="breadcrumb-actual">Categorías</span>
                </nav>
                <h1 class="form-titulo" style="margin-top:0.35rem;">Gestión de Categorías</h1>
            </div>
            <a href="crear_categoria.php" class="btn-nuevo-admin">+ Nueva Categoría</a>
        </div>

        <main class="admin-main">

            <?php if ($alerta): ?>
                <div class="alerta-admin-<?= $alerta['tipo'] === 'exito' ? 'exito' : 'error' ?>">
                    <?= htmlspecialchars($alerta['mensaje']) ?>
                </div>
            <?php endif; ?>

            <div class="tabla-admin-wrapper">
                <table class="tabla-base" id="tabla-categorias">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th class="td-derecha">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr class="fila-tabla">
                                <td style="font-weight:500;">#<?= $categoria['id'] ?></td>

                                <td>
                                    <div class="titulo-curso">
                                        <?= htmlspecialchars($categoria['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                    </div>
                                </td>

                                <td class="descripcion-curso">
                                    <?= htmlspecialchars(substr($categoria['descripcion'] ?? '', 0, 60), ENT_QUOTES, 'UTF-8') ?>
                                    <?php if (strlen($categoria['descripcion'] ?? '') > 60): ?>...<?php endif; ?>
                                </td>

                                <td class="td-derecha">
                                    <a href="editar_categoria.php?id=<?= $categoria['id'] ?>" class="btn-tabla-editar">
                                        Editar
                                    </a>
                                    <form method="POST" action="eliminar_categoria.php" style="display:inline;"
                                          onsubmit="return confirm('¿Seguro que quieres eliminar esta categoría?');">
                                        <?= csrf_campo() ?>
                                        <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
                                        <button type="submit" class="btn-tabla-eliminar">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if (empty($categorias)): ?>
                    <div class="mensaje-vacio">No hay categorías registradas. ¡Crea la primera!</div>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-categorias').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' },
                order: [[0, 'asc']],
                columnDefs: [{ orderable: false, targets: 3 }],
                pageLength: 10,
                responsive: true
            });
        });
    </script>
</body>
</html>
