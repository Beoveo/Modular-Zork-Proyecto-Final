<?php
	require_once __DIR__.'/includes/config.php';
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
		<?php $app->doInclude('comun/cabecera.php');?>
			<div class="flexDesign">
		<?php $app->doInclude('comun/sidebarIzq.php');?>
		<div id="contenido">
			<?php
			$app->doInclude('/infoTienda.php');
				if(isset($_GET['type'])){
					$type = $_GET['type'];
					switch ($type) {
						case 'mapas':
							echo "<h1>Mapas</h1>";
							$mapas = es\ucm\fdi\aw\Mapa::getMapasTerminados();
							foreach ($mapas as $mapa) {
								$mapa->mostrarSimpleInfo('mapas');
							}
							break;
						case 'enemigo':
							echo "<h1>Enemigos</h1>";
							$enemigos = es\ucm\fdi\aw\EnemigoContiene::getEnemigosTienda();
							foreach ($enemigos as $enemigo) {
								$enemigo->mostrarSimpleInfo('enemigo');
							}
							break;
						case 'personaje':
							echo "<h1>Personajes</h1>";
							$personajes = es\ucm\fdi\aw\Personaje::getPersonajesTienda();
							foreach ($personajes as $personaje) {
								$personaje->mostrarSimpleInfo('personaje');
							}
							break;
						case 'consumibles':
							echo "<h1>Consumibles</h1>";$objetos = es\ucm\fdi\aw\ObjetoConsumible::getConsumibleTienda();
							foreach ($objetos as $objeto) {
								$objeto->mostrarSimpleInfo('consumibles');
							}
							break;
					}
				}else
					echo "<h1>Página no disponible</h1>";
			?>
			</div>
		</div>
		<?php
			$app->doInclude('comun/pie.php');
		?>
	</div>
</body>
</html>