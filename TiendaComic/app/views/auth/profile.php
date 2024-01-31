<?php
include_once '../../config/configDB.php';
include_once '../../models/User.php';

session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
}

$conexion = new mysqli($host, $user, $password, $db, $puerto, $raiz);
$users = new Users($conexion);

if (isset($_POST['CambiarPerfil'])) {
    $loginUsuario = $_SESSION['userID'];
    $antiguaPassword = $_POST['antigua_password'];
    
    if (!$users->verificarPassword($loginUsuario, $antiguaPassword)) {
        echo "Contraseña actual incorrecta. Por favor, inténtalo de nuevo.";
    } else {
        $nuevaPassword = $_POST['nueva_password'];

        // Verifica si se proporciona una nueva contraseña
        if (!empty($nuevaPassword)) {
            $salt = $users->obtenerSalDelUsuario($loginUsuario);
            $hashNuevaPassword = hash('sha256', $nuevaPassword . $salt);
        } else {
            // Si no se proporciona una nueva contraseña, utiliza la contraseña existente
            $hashNuevaPassword = $users->getPassword($loginUsuario);
        }

        $nuevoNombre = $_POST['nombre'];
        $nuevoApellido = $_POST['apellido'];
        $nuevoGmail = $_POST['mail'];
        
        if ($users->UpdateProfile($loginUsuario, $hashNuevaPassword, $nuevoNombre, $nuevoApellido, $nuevoGmail)) {
            echo "Perfil actualizado correctamente.";
        } else {
            echo "Error al actualizar el perfil: " . $conexion->error;
        }
    }
}

$loginUsuario = $_SESSION['userID'];
$datosUsuario = $users->obtenerInfoUsuario($loginUsuario);

$conexion->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style_users.css">
    <link rel="stylesheet" href="../../public/css/style_index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Cambiar Perfil</title>
</head>
<body>
    <header>
    <?php
            include_once '../../config/templates.php';
            session_start();
            if(isset($_SESSION['rol']) && $_SESSION['rol']=="registrado"){
                echo $cabecera_registrado;
            }elseif(isset($_SESSION['rol']) && $_SESSION['rol']=="administrador") {
                echo $cabecera_admin;
            }else{
                echo $cabecera_no_registrado;
            }
    ?>
        <h1>Cambiar Perfil</h1>
    </header>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="antigua_password">Contraseña Actual</label>
        <input type="password" name="antigua_password" id="antigua_password">
        <label for="nueva_password">Nueva Contraseña</label>
        <input type="password" name="nueva_password" id="nueva_password">
        <label for="repetir_password">Repetir Nueva Contraseña</label>
        <input type="password" name="repetir_password" id="repetir_password">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $datosUsuario['name']; ?>">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido" value="<?php echo $datosUsuario['surname']; ?>">
        <label for="mail">Correo</label>
        <input type="email" name="mail" id="mail" value="<?php echo $datosUsuario['mail']; ?>">
        <input type="submit" value="Guardar" name="CambiarPerfil">
    </form>
    <?php
    echo $pie;
    ?>
</body>
</html>
