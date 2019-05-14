<?php
require_once __DIR__.'/includes/config.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/game.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estiloSidebarIz.css') ?>" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <title>Portada</title>
    </head>
    <body>
        <div id="contenedor">
        <?php
            $app->doInclude('comun/cabecera.php');
            $app->doInclude('comun/sidebarIzq.php');
            $app->doInclude('contenidos/contenidoJuego.php');
            $app->doInclude('comun/pie.php');
        ?>
            <script type="text/javascript" src="zork/javascript/loadGame.js"></script>
            <script type="text/javascript" src="zork/javascript/game.js"></script>

            
        </div>
    </body>
</html>

<!--	
Bibliografia

Login : http://www.masiosare.mx/login-sin-base-de-datos/

Manual PHP

Material de la asignatura -->
