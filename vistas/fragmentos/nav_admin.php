<?php
/**
 * vistas/fragmentos/nav_admin.php
 *
 * Sidebar de navegación del panel de administración.
 * Detecta la página activa comparando basename() con el archivo actual.
 *
 * Variables de sesión requeridas:
 *   $_SESSION['nombre_usuario']  — nombre del usuario logueado.
 *   $_SESSION['rol']             — rol del usuario (ej: 'administrador').
 *
 * Uso:
 *   include ROOT . '/vistas/fragmentos/nav_admin.php';
 */

$pagina_actual = basename($_SERVER['PHP_SELF']);

/**
 * Devuelve la clase CSS activa si la página actual coincide con
 * uno o más nombres de archivo dados.
 */
function sidebar_activo(string $pagina_actual, string ...$paginas): string {
    return in_array($pagina_actual, $paginas, true) ? 'sidebar-link sidebar-link--activo' : 'sidebar-link';
}

$inicial_usuario = strtoupper(substr($_SESSION['nombre_usuario'] ?? 'A', 0, 1));
$nombre_usuario  = htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Admin');
$rol_usuario     = ucfirst($_SESSION['rol'] ?? 'administrador');
?>
<aside class="sidebar-admin">

    <!-- Logo -->
    <div class="sidebar-logo">
        <span class="sidebar-logo-icon">◈</span>
        <span class="sidebar-logo-text">EDUIAIO</span>
        <span class="sidebar-logo-badge">Admin</span>
    </div>

    <!-- Navegación principal -->
    <nav class="sidebar-nav">

        <a href="<?= APP_URL ?>/panel.php"
           class="<?= sidebar_activo($pagina_actual, 'panel.php') ?>">
            <span class="sidebar-icon">⊞</span>
            Dashboard
        </a>

        <!-- Grupo: Contenido -->
        <div class="sidebar-grupo">
            <span class="sidebar-grupo-label">Contenido</span>

            <a href="<?= APP_URL ?>/operaciones/listar.php"
               class="<?= sidebar_activo($pagina_actual, 'listar.php', 'crear.php', 'editar.php') ?>">
                <span class="sidebar-icon">▤</span>
                Cursos
            </a>

            <a href="<?= APP_URL ?>/operaciones/listar_categorias.php"
               class="<?= sidebar_activo($pagina_actual, 'listar_categorias.php', 'crear_categoria.php', 'editar_categoria.php') ?>">
                <span class="sidebar-icon">◈</span>
                Categorías
            </a>
        </div>

        <!-- Grupo: Usuarios -->
        <div class="sidebar-grupo">
            <span class="sidebar-grupo-label">Usuarios</span>

            <a href="<?= APP_URL ?>/operaciones/listar_usuarios.php"
               class="<?= sidebar_activo($pagina_actual, 'listar_usuarios.php', 'crear_usuario.php', 'editar_usuario.php') ?>">
                <span class="sidebar-icon">◉</span>
                Usuarios
            </a>
        </div>

        <!-- Separador -->
        <div class="sidebar-separador"></div>

        <a href="<?= APP_URL ?>/panel_estudiante.php" class="sidebar-link sidebar-link--externo">
            <span class="sidebar-icon">↗</span>
            Ver como estudiante
        </a>

    </nav>

    <!-- Pie del sidebar: perfil + logout -->
    <div class="sidebar-footer">
        <div class="sidebar-usuario">
            <div class="sidebar-avatar"><?= $inicial_usuario ?></div>
            <div class="sidebar-usuario-info">
                <div class="sidebar-usuario-nombre"><?= $nombre_usuario ?></div>
                <div class="sidebar-usuario-rol"><?= $rol_usuario ?></div>
            </div>
        </div>
        <a href="<?= APP_URL ?>/cerrar_sesion.php" class="sidebar-logout" title="Cerrar sesión">
            ⏻
        </a>
    </div>

</aside>
