<?php
include_once '../../config/configDB.php';
include_once '../../models/User.php';
$conexion = new mysqli($host, $user, $password, $db, $puerto);
$users = new users($conexion);
$listaUsuarios = $users->listarUser();
$conexion->close();
?>
<?php
    include_once '../../config/configDB.php';
    include_once '../../models/User.php';
    session_start();
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== "administrador"){
        header("Location: ../../../index.php");
    }
    if(isset($_REQUEST['Enviar'])){
        $datos= [
            'userID' => $_REQUEST['userID'],
            'name' => $_REQUEST['name'],
            'surname' => $_REQUEST['surname'], 
            'mail' => $_REQUEST['mail'],
            'password' => $_REQUEST['password'],
            'rol' => $_REQUEST['rol']
        ];
        
        $conexion = new mysqli($host, $user, $password, $db, $puerto);
        $users = new users($conexion);
        if ($users->insertarUser($datos)) {
            echo "Usuario insertado correctamente.";
        } else {
            echo "Error al insertar el usuario: " . $conexion->error;
        }
        $conexion->close();
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style_index.css">
    <link rel="stylesheet" href="../../public/css/style_users.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Autenticacion</title>
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
        <h1>Gestionar Usuarios</h1>
    </header>
    <form action="" method="post">
        <label for="userID">Login</label>
        <input type="text" name="userID" id="userID">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name">
        <label for="surname">Apellido</label> 
        <input type="text" name="surname" id="surname">
        <label for="mail">Correo</label>
        <input type="email" name="mail" id="mail">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <label for="rol">Rol</label>
        <select name="rol" id="rol">
            <option value="administrador">Administrador</option>
            <option value="registrado">Registrado</option>
        </select>
        <input type="submit" value="Enviar" name="Enviar">
    </form>
    <table border=1>
        <tr>
            <th>Login</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Actualizar</th>
            <th>Borrar</th>
        </tr>
        <?php
            foreach ($listaUsuarios as $users) {
                echo "<tr>";
                echo "<td>" . $users['userID'] . "</td>";
                echo "<td>" . $users['name'] . "</td>";
                echo "<td>" . $users['surname'] . "</td>"; 
                echo "<td>" . $users['mail'] . "</td>";
                echo "<td>" . $users['rol'] . "</td>";
                echo "<td><a href='update_users.php?userID=" . $users['userID'] . "'>Actualizar</a></td>";
                echo "<td><a href='delete_users.php?userID=" . $users['userID'] . "'>Borrar</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <?php
    echo $pie;
    ?>
</body>
</html>
