<?php
require_once __DIR__.'/includes/config.php';

    if(!($_GET['idMazmorra'] ?? '') ){
                $array[0] = es\ucm\fdi\aw\Mazmorras::cargaMazmorra();
                $array[1] = es\ucm\fdi\aw\Mapa::ultimoMapaCreado(); //Carga datos mapa
                echo json_encode($array);
    }
    else{
                echo "fallo en loadMAZMORRAS";
    }
?>