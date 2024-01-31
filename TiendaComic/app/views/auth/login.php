<?php
include_once '../../config/configDB.php';
include_once '../../models/seguridad.php';

if (isset($_POST['entrar'])) {
    $seguridad = new Seguridad($host, $user, $password, $db, $puerto);

    $login = $_POST['login'];
    $password = $_POST['password'];

    $seguridad->autenticarUsuario($login, $password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Iniciar Sesion</title>
</head>
    <body>
        <div class="loginbox">
            <h1>Login</h1>
            <form method="POST" id="formularioAutenticacion" >
                <img src="../../public/img/ComicHub.png" alt="" class="avatar">
                <label for="login">Login</label>
                <input type="text" name="login" />
                <label for="password">Password</label> 
                <input type="password" name="password"/>
                <input type="submit" name="entrar" value="Entrar"/>	
                <?php
                if(isset($_GET['error'])){
                    echo "<p>Usuario o contraseña incorrectos</p>";
                } 
                ?>
            </form>
        </div>
    </body>
</html>