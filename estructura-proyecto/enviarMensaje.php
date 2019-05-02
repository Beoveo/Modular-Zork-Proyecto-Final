<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
  <title>Signin</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
		<h1>Envia el mensaje a un Usuario</h1>
    <?php $formensaje= new \es\ucm\fdi\aw\FormularioMensaje(); echo $formensaje->gestiona() ?>
	</div>
<?php
$app->doInclude('comun/sidebarDer.php');
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
