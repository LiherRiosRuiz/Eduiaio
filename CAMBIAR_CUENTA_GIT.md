# Cómo Cambiar de Cuenta de GitHub en Windows

El error 403 indica que estás intentando subir cambios con un usuario (`liherrios-prog`) que no tiene permiso en el repositorio de `LiherRiosRuiz`. Para solucionar esto, necesitas "olvidar" las credenciales guardadas y volver a iniciar sesión.

### Paso 1: Eliminar Credenciales Guardadas

1. Abre el menú Inicio de Windows y busca **"Administrador de credenciales"** (o "Credential Manager").
2. Abre la aplicación y ve a la pestaña **"Credenciales de Windows"**.
3. Busca en la lista algo que diga `git:https://github.com`.
4. Haz clic en la flecha para expandirlo y selecciona **"Quitar"** (Remove).

### Paso 2: Volver a Intentar el Push

Vuelve a tu terminal (PowerShell o VS Code) e intenta subir el código otra vez:

```bash
git push origin master
```

### Paso 3: Iniciar Sesión con la Cuenta Correcta

Al ejecutar el comando anterior, Windows te pedirá credenciales de nuevo.
1. Se abrirá una ventana de navegador o un cuadro de diálogo.
2. Inicia sesión con la cuenta **dueña** del repositorio (probablemente `LiherRiosRuiz` o la cuenta que tenga permisos de escritura).
3. Autoriza la conexión.

---

### Solución Alternativa (Configurar Usuario Local)

Si sigues teniendo problemas, asegúrate de que tu configuración local coincida con tu identidad:

```bash
git config user.name "Tu Nombre Correcto"
git config user.email "tu_email_correcto@ejemplo.com"
```
