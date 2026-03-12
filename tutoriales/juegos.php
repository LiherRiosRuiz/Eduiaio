<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial: Ejercita la Mente - EDUIAIO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    <!-- Header -->
    <header class="py-4 px-10 flex items-center fixed top-0 w-full justify-between z-40 bg-white shadow-sm">
        <div class="flex flex-grow basis-0">
            <a href="./" class="text-indigo-600 font-bold text-xl tracking-tighter">EDUIAIO</a>
        </div>
        <nav class="hidden xl:block">
            <ul class="flex text-sm font-medium text-gray-700 [&>li>a]:inline-block [&>li>a]:px-4 [&>li>a]:py-2 hover:[&>li>a]:text-indigo-600">
                <li><a href="./">Inicio</a></li>
                <li><a href="ver_cursos.php">Cursos</a></li>
                <li><a href="ocio.php">Ocio</a></li>
            </ul>
        </nav>
        <div class="flex flex-grow justify-end basis-0">
            <a href="iniciar_sesion.php" class="text-sm font-medium text-gray-700 px-4 py-2 hover:text-indigo-600">Cuenta</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-32 pb-20 px-6 max-w-4xl mx-auto">
        <span class="text-orange-600 font-semibold tracking-wider uppercase text-sm">Ocio y Bienestar</span>
        <h1 class="text-4xl font-bold mt-2 mb-6 text-gray-900">Juegos para mantener la mente activa</h1>
        
        <p class="text-xl text-gray-600 mb-12">Entrenar el cerebro es tan importante como caminar. Internet ofrece pasatiempos maravillosos para ejercitar la memoria y la atención de forma divertida.</p>

        <div class="space-y-12">
            <section class="flex gap-6">
                <div class="w-12 h-12 bg-orange-600 text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">1</div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Los clásicos de siempre</h2>
                    <p class="text-gray-600 mb-4">No necesitas papel y boli. Puedes jugar a:</p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li><strong>Crucigramas y Autodefinidos:</strong> Busca "Crucigramas online gratis" en Google.</li>
                        <li><strong>Sudokus:</strong> Ideales para la concentración y el cálculo.</li>
                        <li><strong>Sopa de letras:</strong> Muy relajante y bueno para la agudeza visual.</li>
                    </ul>
                </div>
            </section>

            <section class="flex gap-6">
                <div class="w-12 h-12 bg-orange-600 text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">2</div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Juegos de Memoria</h2>
                    <p class="text-gray-600 mb-4">Existen aplicaciones como <span class="text-indigo-600 font-semibold">Lumosity</span> o <span class="text-indigo-600 font-semibold">CogniFit</span> diseñadas por científicos para ayudar a mantener el cerebro joven. Son muy sencillas de usar.</p>
                </div>
            </section>
        </div>

        <div class="mt-12 flex justify-between items-center">
            <a href="../tutoriales/musica.php" class="text-orange-600 font-bold hover:underline">← Anterior: Música</a>
            <a href="ocio.php" class="bg-orange-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-orange-700 transition-colors">Volver a Ocio</a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div><h3 class="text-xl font-bold mb-4">EDUIAIO</h3></div>
            <div><h4 class="font-bold mb-4">Legal</h4><ul class="text-sm text-gray-400 space-y-2"><li><a href="privacidad.php">Privacidad</a></li><li><a href="terminos.php">Términos</a></li></ul></div>
        </div>
    </footer>

</body>

</html>
