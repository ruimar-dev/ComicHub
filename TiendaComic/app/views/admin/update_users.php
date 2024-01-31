<?php
include_once '../../config/configDB.php';
include_once '../../models/User.php';

$conexion = new mysqli($host, $user, $password, $db, $puerto, $raiz);
$users = new users($conexion);

session_start();

if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== "administrador"){
        header("Location: ../../../index.php");
}
if (isset($_POST['Actualizar'])) {
    $datosUser = [
        'userID' => $_POST['userID'],
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'mail' => $_POST['mail'],
        'rol' => $_POST['rol'],
    ];

    $nuevaPassword = $_POST['password'];

    if (!empty($nuevaPassword)) {
        $nuevaSalt = $users->obtenerSalDelUsuario($datosUser['userID']);


        $nuevaPasswordHashed = hash('sha256', $nuevaPassword . $nuevaSalt);

        $datosUser['password'] = $nuevaPasswordHashed;
        $datosUser['salt'] = $nuevaSalt;
    }

    if ($users->actualizarUser($datosUser)) {
        echo "Usuario actualizado correctamente.";
    } else {
        echo "Error al actualizar el usuario: " . $conexion->error;
    }
}

$loginUsuario = $_GET['userID'];
$datosUsuario = $users->obtenerInfoUsuario($loginUsuario);

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style_users.css">
    <title>Actualizar Usuario</title>
</head>
<body>
    <header>
        <a href="manage_users.php">Volver</a>
        <h1>Actualizar Usuario</h1>
    </header>

    <form action="" method="post">
        <label for="userID">Login</label>
        <input type="text" name="userID" id="userID" value="<?php echo $datosUsuario['userID']; ?>" readonly>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="<?php echo $datosUsuario['name']; ?>">
        <label for="surname">Apellido</label>
        <input type="text" name="surname" id="surname" value="<?php echo $datosUsuario['surname']; ?>">
        <label for="mail">Correo</label>
        <input type="email" name="mail" id="mail" value="<?php echo $datosUsuario['mail']; ?>">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <label for="rol">Rol</label>
    <select name="rol" id="rol">
        <option value="administrador" <?php echo ($datosUsuario['rol'] == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
        <option value="registrado" <?php echo ($datosUsuario['rol'] == 'registrado') ? 'selected' : ''; ?>>Registrado</option>
    </select>
        <input type="submit" value="Actualizar" name="Actualizar">
    </form>
</body>
</html>
