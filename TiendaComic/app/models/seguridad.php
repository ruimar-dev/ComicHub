<?php

class Seguridad {
    private $conexion;

    public function __construct($host, $user, $password, $db, $puerto) {
        $this->conexion = new mysqli($host, $user, $password, $db, $puerto);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }
    // Comprobar si el usuario está autenticado
    public function autenticarUsuario($userID, $password) {
        $userID = $this->conexion->real_escape_string($userID);
        $password = $this->conexion->real_escape_string($password);
        // Consulta para obtener la sal y la contraseña almacenada del usuario
        $consulta = "SELECT salt, password, rol FROM users WHERE userID='$userID'";
        $resultado = $this->conexion->query($consulta);

        // Verificar si se encontró un usuario
        if ($resultado->num_rows == 1) {
            $fila = $resultado->fetch_assoc();
            $salt = $fila['salt'];
            $contrasenaAlmacenada = $fila['password'];

            // Generar hash con la contraseña proporcionada y la sal almacenada
            $password2 = hash('sha256', $password . $salt);

            // Verificar si las contraseñas coinciden
            if ($password2 === $contrasenaAlmacenada) {
                session_start();
                $_SESSION['rol'] = $fila['rol']; 
                $_SESSION['userID'] = $userID;
                $this->conexion->close();
                header("Location: ../../../index.php");
                exit(); 
            }
        }

        $this->conexion->close();
        header("Location: ../auth/login.php?error=1");
        exit();
    }
}

?>