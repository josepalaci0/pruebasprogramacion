<?php
function getDbConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "Root1234567890";
    $dbname = "prueba2";

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            throw new Exception("Conexión fallida: " . $conn->connect_error);
        }
        return $conn;
    } catch (Exception $e) {
        die("Error al conectar con la base de datos: " . $e->getMessage());
    }
}
?>
