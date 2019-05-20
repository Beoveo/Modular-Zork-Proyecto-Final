<?php
	require_once __DIR__.'/includes/config.php';

	use es\ucm\fdi\aw\Enemigos as Enemigos;
	use es\ucm\fdi\aw\ObjetoConsumible as ObjetoConsumible;
	use es\ucm\fdi\aw\Personaje as Personaje;
	use es\ucm\fdi\aw\Mapa as Mapa;
	//GET id y tipo
	if(isset($_GET["id"]) && isset($_GET["type"])){
		$iden = $_GET["id"];
		$type = $_GET["type"];
		//Busco el objeto por ids
		switch ($type) {
			case 'enemigo':
				$objeto = Enemigos::getEnemigo($iden);
				break;
			case 'consumibles':
				$objeto = ObjetoConsumible::buscaObjetoPorId($iden);
				break;
			case 'personaje':
				$objeto = Personaje::getPersonaje($iden);
				break;
			case 'mapas':
				$objeto = Mapa::buscaMapaPorId($iden);
				break;
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
  	<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estiloSidebarIz.css') ?>" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
  	<title>Objeto</title>
</head>
<body>
	<div id="contenedor">
		<?php
			$app->doInclude('comun/cabecera.php');
			$app->doInclude('comun/sidebarIzq.php');
		?>
		<div id="contenido">
			<?php
			//$app->doInclude('/infoTienda.php');
			if(isset($objeto)){
				$objeto->infoObjetoTienda();
			}else
				echo "<h1>Página no disponible</h1>";
			?>

		</div>
		<?php
			$app->doInclude('comun/pie.php');
		?>
	</div>
</body>
</html>