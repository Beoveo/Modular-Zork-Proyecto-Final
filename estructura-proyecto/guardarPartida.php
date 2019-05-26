<?php
require_once __DIR__.'/includes/config.php';
$arrayMz = $_POST["arrayMz"];
$personaje = $_POST["personaje"];
$idMapa = $_POST["idMapa"];
es\ucm\fdi\aw\MazmorraContiene::guardaMazmorras($arrayMz,$personaje,$idMapa);

?>