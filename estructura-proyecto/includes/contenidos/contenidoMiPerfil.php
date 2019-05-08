<?php
namespace es\ucm\fdi\aw;
    if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
    
        $username = $_SESSION['nombre'];
        $user = Usuario::buscaUsuarioPorNombre($username);  
        if($user){
            $nombre = $user->nombre();
            $correo = $user->usermail();
        }
        else{
            echo "No se ha encontrado el usuario";
        }
    }
?>
<div id="contenido">
    <div id="imagenFromulario">
     <img id ="imgPerf" src="img/agu.png" alt=""/>
     <form name="uploadimage" type="POST" enctype="multipar/fromdata">
        <input type="file" name="imagen"/>
        <input type="submit" name="uploadimage" value="Subir imagen"/> 
     </form>
    </div>
    
    <div id=infoPerfil>
        <h3 id="agustin">Nombre de usuario:</h3>
            <?php echo "$nombre"?>
        <p></p>
        <a href='cambiarNombre.php'type='button' >Cambiar Nombre</a>
        <h3 id="correo">Correo Electronico:</h3>
            <?php echo "$correo"?>
        <p></p>
        <a href='cambiarCorreo.php'type='button' >Cambiar Correo</a>
        <h3 id="correo">Contraseña:</h3>
        <p></p>
        <a href='cambiarContrasenia.php'type='button' >Cambiar Contraseña</a>
        </div>
    </div>