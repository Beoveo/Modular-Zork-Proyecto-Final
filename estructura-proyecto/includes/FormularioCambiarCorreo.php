<?php

namespace es\ucm\fdi\aw;

class FormularioCambiarCorreo extends Form
{

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public function __construct()
  {
    parent::__construct('formEmail');
  }
  
  protected function generaCamposFormulario ($datos)
  {
    $correo = 'Manolito@example.org';
    if ($datos) {
      $correo = isset($datos['correo']) ? $datos['correo'] : $correo;
    }

    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Cambiar Correo de Usuario</legend>
		  <p><label>Correo:</label> <input type="text" name="correo" placeholder="$correo"/></p>
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
    $correo = $datos['correo'] ?? '' ;
    echo $correo;
    if ( !$correo || ! mb_ereg_match(self::HTML5_EMAIL_REGEXP, $correo) ) {
      $result[] = 'El formato de correo no es valido';
      $ok = false;
    }

    if ( $ok ) {
      $user = Usuario::changeEmail($correo);
      if ( $user ) {

        Aplicacion::getSingleton()->cambiarCorreoSesion($user);
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/miPerfil.php');
      }else {
        $result[] = 'No se puede cambiar el correo de usuario';
      }
    }
    return $result;
  }
}
