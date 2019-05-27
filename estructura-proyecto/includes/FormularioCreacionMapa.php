<?php

namespace es\ucm\fdi\aw;

class FormularioCreacionMapa extends Form
{

	//Consumibles,enemigo,mapa
	//Consumible: id,nombre,fuerza,habilidad,vida,precio,idInventario
	//Enemigo: id,nombre,fuerza,habilidad, vida,precio
	//Mapa: idMapa, nombre,dificultad,precio, numMazmorras,recompensa, propietario->Luego rellenar formulario de mazmorras
  public function __construct()
  {
    parent::__construct('formCrear');
  }
  
  //Consumible
  protected function generaCamposFormulario ($datos)
  {
    $nombre = "The floor is lava";
    $descripcion="Descripcion breve...";
    $dificultad = "1-5";
    $numMazmorras= "1-20";
    $recompensa=0;
    $idUsuario=0;

    if ($datos) {
      $nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
      $descripcion = isset($datos['descripcion']) ? $datos['descripcion'] : $descripcion;
      $dificultad = isset($datos['dificultad']) ? $datos['dificultad'] : $dificultad;
      $numMazmorras = isset($datos['numMazmorras']) ? $datos['numMazmorras'] : $numMazmorras;
 	    $recompensa = isset($datos['recompensa']) ? $datos['recompensa'] : $recompensa;
      $idUsuario = isset($datos['idUsuario']) ? $datos['idUsuario'] : $idUsuario;
    }
    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Datos del Mapa</legend>
            <p><label>Nombre: </label> <input type="text"  name="nombre" placeholder="$nombre"/></p>
		  <p><label>Descripcion: </label> <input type="text" name="descripcion" placeholder="$descripcion"/></p>
		  <p><label>Num mazmorras: </label> <input type="text" name="numMazmorras" placeholder="$numMazmorras"/></p>
		  <p><label>Recompensa: </label> <input type="text" name="recompensa" placeholder="$recompensa"/></p>
		  <p><label>Dificultad: </label> <input type="text" name="dificultad" placeholder="$dificultad"/></p>
      <p><label>Id de Usuario: </label> <input type="text" name="idUsuario" placeholder="$idUsuario"/></p>

		  <button type="submit">Crear</button>
		</fieldset>
EOF;
    return $camposFormulario;
  }

  /**
   * Procesa los datos del formulario.
   */
  protected function procesaFormulario($datos)
  {
    $result = array();
    $ok = true;
    $nombre = $datos['nombre'] ?? '' ;
   
    if ( !$nombre || Mapa::buscaMapaPorNombre($nombre)) {
      $result[] = 'El nombre del mapa no es válido';
      $ok = false;
    }
    
    //Coger el objeto de Objeto y acceder al resto de atributos
    $descripcion = $datos['descripcion'] ?? '' ;

    $dificultad = $datos['dificultad'] ?? '' ;

    $numMazmorras = $datos['numMazmorras'] ?? '' ;

    $recompensa = $datos['recompensa'] ?? '' ;
    
    $idUsuario = $datos['idUsuario'] ?? '' ;


    if ( $ok ) {
      $mapa = Mapa::crearMapa($nombre,$dificultad,$numMazmorras,$recompensa,$idUsuario,$descripcion);
      if ( $mapa ) {
       //Carga la ventana que gestiona las mazmorras a crear
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/creacionFinal.php');
      }else {
      	//Sacar mensajes de error
        $result[] = 'El objeto no es válido.';
      }
    }
    return $result;
  }
}
