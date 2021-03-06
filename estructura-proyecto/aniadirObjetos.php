<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estiloSidebarIz.css') ?>" />
	<title>Signin</title>
</head>
<body>
	<div id="contenedor">
	<?php $app->doInclude('comun/cabecera.php');?>
		<div class="flexDesign">
	<?php $app->doInclude('comun/sidebarIzq.php');?>
		<div id="contenido">
			<h1>Añade Objetos Como Administrador.</h1>
	    <?php $formObj = new \es\ucm\fdi\aw\FormularioObjetosConsumibles(); echo $formObj->gestiona(); ?>
		</div>
	</div>
	<?php
	$app->doInclude('comun/pie.php');
	?>
	</div>
</body>
</html>
