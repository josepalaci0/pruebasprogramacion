-- 1. Crear la base de datos
CREATE DATABASE IF NOT EXISTS prueba2;

-- 2. Usar la base de datos
USE prueba2;

-- 3. Crear la tabla usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL
);

-- 4. Insertar al menos 23 registros en la tabla usuarios
INSERT INTO usuarios (nombre, email, contraseña) VALUES
('Juan Perez', 'juan.perez@example.com', 'password123'),
('Maria Garcia', 'maria.garcia@example.com', 'password456'),
('Luis Rodriguez', 'luis.rodriguez@example.com', 'password789'),
('Ana Fernandez', 'ana.fernandez@example.com', 'password012'),
('Pedro Martinez', 'pedro.martinez@example.com', 'password345'),
('Laura Gomez', 'laura.gomez@example.com', 'password678'),
('Jorge Hernandez', 'jorge.hernandez@example.com', 'password901'),
('Carla Ruiz', 'carla.ruiz@example.com', 'password234'),
('Miguel Sanchez', 'miguel.sanchez@example.com', 'password567'),
('Sofia Torres', 'sofia.torres@example.com', 'password890'),
('Ricardo Diaz', 'ricardo.diaz@example.com', 'password1234'),
('Elena Vasquez', 'elena.vasquez@example.com', 'password5678'),
('Victor Morales', 'victor.morales@example.com', 'password9012'),
('Patricia Romero', 'patricia.romero@example.com', 'password3456'),
('Andres Delgado', 'andres.delgado@example.com', 'password7890'),
('Lucia Ortega', 'lucia.ortega@example.com', 'password1122'),
('Diego Castro', 'diego.castro@example.com', 'password3344'),
('Marta Rios', 'marta.rios@example.com', 'password5566'),
('Fernando Alvarez', 'fernando.alvarez@example.com', 'password7788'),
('Gloria Chavez', 'gloria.chavez@example.com', 'password9900'),
('Hector Molina', 'hector.molina@example.com', 'password1212'),
('Raquel Ramos', 'raquel.ramos@example.com', 'password3434'),
('Esteban Reyes', 'esteban.reyes@example.com', 'password5656');

-- 5. Implementar una función que reciba el email de un usuario como parámetro y devuelva su nombre
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

-- 6. Implementar una función que reciba el nombre de un usuario como parámetro y actualice su contraseña en la base de datos
DELIMITER $$
CREATE PROCEDURE actualizar_contraseña_por_nombre(p_nombre VARCHAR(50), p_nueva_contraseña VARCHAR(100))
BEGIN
    UPDATE usuarios 
    SET contraseña = p_nueva_contraseña
    WHERE nombre = p_nombre;
END$$
DELIMITER ;

-- Ejemplo de uso de las funciones y procedimientos

SET SQL_SAFE_UPDATES = 1;


-- Obtener el nombre de un usuario por su email
SELECT obtener_nombre_por_email('juan.perez@example.com') AS nombre_usuario;

-- Actualizar la contraseña de un usuario por su nombre
CALL actualizar_contraseña_por_nombre('Maria Garcia', 'nueva_password456');

-- Verificar la actualización de la contraseña
SELECT * FROM usuarios WHERE nombre = 'Maria Garcia';
