<?php
require_once __DIR__.'/includes/config.php';

use es\ucm\fdi\aw\Aplicacion as App;

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estiloSidebarIz.css') ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Portada</title>
	</head>

	<body>
		<div id="contenedor">
			<?php
                $app->doInclude('comun/cabecera.php');
                $app->doInclude('comun/sidebarIzq.php');
                $app->setPagAct("ranking");
			?>
			
			<div id="contenido">
				<h2>Mejores Jugadores</h2>
				 <div class="Table">
					<div class="Title">
						<h3>Ranking:</h3>
					</div>
					<div class="Heading">
						<div class="Cell"> <p>Posicion</p> </div>
						<div class="Cell"> <p>Usuario</p> </div>
						<div class="Cell"> <p>Puntuacion</p>  </div>
					</div>	
					<?php
						$indice = 1;
						$datos;
						$app = App::getSingleton();
						$conn = $app->conexionBd();
						$query = sprintf("SELECT nombre, puntos FROM usuarios ORDER BY puntos DESC");
						$rs = $conn->query($query) or die ($conn->error. " en la línea ".(__LINE__-1));
						
						if ($rs && $rs->num_rows > 0) {
							while ($fila = $rs->fetch_assoc()) {
								$nombre = $fila['nombre'];
								$puntos = $fila['puntos'];
									echo "<div class='Row'>";
										echo "<div class='Cell'><p>$indice</p></div>";
										echo "<div class='Cell'><p>$nombre</p></div>";
										echo "<div class='Cell'><p>$puntos</p></div>";
									echo "</div>";
								$indice = $indice + 1;
							}
							echo "</table>";
							$rs->free();
						}
					?>
					
				</div>
			</div>
		
			<?php
                $app->doInclude('comun/sidebarDer.php');
                $app->doInclude('comun/pie.php');
			?>
		</div> <!-- Fin del contenedor -->

	</body>
</html>
