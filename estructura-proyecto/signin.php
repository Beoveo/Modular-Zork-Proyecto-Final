<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <title>Signin</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
		<h1>Registrate ¡Gratis!</h1>
    <?php $formsignin= new \es\ucm\fdi\aw\FormularioSignin(); echo $formsignin->gestiona() ?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
