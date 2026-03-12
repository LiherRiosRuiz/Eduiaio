-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2026 a las 11:34:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eduiaio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `tabla` varchar(50) DEFAULT NULL,
  `accion` varchar(50) DEFAULT NULL,
  `registro_id` int(11) DEFAULT NULL,
  `detalles` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `tabla`, `accion`, `registro_id`, `detalles`, `fecha_creacion`) VALUES
(1, 'cursos', 'ACTUALIZAR', 1, 'Precio cambiado de 25.00 a 0.00', '2026-01-26 09:24:13'),
(2, 'cursos', 'ACTUALIZAR', 1, 'Precio cambiado de 0.00 a 100.00', '2026-01-26 09:53:02'),
(3, 'cursos', 'ACTUALIZAR', 1, 'Precio cambiado de 100.00 a 200.00', '2026-01-26 10:05:33'),
(4, 'cursos', 'ACTUALIZAR', 7, 'Precio cambiado de 1.00 a 1.00', '2026-01-26 10:08:01'),
(5, 'cursos', 'ACTUALIZAR', 7, 'Precio cambiado de 1.00 a 1.00', '2026-01-26 10:09:39'),
(6, 'usuarios', 'INSERTAR', 2, 'Nuevo usuario registrado: Alejandro Lopez (Rol: estudiante)', '2026-01-26 10:40:25'),
(7, 'usuarios', 'INSERTAR', 3, 'Nuevo usuario registrado: Fernando R&iacute;os (Rol: estudiante)', '2026-01-27 13:09:42'),
(8, 'usuarios', 'ELIMINAR', 3, 'Usuario eliminado: Fernando R&iacute;os', '2026-02-02 07:56:24'),
(9, 'usuarios', 'ACTUALIZAR', 2, 'Nombre cambiado de \"\" a \"Alejandro Lopez Mogena\". Teléfono cambiado. Dirección actualizada. Notas administrativas actualizadas. ', '2026-02-02 08:37:00'),
(10, 'cursos', 'INSERTAR', 8, 'Nuevo curso creado: Dominando WhatsApp', '2026-02-02 09:01:37'),
(11, 'cursos', 'ACTUALIZAR', 4, 'Precio cambiado de 35.00 a 35.00', '2026-02-02 09:01:37'),
(12, 'cursos', 'INSERTAR', 9, 'Nuevo curso creado: Navegación Segura y Anti-Fraude', '2026-02-02 09:01:37'),
(13, 'usuarios', 'INSERTAR', 4, 'Nuevo usuario registrado: Jimenon (Nombre: Jimena Salado, Rol: admin)', '2026-02-02 10:33:08'),
(14, 'cursos', 'ACTUALIZAR', 4, 'Precio cambiado de 35.00 a 35.00', '2026-02-23 10:31:45'),
(15, 'cursos', 'ACTUALIZAR', 4, 'Precio cambiado de 35.00 a 35.00', '2026-02-23 10:31:54'),
(16, 'usuarios', 'INSERTAR', 5, 'Nuevo usuario registrado: Alejandro Peman (Nombre: N/A, Rol: estudiante)', '2026-02-23 10:33:55'),
(17, 'cursos', 'ACTUALIZAR', 4, 'Precio cambiado de 35.00 a 35.00', '2026-02-23 10:49:59'),
(18, 'cursos', 'ACTUALIZAR', 9, 'Precio cambiado de 25.00 a 25.03', '2026-02-23 11:48:44'),
(19, 'cursos', 'ACTUALIZAR', 9, 'Precio cambiado de 25.03 a 25.03', '2026-02-23 11:48:51'),
(20, 'cursos', 'INSERTAR', 10, 'Nuevo curso creado: delightez', '2026-02-23 11:49:24'),
(21, 'cursos', 'ELIMINAR', 10, 'Curso eliminado: delightez', '2026-02-23 11:49:51'),
(22, 'categorias', 'INSERTAR', 7, 'Nueva categoría creada: Programaci&oacute;n', '2026-02-23 11:50:13'),
(23, 'cursos', 'ACTUALIZAR', 8, 'Precio cambiado de 20.00 a 20.00', '2026-02-23 11:50:40'),
(24, 'categorias', 'ACTUALIZAR', 7, 'Nombre de categoría cambiado de Programaci&oacute;n a Programación', '2026-02-23 11:54:23'),
(25, 'categorias', 'INSERTAR', 8, 'Nueva categoría creada: Atenci&oacute;n', '2026-02-23 12:08:19'),
(26, 'cursos', 'INSERTAR', 11, 'Nuevo curso creado: Prueba acentos', '2026-02-23 12:08:39'),
(27, 'categorias', 'ACTUALIZAR', 8, 'Nombre de categoría cambiado de Atenci&oacute;n a Atención', '2026-02-23 12:13:04'),
(28, 'cursos', 'ACTUALIZAR', 1, 'Precio cambiado de 200.00 a 200.00', '2026-02-23 12:13:04'),
(29, 'cursos', 'ACTUALIZAR', 2, 'Precio cambiado de 20.00 a 20.00', '2026-02-23 12:13:04'),
(30, 'cursos', 'ACTUALIZAR', 3, 'Precio cambiado de 30.00 a 30.00', '2026-02-23 12:13:04'),
(31, 'cursos', 'ACTUALIZAR', 4, 'Precio cambiado de 35.00 a 35.00', '2026-02-23 12:13:04'),
(32, 'cursos', 'ACTUALIZAR', 5, 'Precio cambiado de 15.00 a 15.00', '2026-02-23 12:13:04'),
(33, 'cursos', 'ACTUALIZAR', 8, 'Precio cambiado de 20.00 a 20.00', '2026-02-23 12:13:04'),
(34, 'cursos', 'ACTUALIZAR', 9, 'Precio cambiado de 25.03 a 25.03', '2026-02-23 12:13:04'),
(35, 'cursos', 'ACTUALIZAR', 11, 'Precio cambiado de 100.00 a 100.00', '2026-02-23 12:13:04'),
(36, 'categorias', 'INSERTAR', 9, 'Nueva categoría creada: Precaución activa', '2026-02-23 12:13:45'),
(37, 'cursos', 'INSERTAR', 12, 'Nuevo curso creado: Prevención de Riesgos en Internet', '2026-02-23 12:14:07'),
(38, 'cursos', 'ACTUALIZAR', 9, 'Precio cambiado de 25.03 a 25.03', '2026-02-23 12:14:31'),
(39, 'cursos', 'INSERTAR', 13, 'Nuevo curso creado: Programación', '2026-03-02 11:39:15'),
(40, 'usuarios', 'INSERTAR', 6, 'Nuevo usuario registrado: IOar (Nombre: bua, Rol: estudiante)', '2026-03-02 12:37:32'),
(41, 'usuarios', 'ACTUALIZAR', 6, 'Teléfono cambiado. ', '2026-03-02 12:37:44'),
(42, 'cursos', 'INSERTAR', 14, 'Nuevo curso creado: achine learninbvf', '2026-03-02 12:39:27'),
(43, 'cursos', 'ELIMINAR', 14, 'Curso eliminado: achine learninbvf', '2026-03-02 12:39:37'),
(44, 'usuarios', 'INSERTAR', 7, 'Nuevo usuario registrado: Prueba Telefono (Nombre: Telf, Rol: profesor)', '2026-03-02 12:48:54'),
(45, 'usuarios', 'ACTUALIZAR', 6, 'Teléfono cambiado. ', '2026-03-02 12:49:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Iniciación Digital', 'Primeros pasos con ordenadores, tablets y móviles'),
(2, 'Comunicación y Redes', 'WhatsApp, Videollamadas y Redes Sociales para conectar con la familia'),
(3, 'Trámites y Gestiones', 'Banca online, Citas médicas y Administración electrónica'),
(4, 'Ocio y Bienestar', 'Fotografía, Viajes, Memoria y Entretenimiento digital'),
(5, 'Seguridad Digital', 'Uso seguro de internet y prevención de estafas'),
(7, 'Programación', 'Profe'),
(8, 'Atención', 'Prueba acentos'),
(9, 'Precaución activa', 'Prueba');

