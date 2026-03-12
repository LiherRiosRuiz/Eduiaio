<?php
/**
 * mis_certificados.php
 *
 * Página donde el alumno puede ver y descargar sus certificados
 * de los cursos completados al 100%.
 */

require_once __DIR__ . '/bootstrap.php';

// Verificar acceso
requerir_sesion();

$id_usuario = $_SESSION['id_usuario'];

/**
 * Consulta: cursos completados (100% de lecciones)
 */
$stmt = $conexion->prepare("
    SELECT 
        c.id, 
        c.titulo, 
        MAX(p.fecha_completado) as fecha_fin
    FROM cursos c
    JOIN modulos m ON c.id = m.curso_id
    JOIN lecciones l ON m.id = l.modulo_id
    JOIN progreso p ON l.id = p.leccion_id AND p.usuario_id = ?
    WHERE p.completado = 1
    GROUP BY c.id
    HAVING COUNT(DISTINCT l.id) = (
        SELECT COUNT(l2.id) 
        FROM lecciones l2 
        JOIN modulos m2 ON l2.modulo_id = m2.id 
        WHERE m2.curso_id = c.id
    )
    ORDER BY fecha_fin DESC
");
$stmt->execute([$id_usuario]);
$certificados = $stmt->fetchAll();

$titulo_pagina = 'Mis Certificados';
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
        .lista-certificados {
            margin-top: 2rem;
            display: grid;
            gap: 1.5rem;
        }
        .tarjeta-certificado {
            background: white;
            padding: 1.5rem;
            border-radius: var(--radio-lg);
            box-shadow: var(--sombra-sm);
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: box-shadow 0.2s;
        }
        .tarjeta-certificado:hover {
            box-shadow: var(--sombra-md);
        }
        .cert-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .cert-icon {
            font-size: 2.5rem;
            color: #fbbf24;
        }
        .vacio-state {
            text-align: center;
            padding: 4rem 2rem;
            background: #f1f5f9;
            border-radius: 12px;
            border: 2px dashed #cbd5e1;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <?php include 'vistas/fragmentos/nav_estudiante.php'; ?>

    <main class="contenedor">
        <div style="margin: 3rem 0;">
            <h1 style="color: var(--color-primario);">Mis Certificados</h1>
            <p style="color: var(--texto-secundario);">Aquí encontrarás los títulos que has obtenido al completar tus cursos.</p>
        </div>

        <?php if (empty($certificados)): ?>
            <div class="vacio-state">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🎓</div>
                <h3 style="font-weight: 600; color: #475569;">Aún no tienes certificados</h3>
                <p style="color: #64748b; margin-bottom: 1.5rem;">Completa el 100% de las lecciones de un curso para obtener tu diploma oficial.</p>
                <a href="panel_estudiante.php" class="btn btn-primario">Ir a mis cursos</a>
            </div>
        <?php else: ?>
            <div class="lista-certificados">
                <?php foreach ($certificados as $c): ?>
                    <div class="tarjeta-certificado">
                        <div class="cert-info">
                            <div class="cert-icon">📜</div>
                            <div>
                                <h3 style="font-weight: 600; font-size: 1.1rem;"><?= htmlspecialchars($c['titulo']) ?></h3>
                                <p style="font-size: 0.85rem; color: #64748b;">Completado el: <?= date('d/m/Y', strtotime($c['fecha_fin'])) ?></p>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn btn-borde btn-pequeno" onclick="alert('Funcionalidad de descarga en desarrollo. ¡Enhorabuena por tu título!'); return false;">
                                Descargar PDF
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Sección de motivación -->
        <div style="margin-top: 4rem; padding: 2rem; background: linear-gradient(to right, #e0e7ff, #f5f3ff); border-radius: 16px;">
            <h3 style="font-weight: 700; color: #3730a3; margin-bottom: 0.5rem;">¡Sigue así!</h3>
            <p style="color: #4338ca;">Cada certificado es un paso más hacia tu dominio del mundo digital. Comparte tus logros con tus seres queridos.</p>
        </div>
    </main>
</body>

</html>
