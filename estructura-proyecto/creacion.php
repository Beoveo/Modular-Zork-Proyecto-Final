<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estiloSidebarIz.css') ?>" />

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <title>Portada</title>
</head>
<body>
<div id="contenedor">
<?php
    $app->doInclude('comun/cabecera.php');
    echo "<div id='sidebar-left'>";
    $app->doInclude('comun/sidebarIzq.php');
    echo"</div>";
    //$app->doInclude('contenidos/contenidoCreacion1.php');  


    echo"<div id='contenido'>
    <h1>Creacion de Mapa</h1>";
    $formCrear= new \es\ucm\fdi\aw\FormularioCreacionMapa(); echo $formCrear->gestiona();
    echo "</div>";

    $app->doInclude('comun/pie.php');
?>

    <script type="text/javascript" src="zork/javascript/creacionFinal.js"></script>
    <!-- script type="text/javascript" src="zork/javascript/pruebaCuadricula.js"></script -->
</div>
</body>
</html>