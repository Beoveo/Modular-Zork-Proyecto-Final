<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class ObjetoConsumible
{
//Comprobar que el usuario es admin y se le pasa un objeto Objeto, falta comprobar lo de admin
  public static function cargar($objeto)
  {
    //Buscamos por id y por nombre
    if(!self::buscaObjeto($objeto->id, $objeto->nombre)){ //Si no está
        $app = App::getSingleton();
        $conn = $app->conexionBd();

        $ultId = 0;
              //Obtiene el último id y lo incrementa para incluir otro consumible
        $queryId = sprintf("SELECT MAX(id) FROM consumibles", $conn->real_escape_string($ultId));

        $rs = $conn->query($queryId);
        if ($rs && $rs->num_rows == 1) {
          $fila = $rs->fetch_assoc();

          self::setId($fila['id'] + 1); //Incrementamos el id
          $rs->free();
        }else{
            self::setId(1); //Si está vacio, que el primer id sea 1
          }

          $newId = self::getId();
          $query = sprintf("INSERT INTO consumibles (id,nombre,categoria,fuerza,habilidad,vida,precio) VALUES ('%s','%s','%s' , '%s', '%s','%s' , '%s')",  $conn->real_escape_string($newId), $conn->real_escape_string($objeto->nombre), $conn->real_escape_string($objeto->categoria),$conn->real_escape_string($objeto->fuerza),$conn->real_escape_string($objeto->habilidad),$conn->real_escape_string($objeto->vida),$conn->real_escape_string($objeto->precio));
              // $conn->real_escape_string($ejemplo)
          $rs = $conn->query($query);
          if ($rs) {
            $rs->free();

          //Hace un select de la nueva fila insertada
            if($obj = self::buscaObjeto($objeto->id, $objeto->nombre))
              return $obj;
            else{
                    echo"Error al acceder al objeto buscado"; //Solo para debuggear, cambiar antes de subir
                    return false;
                  }
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


          public static function buscaObjeto($id,$nombre)
          {
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $query = sprintf("SELECT * FROM consumibles WHERE id='%s' AND nombre='%s'", $conn->real_escape_string($id),$conn->real_escape_string($nombre));

            $rs = $conn->query($query);
            if ($rs && $rs->num_rows == 1) {
              $fila = $rs->fetch_assoc();

      //Si la consulta devuelve 1 fila, crea el objeto y lo devuelve con los datos recogidos (Si existe, lo devuelve)
              $obj = new ObjetoConsumible($fila['id'], $fila['nombre'], $fila['categoria'], $fila['fuerza'], $fila['habilidad'], $fila['vida'], $fila['precio']);
              $rs->free();
              return $obj;
            }
            return false;
          }

          private $id;

          private $nombre;

          private $categoria;

          private $fuerza;

          private $habilidad;

          private $vida;

          private $precio;

          private function __construct($id, $nombre, $categoria, $fuerza,$habilidad,$vida,$precio)
          {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->categoria = $categoria;
            $this->fuerza = $fuerza;
            $this->habilidad = $habilidad;
            $this->vida = $vida;
            $this->precio = $precio;

          }

          public function getId()
          {
            return $this->id;
          }

          public function setId($id)
          {
           $this->id = $id;
         }

         public function nombre()
         {
          return $this->nombre;
        }

        public function categoria()
        {
          return $this->categoria;
        }

        public function fuerza()
        {
          return $this->fuerza;
        }

        public function habilidad()
        {
          return $this->habilidad;
        }

        public function vida()
        {
          return $this->vida;
        }

        public function precio()
        {
          return $this->precio;
        }

  /*   
  public static function changeName($name)
  {
      if(!self::buscaUsuarioPorNombre($name)){
          $app = App::getSingleton();
          $conn = $app->conexionBd();
          $query = sprintf("UPDATE usuarios(nombre) SET nombre = '%s' WHERE usuarios.id = %s)"
                    ,$conn->real_escape_string($name),self::id());
          $rs = $conn->query($query);
          if($rs){
              echo"ok";
              return true;
          }
          else{
            return false;
          }
      }
      else{
        
          return false;

      }
  }
  */

}
