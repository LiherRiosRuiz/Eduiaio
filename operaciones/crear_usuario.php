<?php
/**
 * operaciones/crear_usuario.php
 *
 * Formulario para que un administrador cree un nuevo usuario del sistema.
 */

require_once __DIR__ . '/../bootstrap.php';
requerir_sesion();

$error   = '';
$mensaje = '';

$consulta_niveles = $conexion->query("SELECT * FROM niveles ORDER BY id ASC");
$niveles = $consulta_niveles->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
    $correo         = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $contrasena     = $_POST['contrasena'] ?? '';
    $rol            = $_POST['rol'] ?? '';
    $telefono       = trim($_POST['telefono'] ?? '');

    if (!$nombre_usuario || !$correo || !$contrasena || !$rol) {
        $error = 'Usuario, correo, contraseña y rol son obligatorios.';
    } elseif (!empty($telefono) && !preg_match('/^[0-9]+$/', $telefono)) {
        $error = 'El teléfono solo puede contener números.';
    } else {
        try {
            $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = :usuario OR email = :email");
            $stmt->execute(['usuario' => $nombre_usuario, 'email' => $correo]);

            if ($stmt->rowCount() > 0) {
                $error = 'El nombre de usuario o correo ya existen.';
            } else {
                $insertar = $conexion->prepare("
                    INSERT INTO usuarios
                        (usuario, email, clave, rol, nombre_completo, telefono, direccion, fecha_nacimiento, genero, id_nivel, notas)
                    VALUES
                        (:usuario, :email, :clave, :rol, :nombre_completo, :telefono, :direccion, :fecha_nacimiento, :genero, :id_nivel, :notas)
                ");
                $insertar->execute([
                    'usuario'          => $nombre_usuario,
                    'email'            => $correo,
                    'clave'            => password_hash($contrasena, PASSWORD_DEFAULT),
                    'rol'              => $rol,
                    'nombre_completo'  => $_POST['nombre_completo'] ?? null,
                    'telefono'         => !empty($telefono) ? $telefono : null,
                    'direccion'        => $_POST['direccion']       ?? null,
                    'fecha_nacimiento' => !empty($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : null,
                    'genero'           => !empty($_POST['genero'])  ? $_POST['genero'] : null,
                    'id_nivel'         => !empty($_POST['id_nivel']) ? $_POST['id_nivel'] : null,
                    'notas'            => $_POST['notas']           ?? null,
                ]);

                $mensaje = 'Usuario creado correctamente.';
            }
        } catch (PDOException $e) {
            $error = 'Error al crear el usuario. Inténtalo de nuevo.';
        }
    }
}

$titulo_pagina = 'Nuevo Usuario';
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
                <span class="breadcrumb-actual">Nuevo Usuario</span>
            </nav>
        </div>

        <main class="admin-main">
            <div class="contenedor-form">
                <div class="form-card">
                    <h2 class="form-titulo">Crear Usuario</h2>

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
                            <input type="text" id="nombre_usuario" name="nombre_usuario"
                                   class="control-formulario" required>
                        </div>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario" for="correo">Correo Electrónico</label>
                            <input type="email" id="correo" name="correo"
                                   class="control-formulario" required>
                        </div>

                        <div class="grupo-formulario">
                            <label class="etiqueta-formulario" for="contrasena">Contraseña</label>
                            <input type="password" id="contrasena" name="contrasena"
                                   class="control-formulario" required>
                        </div>

                        <div class="grid-2-col">
                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="rol">Rol</label>
                                <select id="rol" name="rol" class="control-formulario">
                                    <option value="estudiante">Estudiante</option>
                                    <option value="profesor">Profesor</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="id_nivel">Nivel del Usuario</label>
                                <select id="id_nivel" name="id_nivel" class="control-formulario">
                                    <option value="">Sin nivel asignado</option>
                                    <?php foreach ($niveles as $nivel): ?>
                                        <option value="<?= $nivel['id'] ?>">
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
                                <input type="text" id="nombre_completo" name="nombre_completo"
                                       class="control-formulario" placeholder="Ej. Juan Pérez">
                            </div>

                            <div class="grid-2-col">
                                <div class="grupo-formulario">
                                    <label class="etiqueta-formulario" for="telefono">Teléfono</label>
                                    <input type="tel" id="telefono" name="telefono"
                                           class="control-formulario" placeholder="Ej. 600000000"
                                           pattern="[0-9]+" title="Solo se permiten números">
                                </div>
                                <div class="grupo-formulario">
                                    <label class="etiqueta-formulario" for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                           class="control-formulario">
                                </div>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="genero">Género</label>
                                <select id="genero" name="genero" class="control-formulario">
                                    <option value="">Seleccionar...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="O">Otro</option>
                                </select>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="direccion">Dirección</label>
                                <textarea id="direccion" name="direccion"
                                          class="control-formulario" rows="2"></textarea>
                            </div>

                            <div class="grupo-formulario">
                                <label class="etiqueta-formulario" for="notas">Notas Administrativas</label>
                                <textarea id="notas" name="notas"
                                          class="control-formulario" rows="3"
                                          placeholder="Observaciones internas..."></textarea>
                            </div>
                        </div>

                        <div class="botones-accion">
                            <button type="submit" class="btn btn-primario">Crear Usuario</button>
                            <a href="listar_usuarios.php" class="btn btn-secundario">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
