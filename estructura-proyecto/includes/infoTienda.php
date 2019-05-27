<div id='infoTienda'>
<?php
	
	use es\ucm\fdi\aw\Usuario as User;

	if(isset($_SESSION["login"])&& $_SESSION["login"]){
		$nombre = $_SESSION["nombre"];
		$user = User::buscaUsuarioPorNombre($nombre);
		if($user){
			$monedas = $user->getMonedas();
			echo "<p>Monedas: ".$monedas." zorkians</p>";
		}
	}
?>
</div>