<?php
/**
 * operaciones/editar_usuario.php
 *
 * Formulario para editar los datos de un usuario existente.
 * La contraseña solo se actualiza si se introduce una nueva.
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: listar_usuarios.php');
    exit;
}

$error   = '';
$mensaje = '';

$consulta_niveles = $conexion->query("SELECT * FROM niveles ORDER BY id ASC");
$niveles = $consulta_niveles->fetchAll();

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch();

if (!$usuario) {
    header('Location: listar_usuarios.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $nombre_usuario   = trim($_POST['nombre_usuario'] ?? '');
    $correo           = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $rol              = $_POST['rol'] ?? '';
    $nueva_contrasena = $_POST['contrasena'] ?? '';
    $telefono         = trim($_POST['telefono'] ?? '');

    if ($nombre_usuario && $correo && $rol) {
        if (!empty($telefono) && !preg_match('/^[0-9]+$/', $telefono)) {
            $error = 'El teléfono solo puede contener números.';
        } else {
            try {
                $campos_extra = [
                    'nombre_completo'  => $_POST['nombre_completo'] ?? null,
                    'telefono'         => !empty($telefono) ? $telefono : null,
                    'direccion'        => $_POST['direccion']       ?? null,
                    'fecha_nacimiento' => !empty($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : null,
                    'genero'           => !empty($_POST['genero'])  ? $_POST['genero'] : null,
                    'id_nivel'         => !empty($_POST['id_nivel']) ? $_POST['id_nivel'] : null,
                    'notas'            => $_POST['notas']           ?? null,
                ];

                if (!empty($nueva_contrasena)) {
                    $sql = "UPDATE usuarios SET usuario=:usuario, email=:email, rol=:rol, clave=:clave,
                            nombre_completo=:nombre_completo, telefono=:telefono, direccion=:direccion,
                            fecha_nacimiento=:fecha_nacimiento, genero=:genero, id_nivel=:id_nivel, notas=:notas WHERE id=:id";
                    $params = array_merge(
                        ['usuario' => $nombre_usuario, 'email' => $correo, 'rol' => $rol,
                         'clave'  => password_hash($nueva_contrasena, PASSWORD_DEFAULT), 'id' => $id],
                        $campos_extra
                    );
                } else {
                    $sql = "UPDATE usuarios SET usuario=:usuario, email=:email, rol=:rol,
                            nombre_completo=:nombre_completo, telefono=:telefono, direccion=:direccion,
                            fecha_nacimiento=:fecha_nacimiento, genero=:genero, id_nivel=:id_nivel, notas=:notas WHERE id=:id";
                    $params = array_merge(
                        ['usuario' => $nombre_usuario, 'email' => $correo, 'rol' => $rol, 'id' => $id],
                        $campos_extra
                    );
                }

                $conexion->prepare($sql)->execute($params);
                $mensaje = 'Usuario actualizado correctamente.';
                $usuario = array_merge($usuario, ['usuario' => $nombre_usuario, 'email' => $correo, 'rol' => $rol], $campos_extra);

            } catch (PDOException $e) {
                $error = 'Error al actualizar el usuario. Inténtalo de nuevo.';
            }
        }
    } else {
        $error = 'Usuario, correo y rol son obligatorios.';
    }
}

$titulo_pagina = 'Editar Usuario';
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
                <a href="listar_usuarios.php">Usuarios</a>
                <span class="breadcrumb-sep">›</span>
                <span class="breadcrumb-actual">Editar Usuario #<?= $usuario['id'] ?></span>
            </nav>
        </div>

        <main class="admin-main">
            <div class="contenedor-form">
                <div class="form-card">
                    <h2 class="form-titulo">Editar: <?= htmlspecialchars($usuario['usuario']) ?></h2>

                    <?php if ($error): ?>
                        <div class="alerta-admin-error"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <?php if ($mensaje): ?>
                        <div class="alerta-admin-exito"><?= htmlspecialchars($mensaje) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <?= csrf_campo() ?>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario" for="nombre_usuario">Nombre de Usuario</label>
                            <input type="text" id="nombre_usuario" name="nombre_usuario" class="control-formulario"
                                   value="<?= htmlspecialchars($usuario['usuario']) ?>" required>
                        </div>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario" for="correo">Correo Electrónico</label>
                            <input type="email" id="correo" name="correo" class="control-formulario"
                                   value="<?= htmlspecialchars($usuario['email']) ?>" required>
                        </div>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario" for="contrasena">Nueva Contraseña <span style="color:#94a3b8;font-weight:400;">(dejar en blanco para no cambiar)</span></label>
                            <input type="password" id="contrasena" name="contrasena" class="control-formulario" placeholder="••••••••">
                        </div>

                        <div class="grid-2-col">
                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="rol">Rol</label>
                                <select id="rol" name="rol" class="control-formulario">
                                    <option value="estudiante" <?= $usuario['rol'] == 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
                                    <option value="profesor"   <?= $usuario['rol'] == 'profesor'   ? 'selected' : '' ?>>Profesor</option>
                                    <option value="admin"      <?= $usuario['rol'] == 'admin'      ? 'selected' : '' ?>>Administrador</option>
                                </select>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="id_nivel">Nivel del Usuario</label>
                                <select id="id_nivel" name="id_nivel" class="control-formulario">
                                    <option value="">Sin nivel asignado</option>
                                    <?php foreach ($niveles as $nivel): ?>
                                        <option value="<?= $nivel['id'] ?>" <?= ($usuario['id_nivel'] ?? '') == $nivel['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($nivel['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Datos personales opcionales -->
                        <div class="form-seccion">
                            <h3 class="form-seccion-titulo">Información Personal</h3>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="nombre_completo">Nombre Completo</label>
                                <input type="text" id="nombre_completo" name="nombre_completo" class="control-formulario"
                                       value="<?= htmlspecialchars($usuario['nombre_completo'] ?? '') ?>" placeholder="Ej. Juan Pérez">
                            </div>

                            <div class="grid-2-col">
                                <div class="grupo-formulario">
                                    <label class="etiqueta-formulario" for="telefono">Teléfono</label>
                                    <input type="tel" id="telefono" name="telefono" class="control-formulario"
                                           value="<?= htmlspecialchars($usuario['telefono'] ?? '') ?>"
                                           placeholder="Ej. 600000000" pattern="[0-9]+" title="Solo se permiten números">
                                </div>
                                <div class="grupo-formulario">
                                    <label class="etiqueta-formulario" for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="control-formulario"
                                           value="<?= htmlspecialchars($usuario['fecha_nacimiento'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="genero">Género</label>
                                <select id="genero" name="genero" class="control-formulario">
                                    <option value="">Seleccionar...</option>
                                    <option value="M" <?= ($usuario['genero'] ?? '') == 'M' ? 'selected' : '' ?>>Masculino</option>
                                    <option value="F" <?= ($usuario['genero'] ?? '') == 'F' ? 'selected' : '' ?>>Femenino</option>
                                    <option value="O" <?= ($usuario['genero'] ?? '') == 'O' ? 'selected' : '' ?>>Otro</option>
                                </select>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="direccion">Dirección</label>
                                <textarea id="direccion" name="direccion" class="control-formulario" rows="2"><?= htmlspecialchars($usuario['direccion'] ?? '') ?></textarea>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="notas">Notas Administrativas</label>
                                <textarea id="notas" name="notas" class="control-formulario" rows="3"
                                          placeholder="Observaciones internas..."><?= htmlspecialchars($usuario['notas'] ?? '') ?></textarea>
                            </div>
                        </div>

                        <div class="botones-accion">
                            <button type="submit" class="btn btn-primario">Actualizar Usuario</button>
                            <a href="listar_usuarios.php" class="btn btn-secundario">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
