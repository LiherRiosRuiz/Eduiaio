<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial: Videollamadas - EDUIAIO</title>
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
            </ul>
        </nav>
        <div class="flex flex-grow justify-end basis-0">
            <a href="iniciar_sesion.php" class="text-sm font-medium text-gray-700 px-4 py-2 hover:text-indigo-600">Cuenta</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-32 pb-20 px-6 max-w-4xl mx-auto">
        <span class="text-indigo-600 font-semibold tracking-wider uppercase text-sm">Comunicación y Conexión</span>
        <h1 class="text-4xl font-bold mt-2 mb-6 text-gray-900">Cómo hacer tu primera videollamada</h1>
        
        <p class="text-xl text-gray-600 mb-12">Las videollamadas son la mejor forma de sentirte cerca de tu familia aunque estén lejos. Poder ver sus caras mientras hablas cambia totalmente la conversación.</p>

        <div class="space-y-12">
            <section class="flex gap-6">
                <div class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.996 4.778 4.739-2.111z"/></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Videollamada por WhatsApp</h2>
                    <p class="text-gray-600 mb-4">Es la forma más fácil porque ya tienes a tus contactos ahí:</p>
                    <ol class="list-decimal pl-6 space-y-4 text-gray-700">
                        <li>Abre el chat de la persona a la que quieres llamar.</li>
                        <li>Busca en la parte superior derecha el icono que parece una <strong>cámara de video</strong>.</li>
                        <li>Pulsa ese icono y espera a que la otra persona acepte la llamada.</li>
                        <li><strong>¡Importante!</strong> Mantén el móvil un poco alejado de tu cara para que te vean bien.</li>
                    </ol>
                </div>
            </section>

            <section class="flex gap-6">
                <div class="w-12 h-12 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-xl shrink-0">💡</div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Consejos para una buena llamada</h2>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Ponte frente a una ventana o una luz; si la luz está detrás de ti, se verá tu cara oscura.</li>
                        <li>Usa el WiFi para que la imagen no se corte.</li>
                        <li>Si no escuchas bien, puedes usar los altavoces o unos auriculares.</li>
                    </ul>
                </div>
            </section>
        </div>

        <div class="mt-12 flex justify-between items-center">
            <a href="descubrir.php" class="text-indigo-600 font-bold hover:underline">← Volver a Descubrir</a>
            <a href="../tutoriales/whatsapp.php" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition-colors">Siguiente: WhatsApp Fácil →</a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
            <div><h3 class="text-xl font-bold mb-4">EDUIAIO</h3></div>
            <div><h4 class="font-bold mb-4">Legal</h4><ul class="text-gray-400 space-y-2"><li><a href="privacidad.php">Privacidad</a></li><li><a href="terminos.php">Términos</a></li></ul></div>
        </div>
    </footer>

</body>

</html>
