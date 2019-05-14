<?php
	require_once __DIR__.'/config.php';
	use es\ucm\fdi\aw\Aplicacion as App;

	function mostrarElemento($type){
		$app = App::getSingleton();
		$conn = $app->conexionBd();
		$query = "SELECT * FROM $type ORDER BY id";
		$consulta = $conn->query($query);
		$res = $consulta->num_rows;
		if($res > 0){
			while ($fila = $consulta->fetch_assoc()){
				$iden = $fila['id'];
				$nombre = $fila['nombre'];
				$precio = $fila['precio'];
				$imagen = RUTA_IMGS.$fila['rutaImagen'];
				echo "<a href='tiendaObjeto.php?id=$iden&type=$type'>
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