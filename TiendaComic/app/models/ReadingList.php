<?php
include_once '../config/configDB.php' ;

class ReadingList {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    // Agregar un comic a la lista de lectura
    public function agregarComicALista($datos) {
        $sql = "INSERT INTO readingList (state, userID, comicID) 
                VALUES ('$datos[state]', '$datos[userID]', '$datos[comicID]')";
        return $this->conexion->query($sql);
    }
    // Actualizar el estado de un comic en la lista de lectura
    public function actualizarEstadoComic($listaID, $nuevoEstado) {
        $sql = "UPDATE readingList SET state = '$nuevoEstado' WHERE listID = '$listaID'";
        return $this->conexion->query($sql);
    }
    // Eliminar un comic de la lista de lectura
    public function eliminarComicDeLista($listaID) {
        $sql = "DELETE FROM readingList WHERE listID = '$listaID'";
        return $this->conexion->query($sql);
    }
    // Obtener la lista de lectura de un usuario
    public function obtenerListaLecturaUsuario($userID) {
        $sql = "SELECT readingList.listID, comics.title, readingList.state 
                FROM readingList
                JOIN comics ON readingList.comicID = comics.comicID
                WHERE readingList.userID = ?";
    
        // Utilizar consulta preparada
        $stmt = $this->conexion->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $userID);
    
            if ($stmt->execute()) {
                $resultados = $stmt->get_result();
    
                if ($resultados) {
                    $datos = $resultados->fetch_all(MYSQLI_ASSOC);
                    $resultados->close();
                    return $datos;
                } else {
                    echo "Error al obtener resultados: " . $this->conexion->error;
                }
            } else {
                echo "Error al ejecutar la consulta: " . $stmt->error;
            }
    
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $this->conexion->error;
        }
    
        return false;
    }
}
?>
