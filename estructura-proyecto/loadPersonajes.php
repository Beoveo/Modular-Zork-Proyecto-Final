<?php
require_once __DIR__.'/includes/config.php';

    if(!($_GET['idPersonaje'] ?? '') ){
                $mapas = es\ucm\fdi\aw\Personaje::cargaPersonajes();
                echo json_encode($mapas);
    }
    else{
                $idPersonaje=$_GET['idPersonaje'];
                $mapa= es\ucm\fdi\aw\Personaje::getPersonaje($idPersonaje);
                //echo $mapa;
                echo json_encode($mapa);
    }
?>
