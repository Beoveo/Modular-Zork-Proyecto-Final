<?php
require_once __DIR__.'/includes/config.php';
            $idMapa= $_GET['idMapa'];
           es\ucm\fdi\aw\Mazmorras::cargaMazmorras($idMapa);
//            es\ucm\fdi\aw\Mazmorras::mazmorraDirNorte();
//            es\ucm\fdi\aw\Mazmorras::mazmorraDirSur();
//            es\ucm\fdi\aw\Mazmorras::mazmorraDirEste();
//            es\ucm\fdi\aw\Mazmorras::mazmorraDirOeste();

?>
