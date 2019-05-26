
<div id="cabecera">
	<h1>Modular ZORK</h1>
	
    <div id="menu">
	    <a href="index.php" class="button active" >Inicio</a>
	    <a href="juego.php" class="button" >Juego</a>
	    <a href="ranking.php" class="button" >Ranking</a>
	    <a href="tienda.php" class="button" >Tienda</a>
	    <a href="creacion.php" class="button" >Creación</a>
	    <a href="ayuda.php" class="button" >Ayuda</a>
	    <a href="admin.php" class="button" >Administrar</a>
    
            <?php
                if(!isset($_SESSION['login'])){
                    echo"<a href='login.php'class='button' id='butRight'>Inicia Sesion</a>
                    <a href='signin.php'class='button' id='butRight'>Registrate</a>";
                }
                else{
                    echo"<a href='miPerfil.php'class='button' >Mi Perfil</a>
                     <a href='misCompras.php'class='button' >Mis Compras.</a>
                     <a href='misCreaciones.php'class='button' >Mis creaciones.</a>
                    <a href='logout.php' class='button' id='butRight'>Cerrar Sesión</a>";
                }
            ?>
    </div>
</div>
