
<div id="contenido">
	<h1>Página principal</h1>
	<p>Este juego está basada en el clásico juego de los 80, que consistía en ir superando niveles de mazmorras mediante comandos por la consola. Puesto que hoy en día los juegos gráficos son los que triunfan hemos decidido renovar la imagen del juego y hacer una experiencia más visual y dinámica para el usuario. </p>

	<p>En el menu superior puedes navegar para poder jugar eligiendo mapas predeterminados o crear tus propios niveles . ¡Intentalo!</p>

	<p>Aqui una imagen o video</p>
    <?php
    if(!($_SESSION['login'] ?? '') ){
        echo'<h1>Acceso al sistema</h1>';
         $formsignin= new \es\ucm\fdi\aw\FormularioSignin();
        echo $formsignin->gestiona() ;
    }

    ?>
</div>
