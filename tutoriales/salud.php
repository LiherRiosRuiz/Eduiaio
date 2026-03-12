<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial: Salud Online - EDUIAIO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>

<body class="bg-gray-50 text-gray-900">

    <header class="py-4 px-10 flex items-center fixed top-0 w-full justify-between z-40 bg-white shadow-sm">
        <div class="flex flex-grow basis-0"><a href="./" class="text-indigo-600 font-bold text-xl tracking-tighter">EDUIAIO</a></div>
        <nav class="hidden xl:block">
            <ul class="flex text-sm font-medium text-gray-700 [&>li>a]:px-4 [&>li>a]:py-2">
                <li><a href="./">Inicio</a></li><li><a href="ver_cursos.php">Cursos</a></li><li><a href="aprender_mas.php">Trámites</a></li>
            </ul>
        </nav>
    </header>

    <main class="pt-32 pb-20 px-6 max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-6 text-red-600">Gestión de Salud desde Casa</h1>
        <p class="text-xl text-gray-600 mb-12">Ya no hace falta ir al centro de salud para todo. Puedes pedir cita, ver tus recetas y descargar tus informes médicos desde tu ordenador o móvil.</p>

        <div class="grid grid-cols-1 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border-l-4 border-red-500">
                <h3 class="text-xl font-bold mb-4">Pedir Cita Previa</h3>
                <p class="text-gray-600 mb-4">Cada comunidad autónoma tiene su propia aplicación (Salud Madrid, ClicSalud+, Sacyl Conecta, etc.).</p>
                <ol class="list-decimal pl-6 space-y-2 text-gray-700">
                    <li>Abre la aplicación de salud de tu comunidad.</li>
                    <li>Introduce el número de tu <strong>Tarjeta Sanitaria</strong>.</li>
                    <li>Selecciona "Cita Previa".</li>
                    <li>Elige el día y la hora que mejor te venga.</li>
                </ol>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border-l-4 border-red-500">
                <h3 class="text-xl font-bold mb-4">Recetas y Tratamientos</h3>
                <p class="text-gray-600">Puedes consultar qué medicamentos tienes activos y hasta qué fecha puedes recogerlos en la farmacia sin tener que llevar el papel impreso siempre contigo.</p>
            </div>
        </div>

        <div class="mt-12">
            <a href="aprender_mas.php" class="text-indigo-600 font-bold">← Volver a Trámites</a>
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-12 mt-20 text-center text-sm">
        &copy; 2026 EDUIAIO.
    </footer>

</body>
</html>
