<?php
require_once __DIR__ . '/../config/db.php';

class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = getDbConnection();
    }

    public function create($nombre, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $this->conn->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la declaración: " . $this->conn->error);
            }
            $stmt->bind_param("sss", $nombre, $email, $passwordHash);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al ejecutar la declaración: " . $stmt->error);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $stmt->close();
        }
    }

    public function validateCredentials($email, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT contraseña FROM usuarios WHERE email = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la declaración: " . $this->conn->error);
            }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $storedPassword = $row['contraseña'];
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
            $stmt->close();
        }
    }

    public function getUserNameByEmail($email) {
        try {
            $stmt = $this->conn->prepare("SELECT nombre FROM usuarios WHERE email = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la declaración: " . $this->conn->error);
            }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row['nombre'];
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        } finally {
            $stmt->close();
        }
    }
}
?>
