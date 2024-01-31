<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones - ComicHub</title>
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
    <h1>Términos y Condiciones</h1>
        <section>
            <h2 class="title">1. Aceptación de Términos</h2>
            <p class="text" >Al acceder y utilizar este sitio web, aceptas cumplir con estos términos y condiciones de uso. Si no estás de acuerdo con alguno de los siguientes términos, no utilices este sitio.</p>
        </section>

        <section>
            <h2 class="title">2. Uso del Sitio</h2>
            <p class="text">Este sitio web y su contenido son propiedad de ComicHub. Queda prohibido el uso no autorizado de este sitio o su contenido para fines comerciales.</p>
        </section>

        <section>
            <h2 class="title">3. Contenido del Usuario</h2>
            <p class="text">Los usuarios son responsables del contenido que publiquen. ComicHub se reserva el derecho de eliminar cualquier contenido que viole estos términos y condiciones.</p>
        </section>

        <section>
            <h2 class="title">4. Privacidad</h2>
            <p class="text">Consulta nuestra <a href="privacy_policy.html">Política de Privacidad</a> para obtener información sobre cómo manejamos tus datos personales.</p>
        </section>

        <section>
            <h2 class="title">5. Modificaciones</h2>
            <p class="text">Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Las modificaciones serán efectivas inmediatamente después de su publicación en el sitio.</p>
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