--
-- Disparadores `categorias`
--
DELIMITER $$
CREATE TRIGGER `categorias_delete` AFTER DELETE ON `categorias` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, registro_id, detalles)
    VALUES ('categorias', 'ELIMINAR', OLD.id, CONCAT('Categoría eliminada: ', OLD.nombre));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `categorias_insert` AFTER INSERT ON `categorias` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, registro_id, detalles)
    VALUES ('categorias', 'INSERTAR', NEW.id, CONCAT('Nueva categoría creada: ', NEW.nombre));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `categorias_update` AFTER UPDATE ON `categorias` FOR EACH ROW BEGIN
    IF OLD.nombre != NEW.nombre THEN
        INSERT INTO auditoria (tabla, accion, registro_id, detalles)
        VALUES ('categorias', 'ACTUALIZAR', OLD.id, CONCAT('Nombre de categoría cambiado de ', OLD.nombre, ' a ', NEW.nombre));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT 0.00,
  `categoria_id` int(11) DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `titulo`, `descripcion`, `precio`, `categoria_id`, `id_nivel`, `creado_por`, `fecha_creacion`) VALUES
(1, 'Uso Básico del Teléfono Móvil', 'Aprende a llamar, guardar contactos y usar la cámara sin miedo', 200.00, 1, 1, 1, '2026-01-26 08:24:33'),
(2, 'WhatsApp para Mantener el Contacto', 'Envía fotos, audios y haz videollamadas con tus nietos y amigos', 20.00, 2, 2, 1, '2026-01-26 08:24:33'),
(3, 'Pierde el Miedo al Ordenador', 'Curso de iniciación desde cero: Ratón, teclado y navegación web', 30.00, 1, 1, 1, '2026-01-26 08:24:33'),
(4, 'Banca Online Segura', 'Gestiona tus cuentas desde casa sin hacer colas. Consulta saldo y movimientos con total seguridad.                                                            ', 35.00, 3, 3, 1, '2026-01-26 08:24:33'),
(5, 'Salud y Citas Médicas Online', 'Gestiona tus citas y recetas desde el móvil o el ordenador', 15.00, 3, 2, 1, '2026-01-26 08:24:33'),
(8, 'Dominando WhatsApp', '                        Aprende a comunicarte con tus nietos, enviar fotos, audios y realizar videollamadas de forma sencilla.                    ', 20.00, 7, 2, 1, '2026-02-02 09:01:37'),
(9, 'Navegación Segura y Anti-Fraude', 'Aprende a detectar estafas, SMS falsos y navega tranquilo por internet.', 25.03, 5, 4, 1, '2026-02-02 09:01:37'),
(11, 'Prueba acentos', 'Hola', 100.00, 8, 1, 1, '2026-02-23 12:08:39'),
(12, 'Prevención de Riesgos en Internet', 'HOla', 100.00, 9, 3, 1, '2026-02-23 12:14:07'),
(13, 'Programación', 'Programación', 100.00, 7, 5, 1, '2026-03-02 11:39:15');

