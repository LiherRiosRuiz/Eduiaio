<?php
/**
 * configuracion.php
 *
 * Ajustes de la cuenta para el estudiante.
 * Cambio de contraseña y preferencias de seguridad.
 */

require_once __DIR__ . '/bootstrap.php';

// Verificar acceso
requerir_sesion();

$id_usuario = $_SESSION['id_usuario'];
$mensaje = '';

// Procesar cambio de contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiar_clave'])) {
    csrf_verificar();
    $actual = $_POST['clave_actual'] ?? '';
    $nueva  = $_POST['clave_nueva'] ?? '';
    $rep    = $_POST['clave_rep'] ?? '';

    // Validaciones básicas
    if (empty($actual) || empty($nueva) || empty($rep)) {
        $mensaje = '<div class="alerta alerta-error">Todos los campos son obligatorios.</div>';
    } elseif ($nueva !== $rep) {
        $mensaje = '<div class="alerta alerta-error">Las nuevas contraseñas no coinciden.</div>';
    } elseif (strlen($nueva) < 6) {
        $mensaje = '<div class="alerta alerta-error">La nueva contraseña debe tener al menos 6 caracteres.</div>';
    } else {
        // Verificar contraseña actual
        $stmt = $conexion->prepare("SELECT clave FROM usuarios WHERE id = ?");
        $stmt->execute([$id_usuario]);
        $hash = $stmt->fetchColumn();

        if (password_verify($actual, $hash)) {
            // Actualizar
            $nuevo_hash = password_hash($nueva, PASSWORD_DEFAULT);
            $update = $conexion->prepare("UPDATE usuarios SET clave = ? WHERE id = ?");
            $update->execute([$nuevo_hash, $id_usuario]);
            $mensaje = '<div class="alerta alerta-exito">Contraseña actualizada correctamente.</div>';
        } else {
            $mensaje = '<div class="alerta alerta-error">La contraseña actual es incorrecta.</div>';
        }
    }
}

$titulo_pagina = 'Configuración';
$fuente = 'Outfit';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'vistas/fragmentos/head.php'; ?>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
        }
        .seccion-config {
            background: white;
            padding: 2rem;
            border-radius: var(--radio-lg);
            box-shadow: var(--sombra-sm);
            border: 1px solid #e2e8f0;
            max-width: 600px;
            margin-bottom: 2rem;
        }
        .grupo-input {
            margin-bottom: 1.25rem;
        }
        .grupo-input label {
            display: block;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.4rem;
            color: #475569;
        }
        .grupo-input input {
            width: 100%;
            padding: 0.7rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }
        .alerta {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .alerta-exito { background: #d1fae5; color: #065f46; border: 1px solid #34d399; }
        .alerta-error { background: #fee2e2; color: #991b1b; border: 1px solid #f87171; }
    </style>
</head>

<body>
    <?php include 'vistas/fragmentos/nav_estudiante.php'; ?>

    <main class="contenedor">
        <div style="margin: 3rem 0;">
            <h1 style="color: var(--color-primario);">Configuración de Cuenta</h1>
            <p style="color: var(--texto-secundario);">Administra la seguridad y ajustes de tu cuenta.</p>
        </div>

        <?= $mensaje ?>

        <!-- Seguridad: Cambio de Contraseña -->
        <div class="seccion-config">
            <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.5rem;">
                Seguridad: Cambiar Contraseña
            </h2>
            <form action="configuracion.php" method="POST">
                <?= csrf_campo() ?>
                <div class="grupo-input">
                    <label for="clave_actual">Contraseña Actual</label>
                    <input type="password" id="clave_actual" name="clave_actual" required>
                </div>
                <div class="grupo-input">
                    <label for="clave_nueva">Nueva Contraseña</label>
                    <input type="password" id="clave_nueva" name="clave_nueva" required>
                </div>
                <div class="grupo-input">
                    <label for="clave_rep">Repetir Nueva Contraseña</label>
                    <input type="password" id="clave_rep" name="clave_rep" required>
                </div>
                <button type="submit" name="cambiar_clave" class="btn btn-primario" style="margin-top: 1rem;">
                    Guardar Cambios
                </button>
            </form>
        </div>

        <!-- Otros ajustes (informativo por ahora) -->
        <div class="seccion-config">
            <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.5rem;">
                Preferencias de Notificación
            </h2>
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <div>
                    <h4 style="font-weight: 600;">Notificaciones por Email</h4>
                    <p style="font-size: 0.85rem; color: #64748b;">Recibe avisos sobre nuevos cursos y avisos de la plataforma.</p>
                </div>
                <input type="checkbox" checked disabled style="width: 20px; height: 20px; cursor: not-allowed;">
            </div>
            <p style="font-size: 0.8rem; color: #94a3b8; font-style: italic;">
                * Algunas preferencias de sistema son gestionadas automáticamente para asegurar tu aprendizaje.
            </p>
        </div>

    </main>
</body>

</html>
