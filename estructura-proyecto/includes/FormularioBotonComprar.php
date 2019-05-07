<?php

namespace es\ucm\fdi\aw;

class FormularioBotonComprar extends Form
{

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public function __construct()
  {
    parent::__construct('formBotonComprar');
  }
  
  protected function generaCamposFormulario ($datos)
  {
  	if($_GET && isset($_GET["type"]) && isset($_GET["id"])){
  		$type = $_GET["type"];
  		$id = $_GET["id"];
  	}else{
  		echo "ERROR";
  	}

  	$camposFormulario=<<<EOF
  		<input type="hidden" name="type" value="$type"/>
  		<input type="hidden" name="id" value="$id"/>
		<button type="submit">Comprar</button>

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
    $type = $datos['type'] ?? '' ;
    if ( !$type || !($type=='mapas'||$type=='enemigo'||$type=='consumibles'||$type=='personaje')) {
      $result[] = 'Error al acceder a los datos de tipo';
      $ok = false;
    }
    $id = $datos['id'] ?? '' ;
    if ( ! $id ||  !is_numeric($id) ) {
      $result[] = 'Error al acceder a los datos de id';
      $ok = false;
    }
      
    if ( $ok ) {
    	if(Aplicacion::getSingleton()->usuarioLogueado()){
    		$compra = Compra::crea($type, $id);
		    $res = $compra->realizarCompra();
		    if ( $res ) {
		      $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/index.php');
		    }else {
		      $result[] = 'No se ha podido realizar la compra';
		    }
		}else{
			echo "Necesitas Iniciar sesión para poder comprar";
		}
    }
    return $result;
  }
}