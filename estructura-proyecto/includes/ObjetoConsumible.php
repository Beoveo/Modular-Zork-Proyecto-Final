<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class ObjetoConsumible
{
//Comprobar que se le pasa un objeto Objeto, falta comprobar lo de admin
  public static function cargarObjeto($objeto)
  {
    //Si existe un objeto con ese nombre
    if($objName = self::buscaObjetoPorNombre($objeto->nombre)){
       echo "Ese nombre ya existe. Elige otro."; 
    }else{
     //Si no está, lo inserta y lo devuelve.
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        //Obtiene el último id y lo incrementa para incluir otro consumible 
        $queryId = sprintf("SELECT MAX(id) FROM consumibles");

        $rs = $conn->query($queryId);
          if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_row()[0];//fetch_assoc();
           //echo "$fila";
            $idMax = $fila;
            $newId = $objeto->getId();
            $objeto->setId($idMax + 1); //Incrementamos el id
          }else
              $objeto->setId(1); 
          
          $obj = self::insertaObjeto($objeto);
          if(!$obj)
            echo "No se pudo insertar el objeto.";
          else
            return $obj;
        }
    $rs->free();
  }


  public static function insertaObjeto($objeto){
    $app = App::getSingleton();
    $conn = $app->conexionBd();

    $newId = $objeto->getId();

          $query = sprintf("INSERT INTO consumibles (id,nombre,categoria,fuerza,habilidad,vida,precio,rutaImagen) VALUES ('%s','%s','%s' , '%s', '%s','%s' , '%s','%s')",  $conn->real_escape_string($newId), $conn->real_escape_string($objeto->nombre), $conn->real_escape_string($objeto->categoria),$conn->real_escape_string($objeto->fuerza),$conn->real_escape_string($objeto->habilidad),$conn->real_escape_string($objeto->vida),$conn->real_escape_string($objeto->precio),$conn->real_escape_string($objeto->rutaImg));

          $rs = $conn->query($query);
            if ($rs) {
              return $obj = self::buscaObjetoPorNombre($objeto->nombre);
              $rs->free();

            }
            else{
              echo"$conn->error";
              return false;
            }
  }


  //Devuelve todos los objetos consumibles de la BBDD
   public static function consultaObjeto($idConsumible)
  { //Copiar de lo que hay en TiendaObjeto.php
        $queryId = sprintf("SELECT * FROM consumibles");

        //Falta hacerlo
        $rs = $conn->query($queryId);
          if ($rs && $rs->num_rows > 0) {
            //while($fila = $rs->fetch_assoc())
            $rs->free();
          }else{
            return false;
          }
  }

      //Busca solo por nombre porque lo mismo no tiene id. 
          public static function buscaObjetoPorNombre($nombre)
          {
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $query = sprintf("SELECT * FROM consumibles WHERE nombre='%s'",$conn->real_escape_string($nombre));

            $rs = $conn->query($query);
            if ($rs && $rs->num_rows == 1) {
              $fila = $rs->fetch_assoc();

      //Si la consulta devuelve 1 fila, crea el objeto y lo devuelve con los datos recogidos (Si existe, lo devuelve)
              $obj = new ObjetoConsumible($fila['id'], $fila['nombre'], $fila['categoria'], $fila['fuerza'], $fila['habilidad'], $fila['vida'], $fila['precio'],$fila['rutaImagen']);
              $rs->free();
              return $obj;
            }
            return false;
          }

      //Busca solo por nombre porque lo mismo no tiene id. 
          public static function buscaObjetoPorId($id)
          {
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $query = sprintf("SELECT * FROM consumibles WHERE id='%s'",$conn->real_escape_string($id));

            $rs = $conn->query($query);
            if ($rs && $rs->num_rows == 1) {
              $fila = $rs->fetch_assoc();

      //Si la consulta devuelve 1 fila, crea el objeto y lo devuelve con los datos recogidos (Si existe, lo devuelve)
              $obj = new ObjetoConsumible($fila['id'], $fila['nombre'], $fila['categoria'], $fila['fuerza'], $fila['habilidad'], $fila['vida'], $fila['precio'],$fila['rutaImagen']);
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

          private $rutaImg;

          public function __construct($id, $nombre, $categoria, $fuerza,$habilidad,$vida,$precio,$rutaImg)
          {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->categoria = $categoria;
            $this->fuerza = $fuerza;
            $this->habilidad = $habilidad;
            $this->vida = $vida;
            $this->precio = $precio;
            $this->rutaImg = $rutaImg;

          }
          //Para acceder a esto, con self:: no vale, es con $objeto->getId()
          public function getId()
          {
            return $this->id;
          }

          public function setId($newId)
          {
            $this->id = $newId;
         }

         public function rutaImg()
         {
          return $this->rutaImg;
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


}
