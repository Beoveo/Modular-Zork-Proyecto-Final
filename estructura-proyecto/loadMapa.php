<?php
require_once __DIR__.'/includes/config.php';
    if(!($_GET['idMapa'] ?? '') ){
                $mapas = es\ucm\fdi\aw\Partida::cargaMapas();
                echo json_encode($mapas);
    }
    else{
                $idMapa=$_GET['idMapa'];
                $mapa= es\ucm\fdi\aw\Mapa::construyeMapa($idMapa);
                //echo $mapa;
                echo json_encode($mapa);
    }
?>
