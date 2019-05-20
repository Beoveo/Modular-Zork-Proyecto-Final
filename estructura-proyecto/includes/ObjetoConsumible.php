<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\ObjetoTienda as Objeto;

class ObjetoConsumible extends Objeto
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
    //carga objetos de una determinada mazmorra
    public static function cargaObjetosMazmorra($idMazmorra){
        $consulta = array();
        $consumibles=array();
        $app = App::getSingleton(); 
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM consumibles,mazmorraconsumibles WHERE mazmorraconsumibles.idMazmorra=%s AND consumibles.id=mazmorraconsumibles.idConsumible",$idMazmorra);
        $rs = $conn->query($query);
        if ($rs) {
            if ($rs->num_rows > 0) {

                while($row = $rs->fetch_assoc()) {
                    array_push($consumibles, new ObjetoConsumible($row['id'],$row['nombre'],$row['categoria'],$row['fuerza'],$row['habilidad'],$row['vida'],$row['precio'],$row['rutaImagen']));
                    array_push($consulta,$row);
                }

                $rs->free();
                return $consulta;
            }
        }
    }

    public static function insertaObjeto($objeto){
        $app = App::getSingleton();
        $conn = $app->conexionBd();

        $newId = $objeto->getId();

        $query = sprintf("INSERT INTO consumibles (id,nombre,categoria,fuerza,habilidad,vida,precio,rutaImagen) VALUES ('%s','%s','%s' , '%s', '%s','%s' , '%s','%s')",  $conn->real_escape_string($newId), $conn->real_escape_string($objeto->getNombre()), $conn->real_escape_string($objeto->categoria),$conn->real_escape_string($objeto->fuerza),$conn->real_escape_string($objeto->habilidad),$conn->real_escape_string($objeto->vida),$conn->real_escape_string($objeto->precio),$conn->real_escape_string($objeto->rutaImg));

        $rs = $conn->query($query);
        if ($rs) { 
            $rs->free();
            return $obj = self::buscaObjetoPorNombre($objeto->nombre);
           
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

    public static function getConsumibleTienda()
    {
        $objetos = array();
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM consumibles";
        $rs = $conn->query($query);
        if($rs && $rs->num_rows > 0){
            while($fila = $rs->fetch_assoc()){ 
                $objeto = new ObjetoConsumible($fila['id'], $fila['nombre'], $fila['categoria'], $fila['fuerza'], $fila['habilidad'], $fila['vida'], $fila['precio'],$fila['rutaImagen']);
                array_push($objetos, $objeto);
            }
            $rs->free();
        }else{
            echo "<p>No hay consumibles disponibles</p>";
        }
        return $objetos;
    }

     public function infoObjetoTienda(){
        parent::mostrarSupTienda();
        $fuerza = self::fuerza();
        $vida = self::vida();
        $habilidad = self::habilidad();
        $categoria = self::categoria();
        echo "<p><strong>Fuerza: </strong>$fuerza</p>
            <p><strong>Vida: </strong>$vida</p>
            <p><strong>Habilidad: </strong>$habilidad</p>
            <p><strong>Categoria: </strong>$categoria</p>";
    }

    private $categoria;
    private $fuerza;
    private $habilidad;
    private $vida;

    public function __construct($id, $nombre, $categoria, $fuerza,$habilidad,$vida,$precio,$rutaImagen)
    {
        parent::__construct($id,$nombre,$precio,$rutaImagen);
        $this->categoria = $categoria;
        $this->fuerza = $fuerza;
        $this->habilidad = $habilidad;
        $this->vida = $vida;
    }

    //Para acceder a esto, con self:: no vale, es con $objeto->getId()

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
}
