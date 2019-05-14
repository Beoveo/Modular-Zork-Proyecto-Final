
<?php
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/tiendaMostrarElemento.php';
?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
  	<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estiloSidebarIz.css') ?>" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
  	<title>Tienda</title>
</head>
<body>
	<div id="contenedor">
		<?php
			$app->doInclude('comun/cabecera.php');
			$app->doInclude('comun/sidebarIzq.php');
		?>
		<div id="contenido">
			<?php $app->doInclude('/infoTienda.php'); ?>
			<div id="mapas">
				<a href="tiendaSeccion.php?type=mapas"><h1>Mapas</h1></a>
				<ul class=listObj id="listaMapas">
					<?php
					$type = "mapas";
					mostrarElemento($type);
					?>
				</ul>
			</div>
			<div id="enemigos">
				<a href="tiendaSeccion.php?type=enemigo"><h1>Enemigos</h1></a>
				<ul class=listObj id="listaEnemigos">
					<?php
					$type = "enemigo";
					mostrarElemento($type);
					?>
				</ul>
			</div>
			<div id="personajes">
				<a href="tiendaSeccion.php?type=personaje"><h1>Personajes</h1></a>
				<ul class=listObj id="listaPersonajes">
					<?php
					$type = "personaje";
					mostrarElemento($type);
					?>
				</ul>
			</div>
			<div id="objetos">
				<a href="tiendaSeccion.php?type=consumibles"><h1>Objetos</h1></a>
				<ul class=listObj id="listaObjetos">
					<?php
					$type = "consumibles";
					mostrarElemento($type);
					?>
				</ul>
			</div>
		</div>
		<?php
			$app->doInclude('comun/pie.php');
		?>
	</div>
</body>
</html>