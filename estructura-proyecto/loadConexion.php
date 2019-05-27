<?php
require_once __DIR__.'/includes/config.php';
    
    $formCon = new \es\ucm\fdi\aw\FormularioConexionMazmorras(); 
    $res = $formCon->gestiona();
    echo json_encode($res);    
?>