--
-- Disparadores `cursos`
--
DELIMITER $$
CREATE TRIGGER `cursos_delete` AFTER DELETE ON `cursos` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, registro_id, detalles)
    VALUES ('cursos', 'ELIMINAR', OLD.id, CONCAT('Curso eliminado: ', OLD.titulo));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cursos_insert` AFTER INSERT ON `cursos` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, registro_id, detalles)
    VALUES ('cursos', 'INSERTAR', NEW.id, CONCAT('Nuevo curso creado: ', NEW.titulo));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `despues_actualizacion_curso` AFTER UPDATE ON `cursos` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, registro_id, detalles)
    VALUES ('cursos', 'ACTUALIZAR', OLD.id, CONCAT('Precio cambiado de ', OLD.precio, ' a ', NEW.precio));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `fecha_inscripcion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','completado','cancelado') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecciones`
--

CREATE TABLE `lecciones` (
  `id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `contenido` longtext DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `duracion_estimada` int(11) DEFAULT 10,
  `orden` int(11) DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lecciones`
--

INSERT INTO `lecciones` (`id`, `modulo_id`, `titulo`, `contenido`, `video_url`, `duracion_estimada`, `orden`, `fecha_creacion`) VALUES
(1, 1, '¿Qué es WhatsApp y cómo funciona?', '<p>WhatsApp es una aplicación que permite enviar mensajes, fotos y videos a través de internet, sin pagar por cada mensaje como los antiguos SMS.</p>\r\n    <h3>Lo que necesitas saber:</h3>\r\n    <ul>\r\n        <li>Necesitas conexión a internet (WiFi o datos móviles).</li>\r\n        <li>Va asociado a tu número de teléfono.</li>\r\n        <li>Es la forma más común de hablar hoy en día.</li>\r\n    </ul>', NULL, 5, 1, '2026-02-02 09:01:37'),
(2, 1, 'Guardar un nuevo contacto', '<p>Para hablar con alguien, primero debes tenerlo guardado en la agenda de tu teléfono.</p>\r\n    <ol>\r\n        <li>Sal de WhatsApp y busca el icono de <strong>Teléfono</strong> o <strong>Contactos</strong>.</li>\r\n        <li>Escribe el número de la persona.</li>\r\n        <li>Dale a \"Guardar\" o \"Crear nuevo contacto\".</li>\r\n        <li>Escribe su nombre (por ejemplo: \"Hijo Pedro\").</li>\r\n        <li>Dale a <strong>Guardar</strong>.</li>\r\n        <li>Ahora, abre WhatsApp, pulsa el botón verde de \"Nuevo Mensaje\" y busca \"Hijo Pedro\" en la lista.</li>\r\n    </ol>', NULL, 10, 2, '2026-02-02 09:01:37'),
(3, 2, 'Cómo enviar una foto', '<p>¡Comparte lo que estás viendo!</p>\r\n    <ol>\r\n        <li>Dentro del chat, busca el icono que parece un <strong>clip</strong> o una <strong>cámara</strong> (abajo a la derecha).</li>\r\n        <li>Si pulsas la <strong>Cámara</strong>, podrás hacer una foto en ese momento.</li>\r\n        <li>Si pulsas el <strong>Clip</strong> y luego \"Galería\", podrás elegir una foto que ya tengas guardada.</li>\r\n        <li>Selecciona la foto y pulsa el botón verde de enviar (el avioncito de papel).</li>\r\n    </ol>', NULL, 8, 1, '2026-02-02 09:01:37'),
(4, 2, 'Las Notas de Voz (Audios)', '<p>A veces es más fácil hablar que escribir.</p>\r\n    <ol>\r\n        <li>Mantén pulsado el icono del <strong>micrófono</strong> verde que está a la derecha de donde se escribe.</li>\r\n        <li>Mientras lo mantienes pulsado, habla claro y cerca del teléfono.</li>\r\n        <li>Cuando termines de hablar, <strong>suelta el dedo</strong>. El mensaje se enviará automáticamente.</li>\r\n        <li><strong>Truco:</strong> Si deslizas el dedo hacia arriba mientras pulsas, se queda \"candado\" y no tienes que apretar todo el rato.</li>\r\n    </ol>', NULL, 10, 2, '2026-02-02 09:01:37'),
(5, 3, 'Descargar la App de tu Banco', '<p>Cada banco tiene su propia aplicación oficial. Es importante descargar SOLO la oficial.</p>\r\n    <ol>\r\n        <li>Entra en <strong>Play Store</strong> (Android) o <strong>App Store</strong> (iPhone).</li>\r\n        <li>En el buscador, escribe el nombre de tu banco (CaixaBank, BBVA, Santander, etc.).</li>\r\n        <li>Busca la que tenga el logo de tu banco y diga \"Oficial\".</li>\r\n        <li>Pulsa <strong>Instalar</strong>.</li>\r\n    </ol>\r\n    <div class=\"alert alert-warning\">Nunca descargues aplicaciones financieras de enlaces que te lleguen por SMS.</div>', NULL, 15, 1, '2026-02-02 09:01:37'),
(6, 3, 'Tu Usuario y Contraseña', '<p>Para entrar, necesitas tus claves. Normalmente te las dan en la oficina al firmar el contrato de banca digital.</p>\r\n    <ul>\r\n        <li><strong>DNI:</strong> Suele ser tu usuario.</li>\r\n        <li><strong>Clave de Acceso:</strong> Un número secreto (suele ser de 4 o 6 cifras).</li>\r\n        <li><strong>Memorízala:</strong> No la lleves apuntada en un papel junto a la tarjeta.</li>\r\n    </ul>', NULL, 10, 2, '2026-02-02 09:01:37'),
(7, 4, 'Consultar Saldo y Movimientos', '<p>Lo primero que ves al entrar es tu \"Posición Global\" o saldo total.</p>\r\n    <ol>\r\n        <li>Pulsa sobre la cuenta que quieras revisar.</li>\r\n        <li>Verás una lista con fechas y cantidades.</li>\r\n        <li><strong>Negro o Verde:</strong> Dinero que ha entrado (pensión, ingresos).</li>\r\n        <li><strong>Rojo o con un menos (-):</strong> Dinero que ha salido (pagos, recibos).</li>\r\n    </ol>', NULL, 10, 1, '2026-02-02 09:01:37'),
(8, 5, '¿Qué es el Phishing?', '<p>El \"Phishing\" es cuando un estafador se hace pasar por una empresa de confianza (Tu Banco, Correos, Hacienda) para robarte datos.</p>\r\n    <h3>Cómo reconocerlo:</h3>\r\n    <ul>\r\n        <li><strong>Urgencia:</strong> Te dicen \"Tu cuenta será bloqueada en 24h\" para que te pongas nervioso.</li>\r\n        <li><strong>Faltas de ortografía:</strong> A veces los mensajes están mal escritos.</li>\r\n        <li><strong>Enlaces extraños:</strong> Te piden que pinches en un enlace azul. <strong>¡NUNCA lo hagas si no estás seguro!</strong></li>\r\n    </ul>', NULL, 15, 1, '2026-02-02 09:01:37'),
(9, 5, 'El timo del \"Hijo en apuros\"', '<p>Muy común en WhatsApp.</p>\r\n    <p>Recibes un mensaje de un número desconocido que dice: <em>\"Mamá/Papá, se me ha roto el móvil, este es mi número nuevo. Necesito dinero urgente...\"</em></p>\r\n    <p><strong>QUÉ HACER:</strong></p>\r\n    <ol>\r\n        <li>No contestes.</li>\r\n        <li>Llama a tu hijo/a a su número de SIEMPRE (el viejo).</li>\r\n        <li>Comprobarás que está bien y que no es él quien te escribe.</li>\r\n        <li>Bloquea el número nuevo en WhatsApp.</li>\r\n    </ol>', NULL, 10, 2, '2026-02-02 09:01:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `orden` int(11) DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `curso_id`, `titulo`, `descripcion`, `orden`, `fecha_creacion`) VALUES
(1, 8, 'Módulo 1: Primeros Pasos y Contactos', 'Configuración básica y cómo agregar a la familia.', 1, '2026-02-02 09:01:37'),
(2, 8, 'Módulo 2: Enviando Fotos y Audios', 'Pierde el miedo a enviar recuerdos y notas de voz.', 2, '2026-02-02 09:01:37'),
(3, 4, 'Módulo 1: Acceso Seguro', 'Entrar a tu banco sin miedo.', 1, '2026-02-02 09:01:37'),
(4, 4, 'Módulo 2: Operaciones Básicas', 'El día a día de tus cuentas.', 2, '2026-02-02 09:01:37'),
(5, 9, 'Módulo 1: Detectando Engaños', 'No caigas en la trampa.', 1, '2026-02-02 09:01:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id`, `nombre`) VALUES
(1, 'A1 (Principiante)'),
(2, 'A2 (Básico)'),
(3, 'B1 (Intermedio)'),
(4, 'B2 (Intermedio Alto)'),
(5, 'C1 (Avanzado)'),
(6, 'C2 (Maestro)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso`
--

CREATE TABLE `progreso` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `leccion_id` int(11) NOT NULL,
  `completado` tinyint(1) DEFAULT 0,
  `fecha_completado` timestamp NULL DEFAULT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `progreso`
--

INSERT INTO `progreso` (`id`, `usuario_id`, `leccion_id`, `completado`, `fecha_completado`, `fecha_inicio`) VALUES
(1, 2, 5, 1, '2026-02-02 10:34:45', '2026-02-02 10:34:45'),
(2, 2, 6, 1, '2026-02-02 10:34:49', '2026-02-02 10:34:49'),
(3, 2, 7, 1, '2026-02-02 10:34:50', '2026-02-02 10:34:50'),
(4, 2, 2, 1, '2026-02-02 12:33:30', '2026-02-02 12:33:30'),
(5, 2, 3, 1, '2026-02-02 12:33:31', '2026-02-02 12:33:31'),
(6, 2, 4, 1, '2026-02-02 12:33:32', '2026-02-02 12:33:32'),
(7, 2, 8, 1, '2026-02-23 09:29:43', '2026-02-23 09:29:43'),
(8, 2, 9, 1, '2026-02-23 09:29:45', '2026-02-23 09:29:45'),
(9, 5, 1, 1, '2026-02-23 10:34:21', '2026-02-23 10:34:21'),
(10, 5, 2, 1, '2026-02-23 10:34:23', '2026-02-23 10:34:23'),
(11, 5, 3, 1, '2026-02-23 10:34:24', '2026-02-23 10:34:24'),
(12, 5, 4, 1, '2026-02-23 10:34:25', '2026-02-23 10:34:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` enum('M','F','O') DEFAULT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` enum('admin','estudiante','profesor') DEFAULT 'estudiante',
  `id_nivel` int(11) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre_completo`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `genero`, `clave`, `rol`, `id_nivel`, `notas`, `fecha_creacion`) VALUES
(1, 'admin', NULL, 'admin@eduiaio.com', NULL, NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 5, NULL, '2026-01-26 08:24:33'),
(2, 'Alejandro López', 'Alejandro Lopez Mogena', 'alejandrol@eduiaio.com', '123456789', 'Calle ASIR', '2006-03-23', 'M', '$2y$10$OgCdV6huPrPZYuazvY4PJub5/V8aT5pudFgUyCgolhrFR4lfzpDHq', 'estudiante', 2, 'Prueba', '2026-01-26 10:40:25'),
(4, 'Jimenon', 'Jimena Salado', 'jimenas@eduiaio.com', '123456789', 'Hola', '2006-05-10', 'O', '$2y$10$yIeaXMlf.pDojD7RpdE41u0.37ACPXMuTOCrsqQdoaFSISGOzj84K', 'admin', 4, 'Hola', '2026-02-02 10:33:08'),
(5, 'Alejandro Peman', NULL, 'prueba1@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$QkXkqwdt7P45KBnLWB1vOez5TFGnGYiD66IR3lID37z0vNiPw2Y6.', 'estudiante', 1, NULL, '2026-02-23 10:33:55'),
(6, 'IOar', 'bua', 'ioar@gmail.com', '12345678910', '2', NULL, 'M', '$2y$10$eYrawsWsRYawvEjfFcORxueSudrpuerANK3V7kY5MyA.7tie2T7na', 'estudiante', 5, 'sds', '2026-03-02 12:37:32'),
(7, 'Prueba Telefono', 'Telf', 'telf@gmail.com', '123456789', 'rfadwa', '2025-10-10', 'M', '$2y$10$ZOD5CIlee2G6mX/hT0.o7uMco7XQq/QVErprd7m40aflFxrTWpFt6', 'profesor', 2, 'adw', '2026-03-02 12:48:54');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `usuarios_delete` AFTER DELETE ON `usuarios` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, registro_id, detalles)
    VALUES ('usuarios', 'ELIMINAR', OLD.id, CONCAT('Usuario eliminado: ', OLD.usuario));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuarios_insert` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, registro_id, detalles)
    VALUES ('usuarios', 'INSERTAR', NEW.id, CONCAT('Nuevo usuario registrado: ', NEW.usuario, ' (Nombre: ', IFNULL(NEW.nombre_completo, 'N/A'), ', Rol: ', NEW.rol, ')'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuarios_update` AFTER UPDATE ON `usuarios` FOR EACH ROW BEGIN
    DECLARE cambios TEXT DEFAULT '';
    
    IF OLD.rol != NEW.rol THEN
        SET cambios = CONCAT(cambios, 'Rol cambiado de ', OLD.rol, ' a ', NEW.rol, '. ');
    END IF;
    
    IF OLD.email != NEW.email THEN
        SET cambios = CONCAT(cambios, 'Email cambiado de ', OLD.email, ' a ', NEW.email, '. ');
    END IF;

    IF IFNULL(OLD.nombre_completo, '') != IFNULL(NEW.nombre_completo, '') THEN
        SET cambios = CONCAT(cambios, 'Nombre cambiado de "', IFNULL(OLD.nombre_completo, ''), '" a "', IFNULL(NEW.nombre_completo, ''), '". ');
    END IF;

    IF IFNULL(OLD.telefono, '') != IFNULL(NEW.telefono, '') THEN
        SET cambios = CONCAT(cambios, 'Teléfono cambiado. ');
    END IF;

    IF IFNULL(OLD.direccion, '') != IFNULL(NEW.direccion, '') THEN
        SET cambios = CONCAT(cambios, 'Dirección actualizada. ');
    END IF;

    IF IFNULL(OLD.notas, '') != IFNULL(NEW.notas, '') THEN
        SET cambios = CONCAT(cambios, 'Notas administrativas actualizadas. ');
    END IF;

    IF cambios != '' THEN
        INSERT INTO auditoria (tabla, accion, registro_id, detalles)
        VALUES ('usuarios', 'ACTUALIZAR', OLD.id, cambios);
    END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `id_nivel` (`id_nivel`),
  ADD KEY `creado_por` (`creado_por`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_course_unique` (`usuario_id`,`curso_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indices de la tabla `lecciones`
--
ALTER TABLE `lecciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulo_id` (`modulo_id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_lesson_unique` (`usuario_id`,`leccion_id`),
  ADD KEY `leccion_id` (`leccion_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_nivel` (`id_nivel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lecciones`
--
ALTER TABLE `lecciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `progreso`
--
ALTER TABLE `progreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cursos_ibfk_3` FOREIGN KEY (`id_nivel`) REFERENCES `niveles` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lecciones`
--
ALTER TABLE `lecciones`
  ADD CONSTRAINT `lecciones_ibfk_1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `modulos_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD CONSTRAINT `progreso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `progreso_ibfk_2` FOREIGN KEY (`leccion_id`) REFERENCES `lecciones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_nivel`) REFERENCES `niveles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
