<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/game.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estiloSidebarIz.css') ?>" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

        <title>Juego</title>
    </head>
    <body>
        <div id="contenedor">
        <?php
        $app->doInclude('comun/cabecera.php');
        $app->doInclude('comun/sidebarIzq.php');
        /*$app->doInclude('comun/sidebarDer.php');*/
        $app->doInclude('contenidos/contenidoJuego.php');
        
        $app->doInclude('comun/pie.php');
        ?>
            <script type="text/javascript" src="zork/javascript/loadGameFinal.js"></script>
            <script type="text/javascript" src="zork/javascript/gameFinal.js"></script>
            <script type="text/javascript" src="zork/javascript/Mazmorra.js"></script>
            <script type="text/javascript" src="zork/javascript/Mapa.js"></script>
            <script type="text/javascript" src="zork/javascript/Consumible.js"></script>
            <script type="text/javascript" src="zork/javascript/Personaje.js"></script>
            <script type="text/javascript" src="zork/javascript/Monstruo.js"></script>
            <!-- <script type="text/javascript" src="zork/javascript/pruebaCuadricula.js"></script> -->
        </div>
    </body>
</html>

<!--	
Bibliografia

Login : http://www.masiosare.mx/login-sin-base-de-datos/

Manual PHP

Material de la asignatura -->
