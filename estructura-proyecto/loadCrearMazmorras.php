<?php
require_once __DIR__.'/includes/config.php';
        $mazmorras= es\ucm\fdi\aw\Mazmorras::guardarMazmorra($_GET['nombre'], $_GET['rutaImagen'],$_GET['w'],$_GET['h']); //Creamos las mazmorras nuevas
        echo json_encode($mazmorras);
?>