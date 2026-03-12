<?php
/**
 * operaciones/listar_usuarios.php
 *
 * Lista todos los usuarios del sistema en una tabla.
 * Permite acceder a editar o eliminar cada usuario.
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

$consulta = $conexion->query("
    SELECT usuarios.*, niveles.nombre AS nombre_nivel
    FROM usuarios
    LEFT JOIN niveles ON usuarios.id_nivel = niveles.id
    ORDER BY usuarios.fecha_creacion DESC
");
$usuarios = $consulta->fetchAll();

$alerta = $_SESSION['alerta'] ?? null;
unset($_SESSION['alerta']);

$titulo_pagina = 'Gestión de Usuarios';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include ROOT . '/vistas/fragmentos/head.php'; ?>
    <link rel="stylesheet" href="<?= APP_URL ?>/recursos/estilos/paginas/panel.css">
    <style>
        .badge-rol      { display:inline-block; padding:0.25rem 0.5rem; border-radius:9999px; font-size:0.75rem; font-weight:500; }
        .rol-admin      { background:#fee2e2; color:#991b1b; }
        .rol-profesor   { background:#fef3c7; color:#92400e; }
        .rol-estudiante { background:#d1fae5; color:#065f46; }
    </style>
</head>

<body class="panel-admin">

    <?php include ROOT . '/vistas/fragmentos/nav_admin.php'; ?>

    <div class="admin-contenido">

        <div class="admin-topbar">
            <div>
                <nav class="breadcrumb">
                    <a href="<?= APP_URL ?>/panel.php">Dashboard</a>
                    <span class="breadcrumb-sep">›</span>
                    <span class="breadcrumb-actual">Usuarios</span>
                </nav>
                <h1 class="form-titulo" style="margin-top:0.35rem;">Lista de Usuarios</h1>
            </div>
            <a href="crear_usuario.php" class="btn-nuevo-admin">+ Nuevo Usuario</a>
        </div>

        <main class="admin-main">

            <?php if ($alerta): ?>
                <div class="alerta-admin-<?= $alerta['tipo'] === 'exito' ? 'exito' : 'error' ?>">
                    <?= htmlspecialchars($alerta['mensaje']) ?>
                </div>
            <?php endif; ?>

            <div class="tabla-admin-wrapper">
                <table class="tabla-base" id="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Nivel</th>
                            <th>Fecha Creación</th>
                            <th class="td-derecha">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr class="fila-tabla">
                                <td style="font-weight:500;">#<?= $usuario['id'] ?></td>
                                <td><?= htmlspecialchars($usuario['usuario']) ?></td>
                                <td><?= htmlspecialchars($usuario['nombre_completo'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>

                                <td>
                                    <span class="badge-rol <?= clase_badge_rol($usuario['rol']) ?>">
                                        <?= ucfirst($usuario['rol']) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="badge-nivel">
                                        <?= htmlspecialchars($usuario['nombre_nivel'] ?? 'Sin Nivel', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>

                                <td class="texto-secundario">
                                    <?= date('d/m/Y', strtotime($usuario['fecha_creacion'])) ?>
                                </td>

                                <td class="td-derecha">
                                    <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="btn-tabla-editar">
                                        Editar
                                    </a>
                                    <?php if ($usuario['id'] != $_SESSION['id_usuario']): ?>
                                        <form method="POST" action="eliminar_usuario.php" style="display:inline;"
                                              onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?');">
                                            <?= csrf_campo() ?>
                                            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                                            <button type="submit" class="btn-tabla-eliminar">Eliminar</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if (empty($usuarios)): ?>
                    <div class="mensaje-vacio">No hay usuarios registrados.</div>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-usuarios').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' },
                order: [[6, 'desc']],
                columnDefs: [{ orderable: false, targets: 7 }],
                pageLength: 10,
                responsive: true
            });
        });
    </script>
</body>
</html>
