<?php
    include_once '../config/configDB.php' ;
    class users{
        private $conexion;
        private function limpiarDatos($datos)
        {
            $datosLimpio = [];
            foreach ($datos as $key => $value) {
                $datosLimpio[$key] = $this->conexion->real_escape_string($value);
            }
            return $datosLimpio;
        }
    
        public function __construct($conexion){
            $this->conexion = $conexion;
        }
        // Agregar un usuario
        public function insertarUser($datos){
            $salt = random_int(10000000, 99999999);
            $hashedPassword = hash('sha256', $datos['password'] . $salt);
            $sql = "INSERT INTO users (userID, name, surname,mail, salt, password, rol) VALUES ('$datos[userID]', '$datos[name]', '$datos[surname]','$datos[mail]', '$salt', '$hashedPassword', '$datos[rol]')";
            return $this->conexion->query($sql);
        }
        // Eliminar un usuario
        public function eliminarUser($userID){
            $sql = "DELETE FROM users WHERE userID = '$userID'";
            return $this->conexion->query($sql);
        }
        // Actualizar un usuario
        public function actualizarUser($datosUser){
            $mySet = "SET";
            
            if ($datosUser['userID']) {
                $mySet .= " userID='{$datosUser['userID']}',";
            }
            
            if ($datosUser['password']) {
                $mySet .= " password='{$datosUser['password']}',";
            }
        
            if ($datosUser['name']) {
                $mySet .= " name='{$datosUser['name']}',";
            }
            if ($datosUser['surname']) {
                $mySet .= " surname='{$datosUser['surname']}',";
            }
            if ($datosUser['mail']) {
                $mySet .= " mail='{$datosUser['mail']}',";
            }
            if ($datosUser['rol']) {
                $mySet .= " rol='{$datosUser['rol']}',";
            }
        
            $mySet = rtrim($mySet, ',');
            $sql = "UPDATE users $mySet WHERE userID = '{$datosUser['userID']}'";
        
            return $this->conexion->query($sql);
        }
        // Listar todos los usuarios
        public function listarUser(){
            $sql = "SELECT userID, name, surname,mail, rol FROM users";
            $resultados = $this->conexion->query($sql);
        
            if ($resultados) {
                if ($resultados->num_rows > 0) {
                    $datos = $resultados->fetch_all(MYSQLI_ASSOC);
                    $resultados->close();
                    return $datos;
                } else {
                    $resultados->close();
                    return [];
                }
            } else {
                echo "Error en la consulta: " . $this->conexion->error;
                return false;
            }
        }
        
        
        // Obtener información de un usuario
        public function obtenerInfoUsuario($userID){
            $query = "SELECT * FROM users WHERE userID = ?";
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("s", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();
            $stmt->close();

            return $usuario;
        }

        // Obtener la sal de un usuario
        public function obtenerSalDelUsuario($userID) {
            $query = "SELECT salt FROM users WHERE userID = '$userID'";
            $result = $this->conexion->query($query);
        
            if ($result) {
                $row = $result->fetch_assoc();
                $salt = $row['salt'];
                $result->close();
                return $salt;
            } else {
                return null; 
            }
        }

        // Actualizar la contraseña de un usuario
        public function UpdatePassword($userID, $nuevaPassword) {
            $sql = "UPDATE users SET password = '$nuevaPassword' WHERE userID = '$userID'";
            return $this->conexion->query($sql);
        } 
        public function UpdateProfile($userID, $nuevaPassword, $nuevoNombre, $nuevoApellido, $nuevoGmail) {
            $mySet = "SET";
            
            if ($nuevaPassword) {
                $mySet .= " password='$nuevaPassword',";
            }
        
            if ($nuevoNombre) {
                $mySet .= " name='$nuevoNombre',";
            }
            if ($nuevoApellido) {
                $mySet .= " surname='$nuevoApellido',";
            }
            if ($nuevoGmail) {
                $mySet .= " mail='$nuevoGmail',";
            }
        
            $mySet = rtrim($mySet, ',');
            $sql = "UPDATE users $mySet WHERE userID = '$userID'";
        
            return $this->conexion->query($sql);
        }

        // Verificar si la contraseña es correcta
        public function verificarPassword($userID, $password) {
            $query = "SELECT salt, password FROM users WHERE userID = '$userID' LIMIT 1";
            $result = $this->conexion->query($query);
        
            if ($result) {
                $row = $result->fetch_assoc();
        
                if ($row) {
                    $storedSalt = $row['salt'];
                    $storedPasswordHash = $row['password'];
                    $passwordHash = hash('sha256', $password . $storedSalt);
        
                    if ($passwordHash === $storedPasswordHash) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                // Manejo de error si la consulta no fue exitosa
                echo "Error en la consulta: " . $this->conexion->error;
                return false;
            }
        }

        // Obtener la contraseña de un usuario
        public function getPassword($userID) {
            $sql = "SELECT password FROM users WHERE userID = '$userID'";
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                if ($resultado->num_rows == 1) {
                    $fila = $resultado->fetch_assoc();
                    return $fila['password'];
                } else {
                    return null; // Usuario no encontrado
                }
            } else {
                echo "Error en la consulta: " . $this->conexion->error;
                return false;
            }
        }
        
    }
    
       
?>