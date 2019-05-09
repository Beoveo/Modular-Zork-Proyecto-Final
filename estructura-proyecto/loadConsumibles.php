<?php
require_once __DIR__.'/includes/config.php';
            $idMazmorra= $_GET['idMazmorra'];
           es\ucm\fdi\aw\Consumibles::cargaConsumibles($idMazmorra);
//            es\ucm\fdi\aw\Mazmorras::mazmorraDirNorte();
//            es\ucm\fdi\aw\Mazmorras::mazmorraDirSur();
//            es\ucm\fdi\aw\Mazmorras::mazmorraDirEste();
//            es\ucm\fdi\aw\Mazmorras::mazmorraDirOeste();

?>
