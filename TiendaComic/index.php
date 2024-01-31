<?php
    if(!file_exists("app/config/configDB.php")){
        header("Location: app/install/install.php");
    }
?>
<?php
    include_once "app/config/configDB.php";
    $conexion = new mysqli($host, $user, $password, $db, $puerto,$raiz);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="app/public/css/style_index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
    <?php
    include_once 'app/config/templates.php';
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
    <section class="hero">
        <h1>Encuentra y ordena tus cómics indispensables dentro del vasto universo Marvel</h1>
        <p>Bienvenido a ComicHub, tu destino definitivo para explorar y disfrutar de los cómics más emocionantes de Marvel. Sumérgete en historias épicas, descubre nuevos personajes y sigue las aventuras de tus héroes favoritos.</p>
    </section>
    <section class="search-section">
        <h2>Encuentra tus cómics favoritos fácilmente</h2>
        <p>Con ComicHub, la búsqueda de tus cómics favoritos es más sencilla que nunca. Utiliza nuestra potente herramienta de búsqueda para encontrar rápidamente los cómics que te interesan. Filtra por personajes, escritores, series o cualquier otra palabra clave que desees.</p>
        <p>Explora nuestro extenso catálogo y descubre nuevas joyas del universo Marvel. Ya sea que busques cómics clásicos, eventos épicos o las últimas novedades, ComicHub tiene todo lo que necesitas para satisfacer tu pasión por los cómics.</p>
        <a href="app/API/search.php" class="section__search">Ir al Buscador</a>

    </section>
    <section class="register-section">
    <h2>Regístrate para una experiencia personalizada</h2>
    <p>Únete a ComicHub y disfruta de beneficios exclusivos. Regístrate para crear tu lista de lectura personalizada, donde podrás organizar y hacer un seguimiento de tus cómics favoritos, marcar los que has leído o planear leer en el futuro. Además estarás al tanto de las últimas novedades del universo Marvel.</p>
    <a href="app/views/auth/login.php" class="section__register">Registrarse</a>
    </section>
    <section class="contact-section">
    <h2>¿Necesitas ayuda o tienes alguna pregunta?</h2>
    <p>Estamos aquí para ayudarte. Contáctanos para resolver tus dudas, recibir asistencia técnica o proporcionarnos tus comentarios. Tu opinión es importante para nosotros.</p>
    <a href="app/views/home/contact.php" class="section__link">Contactar</a>
</section>

</main>

<?php
    echo $pie;
?>

</div>
</body>
</html>

