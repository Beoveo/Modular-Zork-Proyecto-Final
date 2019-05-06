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
			<?php
				if(isset($_GET['type'])){
					$type = $_GET['type'];
					switch ($type) {
						case 'mapas':
							echo "<h1>Mapas</h1>";
							break;
						case 'enemigo':
							echo "<h1>Enemigos</h1>";
							break;
						case 'personaje':
							echo "<h1>Personajes</h1>";
							break;
						case 'consumibles':
							echo "<h1>Consumibles</h1>";
							break;
					}
					$conn = $app->conexionBd();
					mostrarElemento($conn, $type);
					$conn->close();
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