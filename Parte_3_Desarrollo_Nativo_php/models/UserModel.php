<?php
require_once __DIR__ . '/../config/db.php';

class UserModel {
    private $conn;

    /**
     * Constructor de la clase UserModel.
     * Establece la conexión a la base de datos utilizando la función getDbConnection.
     */
    public function __construct() {
        $this->conn = getDbConnection();
    }

    /**
     * Crea un nuevo usuario en la base de datos.
     *
     * @param string $nombre El nombre del usuario.
     * @param string $email El correo electrónico del usuario.
     * @param string $password La contraseña del usuario.
     * @return bool|string Verdadero si la creación es exitosa, o un mensaje de error en caso de fallo.
     */
    public function create($nombre, $email, $password) {
        // Generar un hash seguro de la contraseña utilizando BCRYPT.
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        try {
            // Preparar la declaración SQL para insertar un nuevo usuario.
            $stmt = $this->conn->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la declaración: " . $this->conn->error);
            }
            // Vincular los parámetros a la declaración SQL.
            $stmt->bind_param("sss", $nombre, $email, $passwordHash);

            // Ejecutar la declaración.
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al ejecutar la declaración: " . $stmt->error);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            // Cerrar la declaración para liberar recursos.
            $stmt->close();
        }
    }

    /**
     * Valida las credenciales del usuario.
     *
     * @param string $email El correo electrónico del usuario.
     * @param string $password La contraseña del usuario.
     * @return bool Verdadero si las credenciales son válidas, falso en caso contrario.
     */
    public function validateCredentials($email, $password) {
        try {
            // Preparar la declaración SQL para seleccionar la contraseña del usuario según el email.
            $stmt = $this->conn->prepare("SELECT contraseña FROM usuarios WHERE email = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la declaración: " . $this->conn->error);
            }
            // Vincular el parámetro de email a la declaración preparada.
            $stmt->bind_param("s", $email);
            // Ejecutar la declaración preparada.
            $stmt->execute();
            // Obtener el resultado de la ejecución.
            $result = $stmt->get_result();

            // Verificar si se encontró exactamente un usuario con ese email.
            if ($result->num_rows == 1) {
                // Obtener la fila de resultados.
                $row = $result->fetch_assoc();
                // Obtener la contraseña almacenada.
                $storedPassword = $row['contraseña'];
                // Verificar si la contraseña proporcionada coincide con la almacenada.
                if (password_verify($password, $storedPassword)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        } finally {
            // Cerrar la declaración preparada para liberar recursos.
            $stmt->close();
        }
    }

    /**
     * Obtiene el nombre de usuario por su correo electrónico.
     *
     * @param string $email El correo electrónico del usuario.
     * @return string|null El nombre del usuario o null si no se encuentra.
     */
    public function getUserNameByEmail($email) {
        try {
            // Preparar la declaración SQL para seleccionar el nombre del usuario según el email.
            $stmt = $this->conn->prepare("SELECT nombre FROM usuarios WHERE email = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la declaración: " . $this->conn->error);
            }
            // Vincular el parámetro de email a la declaración preparada.
            $stmt->bind_param("s", $email);
            // Ejecutar la declaración preparada.
            $stmt->execute();
            // Obtener el resultado de la ejecución.
            $result = $stmt->get_result();

            // Verificar si se encontró exactamente un usuario con ese email.
            if ($result->num_rows == 1) {
                // Obtener la fila de resultados.
                $row = $result->fetch_assoc();
                return $row['nombre'];
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        } finally {
            // Cerrar la declaración preparada para liberar recursos.
            $stmt->close();
        }
    }
}
?>
