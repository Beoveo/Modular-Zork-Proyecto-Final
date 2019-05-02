<?php

namespace es\ucm\fdi\aw;

class FormularioBloquearUsuario extends Form
{
const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';
  public function __construct()
  {
    parent::__construct('formMensaje');
  }
  
  protected function generaCamposFormulario ($datos)
  {
    $mensaje = 'Mensaje';
    if ($datos) {
      $mensaje = $datos['mensaje'] ?? $mensaje;
    }
    $username="manolo@example.org";
    $maxSize = Mensaje::MAX_SIZE;
    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Bloquea Usuario</legend>
            <p><label>e-mail:</label> <input type="text" name="username" placeholder="$username"/></p>
		  <button type="submit">Confirmar</button>
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
    $mensaje = $datos['mensaje'] ?? '' ;
    if ( ! $mensaje ||  mb_strlen($mensaje) == 0 || mb_strlen($mensaje) > 140 ) {
      $result[] = 'La longitud del mensaje debe ser entre 1 o 140 caracteres.';
      $ok = false;
    }

    if ( $ok ) {
      $app = Aplicacion::getSingleton();
      $mensaje = Mensaje::crea($app->nombreUsuario(), $mensaje);
      if ( $mensaje ) {
        $result = $app->resuelve('/mensajes.php');
      }else {
        $result[] = 'No se ha podido añadir el mensaje.';
      }
    }
    return $result;
  }
}
