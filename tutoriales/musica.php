<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial: Música y Radio Online - EDUIAIO</title>
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
                <li><a href="descubrir.php">Descubrir</a></li>
                <li><a href="ocio.php">Ocio</a></li>
            </ul>
        </nav>
        <div class="flex flex-grow justify-end basis-0">
            <a href="iniciar_sesion.php" class="text-sm font-medium text-gray-700 px-4 py-2 hover:text-indigo-600">Cuenta</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-32 pb-20 px-6 max-w-4xl mx-auto">
        <span class="text-pink-600 font-semibold tracking-wider uppercase text-sm">Ocio y Bienestar</span>
        <h1 class="text-4xl font-bold mt-2 mb-6 text-gray-900">Escucha tus canciones y radios favoritas</h1>
        
        <p class="text-xl text-gray-600 mb-12">La música nos acompaña y nos alegra el día. En esta guía te enseñamos cómo encontrar cualquier canción que te guste y cómo escuchar la radio desde tu móvil u ordenador.</p>

        <div class="space-y-12">
            <!-- Step 1 -->
            <section class="flex gap-6">
                <div class="w-12 h-12 bg-pink-600 text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">1</div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">¿Dónde escuchar música?</h2>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <li class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                            <strong class="text-pink-600">YouTube:</strong> Es ideal porque además de escuchar, puedes ver los videos o actuaciones antiguas. Solo tienes que buscar el nombre del artista.
                        </li>
                        <li class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                            <strong class="text-pink-600">Spotify:</strong> Es como una gran biblioteca de música. Puedes buscar discos enteros y crear tus propias listas de canciones.
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Step 2 -->
            <section class="flex gap-6">
                <div class="w-12 h-12 bg-pink-600 text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">2</div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Escuchar la Radio Online</h2>
                    <p class="text-gray-600 mb-4">Ya no necesitas un transistor con antena. Todas las emisoras (RNE, SER, COPE, etc.) tienen su propia web o aplicación gratuita. Busca en Google: "Escuchar [nombre de la radio] en directo".</p>
                    <div class="bg-pink-50 p-6 rounded-2xl flex justify-center text-5xl">
                        📻
                    </div>
                </div>
            </section>
        </div>

        <div class="mt-12 flex justify-between items-center">
            <a href="../tutoriales/cine.php" class="text-pink-600 font-bold hover:underline">← Anterior: Cine</a>
            <a href="ocio.php" class="text-pink-600 font-bold hover:underline">Volver a Ocio</a>
            <a href="../tutoriales/juegos.php" class="bg-pink-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-pink-700 transition-colors">Siguiente: Juegos →</a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div><h3 class="text-xl font-bold mb-4">EDUIAIO</h3><p class="text-gray-400 text-sm">Tecnología accesible para todos.</p></div>
            <div><h4 class="font-bold mb-4">Secciones</h4><ul class="text-sm text-gray-400 space-y-2"><li><a href="./">Inicio</a></li><li><a href="ocio.php">Ocio</a></li></ul></div>
            <div><h4 class="font-bold mb-4">Legal</h4><ul class="text-sm text-gray-400 space-y-2"><li><a href="privacidad.php">Privacidad</a></li><li><a href="terminos.php">Términos</a></li></ul></div>
            <div><h4 class="font-bold mb-4">Contacto</h4><p class="text-sm text-gray-400">soporte@eduiaio.com</p></div>
        </div>
    </footer>

</body>

</html>
