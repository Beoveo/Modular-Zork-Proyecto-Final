<?php
require_once __DIR__.'/includes/config.php';
            $idMazmorra= $_GET['idMazmorra'];
           es\ucm\fdi\aw\Consumibles::loadPartida($idMazmorra);
json_encode()
    

?>
