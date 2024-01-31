<?php
include_once '../../config/configDB.php';
include_once '../../models/Comic.php';
include_once '../../models/ReadingList.php';

session_start();
// Verifica si el usuario está autenticado
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "registrado" && $_SESSION['rol'] !== "administrador") {
    header("Location: ../auth/login.php");
}

// Crea instancias de las clases Comic y ReadingList
$conexion = new mysqli($host, $user, $password, $db, $puerto);
$comicModel = new Comic($conexion);
$readingListModel = new ReadingList($conexion);

// Agregar cómic a la lista de lectura
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $comicID = $_POST['comicID'];
    $userID = $_SESSION['userID'];
    $estado = $_POST['estado'];

    $datos = [
        'state' => $estado,
        'userID' => $userID,
        'comicID' => $comicID,
    ];

    $readingListModel->agregarComicALista($datos);
}

// Actualizar estado del cómic en la lista de lectura
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $listaID = $_POST['listaID'];
    $nuevoEstado = $_POST['nuevoEstado'];

    $readingListModel->actualizarEstadoComic($listaID, $nuevoEstado);
}

// Eliminar cómic de la lista de lectura
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $listaID = $_POST['listaID'];

    $readingListModel->eliminarComicDeLista($listaID);
}

// Obtener la lista de cómics del usuario
$userID = $_SESSION['userID'];
$listaLectura = $readingListModel->obtenerListaLecturaUsuario($userID);

// Obtener la lista completa de cómics para el formulario de agregar
$listaCompleta = $comicModel->listarComics();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Lectura - ComicHub</title>
    <link rel="stylesheet" href="../../public/css/style_readingList.css">
    <link rel="stylesheet" href="../../public/css/style_index.css">
</head>

<body>
    <div class="container">
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
        <main>
            <section class="lectura">
                <h1>Lista de Lectura</h1>
                <form action="" method="post">
                    <label for="comicID">Selecciona un cómic:</label>
                    <select name="comicID" id="comicID" required>
                        <?php foreach ($listaCompleta as $comic) : ?>
                            <option value="<?= $comic['comicID']; ?>"><?= $comic['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="../../controllers/HomeController.php" class="agregar">Agregar Nuevo Cómic</a>
                    <label for="estado">Estado:</label>
                    <select name="estado" id="estado" required>
                        <option value="leido">Leído</option>
                        <option value="leyendo">Leyendo</option>
                    </select>

                    <button type="submit" name="agregar">Agregar a la Lista</button>
                </form>

                <table border="1">
                    <tr>
                        <th>Cómic</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($listaLectura as $comicLista) : ?>
                        <tr>
                            <td><?= $comicLista['title']; ?></td>
                            <td><?= $comicLista['state']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="listaID" value="<?= $comicLista['listID']; ?>">
                                    <label for="nuevoEstado" class="estado">Actualizar Estado:</label>
                                    <select name="nuevoEstado" id="nuevoEstado" class="select" required>
                                        <option value="leido"  <?php echo ($datos['state'] == 'leido') ? 'selected' : ''; ?>>Leído</option>
                                        <option value="leyendo"  <?php echo ($datos['state'] == 'leyendo') ? 'selected' : ''; ?>>Leyendo</option>
                                    </select>
                                    <button type="submit" name="actualizar">Actualizar</button>
                                </form>
                                <form action="" method="post">
                                    <input type="hidden" name="listaID" value="<?= $comicLista['listID']; ?>">
                                    <button type="submit" name="eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </section>
        </main>

        <?php
    echo $pie;
    ?>
    </div>
</body>

</html>
