<?php
/**
 * iniciar_sesion.php
 *
 * Página de inicio de sesión de EDUIAIO.
 * Procesa el formulario POST, verifica credenciales contra la BD
 * y, si son correctas, inicia la sesión y redirige al panel.
 */

require_once __DIR__ . '/bootstrap.php';

// ── Si ya está logueado, redirigir directamente al panel ──────────────
if (isset($_SESSION['id_usuario'])) {
    header('Location: ' . APP_URL . '/panel.php');
    exit;
}

// ── Procesamiento del formulario ──────────────────────────────────────
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $correo    = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $contrasena = $_POST['contrasena'] ?? '';

    if ($correo && $contrasena) {
        // Buscar el usuario por email
        $consulta = $conexion->prepare(
            "SELECT id, usuario, clave, rol FROM usuarios WHERE email = :correo"
        );
        $consulta->execute(['correo' => $correo]);
        $usuario = $consulta->fetch();

        // Verificar contraseña con hash bcrypt
        if ($usuario && password_verify($contrasena, $usuario['clave'])) {
            // Regenerar ID de sesión para prevenir session fixation
            session_regenerate_id(true);

            // Inicio de sesión exitoso — guardar datos en sesión
            $_SESSION['id_usuario']      = $usuario['id'];
            $_SESSION['nombre_usuario']  = $usuario['usuario'];
            $_SESSION['rol']             = $usuario['rol'];

            header('Location: ' . APP_URL . '/panel.php');
            exit;
        } else {
            $error = 'Correo o contraseña incorrectos.';
        }
    } else {
        $error = 'Por favor, completa todos los campos.';
    }
}

// ── Variables para el fragmento <head> ───────────────────────────────
$titulo_pagina = 'Iniciar Sesión';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'vistas/fragmentos/head.php'; ?>
</head>

<body>
    <div class="contenedor-login">
        <div class="tarjeta-login">

            <!-- Cabecera de la tarjeta -->
            <div class="cabecera-login">
                <h1>EDUIAIO</h1>
                <p>Bienvenido de nuevo</p>
            </div>

            <!-- Mensaje de error (si lo hay) -->
            <?php if ($error): ?>
                <div class="alerta-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Formulario de login -->
            <form method="POST" action="">
                <?= csrf_campo() ?>

                <div class="grupo-formulario">
                    <label class="etiqueta-formulario" for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo"
                           class="control-formulario"
                           placeholder="admin@eduiaio.com" required>
                </div>

                <div class="grupo-formulario">
                    <label class="etiqueta-formulario" for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena"
                           class="control-formulario"
                           placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-primario btn-login">
                    Iniciar Sesión
                </button>

            </form>

            <!-- Credenciales de demo (solo en entorno de desarrollo) -->
            <?php if (APP_ENV === 'development'): ?>
            <div class="info-credenciales">
                <p>Credenciales Demo:</p>
                <code>admin@eduiaio.com / password</code>
            </div>
            <?php endif; ?>

            <!-- Enlace a registro -->
            <div class="pie-login" style="text-align: center; margin-top: 1.5rem; border-top: 1px solid var(--borde-color); padding-top: 1rem;">
                <p style="color: var(--texto-secundario);">
                    ¿Eres alumno nuevo?
                    <a href="registro.php" style="color: var(--color-primario); text-decoration: none; font-weight: 500;">
                        Regístrate aquí
                    </a>
                </p>
            </div>

        </div>
    </div>
</body>

</html>