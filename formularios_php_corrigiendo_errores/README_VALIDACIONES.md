# Validaciones agregadas (HTML5 + PHP)

Se han aplicado validaciones para los campos:
- **id**: solo números enteros (HTML: `type=number`, `pattern="\d+"`; PHP: `FILTER_VALIDATE_INT`).
- **nombre**: solo letras (HTML: `pattern` para letras y espacios; PHP: `preg_match`).
- **telefono**: solo números enteros (HTML: `pattern="\d+"`; PHP: `FILTER_VALIDATE_INT`).
- **precio**: número decimal (HTML: `type=number`, `step="0.01"`; PHP: `FILTER_VALIDATE_FLOAT`).

### ¿Qué se inyectó?
1. Un bloque de **validación en PHP** al inicio de los archivos que procesan `POST`. Si hay errores, se establece `$validacion_fallida = true` para que el código existente pueda decidir no continuar con la inserción/actualización.
2. Un **renderizador de errores** encima del primer `<form>`, que muestra los mensajes en un recuadro rojo.
3. **Atributos HTML5** en los `<input>` de `id`, `nombre`, `telefono`, `precio`.

> Nota: La inyección es no destructiva; no elimina tu lógica previa. Si un archivo usa otros nombres de campo, no será afectado.

### Archivos modificados
- clientes/crear.php
- clientes/editar.php
- productos/crear.php
- productos/editar.php
- usuarios/crear.php
- usuarios/editar.php
- ventas/crear.php
- ventas/editar.php