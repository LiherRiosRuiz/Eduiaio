<?php
/**
 * registro.php
 *
 * Formulario de auto-registro para nuevos estudiantes.
 * Valida los datos, comprueba duplicados y crea el usuario en la BD.
 */

require_once __DIR__ . '/bootstrap.php';

// ── Si ya está logueado, redirigir directamente al panel ──────────────
if (isset($_SESSION['id_usuario'])) {
    header('Location: ' . APP_URL . '/panel.php');
    exit;
}

// ── Procesamiento del formulario ──────────────────────────────────────
$error   = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $nombre_usuario      = trim($_POST['nombre_usuario'] ?? '');
    $correo              = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $contrasena          = $_POST['contrasena'] ?? '';
    $confirmar_contrasena = $_POST['confirmar_contrasena'] ?? '';

    // Validaciones básicas
    if (!$nombre_usuario || !$correo || !$contrasena || !$confirmar_contrasena) {
        $error = 'Por favor, completa todos los campos.';
    } elseif ($contrasena !== $confirmar_contrasena) {
        $error = 'Las contraseñas no coinciden.';
    } elseif (strlen($contrasena) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres.';
    } else {
        // Verificar que el usuario o correo no estén ya registrados
        $stmt = $conexion->prepare(
            "SELECT id FROM usuarios WHERE usuario = :usuario OR email = :email"
        );
        $stmt->execute(['usuario' => $nombre_usuario, 'email' => $correo]);

        if ($stmt->rowCount() > 0) {
            $error = 'El nombre de usuario o correo ya están en uso.';
        } else {
            // Crear el nuevo usuario con rol de estudiante
            try {
                $hash = password_hash($contrasena, PASSWORD_DEFAULT);

                $insertar = $conexion->prepare(
                    "INSERT INTO usuarios (usuario, email, clave, rol)
                     VALUES (:usuario, :email, :clave, 'estudiante')"
                );
                $insertar->execute([
                    'usuario' => $nombre_usuario,
                    'email'   => $correo,
                    'clave'   => $hash,
                ]);

                $mensaje = '¡Cuenta creada con éxito! Ya puedes iniciar sesión.';
            } catch (PDOException $e) {
                $error = 'Error al crear la cuenta. Inténtalo de nuevo.';
            }
        }
    }
}

// ── Variables para el fragmento <head> ───────────────────────────────
$titulo_pagina = 'Registro';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'vistas/fragmentos/head.php'; ?>
</head>

<body>
    <div class="contenedor-login">
        <div class="tarjeta-login" style="max-width: 450px;">

            <!-- Cabecera -->
            <div class="cabecera-login">
                <h1>EDUIAIO</h1>
                <p>Crear nueva cuenta de Estudiante</p>
            </div>

            <!-- Mensaje de error -->
            <?php if ($error): ?>
                <div class="alerta-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Mensaje de éxito o formulario -->
            <?php if ($mensaje): ?>
                <div class="alerta-exito" style="background-color: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; text-align: center;">
                    <?= htmlspecialchars($mensaje) ?>
                    <br>
                    <a href="iniciar_sesion.php"
                       style="font-weight: 600; color: var(--color-primario); text-decoration: none; display: block; margin-top: 0.5rem;">
                        Ir a Iniciar Sesión
                    </a>
                </div>
            <?php else: ?>

                <!-- Formulario de registro -->
                <form method="POST" action="">
                    <?= csrf_campo() ?>

                    <div class="grupo-formulario">
                        <label class="etiqueta-formulario" for="nombre_usuario">Nombre de Usuario</label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario"
                               class="control-formulario" placeholder="ej. juanperez" required
                               value="<?= isset($_POST['nombre_usuario']) ? htmlspecialchars($_POST['nombre_usuario']) : '' ?>">
                    </div>

                    <div class="grupo-formulario">
                        <label class="etiqueta-formulario" for="correo">Correo Electrónico</label>
                        <input type="email" id="correo" name="correo"
                               class="control-formulario" placeholder="juan@ejemplo.com" required
                               value="<?= isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : '' ?>">
                    </div>

                    <div class="grupo-formulario">
                        <label class="etiqueta-formulario" for="contrasena">Contraseña</label>
                        <input type="password" id="contrasena" name="contrasena"
                               class="control-formulario" placeholder="••••••••" required>
                    </div>

                    <div class="grupo-formulario">
                        <label class="etiqueta-formulario" for="confirmar_contrasena">Confirmar Contraseña</label>
                        <input type="password" id="confirmar_contrasena" name="confirmar_contrasena"
                               class="control-formulario" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-primario btn-login">
                        Registrarse
                    </button>

                </form>

                <!-- Enlace a login -->
                <div class="pie-login" style="text-align: center; margin-top: 1.5rem;">
                    <p style="color: var(--texto-secundario);">
                        ¿Ya tienes cuenta?
                        <a href="iniciar_sesion.php"
                           style="color: var(--color-primario); text-decoration: none; font-weight: 500;">
                            Inicia Sesión
                        </a>
                    </p>
                </div>

            <?php endif; ?>
        </div>
    </div>
</body>

</html>
