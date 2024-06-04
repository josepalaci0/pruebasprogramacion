<?php
/**
 * Establece una conexión con la base de datos MySQL.
 * 
 * @return mysqli La conexión a la base de datos.
 */
function getDbConnection() {
    // Datos de conexión a la base de datos.
    $servername = "localhost";
    $username = "root";
    $password = "Root1234567890";
    $dbname = "prueba2";

    try {
        // Crea una nueva conexión a la base de datos MySQL.
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Verifica si hay algún error en la conexión.
        if ($conn->connect_error) {
            // Si hay un error en la conexión, lanza una excepción.
            throw new Exception("Conexión fallida: " . $conn->connect_error);
        }
        
        // Retorna la conexión establecida.
        return $conn;
    } catch (Exception $e) {
        // En caso de una excepción, detiene la ejecución del script y muestra un mensaje de error.
        die("Error al conectar con la base de datos: " . $e->getMessage());
    }
}
?>
