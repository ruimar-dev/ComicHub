<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar la biblioteca PHPMailer
require '../../../vendor/autoload.php';

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $mensaje = $_POST['mensaje'];

    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
         // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ruizmartinsergio0@gmail.com';
        $mail->Password   = 'obwzuhtsfglalquf';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Establecer el remitente y destinatario del correo
        $mail->setFrom($email, $nombre); // Establece la dirección de correo y el nombre del remitente
        $mail->addAddress('ruizmartinsergio0@gmail.com', 'Sergio Ruiz Martin');

        // Configuración del correo como HTML
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body    = "Nombre: $nombre<br>Correo: $email<br>Mensaje:<br>$mensaje";

        // Enviar el correo
        $mail->send();
        
        echo 'El mensaje se ha enviado correctamente';
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - ComicHub</title>
    <link rel="stylesheet" href="../../public/css/style_index.css">
    <link rel="stylesheet" href="../../public/css/style_contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php
        session_start();
        include_once '../../config/templates.php';
        if (isset($_SESSION['rol']) && $_SESSION['rol'] == "registrado") {
            echo $cabecera_registrado;
        } elseif (isset($_SESSION['rol']) && $_SESSION['rol'] == "administrador") {
            echo $cabecera_admin;
        } else {
            echo $cabecera_no_registrado;
        }
        ?>

        <main>
            <section class="contacto">
                <h1>Contacto</h1>
                <p>¡Estamos aquí para ayudarte! Ponte en contacto con nosotros mediante el formulario a continuación:</p>

                <form action="" method="post">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

                    <button type="submit" value="Enviar">Enviar Mensaje</button>
                </form>
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
    </div>
</body>

</html>