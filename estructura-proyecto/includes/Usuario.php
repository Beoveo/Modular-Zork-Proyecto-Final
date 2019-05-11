<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Usuario
{
//-------------------------------------------------------------------------------------------------------------------------------------------
//Alberto Caballero Es un boceto no terminada consulta.
  public static function changeEmail($correo)
  {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $name = $app->nombreUsuario();
      $user = self::buscaUsuarioPorNombre($name);
     $existe =self::buscaUsuario($correo);
     if($user && !$existe){
          $app = App::getSingleton();
          $conn = $app->conexionBd();
          $query = sprintf("UPDATE usuarios SET correo = '%s' WHERE usuarios.id = %s"
                    ,$conn->real_escape_string($correo),$user->id());
          $rs = $conn->query($query);
          if($rs){
              $user->setUsermail($correo);
              return $user;
          }
          else echo $conn->error;

      }
      return false;
  }    
    
    
  public static function changePass($password)
  {
          $app = App::getSingleton();
          $conn = $app->conexionBd();
		  $name = $app->nombreUsuario();
		  $user = self::buscaUsuarioPorNombre($name);
      if($user){
          $contraseñaIgual=$user->compruebaPassword($password);
		  if(! $contraseñaIgual){
              
			  $auxpass=password_hash($password,PASSWORD_DEFAULT);
              
			  $query = sprintf("UPDATE usuarios SET contraseña = '%s' WHERE usuarios.id = %s"
						,$conn->real_escape_string($auxpass), $user->id());
			  $rs = $conn->query($query);
			  if($rs){
				 echo"La contraseña se ha cambiado correctamente";
                  return true;
			  }
			  else{
				echo"$conn->error";
				return false;
			  }
		  }
      }
      else {
          
          echo "Algo ha ido mal...";
          return false;
      }
  
  }
   //Alberto Caballero Es un boceto no terminada consulta. 
  public static function changeName($name)
  {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
	  $firstname = $app->nombreUsuario();
      $user = self::buscaUsuarioPorNombre($firstname);
      $exist = self::buscaUsuarioPorNombre($name);
      if($user && !$exist){
          $app = App::getSingleton();
          $conn = $app->conexionBd();
          $query = sprintf("UPDATE usuarios SET nombre = '%s' WHERE usuarios.id = %s"
                    ,$conn->real_escape_string($name),$user->id());
          $rs = $conn->query($query);
          if($rs){
              $user->setNombre($name);
              return $user;
          }
          else echo $conn->error;
      }
      return false;
      
  }
//Cambiar a signup
  public static function signin($name,$usermail, $password)
  {
    if(!self::buscaUsuario($usermail) && !self::buscaUsuarioPorNombre($name)){
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $auxpass=password_hash($password,PASSWORD_DEFAULT);
            $query = sprintf("INSERT INTO usuarios (nombre,correo, contraseña) VALUES ('%s','%s' , '%s')",$conn->real_escape_string($name),$conn->real_escape_string($usermail),$conn->real_escape_string($auxpass));
            $rs = $conn->query($query);
            $user= self::buscaUsuario($usermail);
            if ($rs && $user) {
                echo $user->id();
                $query = sprintf("INSERT INTO rolesusuario (usuario,rol) VALUES ('%s',%s)",$user->id(),2);
                $rs = $conn->query($query);
                if($rs)
                $user->addRol("admin"); //user: 1, admin:2
                else{
                    echo $conn->error;
                    return false;
                }
                return $user;
            }
            else{
                echo"$conn->error";
                return false;
            }
    }
    else{
        
        return false;
          
    }
    
  }
//-------------------------------------------------------------------------------------------------------------------------------------------
  public static function login($usermail, $password)
  {
    $user = self::buscaUsuario($usermail);
    if ($user && $user->compruebaPassword($password)) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT R.nombre FROM rolesusuario RU, roles R WHERE RU.rol = R.id AND RU.usuario=%s", $conn->real_escape_string($user->id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) { 
          $user->addRol($fila['nombre']);
        }
        $rs->free();
      }
      return $user;
    }    
    return false;
  }
  public static function buscaUsuario($usermail)
  {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM usuarios WHERE correo='%s'", $conn->real_escape_string($usermail));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
		$fila = $rs->fetch_assoc(); 
		$user = new Usuario($fila['id'], $fila['nombre'], $fila['correo'], $fila['contraseña']);
		$rs->free();
		return $user;
    }
    return false;
  }
    
    
  public static function buscaUsuarioPorNombre($name)
  {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM usuarios WHERE nombre='%s'", $conn->real_escape_string($name));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
		$user = new Usuario($fila['id'], $fila['nombre'], $fila['correo'], $fila['contraseña']);
      $rs->free();
      return $user;
    }
      echo"$conn->error";
    return false;
  }
  private $id;
  private $usermail;
  private $password;
  private $roles;
  
  private $name;
  
  private function __construct($id, $name, $usermail, $password)
  {
    $this->id = $id;
	$this->name = $name;
    $this->usermail = $usermail;
    $this->password = $password;
    $this->roles = [];
  }
  public function id()
  {
    return $this->id;
  }
   public function nombre()
  {
    return $this->name;
  }
  public function setNombre($newName)
  {
    $this->name=$newName;
  }
  public function addRol($role)
  {
    $this->roles[] = $role;
  }
  public function roles()
  {
    return $this->roles;
  }
  public function usermail()
  {
    return $this->usermail;
  }
    public function setUsermail($correo)
  {
    return $this->usermail=$correo;
  }
  public function compruebaPassword($password)
  {
    return password_verify($password, $this->password);
  }
  /*
  public function cambiaPassword($nuevoPassword)
  {
    $this->password = password_hash($nuevoPassword, PASSWORD_DEFAULT);
  }
  */
}