<?php
/**
 * vistas/fragmentos/nav_estudiante.php
 *
 * Barra de navegación superior del panel de estudiante.
 *
 * Variables esperadas:
 *   $_SESSION['nombre_usuario']  — nombre del usuario logueado.
 *
 * Uso:
 *   include ROOT . '/vistas/fragmentos/nav_estudiante.php';
 */
?>
<header class="cabecera-navegacion cabecera-estudiante">
    <div class="contenedor contenido-navegacion">

        <!-- Logo / nombre con estilo de alumno -->
        <h2 class="titulo-panel" style="color: white;">
            EDUIAIO <span style="opacity: 0.8; font-weight: 300;">Alumno</span>
        </h2>

        <!-- Info del usuario y cierre de sesión -->
        <div class="info-usuario">
            <span style="color: white;">
                Hola, <strong><?= htmlspecialchars($_SESSION['nombre_usuario']) ?></strong>
            </span>
            <a href="<?= APP_URL ?>/cerrar_sesion.php"
               class="btn btn-peligro texto-pequeno"
               style="border: 1px solid rgba(255,255,255,0.2);">
                Cerrar Sesión
            </a>
        </div>

    </div>
</header>
