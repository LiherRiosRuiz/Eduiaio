<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubrir - EDUIAIO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    <header
        class="py-4 px-10 flex items-center fixed top-0 w-full justify-between z-40 bg-white shadow-sm transition-colors duration-300">
        <div class="flex flex-grow basis-0">
            <a href="./" class="text-indigo-600 font-bold text-xl tracking-tighter">EDUIAIO</a>
        </div>
        <nav class="hidden xl:block sm:hidden">
            <ul
                class="flex text-sm font-medium text-gray-700 [&>li>a]:transition-colors [&>li>a]:duration-300 [&>li>a]:inline-block [&>li>a]:px-4 [&>li>a]:py-2 hover:[&>li>a]:text-indigo-600">
                <li><a href="./#inicio">Inicio</a></li>
                <li><a href="./#iniciacion">Iniciación</a></li>
                <li><a href="./#comunicacion">Comunicación</a></li>
                <li><a href="./#tramites">Trámites</a></li>
                <li><a href="./#ocio">Ocio</a></li>
            </ul>
        </nav>
        <nav class="flex flex-grow justify-end basis-0">
            <ul
                class="flex text-sm font-medium text-gray-700 [&>li>a]:transition-colors [&>li>a]:duration-300 [&>li>a]:inline-block [&>li>a]:px-4 [&>li>a]:py-2 hover:[&>li>a]:text-indigo-600">
                <li class="hidden xl:block sm:hidden"><a href="iniciar_sesion.php">Cuenta</a></li>
                <li><a id="menu-btn" href="#" class="xl:hidden">Menú</a></li>
            </ul>
        </nav>
        <div id="mobile-menu" class="fixed inset-0 bg-white z-50 hidden flex-col p-8">
            <div class="flex justify-end mb-8">
                <button id="close-menu" class="text-black text-2xl">&times;</button>
            </div>
            <ul class="flex flex-col gap-4 text-black font-medium text-lg">
                <li><a href="./#inicio">Inicio</a></li>
                <li><a href="./#iniciacion">Iniciación Digital</a></li>
                <li><a href="./#comunicacion">Comunicación</a></li>
                <li><a href="./#tramites">Trámites Online</a></li>
                <li><a href="./#ocio">Ocio y Bienestar</a></li>
                <li><a href="iniciar_sesion.php" class="bg-gray-100 p-2 rounded text-center mt-4">Iniciar Sesión</a>
                </li>
            </ul>
        </div>
    </header>

    <main class="pt-24 pb-12 px-6 lg:px-12 max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="text-indigo-600 font-semibold tracking-wider uppercase text-sm">Comunicación y Conexión</span>
            <h1 class="text-4xl md:text-5xl font-bold mt-2 mb-4 text-gray-900">Descubre el Mundo</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Herramientas para estar más cerca de los tuyos y explorar
                tus intereses.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Article Main -->
            <article class="col-span-1 lg:col-span-2 relative rounded-3xl overflow-hidden shadow-lg group h-[400px]">
                <img src="recursos/imagenes/abuelos_movil.png" alt="Videollamadas"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-8 md:p-12">
                    <span class="text-white/80 text-sm font-semibold uppercase tracking-wider mb-2">Tutorial
                        Destacado</span>
                    <h2 class="text-white text-3xl font-bold mb-4">Cómo hacer tu primera videollamada</h2>
                    <p class="text-white/90 text-lg max-w-2xl mb-6">Guía paso a paso para usar WhatsApp y estar cerca de
                        tus hijos y nietos, estén donde estén.</p>
                    <a href="tutoriales/videollamada.php"
                        class="inline-block bg-white text-black font-medium px-6 py-3 rounded-lg hover:bg-gray-100 transition-colors w-fit">Leer
                        Artículo</a>
                </div>
            </article>

            <!-- Tool Card 1 -->
            <div
                class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-start hover:border-indigo-100 transition-colors">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 mb-6">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.996 4.778 4.739-2.111z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">WhatsApp Fácil</h3>
                <p class="text-gray-600 mb-6 flex-grow">Aprende los trucos básicos: enviar fotos, notas de voz y crear
                    grupos con la familia.</p>
                <a href="tutoriales/whatsapp.php" class="text-indigo-600 font-semibold text-sm hover:underline">Ver Guía &rarr;</a>
            </div>

            <!-- Tool Card 2 -->
            <div
                class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-start hover:border-indigo-100 transition-colors">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 mb-6">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Redes Sociales</h3>
                <p class="text-gray-600 mb-6 flex-grow">Entiende Facebook e Instagram para ver las fotos que comparten
                    tus amigos y familiares.</p>
                <a href="tutoriales/redes.php" class="text-indigo-600 font-semibold text-sm hover:underline">Ver Guía &rarr;</a>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-4 gap-8">
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
                    <li><a href="contacto.php" class="hover:text-white">Contacto</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Contacto</h4>
                <p class="text-sm text-gray-400">soporte@eduiaio.com</p>
            </div>
        </div>
        <div class="text-center text-gray-500 text-xs mt-12 pt-8 border-t border-gray-800">
            &copy; 2026 EDUIAIO. Todos los derechos reservados.
        </div>
    </footer>
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const closeMenuBtn = document.getElementById('close-menu');
        const mobileMenu = document.getElementById('mobile-menu');
        function toggleMenu() {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        }
        menuBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleMenu();
        });
        closeMenuBtn.addEventListener('click', toggleMenu);
    </script>
</body>

</html>