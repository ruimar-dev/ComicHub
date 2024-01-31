<?php
include_once '../models/Comic.php';
include_once '../config/configDB.php';

$conexion = new mysqli($host, $user, $password, $db, $puerto, $raiz);
$comic = new Comic($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datosComic = [
        'title' => htmlspecialchars($_POST['title']),
        'writer' => htmlspecialchars($_POST['writer']),
        'character' => htmlspecialchars($_POST['character']),
        'publicationDate' => htmlspecialchars($_POST['publicationDate']),
    ];

    try {
        $comic->agregarComic($datosComic);
        // Redireccionar a la lista de cómics u otra página después de agregar
        header("Location: ../views/home/reading_list.php");
        exit();
    } catch (Exception $e) {
        echo "Error al agregar el cómic: " . $e->getMessage();
    }
}

// Cierra la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style_comic.css">
    <title>Agregar comics</title>
</head>
<body>
    <a href="../views/home/reading_list.php" class="volver">Volver</a>
    <h1>Agregar comics</h1>

    <form action="" method="POST">
        <label for="title">Titulo</label>
        <input type="text" name="title" id="title">
        <label for="writer">Escritor</label>
        <input type="text" name="writer" id="writer">
        <label for="character">Personaje</label>
        <input type="text" name="character" id="character">
        <label for="publicationDate">Fecha de publicacion</label>
        <input type="date" name="publicationDate" id="publicationDate">
        <input type="submit" value="Agregar">
    </form>
    
</body>
</html>