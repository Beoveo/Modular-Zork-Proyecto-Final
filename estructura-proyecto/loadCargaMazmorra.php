<?php
require_once __DIR__.'/includes/config.php';

    if(!($_GET['idMazmorra'] ?? '') ){
                $array = es\ucm\fdi\aw\Mazmorras::cargaUltimaMazmorra();
                echo json_encode($array);
    }
    else{
                echo "fallo en loadMAZMORRAS";
    }
?>