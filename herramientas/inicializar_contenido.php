<?php
require_once '../configuracion/conexion.php';

// Disable output buffering to show progress immediately
if (ob_get_level()) ob_end_flush();
// Implicitly flush the buffer(s)
ini_set('implicit_flush', true);

echo "Iniciando población de contenido educativo...\n";

// Helper function to insert if not exists
function getOrCreateCategory($conexion, $nombre, $descripcion) {
    $stmt = $conexion->prepare("SELECT id FROM categorias WHERE nombre = ?");
    $stmt->execute([$nombre]);
    $id = $stmt->fetchColumn();
    if ($id) return $id;
    
    $stmt = $conexion->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)");
    $stmt->execute([$nombre, $descripcion]);
    return $conexion->lastInsertId();
}

function getOrCreateCourse($conexion, $titulo, $descripcion, $precio, $categoria_id, $creado_por) {
    // Check by title AND category to avoid mixups, though title should be unique-ish
    $stmt = $conexion->prepare("SELECT id FROM cursos WHERE titulo = ?");
    $stmt->execute([$titulo]);
    $id = $stmt->fetchColumn();
    
    if ($id) {
        // Update description just in case we are improving it
        $stmt = $conexion->prepare("UPDATE cursos SET descripcion = ?, precio = ?, categoria_id = ? WHERE id = ?");
        $stmt->execute([$descripcion, $precio, $categoria_id, $id]);
        return $id;
    }
    
    $stmt = $conexion->prepare("INSERT INTO cursos (titulo, descripcion, precio, categoria_id, creado_por) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$titulo, $descripcion, $precio, $categoria_id, $creado_por]);
    return $conexion->lastInsertId();
}

function createModule($conexion, $curso_id, $titulo, $descripcion, $orden) {
    // Check if exists
    $stmt = $conexion->prepare("SELECT id FROM modulos WHERE curso_id = ? AND titulo = ?");
    $stmt->execute([$curso_id, $titulo]);
    $id = $stmt->fetchColumn();
    
    if ($id) return $id;
    
    $stmt = $conexion->prepare("INSERT INTO modulos (curso_id, titulo, descripcion, orden) VALUES (?, ?, ?, ?)");
    $stmt->execute([$curso_id, $titulo, $descripcion, $orden]);
    return $conexion->lastInsertId();
}

function createLesson($conexion, $modulo_id, $titulo, $contenido, $orden, $duracion) {
    // Check if exists
    $stmt = $conexion->prepare("SELECT id FROM lecciones WHERE modulo_id = ? AND titulo = ?");
    $stmt->execute([$modulo_id, $titulo]);
    $id = $stmt->fetchColumn();
    
    if ($id) {
        // Update content if re-running script to fix typos etc
        $stmt = $conexion->prepare("UPDATE lecciones SET contenido = ?, duracion_estimada = ?, orden = ? WHERE id = ?");
        $stmt->execute([$contenido, $duracion, $orden, $id]);
        return $id;
    }
    
    $stmt = $conexion->prepare("INSERT INTO lecciones (modulo_id, titulo, contenido, orden, duracion_estimada) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$modulo_id, $titulo, $contenido, $orden, $duracion]);
    return $conexion->lastInsertId();
}

// 1. Get Admin User ID (using 'admin' username)
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = 'admin'");
$stmt->execute();
$adminId = $stmt->fetchColumn() ?: 1; // Default to 1 if not found

// 2. Define Categories (Based on Ops Manual)
$catComunicacion = getOrCreateCategory($conexion, 'Comunicación y Redes', 'WhatsApp, Videollamadas y Redes Sociales');
$catBanca = getOrCreateCategory($conexion, 'Trámites y Gestiones', 'Banca online, Citas médicas y Administración');
$catSeguridad = getOrCreateCategory($conexion, 'Seguridad Digital', 'Prevención de estafas y uso seguro');
$catIniciacion = getOrCreateCategory($conexion, 'Iniciación Digital', 'Primeros pasos con el móvil y ordenador');

// ==========================================
// COURSE 1: WHATSAPP (Comunicación)
// ==========================================
echo "Creando curso: WhatsApp...\n";
$cursoWhatsapp = getOrCreateCourse($conexion, 
    'Dominando WhatsApp', 
    'Aprende a comunicarte con tus nietos, enviar fotos, audios y realizar videollamadas de forma sencilla.', 
    20.00, 
    $catComunicacion, 
    $adminId
);

// Module 1: Primeros Pasos
$mod1 = createModule($conexion, $cursoWhatsapp, 'Módulo 1: Primeros Pasos y Contactos', 'Configuración básica y cómo agregar a la familia.', 1);

createLesson($conexion, $mod1, '¿Qué es WhatsApp y cómo funciona?', 
    '<p>WhatsApp es una aplicación que permite enviar mensajes, fotos y videos a través de internet, sin pagar por cada mensaje como los antiguos SMS.</p>
    <h3>Lo que necesitas saber:</h3>
    <ul>
        <li>Necesitas conexión a internet (WiFi o datos móviles).</li>
        <li>Va asociado a tu número de teléfono.</li>
        <li>Es la forma más común de hablar hoy en día.</li>
    </ul>', 1, 5);

createLesson($conexion, $mod1, 'Guardar un nuevo contacto', 
    '<p>Para hablar con alguien, primero debes tenerlo guardado en la agenda de tu teléfono.</p>
    <ol>
        <li>Sal de WhatsApp y busca el icono de <strong>Teléfono</strong> o <strong>Contactos</strong>.</li>
        <li>Escribe el número de la persona.</li>
        <li>Dale a "Guardar" o "Crear nuevo contacto".</li>
        <li>Escribe su nombre (por ejemplo: "Hijo Pedro").</li>
        <li>Dale a <strong>Guardar</strong>.</li>
        <li>Ahora, abre WhatsApp, pulsa el botón verde de "Nuevo Mensaje" y busca "Hijo Pedro" en la lista.</li>
    </ol>', 2, 10);

// Module 2: Mensajes y Multimedia
$mod2 = createModule($conexion, $cursoWhatsapp, 'Módulo 2: Enviando Fotos y Audios', 'Pierde el miedo a enviar recuerdos y notas de voz.', 2);

createLesson($conexion, $mod2, 'Cómo enviar una foto', 
    '<p>¡Comparte lo que estás viendo!</p>
    <ol>
        <li>Dentro del chat, busca el icono que parece un <strong>clip</strong> o una <strong>cámara</strong> (abajo a la derecha).</li>
        <li>Si pulsas la <strong>Cámara</strong>, podrás hacer una foto en ese momento.</li>
        <li>Si pulsas el <strong>Clip</strong> y luego "Galería", podrás elegir una foto que ya tengas guardada.</li>
        <li>Selecciona la foto y pulsa el botón verde de enviar (el avioncito de papel).</li>
    </ol>', 1, 8);

createLesson($conexion, $mod2, 'Las Notas de Voz (Audios)', 
    '<p>A veces es más fácil hablar que escribir.</p>
    <ol>
        <li>Mantén pulsado el icono del <strong>micrófono</strong> verde que está a la derecha de donde se escribe.</li>
        <li>Mientras lo mantienes pulsado, habla claro y cerca del teléfono.</li>
        <li>Cuando termines de hablar, <strong>suelta el dedo</strong>. El mensaje se enviará automáticamente.</li>
        <li><strong>Truco:</strong> Si deslizas el dedo hacia arriba mientras pulsas, se queda "candado" y no tienes que apretar todo el rato.</li>
    </ol>', 2, 10);

// ==========================================
// COURSE 2: BANCA ONLINE (Gestiones)
// ==========================================
echo "Creando curso: Banca Online...\n";
$cursoBanca = getOrCreateCourse($conexion, 
    'Banca Online Segura', 
    'Gestiona tus cuentas desde casa sin hacer colas. Consulta saldo y movimientos con total seguridad.', 
    35.00, 
    $catBanca, 
    $adminId
);

$modB1 = createModule($conexion, $cursoBanca, 'Módulo 1: Acceso Seguro', 'Entrar a tu banco sin miedo.', 1);

createLesson($conexion, $modB1, 'Descargar la App de tu Banco', 
    '<p>Cada banco tiene su propia aplicación oficial. Es importante descargar SOLO la oficial.</p>
    <ol>
        <li>Entra en <strong>Play Store</strong> (Android) o <strong>App Store</strong> (iPhone).</li>
        <li>En el buscador, escribe el nombre de tu banco (CaixaBank, BBVA, Santander, etc.).</li>
        <li>Busca la que tenga el logo de tu banco y diga "Oficial".</li>
        <li>Pulsa <strong>Instalar</strong>.</li>
    </ol>
    <div class="alert alert-warning">Nunca descargues aplicaciones financieras de enlaces que te lleguen por SMS.</div>', 1, 15);

createLesson($conexion, $modB1, 'Tu Usuario y Contraseña', 
    '<p>Para entrar, necesitas tus claves. Normalmente te las dan en la oficina al firmar el contrato de banca digital.</p>
    <ul>
        <li><strong>DNI:</strong> Suele ser tu usuario.</li>
        <li><strong>Clave de Acceso:</strong> Un número secreto (suele ser de 4 o 6 cifras).</li>
        <li><strong>Memorízala:</strong> No la lleves apuntada en un papel junto a la tarjeta.</li>
    </ul>', 2, 10);

$modB2 = createModule($conexion, $cursoBanca, 'Módulo 2: Operaciones Básicas', 'El día a día de tus cuentas.', 2);

createLesson($conexion, $modB2, 'Consultar Saldo y Movimientos', 
    '<p>Lo primero que ves al entrar es tu "Posición Global" o saldo total.</p>
    <ol>
        <li>Pulsa sobre la cuenta que quieras revisar.</li>
        <li>Verás una lista con fechas y cantidades.</li>
        <li><strong>Negro o Verde:</strong> Dinero que ha entrado (pensión, ingresos).</li>
        <li><strong>Rojo o con un menos (-):</strong> Dinero que ha salido (pagos, recibos).</li>
    </ol>', 1, 10);

// ==========================================
// COURSE 3: SEGURIDAD (Seguridad)
// ==========================================
echo "Creando curso: Seguridad Digital...\n";
$cursoSeg = getOrCreateCourse($conexion, 
    'Navegación Segura y Anti-Fraude', 
    'Aprende a detectar estafas, SMS falsos y navega tranquilo por internet.', 
    25.00, 
    $catSeguridad, 
    $adminId
);

$modS1 = createModule($conexion, $cursoSeg, 'Módulo 1: Detectando Engaños', 'No caigas en la trampa.', 1);

createLesson($conexion, $modS1, '¿Qué es el Phishing?', 
    '<p>El "Phishing" es cuando un estafador se hace pasar por una empresa de confianza (Tu Banco, Correos, Hacienda) para robarte datos.</p>
    <h3>Cómo reconocerlo:</h3>
    <ul>
        <li><strong>Urgencia:</strong> Te dicen "Tu cuenta será bloqueada en 24h" para que te pongas nervioso.</li>
        <li><strong>Faltas de ortografía:</strong> A veces los mensajes están mal escritos.</li>
        <li><strong>Enlaces extraños:</strong> Te piden que pinches en un enlace azul. <strong>¡NUNCA lo hagas si no estás seguro!</strong></li>
    </ul>', 1, 15);

createLesson($conexion, $modS1, 'El timo del "Hijo en apuros"', 
    '<p>Muy común en WhatsApp.</p>
    <p>Recibes un mensaje de un número desconocido que dice: <em>"Mamá/Papá, se me ha roto el móvil, este es mi número nuevo. Necesito dinero urgente..."</em></p>
    <p><strong>QUÉ HACER:</strong></p>
    <ol>
        <li>No contestes.</li>
        <li>Llama a tu hijo/a a su número de SIEMPRE (el viejo).</li>
        <li>Comprobarás que está bien y que no es él quien te escribe.</li>
        <li>Bloquea el número nuevo en WhatsApp.</li>
    </ol>', 2, 10);

echo "¡Contenido educativo creado con éxito!\n";
?>
