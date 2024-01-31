<?php
    include_once '../config/configDB.php' ;

class Comic {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function agregarComic($datos) {
        // Utilizar una consulta preparada para evitar inyección de SQL
        $sql = "INSERT INTO comics (`comicID`,`title`, `writer`, `character`, `publicationDate`) VALUES (NULL,'{$datos['title']}', '{$datos['writer']}', '{$datos['character']}', '{$datos['publicationDate']}')";
    
        // Preparar la consulta
        return $this->conexion->query($sql);
    }
    
    // Obtener un comic por su ID
    public function obtenerComic($comicID) {
        $query = "SELECT * FROM comics WHERE comicID = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $comicID);
        $stmt->execute();
        $result = $stmt->get_result();
        $comic = $result->fetch_assoc();
        $stmt->close();

        return $comic;
    }
    // Actualizar un comic
    public function actualizarComic($datosComic) {
        $set = "SET";

        if ($datosComic['title']) {
            $set .= " title='{$datosComic['title']}',";
        }

        if ($datosComic['writer']) {
            $set .= " writer='{$datosComic['writer']}',";
        }

        if ($datosComic['character']) {
            $set .= " character='{$datosComic['character']}',";
        }

        if ($datosComic['publicationDate']) {
            $set .= " publicationDate='{$datosComic['publicationDate']}',";
        }

        $set = rtrim($set, ',');
        $sql = "UPDATE comics $set WHERE comicID = '{$datosComic['comicID']}'";

        return $this->conexion->query($sql);
    }

    // Eliminar un comic
    public function eliminarComic($comicID) {
        $sql = "DELETE FROM comics WHERE comicID = '$comicID'";
        return $this->conexion->query($sql);
    }
    // Listar todos los comics
    public function listarComics() {
        $sql = "SELECT * FROM comics";
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
}
?>
