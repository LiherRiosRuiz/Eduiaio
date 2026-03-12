<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial: Redes Sociales - EDUIAIO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>

<body class="bg-gray-50 text-gray-900">

    <header class="py-4 px-10 flex items-center fixed top-0 w-full justify-between z-40 bg-white shadow-sm">
        <div class="flex flex-grow basis-0"><a href="./" class="text-indigo-600 font-bold text-xl tracking-tighter">EDUIAIO</a></div>
        <nav class="hidden xl:block">
            <ul class="flex text-sm font-medium text-gray-700 [&>li>a]:px-4 [&>li>a]:py-2">
                <li><a href="./">Inicio</a></li><li><a href="ver_cursos.php">Cursos</a></li><li><a href="descubrir.php">Descubrir</a></li>
            </ul>
        </nav>
    </header>

    <main class="pt-32 pb-20 px-6 max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-bold mb-6">Explora las Redes Sociales</h1>
        <p class="text-xl text-gray-600 mb-12">Facebook e Instagram no son solo para jóvenes. Son ventanas digitales para ver qué hacen tus amigos y familiares.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-blue-50">
                <div class="text-4xl mb-4">👥</div>
                <h3 class="text-xl font-bold mb-4 text-blue-700">Facebook</h3>
                <p class="text-gray-600 text-sm">Perfecto para encontrar a antiguos compañeros de colegio o vecinos. Puedes leer sus publicaciones y dejar comentarios.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-pink-50">
                <div class="text-4xl mb-4">📸</div>
                <h3 class="text-xl font-bold mb-4 text-pink-700">Instagram</h3>
                <p class="text-gray-600 text-sm">Se basa en fotos. Es ideal para seguir a tus hijos y nietos y ver las fotos que cuelgan de sus viajes o del día a día.</p>
            </div>
        </div>

        <div class="bg-yellow-50 p-8 rounded-2xl border border-yellow-100 text-left">
            <h4 class="font-bold text-yellow-800 mb-2">⚠️ Recuerda la Seguridad</h4>
            <ul class="list-disc pl-6 space-y-2 text-yellow-900 text-sm">
                <li>No aceptes solicitudes de amistad de gente que no conozcas de nada.</li>
                <li>Si alguien te pide dinero por internet, desconfía siempre, aunque parezca alguien conocido.</li>
                <li>Pide ayuda a un familiar para configurar tu cuenta como "Privada".</li>
            </ul>
        </div>

        <div class="mt-12">
            <a href="descubrir.php" class="text-indigo-600 font-bold">← Volver a Descubrir</a>
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-12 mt-20 text-center text-sm">
        &copy; 2026 EDUIAIO.
    </footer>

</body>
</html>
