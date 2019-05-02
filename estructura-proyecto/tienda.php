<?php
	require_once __DIR__.'/includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
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
			<div id="mapas">
				<h1>Mapas</h1>
				<ul class=listObj id="listaMapas">
					<?php
						/*Connectar con la base de datos $conn
        				$conn = $app->conexionBd();
						*/
						$conn = new mysqli('localhost','root', '','sw');
						$query = "SELECT * FROM mapas";
						$consulta = $conn->query($query);
						if($consulta)
						{
							while ($fila = $consulta->fetch_assoc()){
								$iden = $fila['idMapa'];
								$nombre = $fila['nombre'];
								$precio = $fila['precio'];
								$imagen = $fila['rutaImagen'];
								//Form get
								echo "<a href='objetoTienda.php?id=$iden&type=mapa'>
									<li class='item'>
										<div class='imgen'>
											<img class='imgObj' src=$imagen/>
										</div>
										<p>$nombre<em>~$precio zorkians</em></p>
									</li>
								</a>";
							}
							
							$consulta->free();
						}
					?>
				</ul>
			</div>
			<div id="enemigos">
				<h1>Enemigos</h1>
				<ul class=listObj id="listaEnemigos">
					<?php
						/*Connectar con la base de datos $conn
        				$conn = $app->conexionBd();
						*/
						$conn = new mysqli('localhost','root', '','sw');
						$query = "SELECT * FROM enemigos";
						$consulta = $conn->query($query);
						if($consulta){
							while ($fila = $consulta->fetch_assoc()){
								$iden = $fila['id'];
								$nombre = $fila['nombre'];
								$precio = $fila['precio'];
								$imagen = $fila['rutaImagen'];
								echo "<a href='objetoTienda.php?id=$iden&type=enemigo'>
									<li class='item'>
										<div class='imgen'>
											<img class='imgObj' src=$imagen/>
										</div>
										<p>$nombre<em>~$precio zorkians</em></p>
									</li>
								</a>";
							}
							$consulta->free();
						}else{
							echo "No hay enemigos";
						}
					?>
				</ul>
			</div>
			<div id="personajes">
				<h1>Personajes</h1>
				<ul class=listObj id="listaPersonajes">
					<!--Listar 4 objetos-->
					<?php
						/*Connectar con la base de datos $conn
        				$conn = $app->conexionBd();
						*/
						$conn = new mysqli('localhost','root', '','sw');
						$query = "SELECT * FROM personaje";
						$consulta = $conn->query($query);
						if($consulta){
							while ($fila = $consulta->fetch_assoc()){
								$iden = $fila['id'];
								$nombre = $fila['nombre'];
								$precio = $fila['precio'];
								$imagen = $fila['rutaImagen'];
								echo "<a href='objetoTienda.php?id=$iden&type=personaje'>
									<li class='item'>
										<div class='imgen'>
											<img class='imgObj' src=$imagen/>
										</div>
										<p>$nombre<em>~$precio zorkians</em></p>
									</li>
								</a>";
							}
							$consulta->free();
						}else{
							echo "No hay consumibles";
						}
					?>
					
				</ul>
			</div>
			<div id="objetos">
				<h1>Consumibles</h1>
				<ul class=listObj id="listaObjetos">
					<!--Listar 4 objetos-->
					<?php
						/*Connectar con la base de datos $conn
        				$conn = $app->conexionBd();
						*/
						$conn = new mysqli('localhost','root', '','sw');
						$query = "SELECT * FROM consumibles";
						$consulta = $conn->query($query);
						if($consulta){
							while ($fila = $consulta->fetch_assoc()){
								$iden = $fila['id'];
								$nombre = $fila['nombre'];
								$precio = $fila['precio'];
								$imagen = $fila['rutaImagen'];
								echo "<a href='objetoTienda.php?id=$iden&type=consumible'>
									<li class='item'>
										<div class='imgen'>
											<img class='imgObj' src=$imagen/>
										</div>
										<p>$nombre<em>~$precio zorkians</em></p>
									</li>
								</a>";
							}
							$consulta->free();
						}else{
							echo "No hay consumibles";
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