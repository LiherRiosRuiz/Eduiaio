<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial: Cine y Series Online - EDUIAIO</title>
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
        <span class="text-indigo-600 font-semibold tracking-wider uppercase text-sm">Ocio y Bienestar</span>
        <h1 class="text-4xl font-bold mt-2 mb-6 text-gray-900">Cómo ver tus películas y series favoritas en internet</h1>
        
        <p class="text-xl text-gray-600 mb-12">Hoy en día ya no hay que esperar a que pongan una película en la tele. Puedes elegir qué ver y cuándo verlo usando plataformas de internet. En esta guía te enseñamos cómo.</p>

        <div class="space-y-12">
            <!-- Step 1 -->
            <section class="flex gap-6">
                <div class="w-12 h-12 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">1</div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">¿Qué plataforma elegir?</h2>
                    <p class="text-gray-600 mb-4">Existen muchas opciones, pero estas son las más recomendadas para empezar:</p>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <li class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                            <strong class="text-indigo-600">RTVE Play:</strong> Es gratuita y tiene todas las series, documentales y películas de Televisión Española. No necesitas suscribirte.
                        </li>
                        <li class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                            <strong class="text-indigo-600">Netflix:</strong> Es de pago mensual. Tiene el catálogo más grande de películas y series actuales del mundo.
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Step 2 -->
            <section class="flex gap-6">
                <div class="w-12 h-12 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">2</div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Cómo buscar una película</h2>
                    <p class="text-gray-600 mb-4">En todas las aplicaciones verás un icono de una <strong>lupa</strong>. Pulsa sobre ella y escribe el nombre de la película o del actor que te guste.</p>
                    <div class="bg-gray-100 p-6 rounded-2xl flex justify-center">
                        <span class="text-4xl">🔍</span>
                    </div>
                </div>
            </section>

            <!-- Step 3 -->
            <section class="flex gap-6">
                <div class="w-12 h-12 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">3</div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Controla la reproducción</h2>
                    <p class="text-gray-600 mb-4">Una vez que empiece la película, puedes pausarla si necesitas levantarte, o volver atrás si te has perdido algo.</p>
                    <div class="flex gap-4 justify-center py-4">
                        <div class="text-center"><span class="block text-3xl">⏯️</span><span class="text-xs">Pausa/Play</span></div>
                        <div class="text-center"><span class="block text-3xl">⏪</span><span class="text-xs">Retroceder</span></div>
                        <div class="text-center"><span class="block text-3xl">🔊</span><span class="text-xs">Volumen</span></div>
                    </div>
                </div>
            </section>
        </div>

        <div class="mt-16 p-8 bg-indigo-50 rounded-2xl border border-indigo-100 italic text-indigo-800 text-center">
            "Recuerda que si usas una tablet o móvil, asegúrate de estar conectado al WiFi de casa para no gastar tus datos."
        </div>

        <div class="mt-12 flex justify-between items-center">
            <a href="ocio.php" class="text-indigo-600 font-bold hover:underline">← Volver a Ocio</a>
            <a href="../tutoriales/musica.php" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition-colors">Siguiente Tutorial →</a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">EDUIAIO</h3>
                <p class="text-gray-400 text-sm">Tecnología accesible para todos, sin importar la edad.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Secciones</h4>
                <ul class="text-sm text-gray-400 space-y-2">
                    <li><a href="./" class="hover:text-white">Inicio</a></li>
                    <li><a href="ver_cursos.php" class="hover:text-white">Cursos</a></li>
                    <li><a href="descubrir.php" class="hover:text-white">Descubrir</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Legal</h4>
                <ul class="text-sm text-gray-400 space-y-2">
                    <li><a href="privacidad.php" class="hover:text-white">Privacidad</a></li>
                    <li><a href="terminos.php" class="hover:text-white">Términos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Contacto</h4>
                <p class="text-sm text-gray-400">soporte@eduiaio.com</p>
            </div>
        </div>
    </footer>

</body>

</html>
