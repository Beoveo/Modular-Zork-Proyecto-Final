<?php
require_once __DIR__.'/includes/config.php';
            $idMapa= $_GET['idMapa'];
           es\ucm\fdi\aw\Mazmorras::cargaMazmorras($idMapa);
?>
