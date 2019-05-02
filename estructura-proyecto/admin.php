<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
  <title>Admin</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
<div id="contenido">

	<?php
		if ($app->tieneRol('admin', 'Acceso Denegado', 'No tienes permisos suficientes para administrar la web.')){
	?>
		<h1>Consola de administración</h1>
		<p>Aquí estarían todos los controles de administración</p>
		<div id=admin>
            <ul>
			<li><a href='aniadirObjetos.php' type="button">Añadir Objetos</a></li>	
                <!-- en esta opcion se abrira un formulario y podremos añadir
				un mapa, personaje, objetos nuevos, etc.. se podra seleccionar a subir un archivo
                <a href='eliminarObjetoJuego.php'>Eliminar Objeto</a></p><!-- se ostrara formulario para indicar y 
				seleccionar que tipo de objeto eliminar y la categoria -->
			<li><a href='enviarMensaje.php' type="button">Enviar Mensaje Usuario</a></li>   <!-- mostrara un formulario para indicar mensaje y usuario de destino -->
			<li><a href='bloquearUsuario.php' type="button">Bloquear Usuario</a></li>	<!-- tendra un campo para indicar el usuario a bloquear -->
			</ul>
		</div>
	<?php
		}
	?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>


