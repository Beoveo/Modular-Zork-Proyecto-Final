<?php
namespace es\ucm\fdi\aw;
class FormularioCambiarContrasenia extends Form
{
  public function __construct()
  {
    parent::__construct('formPass');
  }
  
  protected function generaCamposFormulario ($datos)
  {
    if ($datos) {
      $password1 = isset($datos['password1']) ? $datos['password1'] : $password1;
    
      $password2 = isset($datos['password2']) ? $datos['password2'] : $password2;
    }
    $camposFormulario=<<<EOF
    <fieldset>
      <legend>Cambiar Contraseña de Usuario</legend>
      <p><label>Password:</label> <input type="password" name="password1" /></p>
          <p><label>Repeat:</label> <input type="password" name="password2" /></p>
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
    $password1 = $datos['password1'] ?? '' ;
  $password2 = $datos['password2'] ?? '' ;
  
    if ( $password1 != $password2 || mb_strlen($password1) < 4 ) {
      $result[] = 'las contraseñas no coinciden';
      $ok = false;
    }
   
      
    if ( $ok ) {    
    if(Usuario::changePass($password1)){
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/miPerfil.php');
        
    }
    
     /* if ( $user ) {
        // SEGURIDAD: Forzamos que se genere una nueva cookie de sesión por si la han capturado antes de hacer login
        session_regenerate_id(true);
        Aplicacion::getSingleton()->login($user);
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/index.php');
      }else {
        $result[] = 'El usuario o la contraseña es incorrecta';
      }*/
    }
    return $result;
  }
}