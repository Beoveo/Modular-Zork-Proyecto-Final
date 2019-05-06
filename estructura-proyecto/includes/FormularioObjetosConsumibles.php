<?php

namespace es\ucm\fdi\aw;

class FormularioObjetos extends Form
{

	//Consumibles,enemigo,mapa
	//Consumible: id,nombre,fuerza,habilidad,vida,precio,idInventario
	//Enemigo: id,nombre,fuerza,habilidad, vida,precio
	//Mapa: idMapa, nombre,dificultad,precio, numMazmorras,recompensa, propietario->Luego rellenar formulario de mazmorras
  public function __construct()
  {
    parent::__construct('formObj');
  }
  
  //Consumible
  protected function generaCamposFormulario ($datos)
  {
    $nombre = 'troll verde';
    $categoria = 'enemigo/arma/pocion'
    $fuerza= 0;
    $habilidad=0;
    $vida=0;
    $precio= 0;

    if ($datos) {
      $nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
      $fuerza = isset($datos['fuerza']) ? $datos['fuerza'] : $fuerza;
      $vida = isset($datos['vida']) ? $datos['vida'] : $vida;
      $precio = isset($datos['precio']) ? $datos['precio'] : $precio;
 	  $categoria = isset($datos['categoria']) ? $datos['categoria'] : $categoria;
      $habilidad = isset($datos['habilidad']) ? $datos['habilidad'] : $habilidad;

    }
    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Añade el Objeto</legend>
            <p><label>Nombre:</label> <input type="text"        name="nombre" placeholder="$nombre"/></p>
		  <p><label>Categoria:</label> <input type="text" name="categoria" placeholder="$categoria"/></p>
		  <p><label>Fuerza:</label> <input type="text" name="fuerza" placeholder="$fuerza"/></p>
		  <p><label>Habilidad:</label> <input type="text" name="habilidad" placeholder="$habilidad"/></p>
		  <p><label>Vida:</label> <input type="text" name="vida" placeholder="$vida"/></p>
		  <p><label>Precio:</label> <input type="text" name="precio" placeholder="$precio"/></p>
		  <button type="submit">Cargar</button>
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
    if ( !$nombre || ObjetoConsumible::buscaObjeto($nombre)) {
      $result[] = 'El nombre del objeto no es válido';
      $ok = false;
    }
    
    //Coger el objeto de Objeto y acceder al resto de atributos
    $categoria = $datos['categoria'] ?? '' ;

    $fuerza = $datos['fuerza'] ?? '' ;

    $habilidad = $datos['habilidad'] ?? '' ;

    $vida = $datos['vida'] ?? '' ;
    
    $precio = $datos['precio'] ?? '' ;


    if ( $ok ) {
      $obj = Objeto::cargar($nombre,$categoria,$fuerza,$habilidad,$vida,$precio);
      if ( $obj ) {
       //Comprobaciones de que no exista el objeto
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/index.php');
      }else {
      	//Sacar mensajes de error
        $result[] = 'El usuario o la contraseña es incorrecta';
      }
    }
    return $result;
  }
}
