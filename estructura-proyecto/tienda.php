<?php
	require_once __DIR__.'/includes/config.php';
?><!DOCTYPE html>
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
			$conn = $app->conexionBd();
		?>
		<div id="contenido">
			<div id="mapas">
				<h1>Mapas</h1>
				<ul class=listObj id="listaMapas">
					<?php
						$query = "SELECT * FROM mapas";
						$consulta = $conn->query($query);
						$res = $consulta->num_rows;
						if($res > 0){
							while ($fila = $consulta->fetch_assoc()){
								$iden = $fila['id'];
								$nombre = $fila['nombre'];
								$precio = $fila['precio'];
								$imagen = RUTA_IMGS.$fila['rutaImagen'];
								echo "<a href='objetoTienda.php?id=$iden&type=mapas'>
									<li class='item'>
										<div class='imgen'>
											<img class='imgObj' src='$imagen'/>
										</div>
										<p>$nombre<em>~$precio zorkians</em></p>
									</li>
								</a>";
							}
							$consulta->free();
						}else{
							echo "No hay mapas disponibles";
						}
					?>
				</ul>
			</div>
			<div id="enemigos">
				<h1>Enemigos</h1>
				<ul class=listObj id="listaEnemigos">
					<?php
						$query = "SELECT * FROM enemigo";
						$consulta = $conn->query($query);
						$res = $consulta->num_rows;
						if($res > 0){
							while ($fila = $consulta->fetch_assoc()){
								$iden = $fila['id'];
								$nombre = $fila['nombre'];
								$precio = $fila['precio'];
								$imagen = RUTA_IMGS.$fila['rutaImagen'];
								echo "<a href='objetoTienda.php?id=$iden&type=enemigo'>
									<li class='item'>
										<div class='imgen'>
											<img class='imgObj' src='$imagen'/>
										</div>
										<p>$nombre<em>~$precio zorkians</em></p>
									</li>
								</a>";
							}
							$consulta->free();
						}else{
							echo "No hay enemigos disponibles";
						}
					?>
				</ul>
			</div>
			<div id="personajes">
				<h1>Personajes</h1>
				<ul class=listObj id="listaPersonajes">
					<?php
						$query = "SELECT * FROM personaje";
						$consulta = $conn->query($query);
						$res = $consulta->num_rows;
						if($res > 0){
							while ($fila = $consulta->fetch_assoc()){
								$iden = $fila['id'];
								$nombre = $fila['nombre'];
								$precio = $fila['precio'];
								$imagen = RUTA_IMGS.$fila['rutaImagen'];
								echo "<a href='objetoTienda.php?id=$iden&type=personaje'>
									<li class='item'>
										<div class='imgen'>
											<img class='imgObj' src='$imagen'/>
										</div>
										<p>$nombre<em>~$precio zorkians</em></p>
									</li>
								</a>";
							}
							$consulta->free();
						}else{
							echo "No hay personajes disponibles";
						}
					?>
				</ul>
			</div>
			<div id="objetos">
				<h1>Objetos</h1>
				<ul class=listObj id="listaObjetos">
					<?php
						$query = "SELECT * FROM consumibles";
						$consulta = $conn->query($query);
						$res = $consulta->num_rows;
						if($res > 0){
							while ($fila = $consulta->fetch_assoc()){
								$iden = $fila['id'];
								$nombre = $fila['nombre'];
								$precio = $fila['precio'];
								$imagen = RUTA_IMGS.$fila['rutaImagen'];
								echo "<a href='objetoTienda.php?id=$iden&type=consumibles'>
									<li class='item'>
										<div class='imgen'>
											<img class='imgObj' src='$imagen'/>
										</div>
										<p>$nombre<em>~$precio zorkians</em></p>
									</li>
								</a>";
							}
							$consulta->free();
						}else{
							echo "No hay consumibles disponibles";
						}
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