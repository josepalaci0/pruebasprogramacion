# Parte 1: Base de Datos prueba2

Este proyecto describe la creación de una base de datos MySQL llamada `prueba2`, que contiene una tabla `usuarios` con varios registros de prueba. Además, se implementan dos funciones: una para obtener el nombre de un usuario a partir de su email y otra para actualizar la contraseña de un usuario dado su nombre.

## Contenido

- [Creación de la base de datos `prueba2`](#1-crear-la-base-de-datos)
- [Creación de la tabla `usuarios`](#3-crear-la-tabla-usuarios)
- [Inserción de 2 registros en la tabla `usuarios`](#4-insertar-registros-en-la-tabla-usuarios)
- [Creación de una función para obtener el nombre de un usuario por su email](#5-crear-una-función-para-obtener-el-nombre-por-email)
- [Creación de un procedimiento para actualizar la contraseña de un usuario por su nombre](#6-crear-un-procedimiento-para-actualizar-la-contraseña-por-nombre)

## Instrucciones

### 1. Crear la base de datos

```sql
CREATE DATABASE IF NOT EXISTS prueba2;


USE prueba2;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL
);

INSERT INTO usuarios (nombre, email, contraseña) VALUES
('Juan Perez', 'juan.perez@example.com', 'password123'),
('Maria Garcia', 'maria.garcia@example.com', 'password456'),
...
('Esteban Reyes', 'esteban.reyes@example.com', 'password5656');

DELIMITER $$
CREATE FUNCTION obtener_nombre_por_email(p_email VARCHAR(100)) 
RETURNS VARCHAR(50)
DETERMINISTIC
BEGIN
    DECLARE v_nombre VARCHAR(50);
    SELECT nombre INTO v_nombre FROM usuarios WHERE email = p_email;
    RETURN v_nombre;
END$$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE actualizar_contraseña_por_nombre(p_nombre VARCHAR(50), p_nueva_contraseña VARCHAR(100))
BEGIN
    UPDATE usuarios 
    SET contraseña = p_nueva_contraseña
    WHERE nombre = p_nombre;
END$$
DELIMITER ;

SET SQL_SAFE_UPDATES = 1;

-- Obtener el nombre de un usuario por su email
SELECT obtener_nombre_por_email('juan.perez@example.com') AS nombre_usuario;

-- Actualizar la contraseña de un usuario por su nombre
CALL actualizar_contraseña_por_nombre('Maria Garcia', 'nueva_password456');

-- Verificar la actualización de la contraseña
SELECT * FROM usuarios WHERE nombre = 'Maria Garcia';