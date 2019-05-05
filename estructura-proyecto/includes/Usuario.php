<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Usuario
{
//-------------------------------------------------------------------------------------------------------------------------------------------
//Alberto Caballero Es un boceto no terminada consulta.
  public static function changeEmail($correo)
  {
            if(!self::buscaUsuarioPorNombre($correo)){
          $app = App::getSingleton();
          $conn = $app->conexionBd();
          $query = sprintf("UPDATE usuarios(nombre) SET correo = '%s' WHERE usuarios.id = %s)"
                    ,$conn->real_escape_string($name),self::id());
          $rs = $conn->query($query);
          if($rs){
              echo"ok";
              return true;
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
    
 //Alberto Caballero Es un boceto no terminada consulta.   
  public static function changePass($password)
  {
          $app = App::getSingleton();
          $conn = $app->conexionBd();
          $query = sprintf("UPDATE usuarios(nombre) SET contraseña = '%s' WHERE usuarios.id = %s)"
                    ,$conn->real_escape_string($name),self::id());
          $rs = $conn->query($query);
          if($rs){
             echo"ok";
          }
          else{
            echo"$conn->error";
            return false;
          }
  
  }
   //Modificado por Lidia
  public static function changeName($name)
  {
    //Si el nuevo nombre no existe en la base de datos
      if(!self::buscaUsuarioPorNombre($name)){
          $app = App::getSingleton();
          $conn = $app->conexionBd();
          //Actualizar el usuario logeado. Acceder al identificador de Usuario
          $user = self::buscaUsuario($_SESSION['nombre']);
          $ident = $user->id();
          $nombre = $conn->real_escape_string($name);
          $query = sprintf("UPDATE usuarios SET nombre = '%s' WHERE id = %s" ,$nombre,$ident);
          $rs = $conn->query($query);
          if($rs){
              echo"Tu nombre de usuario se ha cambiado a $name";
              return true;
          }
          else{
            echo "Error de conexión con la base de datos";
            return false;
          }
      }
      else{
        echo "El nombre de usuario ya existe. Vuelve a intentarlo";
        return false;
      }
  }
//Alberto Caballero Es un boceto no terminada consulta.
  public static function signin($name,$username, $password)
  {

    if(!self::buscaUsuario($username)){
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $auxpass=password_hash($password,PASSWORD_DEFAULT);
            $query = sprintf("INSERT INTO usuarios (nombre,correo, contraseña) VALUES ('%s','%s' , '%s')",$conn->real_escape_string($name),$conn->real_escape_string($username),$conn->real_escape_string($auxpass));
            $rs = $conn->query($query);
            if ($rs) {
                $user= new Usuario($conn->id,$username, $auxpass); 
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
  public static function login($username, $password)
  {
    $user = self::buscaUsuario($username);
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

  public static function buscaUsuario($username)
  {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM usuarios WHERE correo='%s'", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['id'], $fila['correo'], $fila['contraseña']);
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
      $user = new Usuario($fila['id'], $fila['correo'], $fila['contraseña']);
      $rs->free();
      return $user;
    }
      echo"$conn->error";
    return false;
  }

  private $id;

  private $username;

  private $password;

  private $roles;

  private function __construct($id, $username, $password)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->roles = [];
  }

  public function id()
  {
    return $this->id;
  }

  public function addRol($role)
  {
    $this->roles[] = $role;
  }

  public function roles()
  {
    return $this->roles;
  }

  public function username()
  {
    return $this->username;
  }

  public function compruebaPassword($password)
  {
    return password_verify($password, $this->password);
  }

  public function cambiaPassword($nuevoPassword)
  {
    $this->password = password_hash($nuevoPassword, PASSWORD_DEFAULT);
  }
}
