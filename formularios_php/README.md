# Sistema de Ventas (PHP + PostgreSQL)

Este proyecto implementa CRUD completo para **Clientes, Productos, Usuarios** y **Ventas con Detalle**.

## Requisitos
- PHP 8+ con extensión PDO y pdo_pgsql habilitadas
- PostgreSQL 13+
- Servidor local (Apache / Nginx) o `php -S`

## Instalación
1. Crear la BD y tablas en PostgreSQL ejecutando `script_bd.sql`.
2. Copiar la carpeta `sistema_ventas_php` al directorio raíz de tu servidor (o a cualquier ruta local).
3. Editar `config/conexion.php` y colocar tu usuario/contraseña de PostgreSQL.
4. Iniciar servidor:
   ```bash
   php -S localhost:8000 -t sistema_ventas_php
   ```
5. Abrir `http://localhost:8000` en el navegador.

## Notas
- Las restricciones de no-negativos y claves foráneas se respetan en BD.
- En Ventas: se descuenta stock al crear/editar y se repone stock al eliminar.
- El estilo es CSS puro sin dependencias pesadas.
