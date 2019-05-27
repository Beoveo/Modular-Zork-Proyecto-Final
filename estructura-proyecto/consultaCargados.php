<?php

require_once __DIR__.'/includes/config.php';
$idPartida = $_GET['idPartida'];

$consumibles=es\ucm\fdi\aw\Partida::consultaCargados($idPartida);
$inventario=es\ucm\fdi\aw\Partida::cargarInventarioPartida($idPartida);
$array=array();
$array[0]=$consumibles;
$array[1]=$inventario;
echo json_encode($array);


?>