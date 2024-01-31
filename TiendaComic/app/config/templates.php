<?php
/**
 * Cabecera de mi aplicación
 */
//$raiz = $_SERVER['HTTP_HOST'];
require_once 'configDB.php';

$cabecera_admin=
<<<EX
<header>
            <nav>
            <a href="$raiz/index.php"><img src="$raiz/app/public/img/ComicHub.png" alt=""></a>
                <ul>
                    <li><a href="$raiz/app/API/search.php">Buscador</a></li>
                    <li><a href="$raiz/app/views/home/reading_list.php">Lista de Lectura</a></li>
                    <li><a href="$raiz/app/views/home/contact.php">Contacto</a></li>
                    <li><a href="$raiz/app/views/auth/profile.php">Cambiar datos</a></li>
                    <li><a href="$raiz/app/views/admin/manage_users.php">Gestionar Usuarios</a></li>
                    <li><a href="$raiz/app/views/auth/close.php">Salir</a></li>
                </ul>
            </nav>
</header>
EX;
$cabecera_registrado=
<<<EX
<header>
            <nav>
            <a href="$raiz/index.php"><img src="$raiz/app/public/img/ComicHub.png" alt=""></a>
                <ul>
                    <li><a href="$raiz/app/API/search.php">Buscador</a></li>
                    <li><a href="$raiz/app/views/home/reading_list.php">Lista de Lectura</a></li>
                    <li><a href="$raiz/app/views/home/contact.php">Contacto</a></li>
                    <li><a href="$raiz/app/views/auth/profile.php">Cambiar datos</a></li>
                    <li><a href="$raiz/app/views/auth/close.php">Salir</a></li>
                </ul>
            </nav>
</header>
EX;
$cabecera_no_registrado=
<<<EX
<header>
            <nav>
            <a href="$raiz/index.php"><img src="$raiz/app/public/img/ComicHub.png" alt=""></a>
                <ul>
                    <li><a href="$raiz/app/API/search.php">Buscador</a></li>
                    <li><a href="$raiz/app/views/home/reading_list.php">Lista de Lectura</a></li>
                    <li><a href="$raiz/app/views/home/contact.php">Contacto</a></li>
                    <li><a href="$raiz/app/views/auth/login.php">Iniciar Sesión</a></li>
                </ul>
            </nav>
</header>
EX;

/**
 * Pie de mi aplicacion
 */

$pie=
<<<EX
<footer>
    <div class="container">
        <div class="footer__content">
            <div class="footer__logo">
                <img src="$raiz/app/public/img/ComicHub.png" alt="ComicHub Logo">
            </div>
            <div class="footer__links">
                <ul>
                    <li><a href="$raiz/app/views/home/terminos.php">Términos y condiciones</a></li>
                    <li><a href="$raiz/app/views/home/privacy_policy.php">Política de privacidad</a></li>
                    <li><a href="$raiz/app/views/home/contact.php">Contacto</a></li>
                </ul>
             </div>
            <div class="footer__social">
                <a href="https://x.com/ruimardev?t=T1PvKIg2-U4jaU6QC-9TCg&s=09" target="_blank"><span class="icon-twitter"></span></a>
                <a href="https://github.com/ruimar-dev" target="_blank"><span class="icon-github"></span></a>
                <a href="https://www.instagram.com/_sergio_.22?igsh=NGVhN2U2NjQ0Yg==" target="_blank"><span class="icon-instagram"></span></a>
            </div>
        </div>
        <div class="footer__copyright">
            <p class="derechos">&copy; 2023 ComicHub. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
EX;

?>
