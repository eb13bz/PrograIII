-- 1. Crear base de datos
CREATE DATABASE sistema_ventas;
\c sistema_ventas;

-- 2. Crear tabla clientes
CREATE TABLE clientes (
    id_cliente SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) UNIQUE NOT NULL,
    telefono VARCHAR(20)
);

-- 3. Crear tabla usuarios
CREATE TABLE usuarios (
    id_usuario SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

-- 4. Crear tabla productos
CREATE TABLE productos (
    id_producto SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio NUMERIC(10,2) NOT NULL CHECK (precio >= 0),
    stock INT NOT NULL CHECK (stock >= 0)
);

-- 5. Crear tabla ventas
CREATE TABLE ventas (
    id_venta SERIAL PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_usuario INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total NUMERIC(12,2) NOT NULL CHECK (total >= 0),
    FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario) ON DELETE CASCADE
);

-- 6. Crear tabla detalles_venta
CREATE TABLE detalles_venta (
    id_detalle SERIAL PRIMARY KEY,
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL CHECK (cantidad > 0),
    precio_unitario NUMERIC(10,2) NOT NULL CHECK (precio_unitario >= 0),
    subtotal NUMERIC(12,2) GENERATED ALWAYS AS (cantidad * precio_unitario) STORED,
    FOREIGN KEY (id_venta) REFERENCES ventas (id_venta) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos (id_producto) ON DELETE CASCADE
);

-- 7. Índices
CREATE INDEX idx_ventas_cliente ON ventas (id_cliente);
CREATE INDEX idx_detalles_producto ON detalles_venta (id_producto);

-- 8. Datos de ejemplo
INSERT INTO clientes (nombre, correo, telefono) VALUES
('Juan Pérez', 'juan@example.com', '789456123'),
('María López', 'maria@example.com', '745896321');

INSERT INTO usuarios (nombre, usuario, contrasena) VALUES
('Carlos Gómez', 'carlos', '1234'),
('Ana Torres', 'ana', 'abcd');

INSERT INTO productos (nombre, precio, stock) VALUES
('Laptop', 1200.50, 10),
('Mouse', 25.00, 50);
