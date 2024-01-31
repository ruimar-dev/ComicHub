<?php
include_once '../config/configDB.php';
// Intentar establecer una conexión a la base de datos
$conexion = new mysqli($host, $user, $password, $db, $puerto, $raiz);

// Comprobar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    echo "La conexión a la base de datos se ha establecido con éxito. ";
}

$registroExitoso = false;
// Comprueba si se han enviado los datos del formulario
if (isset($_POST['nombrelinea']) && isset($_POST['nombre']) && isset($_POST['contrasena'])) {
    $nombrelinea = $_POST['nombrelinea'];
    $nombre = $_POST['nombre'];
    $Apellidos = $_POST['Apellidos'];
    $mail = $_POST['mail'];
    $contrasena = $_POST['contrasena'];

    // El salt aleatorio y el rol se ponen por defecto
    $salt = random_int(10000000, 99999999);
    $rol = "administrador";
    $contrasena = hash('sha256', $contrasena . $salt);
    // Insertar el usuario en la base de datos
    $sql = "INSERT INTO users (userID, name, surname, mail, salt, password, rol) VALUES ('$nombrelinea', '$nombre', '$Apellidos', '$mail', '$salt', '$contrasena', '$rol')";
    // Comprobar si la inserción se ha realizado correctamente
    if ($conexion->query($sql) === TRUE) {
        echo "Usuario registrado exitosamente. ";
        echo "Borre el script de instalación.";
        $registroExitoso = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
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
    <title>Registro del Primer Usuario Administrador</title>
</head>
<body>
    <h1>Registro del Primer Usuario Administrador</h1>
    <!-- Si el registro se ha realizado correctamente, mostrar un mensaje de éxito y un enlace para ir a la página principal -->
    <?php if ($registroExitoso) { ?>
        <p>Usuario registrado exitosamente. Borre el script de instalación.</p>
        <a href="../../index.php">¡Empieza a navegar!</a>
    <?php } else { ?>
        <form action="" method="POST">
            <label for="nombrelinea">Login:</label>
            <input type="text" id="nombrelinea" name="nombrelinea" required><br><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>
            
            <label for="Apellidos">Apellidos:</label>
            <input type="text" id="Apellidos" name="Apellidos" required><br><br>

            <label for="mail">Correo electrónico:</label>
            <input type="email" id="mail" name="mail" required><br><br>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required><br><br>

            <button type="submit">Registrar Administrador</button>
        </form>
    <?php } ?>
</body>
</html>
