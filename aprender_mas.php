<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprender Más - EDUIAIO</title>
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
            <span class="text-indigo-600 font-semibold tracking-wider uppercase text-sm">Trámites y Gestiones</span>
            <h1 class="text-4xl md:text-5xl font-bold mt-2 mb-4 text-gray-900">Simplifica tu Vida</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Aprende a realizar gestiones bancarias, pedir citas
                médicas y trámites administrativos desde casa.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Cards -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div
                    class="h-12 w-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 mb-4 text-2xl">
                    🏥
                </div>
                <h3 class="text-lg font-bold mb-2">Salud Online</h3>
                <p class="text-gray-600 text-sm mb-4">Pide cita en tu centro de salud, descarga recetas y consulta tus
                    informes médicos.</p>
                <a href="tutoriales/salud.php" class="text-red-600 font-semibold text-sm hover:underline">Empezar Tutorial</a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div
                    class="h-12 w-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 mb-4 text-2xl">
                    🏦
                </div>
                <h3 class="text-lg font-bold mb-2">Banca Digital</h3>
                <p class="text-gray-600 text-sm mb-4">Consulta tu saldo, revisa los movimientos y aprende a operar con
                    seguridad.</p>
                <a href="tutoriales/banca.php" class="text-indigo-600 font-semibold text-sm hover:underline">Empezar Tutorial</a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div
                    class="h-12 w-12 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600 mb-4 text-2xl">
                    🏛️
                </div>
                <h3 class="text-lg font-bold mb-2">Administración</h3>
                <p class="text-gray-600 text-sm mb-4">Certificado digital, Cl@ve PIN y gestiones con el ayuntamiento o
                    la seguridad social.</p>
                <a href="tutoriales/administracion.php" class="text-yellow-600 font-semibold text-sm hover:underline">Empezar Tutorial</a>
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