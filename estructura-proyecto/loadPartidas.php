<?php
require_once __DIR__.'/includes/config.php';

    $partidas= es\ucm\fdi\aw\Partida::partidasUsuario();
    echo json_encode($partidas);

?>
