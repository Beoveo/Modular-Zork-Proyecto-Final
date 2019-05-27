<?php
namespace es\ucm\fdi\aw;

class FormularioConexionMazmorras extends Form
{

	//Consumibles,enemigo,mapa
	//Consumible: id,nombre,fuerza,habilidad,vida,precio,idInventario
	//Enemigo: id,nombre,fuerza,habilidad, vida,precio
	//Mapa: idMapa, nombre,dificultad,precio, numMazmorras,recompensa, propietario->Luego rellenar formulario de mazmorras
  public function __construct()
  {
    parent::__construct('formConn');
  }
  
  //Consumible
  protected function generaCamposFormulario ($datos)
  {
    $id = 0;
    $mazmorraNorte=0;
    $mazmorraSur =0;
    $mazmorraEste=0;
    $mazmorraOeste=0;
    $mazmorraInicial=0;
    $mazmorraFinal=0;

    if ($datos) {
      $id = isset($datos['id']) ? $datos['id'] : $id;
      $mazmorraNorte = isset($datos['mazmorraNorte']) ? $datos['mazmorraNorte'] : $mazmorraNorte;
      $mazmorraSur = isset($datos['mazmorraSur']) ? $datos['mazmorraSur'] : $mazmorraSur;
      $mazmorraEste = isset($datos['mazmorraEste']) ? $datos['mazmorraEste'] : $mazmorraEste;
 	    $mazmorraOeste = isset($datos['mazmorraOeste']) ? $datos['mazmorraOeste'] : $mazmorraOeste;
      $mazmorraInicial = isset($datos['mazmorraInicial']) ? $datos['mazmorraInicial'] : $mazmorraInicial;
      $mazmorraFinal = isset($datos['mazmorraFinal']) ? $datos['mazmorraFinal'] : $mazmorraFinal;
    }

    //Incluir unas instrucciones

    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Relaciones de Mazmorras</legend>
            <p><label>Id mazmorra: </label> <input type="text"  name="id" placeholder="$id"/></p>
		  <p><label>Mazmorra Norte: </label> <input type="text" name="mazmorraNorte" placeholder="$mazmorraNorte"/></p>
		  <p><label>Mazmorra Sur: </label> <input type="text" name="mazmorraSur" placeholder="$mazmorraSur"/></p>
		  <p><label>Mazmorra Este: </label> <input type="text" name="mazmorraEste" placeholder="$mazmorraEste"/></p>
		  <p><label>Mazmorra Oeste: </label> <input type="text" name="mazmorraOeste" placeholder="$mazmorraOeste"/></p>
      <p><label>Mazmorra Inicial: </label> <input type="text" name="mazmorraInicial" placeholder="$mazmorraInicial"/></p>
      <p><label>Mazmorra Final: </label> <input type="text" name="mazmorraFinal" placeholder="$mazmorraFinal"/></p>

		  <button type="submit">Siguiente</button>
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
   
    
    $id = $datos['id'] ?? '' ;
    //Coger el objeto de Objeto y acceder al resto de atributos
    $mazmorraNorte = $datos['mazmorraNorte'] ?? '' ;
    if($mazmorraNorte == 0) $mazmorraNorte = null;

    $mazmorraSur = $datos['mazmorraSur'] ?? '' ;
    if($mazmorraSur == 0) $mazmorraSur = null;

    $mazmorraEste = $datos['mazmorraEste'] ?? '' ;
    if($mazmorraEste == 0) $mazmorraEste = null;

    $mazmorraOeste = $datos['mazmorraOeste'] ?? '' ;
    if($mazmorraOeste == 0) $mazmorraOeste = null;
    
    $mazmorraInicial = $datos['mazmorraInicial'] ?? '' ;
    if($mazmorraInicial == 0) $mazmorraInicial = null;

    $mazmorraFinal = $datos['mazmorraFinal'] ?? '' ;
    if($mazmorraFinal == 0) $mazmorraFinal = null;

    if ( $ok ) {
      
      $mapa = Mapa::ultimoMapaCreado();
    
 
      $maz = MapaMazmorra::guardarConexiones($mapa[0]['id'],$id,$mazmorraNorte,$mazmorraSur,$mazmorraEste,$mazmorraOeste,$mazmorraInicial,$mazmorraFinal);
      print_r($maz);

      if ($maz ) {
       //Carga la ventana que gestiona las mazmorras a crear
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/creacionFinal.php');
      }else
        $result[] = 'El objeto no es válido.';
    }
    return $result;
  }
}
