<?php
// Verificar si se han enviado datos del formulario
if(isset($_POST['host']) && isset($_POST['user']) && isset($_POST['password']) && isset($_POST['database']) && isset($_POST['puerto'])){
    
    // Obtener los datos del formulario
    $host = $_POST['host'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    $db = $_POST['database'];
    $puerto = $_POST['puerto'];

    try {
        // Intentar establecer una conexión a la base de datos
        $conexion = new mysqli($host, $user, $password, $db, $puerto);
        
        // Verificar si hay un error en la conexión
        if ($conexion->connect_error) {
            echo "Error en las credenciales: " . $conexion->connect_error;
        } else {
            // Credenciales válidas. La conexión a la base de datos se ha establecido con éxito.

            // Crear o abrir el archivo de configuración
            $file = fopen("../config/configDB.php", "w");

            // Obtener la ruta raíz del servidor
            $raiz = substr($_SERVER['HTTP_REFERER'],0,-24);

            // Escribir las credenciales en el archivo de configuración
            fwrite($file, "<?php\n");
            fwrite($file, "\$host = '$host';\n");
            fwrite($file, "\$user = '$user';\n");
            fwrite($file, "\$password = '$password';\n");
            fwrite($file, "\$db = '$db';\n");
            fwrite($file, "\$puerto = '$puerto';\n");
            fwrite($file, "\$raiz = '$raiz';\n");
            fwrite($file, "?>");

            // Cerrar el archivo
            fclose($file);

            // Redirigir a la siguiente página
            header("Location: insertar_admin.php");
        }
    } catch (Exception $e) {
        // Capturar cualquier excepción durante el proceso
        echo "Error en las credenciales ";
    }
} else {
    // Mensaje de error si no se proporcionó algún dato en el formulario
    echo "Error: no se proporcionaron datos.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style_admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Credenciales</title>
    <style>
        input:last-child {
            border: none;
            outline: none;
            height: 40px;
            background: #08b0ce;
            color: #fff;
            font-size: 18px;
            width: 100%;
            border-radius: 10px;
        }

        input:last-child:hover{
            cursor: pointer;
            background: #fff;
            color: #000;

        }
    </style>
</head>
<body>
    <h1 class="h1">Credenciales necesarias</h1>
    <h3>Ponga las credenciales del sistema gestor de Bases de datos</h3>
    <form action="" method="post">
        <label for="host">Host</label>
        <input type="text" name="host" id="host" required>
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <label for="database">Nombre de la base de datos</label>
        <input type="text" name="database" id="database" required>
        <label for="puerto">Puerto</label>
        <input type="number" name="puerto" id="puerto" required>
        <input type="submit" value="Enviar">
    </form>

    <?php
    include_once '../config/configDB.php';
    $conexion = new mysqli($host, $user, $password, $db, $puerto);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    } else {
        $sql = "CREATE TABLE comics (
            `comicID` int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `writer` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `character` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `publicationDate` date NOT NULL
        )";

        if ($conexion->query($sql) === TRUE) {
            echo "Tabla comics creada exitosamente";
        } else {
            echo "Error creando la tabla comics: " . $conexion->error;
        }

        $sql = "CREATE TABLE users (
            `userID` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL PRIMARY KEY,
            `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `surname` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `mail` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `salt` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `rol` enum('administrador','registrado') COLLATE utf8mb4_unicode_ci NOT NULL
        )";

        if ($conexion->query($sql) === TRUE) {
            echo "Tabla usuarios creada exitosamente";
        } else {
            echo "Error creando la tabla usuarios: " . $conexion->error;
        }
        $sql = "CREATE TABLE readingList (
            `listID` int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `state` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `userID` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
            `comicID` int UNSIGNED,
            FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
            FOREIGN KEY (`comicID`) REFERENCES `comics` (`comicID`)
        )";
        
        if ($conexion->query($sql) === TRUE) {
            echo "Tabla readingList creada exitosamente";
        } else {
            echo "Error creando la tabla readingList: " . $conexion->error;
        }
    }