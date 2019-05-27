<?php
require_once __DIR__.'/includes/config.php';

    if($_GET['arrayMaz'] ?? ''){
        $maz=$_GET['arrayMaz'];
        //$mapa= es\ucm\fdi\aw\MapaContiene::guardarConexion($maz);
        $mazmorras= es\ucm\fdi\aw\Mazmorras::guardarMazmorras($maz); //Creamos las mazmorras nuevas
        echo json_encode($mazmorras);
    }
    else{
        echo "fallo en loadSeleccion";
                
    }
?>