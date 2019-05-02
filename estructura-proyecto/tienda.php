<?php
	require_once __DIR__.'/includes/config.php';
?><!DOCTYPE html>
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
					<a href="tienda.php">
						<li class="item">
							<div class="imgen">
								<img class="imgObj" src="img/desierto.jpg"/>
							</div>
							<p>Desierto <em>~ 20 zorkians</em></p>
						</li>
					</a>
					<a href="tienda.php">
						<li class="item">
							<div class="imgen">
								<img class="imgObj" src="img/fondo.jpg"/>
							</div>
							<p>Cueva <em>~ 50 zorkians</em></p>
						</li>
					</a>
					<a href="tienda.php">
						<li class="item">
							<div class="imgen">
								<img class="imgObj" src="img/mapa.jpg"/>
							</div>
							<p>Bosque <em>~ 5 zorkians</em></p>
						</li>
					</a>
				</ul>
			</div>
			<div id="personajes">
				<h1>Personajes</h1>
				<ul class=listObj id="listaPersonajes">
					<a href="tienda.php">
						<li class="item">
							<div class="imgen">
								<img class="imgObj" src="img/bea.png"/>
							</div>
							<p>Chica <em>~ 8 zorkians</em></p>
						</li>
					</a>
					<a href="tienda.php">
						<li class="item">
							<div class="imgen">
								<img class="imgObj" src="img/geo.png"/>
							</div>
							<p>Chico <em>~ 5 zorkians</em></p>
						</li>
					</a>
					<a href="tienda.php">
						<li class="item">
							<div class="imgen">
								<img class="imgObj" src="img/troll.jpg"/>
							</div>
							<p>Troll <em>~ 10 zorkians</em></p>
						</li> 
					</a>
				</ul>
			</div>
			<div id="objetos">
				<h1>Objetos</h1>
				<ul class=listObj id="listaObjetos">
					<a href="tienda.php">
						<li class="item">
							<div class="imgen">
								<img class="imgObj" src="img/knive.png"/>
							</div>
							<p>Cuchillo <em>~35 zorkians</em></p>
						</li>
					</a>
					<a href="tienda.php">
						<li class="item">
							<div class="imgen">
								<img class="imgObj" src="img/axe.png"/>
							</div>
							<p>Hacha <em>~ 30 zorkians</em></p>
						</li>
					</a>
					<a href="tienda.php">
						<li class="item">
							<div class="imgen">
								<img class="imgObj" src="img/sword.png"/>
							</div>
							<p>Espada<em>~ 15 zorkians</em></p>
						</li>
					</a>
				</ul>
			</div>

			<div id="contenidoboton">
				<form action="tienda.php" method="POST">
					<p><input type="submit" value="Comprar" ></p>
				</form>
			</div>
		</div>


		<?php
			$app->doInclude('comun/pie.php');
		?>
	</div>
</body>
</html>