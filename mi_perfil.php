<?php
/**
 * mi_perfil.php
 *
 * Página de perfil del estudiante.
 * Permite ver y actualizar los datos personales.
 */

require_once __DIR__ . '/bootstrap.php';

// Verificar acceso
requerir_sesion();

$id_usuario = $_SESSION['id_usuario'];
$mensaje = '';

// Procesar actualización de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verificar();
    $nombre = $_POST['nombre_completo'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $genero = $_POST['genero'] ?? '';

    try {
        $stmt = $conexion->prepare("
            UPDATE usuarios 
            SET nombre_completo = ?, email = ?, telefono = ?, direccion = ?, genero = ? 
            WHERE id = ?
        ");
        $stmt->execute([$nombre, $email, $telefono, $direccion, $genero, $id_usuario]);
        
        // Actualizar nombre en sesión por si acaso se usa en la navegación
        $_SESSION['nombre_usuario'] = $nombre ? explode(' ', $nombre)[0] : $_SESSION['usuario'];
        
        $mensaje = '<div class="alerta alerta-exito">Perfil actualizado correctamente.</div>';
    } catch (PDOException $e) {
        $mensaje = '<div class="alerta alerta-error">Error al actualizar: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}

// Obtener datos actuales del usuario
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id_usuario]);
$usuario = $stmt->fetch();

$titulo_pagina = 'Mi Perfil';
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
        .form-perfil {
            background: white;
            padding: 2.5rem;
            border-radius: var(--radio-lg);
            box-shadow: var(--sombra-md);
            border: 1px solid #e2e8f0;
            max-width: 700px;
            margin: 2rem auto;
        }
        .grupo-input {
            margin-bottom: 1.5rem;
        }
        .grupo-input label {
            display: block;
            font-weight: 500;
            color: var(--texto-principal);
            margin-bottom: 0.5rem;
        }
        .grupo-input input, .grupo-input select, .grupo-input textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.2s;
        }
        .grupo-input input:focus {
            border-color: #4f46e5;
        }
        .alerta {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .alerta-exito {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #34d399;
        }
        .alerta-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
        }
    </style>
</head>

<body>
    <?php include 'vistas/fragmentos/nav_estudiante.php'; ?>

    <main class="contenedor">
        <div style="margin: 3rem 0;">
            <a href="panel_estudiante.php" class="text-sm text-indigo-600 hover:underline">← Volver al Panel</a>
            <h1 style="color: var(--color-primario); margin-top: 1rem;">Mi Perfil</h1>
            <p style="color: var(--texto-secundario);">Gestiona tu información personal y mantén tu cuenta actualizada.</p>
        </div>

        <?= $mensaje ?>

        <div class="form-perfil">
            <form action="mi_perfil.php" method="POST">
                <?= csrf_campo() ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <div class="grupo-input">
                        <label for="usuario">Nombre de Usuario</label>
                        <input type="text" id="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" disabled style="background: #f1f5f9; cursor: not-allowed;">
                        <small style="color: #64748b;">El nombre de usuario no se puede cambiar.</small>
                    </div>
                    
                    <div class="grupo-input">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                    </div>
                </div>

                <div class="grupo-input">
                    <label for="nombre_completo">Nombre Completo</label>
                    <input type="text" id="nombre_completo" name="nombre_completo" value="<?= htmlspecialchars($usuario['nombre_completo']) ?>" placeholder="Ej: Juan Pérez García">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <div class="grupo-input">
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>" placeholder="Ej: 600 000 000">
                    </div>
                    
                    <div class="grupo-input">
                        <label for="genero">Género</label>
                        <select id="genero" name="genero">
                            <option value="" <?= empty($usuario['genero']) ? 'selected' : '' ?>>Prefiero no decirlo</option>
                            <option value="M" <?= $usuario['genero'] === 'M' ? 'selected' : '' ?>>Masculino</option>
                            <option value="F" <?= $usuario['genero'] === 'F' ? 'selected' : '' ?>>Femenino</option>
                            <option value="O" <?= $usuario['genero'] === 'O' ? 'selected' : '' ?>>Otro</option>
                        </select>
                    </div>
                </div>

                <div class="grupo-input">
                    <label for="direccion">Dirección</label>
                    <textarea id="direccion" name="direccion" rows="2" placeholder="Tu dirección actual"><?= htmlspecialchars($usuario['direccion']) ?></textarea>
                </div>

                <div style="margin-top: 2rem;">
                    <button type="submit" class="btn btn-primario" style="width: 100%; padding: 0.85rem;">Actualizar Perfil</button>
                </div>
            </form>

            <hr style="margin: 2rem 0; border: 0; border-top: 1px solid #e2e8f0;">
            
            <div style="text-center">
                <p style="font-size: 0.9rem; color: #64748b;">¿Quieres cambiar tu contraseña? Ve a <a href="configuracion.php" class="text-indigo-600 hover:underline">Configuración de Cuenta</a>.</p>
            </div>
        </div>
    </main>
</body>

</html>
