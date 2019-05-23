
<?php
	require_once __DIR__.'/includes/config.php';
?>
<!DOCTYPE html>
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
			<?php // $app->doInclude('/infoTienda.php'); ?>
			<div id="mapas">
				<a href="tiendaSeccion.php?type=mapas"><h1>Mapas</h1></a>
				<ul class=listObj id="listaMapas">
					<?php
					$mapas = es\ucm\fdi\aw\Mapa::getMapasTerminados();
					foreach ($mapas as $mapa) {
						$mapa->mostrarSimpleInfo('mapas');
					}
					?>
				</ul>
			</div>
			<div id="enemigos">
				<a href="tiendaSeccion.php?type=enemigo"><h1>Enemigos</h1></a>
				<ul class=listObj id="listaEnemigos">
					<?php
					$enemigos = es\ucm\fdi\aw\EnemigoContiene::getEnemigosTienda();
					foreach ($enemigos as $enemigo) {
						$enemigo->mostrarSimpleInfo('enemigo');
					}
					?>
				</ul>
			</div>
			<div id="personajes">
				<a href="tiendaSeccion.php?type=personaje"><h1>Personajes</h1></a>
				<ul class=listObj id="listaPersonajes">
					<?php
					$personajes = es\ucm\fdi\aw\Personaje::getPersonajesTienda();
					foreach ($personajes as $personaje) {
						$personaje->mostrarSimpleInfo('personaje');
					}
					?>
				</ul>
			</div>
			<div id="objetos">
				<a href="tiendaSeccion.php?type=consumibles"><h1>Objetos</h1></a>
				<ul class=listObj id="listaObjetos">
					<?php
					$objetos = es\ucm\fdi\aw\ObjetoConsumible::getConsumibleTienda();
					foreach ($objetos as $objeto) {
						$objeto->mostrarSimpleInfo('consumibles');
					}
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