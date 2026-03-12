# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Common Commands

```bash
# Start local dev server (XAMPP Apache must be running for MySQL; use this for quick PHP testing)
php -S 127.0.0.1:8000

# PHP syntax check
php -l operaciones/crear.php

# Database backup
mysqldump -u root eduiaio > base_de_datos/backup.sql

# Restore database
mysql -u root eduiaio < base_de_datos/eduiaio.sql
```

## Architecture

PHP procedural/MVC-lite application for an elderly-focused digital education platform (EDUIAIO). No composer, no autoloader — files are included manually via `require_once`.

**Request flow:**
1. Public pages (landing_page.php, iniciar_sesion.php, registro.php)
2. Login sets `$_SESSION['id_usuario']` and `$_SESSION['rol']`
3. Protected pages call `requerir_sesion()` → `requerir_rol()` from `includes/auth.php`
4. Admins land on `panel.php`; students on `panel_estudiante.php`

**Key directories:**
- `configuracion/conexion.php` — Single PDO connection (root/no-password, XAMPP defaults). All pages do `require_once '../configuracion/conexion.php'` to get `$pdo`.
- `includes/auth.php` — `requerir_sesion()`, `requerir_rol()`, `tiene_rol()`
- `includes/funciones.php` — Helpers: `obtener_icono_curso()`, `calcular_porcentaje()`, `clase_badge_rol()`
- `operaciones/` — CRUD handlers for cursos, categorias, usuarios. Each file handles its own GET (render form) and POST (process + redirect) cycle.
- `vistas/fragmentos/` — Shared partials: `head.php`, `nav_admin.php`, `nav_estudiante.php`
- `recursos/estilos/` — Custom CSS design system (no framework). Load order matters: `variables.css` → `base.css` → `componentes.css` → page-specific CSS.

## Database

MySQL database `eduiaio`. Core tables: `usuarios`, `cursos`, `categorias`, `niveles`, `modulos`, `lecciones`, `inscripciones`, `progreso`, `auditoria`.

Every table has INSERT/UPDATE/DELETE triggers that write to the `auditoria` table automatically — do not bypass triggers with bulk SQL.

**Roles:** `admin`, `profesor`, `estudiante`
**Levels:** A1–C2 (stored in `niveles` table, not as ENUM)

## Conventions

- All user output uses `htmlspecialchars($val, ENT_QUOTES, 'UTF-8')` — never skip this.
- All DB writes use PDO prepared statements — never concatenate user input into SQL.
- Passwords: `password_hash($pass, PASSWORD_DEFAULT)` on write, `password_verify()` on login.
- Form validation happens in the same file that renders the form (no separate validator layer).
- Success/error messages are passed via `$_SESSION['mensaje']` and displayed on redirect.
- DataTables (jQuery plugin) is used for all admin listing pages with Spanish locale config.
