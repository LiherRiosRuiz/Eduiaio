<?php
/**
 * vistas/fragmentos/head.php
 *
 * Fragmento HTML reutilizable para el <head> de todas las páginas.
 *
 * Variables esperadas antes de incluir este fragmento:
 *   $titulo_pagina  (string) — texto que aparece en la pestaña del navegador.
 *   $fuente         (string, opcional) — 'Inter' (defecto) o 'Outfit'
 *
 * Uso:
 *   $titulo_pagina = 'Mi Panel';
 *   include ROOT . '/vistas/fragmentos/head.php';
 */

// Ruta absoluta al CSS principal usando la constante APP_URL de bootstrap.php
$css_href = APP_URL . '/recursos/estilos/estilos.css';
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($titulo_pagina ?? 'EDUIAIO') ?> - EDUIAIO</title>

<!-- Google Fonts: DM Sans (cabeceras admin) + Inter (cuerpo) + Outfit (área estudiante) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<!-- Hoja de estilos principal (importa base, componentes y páginas) -->
<link rel="stylesheet" href="<?= $css_href ?>">
