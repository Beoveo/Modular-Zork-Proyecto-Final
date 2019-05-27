
<?php

require_once __DIR__.'/includes/config.php';
$array = $_POST['arrayMz'];
$pers = $_POST['personaje'];
$id = $_POST['idMapa'];

$res=es\ucm\fdi\aw\MazmorraContiene::guardaMazmorras($array,$pers,$id);

echo $res;


?>