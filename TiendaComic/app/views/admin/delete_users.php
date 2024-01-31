<?php
    include_once '../../config/configDB.php';
    include_once '../../models/User.php';
if (isset($_REQUEST['userID'])) {
    $conexion = new mysqli($host, $user, $password, $db, $puerto);
    $users = new users($conexion);
    $loginToDelete = $_REQUEST['userID'];
    $users->eliminarUser($loginToDelete);
    $conexion->close();
    header("Location: manage_users.php");
}
?>