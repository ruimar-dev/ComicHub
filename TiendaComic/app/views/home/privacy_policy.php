<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad - ComicHub</title>
    <link rel="stylesheet" href="../../public/css/style_index.css">
    <link rel="stylesheet" href="../../public/css/style_terminos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        .text{
            color:black;
        }
        h1{
            font-size: 51px;
            color:black;
        }
    </style>
</head>

<body>
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
    <h1>Política de Privacidad</h1>
        <section class="section">
            <h2 class="title">Información que Recopilamos</h2>
            <p class="text">Recopilamos información personal, como nombre, dirección de correo electrónico, etc., cuando te registras en nuestro sitio o interactúas con nuestros servicios.</p>
        </section class="section">

        <section class="section">
            <h2 class="title">Cómo Usamos la Información</h2>
            <p class="text">Usamos la información recopilada para proporcionar y mejorar nuestros servicios, personalizar tu experiencia y enviar actualizaciones relevantes.</p>
        </section>

        <section class="section">
            <h2 class="title">Compartir Información</h2>
            <p class="text">No compartiremos tu información personal con terceros, excepto cuando sea necesario para proporcionar nuestros servicios o cumplir con requisitos legales.</p>
        </section>

        <section class="section">
            <h2 class="title">Cookies y Tecnologías Similares</h2>
            <p class="text">Utilizamos cookies y tecnologías similares para mejorar la experiencia del usuario y analizar el tráfico. Puedes configurar tu navegador para rechazar cookies, pero esto puede afectar la funcionalidad del sitio.</p>
        </section>

        <section class="section">
            <h2 class="title">Seguridad</h2>
            <p class="text">Implementamos medidas de seguridad para proteger tu información. Sin embargo, ninguna transmisión por internet o almacenamiento electrónico es completamente segura, y no podemos garantizar la seguridad absoluta.</p>
        </section>

    </main>

    <footer>
    <div class="container">
        <div class="footer__content">
            <div class="footer__logo">
                <img src="../../public/img/ComicHub.png" alt="ComicHub Logo">
            </div>
            <div class="footer__links">
                <ul>
                    <li><a href="terminos.php">Términos y condiciones</a></li>
                    <li><a href="privacy_policy.php">Política de privacidad</a></li>
                    <li><a href="contact.php">Contacto</a></li>
                </ul>
             </div>
            <div class="footer__social">
                <a href="https://x.com/ruimardev?t=T1PvKIg2-U4jaU6QC-9TCg&s=09" target="_blank"><span class="icon-twitter"></span></a>
                <a href="#" target="_blank"><span class="icon-github"></span></a>
                <a href="https://www.instagram.com/_sergio_.22?igsh=NGVhN2U2NjQ0Yg==" target="_blank"><span class="icon-instagram"></span></a>
            </div>
        </div>
        <div class="footer__copyright">
            <p class="derechos">&copy; 2023 ComicHub. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
</body>

</html>
