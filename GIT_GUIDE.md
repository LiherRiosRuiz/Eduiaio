# Guía de Git para EDUIAIO

Sigue estos pasos para guardar tus cambios y subirlos a GitHub.

## 1. Verificar el Estado
Antes de nada, mira qué archivos han cambiado:

```bash
git status
```

Deberías ver modificados:
- `README.md`
- `base_de_datos/eduiaio_es.sql`
- Y posiblemente otros archivos si has editado código.

## 2. Añadir Cambios (Staging)
Prepara todos los archivos modificados para ser guardados:

```bash
git add .
```

*Nota: El punto `.` significa "todo el directorio actual".*

## 3. Guardar Cambios (Commit)
Crea un punto de guardado en tu historial local con un mensaje descriptivo:

```bash
git commit -m "feat: actualización de categorías y cursos para personas mayores"
```

## 4. Subir a GitHub (Push)
Envía tus cambios al repositorio remoto (GitHub):

```bash
git push origin main
```

*Si tu rama principal se llama `master` en lugar de `main`, usa `git push origin master`.*

---

### Solución de Problemas Comunes

**Error: "refusing to merge unrelated histories"**
Si acabas de crear el repo y te da este error al hacer pull:
```bash
git pull origin main --allow-unrelated-histories
```

**Verificar configuración remota**
Si no sabes a dónde estás subiendo:
```bash
git remote -v
```
