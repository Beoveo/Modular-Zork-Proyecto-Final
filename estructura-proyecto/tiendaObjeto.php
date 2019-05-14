<?php
	require_once __DIR__.'/includes/config.php';

	function detallesMapa($fila, $conn){
		$nombre = $fila['nombre'];
		$precio = $fila['precio'];
		$imagen = RUTA_IMGS.$fila['rutaImagen'];
		$dificultad = $fila['dificultad'];
		$numMazmorras = $fila['numMazmorras'];
		$recompensa = $fila['recompensa'];
		$IDpropietario = $fila['propietario'];
		$descripcion = $fila['descripcion'];
		$valoracion = $fila['valoracion'];
		$numJugado = $fila['numJugado'];
		$terminadoCreado = $fila['terminadoCreado'];
		//Busca el numbre del propietario
		$query = "SELECT nombre FROM usuarios WHERE id = $IDpropietario";
		$consulta = $conn->query($query);
		if($consulta->num_rows > 0){
			$fila = $consulta->fetch_assoc();
			$nombPropietario = $fila['nombre'];
		}else{
			$nombPropietario = "Anonimo";
		}
		echo "<p><strong>Dificultad: </strong>$dificultad</p>
			<p><strong>Número de mazmorras: </strong>$numMazmorras</p>
			<p><strong>Recompensa: </strong>$recompensa</p>
			<p><strong>Propietario: </strong>$nombPropietario</p>
			<p><strong>Descripción: </strong>$descripcion</p>
			<p><strong>Valoración: </strong>$valoracion</p>";
	}

	function detallesConsumibles($fila){
		$fuerza = $fila['fuerza'];
		$vida = $fila['vida'];
		$habilidad = $fila['habilidad'];
		$categoria = $fila['categoria'];
		echo "<p><strong>Fuerza: </strong>$fuerza</p>
			<p><strong>Vida: </strong>$vida</p>
			<p><strong>Habilidad: </strong>$habilidad</p>
			<p><strong>Categoria: </strong>$categoria</p>";
	}

	function detallesEnemigo($fila){
		$fuerza = $fila['fuerza'];
		$vida = $fila['vida'];
		$habilidad = $fila['habilidad'];
		echo "<p><strong>Fuerza: </strong>$fuerza</p>
			<p><strong>Vida: </strong>$vida</p>
			<p><strong>Habilidad: </strong>$habilidad</p>";
	}

	function detallesPersonaje($fila){
		$fuerza = $fila['fuerza'];
		$vida = $fila['vida'];
		$habilidad = $fila['habilidad'];
		echo "<p><strong>Fuerza: </strong>$fuerza</p>
			<p><strong>Vida: </strong>$vida</p>
			<p><strong>Habilidad: </strong>$habilidad</p>";
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
			$app->doInclude('/infoTienda.php');
			if(isset($_GET["id"]) && isset($_GET["type"])){
				$iden = $_GET["id"];
				$type = $_GET["type"];

				$conn = $app->conexionBd();
				$query = "SELECT * FROM $type WHERE id = $iden";
				$consulta = $conn->query($query);
				$res = $consulta->num_rows;
				if($res > 0){
					while ($fila = $consulta->fetch_assoc()){
						$nombre = $fila['nombre'];
						$precio = $fila['precio'];
						$imagen = RUTA_IMGS.$fila['rutaImagen'];
					
						echo "<div class='supTienda'>
								<div class='imgCompra'>
									<img class='imgCompra' src='$imagen'/>
								</div>
								<div class='infoCompra'>
									<h1>$nombre</h1>
									<h2 class='precio'>$precio zorkians</h2><div id='errorTienda'>";
									$formBotCompra = new \es\ucm\fdi\aw\FormularioBotonComprar(); echo $formBotCompra->gestiona();
						echo "</div></div>
							</div>
							<div class='infTienda'>
								<h2>Detalles</h2>";
						switch ($type) {
							case 'mapas':
								detallesMapa($fila,$conn);
								break;
							case 'consumibles':
								detallesConsumibles($fila);
								break;
							case 'enemigo':
								detallesEnemigo($fila);
								break;
							case 'personaje':
								detallesPersonaje($fila);
								break;
							default:
								echo "ERROR: No hay detalles";
								break;
						}
						echo "</div>";
					}

					$consulta->free();
					$conn->close();
				}else
					echo "Error en la consulta";
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