# Propuesta de Mejoras para EDUIAIO

Basado en el análisis del proyecto actual y el enfoque en **personas mayores**, sugiero las siguientes mejoras:

## 1. Experiencia de Usuario (UX) y Accesibilidad (Prioridad Alta)
El público objetivo requiere interfaces extremadamente claras y adaptadas.

*   **Tipografía Adaptable**: Implementar controles para aumentar/disminuir el tamaño de letra fácilmente.
*   **Contraste Alto**: Asegurar suficiente contraste entre texto y fondo (WCAG AAA).
*   **Navegación Simplificada**: Botones grandes, etiquetas claras ("Ir al  Inicio" en lugar de iconos solos).
*   **Feedback Visual**: Mensajes de éxito/error muy claros y en lenguaje natural (evitar tecnicismos).

## 2. Seguridad (Prioridad Media)
Mejorar la robustez de la aplicación web.

*   **Protección CSRF**: Implementar tokens anti-Falsificación de Petición en Sitios Cruzados en todos los formularios.
*   **Validación de Entradas**: Sanitizar todos los datos recibidos (`$_POST`, `$_GET`) para prevenir XSS e inyecciones SQL (aunque usemos PDO, la validación extra es buena práctica).
*   **Hash de Contraseñas**: Asegurar el uso de `password_hash()` actualizado (Argon2id es preferible si está disponible).

## 3. Arquitectura del Código (Prioridad Media)
Para facilitar el mantenimiento futuro.

*   **Estructura MVC (Modelo-Vista-Controlador)**: Separar la lógica PHP (Controlador) del HTML (Vista). Actualmente están mezclados en archivos como `operaciones/listar.php`.
*   **Sistema de Plantillas**: Usar un sistema básico (o librerías como Twig/Blade) para reutilizar cabeceras y pies de página sin recurrir a `include` repetitivos.
*   **Autocarga (Autoloading)**: Usar Composer para gestionar dependencias y carga de clases automática.

## 4. Funcionalidades Nuevas (Futuro)
*   **Progreso del Alumno**: Barra de progreso visual para que vean cuánto han avanzado en un curso.
*   **Modo "Lectura Fácil"**: Una versión simplificada del contenido de los cursos.
*   **Asistente de Voz**: Integración básica para leer los textos en voz alta.

## 5. Base de Datos
*   **Backups Automáticos**: Script para generar copias de seguridad periódicas de `eduiaio`.
*   **Migraciones**: Usar un sistema de control de versiones para la base de datos (no solo archivos .sql sueltos).
