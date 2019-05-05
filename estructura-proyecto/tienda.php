<?php
	function mostrarElemento($conn, $type){
		$query = "SELECT * FROM $type";
		$consulta = $conn->query($query);
		$res = $consulta->num_rows;
		if($res > 0){
			while ($fila = $consulta->fetch_assoc()){
				$iden = $fila['id'];
				$nombre = $fila['nombre'];
				$precio = $fila['precio'];
				$imagen = RUTA_IMGS.$fila['rutaImagen'];
				echo "<a href='objetoTienda.php?id=$iden&type=$type'>
					<li class='item'>
						<div class='imgen'>
							<img class='imgObj' src='$imagen'/>
						</div>
						<div class='info'>
							<p>$nombre<em></p>
							<p>$precio zorkians</em></p>
						</div>
					</li>
				</a>";
			}
			$consulta->free();
		}else{
			echo "No hay $type disponibles";
		}
	}

?>
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
		<?php
			$app->doInclude('comun/cabecera.php');
			$app->doInclude('comun/sidebarIzq.php');
			$conn = $app->conexionBd();
		?>
		<div id="contenido">
			<div id="mapas">
				<a href="seccionTienda.php?type=mapas"><h1>Mapas</h1></a>
				<ul class=listObj id="listaMapas">
					<?php
					$type = "mapas";
					mostrarElemento($conn, $type);
					?>
				</ul>
			</div>
			<div id="enemigos">
				<a href="seccionTienda.php?type=enemigo"><h1>Enemigos</h1></a>
				<ul class=listObj id="listaEnemigos">
					<?php
					$type = "enemigo";
					mostrarElemento($conn, $type);
					?>
				</ul>
			</div>
			<div id="personajes">
				<a href="seccionTienda.php?type=personaje"><h1>Personajes</h1></a>
				<ul class=listObj id="listaPersonajes">
					<?php
					$type = "personaje";
					mostrarElemento($conn, $type);
					?>
				</ul>
			</div>
			<div id="objetos">
				<a href="seccionTienda.php?type=consumibles"><h1>Objetos</h1></a>
				<ul class=listObj id="listaObjetos">
					<?php
					$type = "consumibles";
					mostrarElemento($conn, $type);
					?>
				</ul>
			</div>
		</div>
		<?php
			$conn->close();
			$app->doInclude('comun/pie.php');
		?>
	</div>
</body>
</html>