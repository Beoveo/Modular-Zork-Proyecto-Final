<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\ObjetoTienda as Objeto;
class Personaje extends Objeto
{
    //Modificar  
    public static function getPersonaje($idPartida,$idPersonaje)
    {

        $result_array=array();
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM personaje,partida WHERE personaje.id =%s",$idPersonaje);
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc(); 
            $personaje= new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['idInventario'],$fila['rutaImagen'],$fila['w'],$fila['h']);
            $rs->free();
            return $fila;
        }

        return false;
    }

    public static function getPersonajeT($idPersonaje) {

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM personaje WHERE personaje.id =%s",$idPersonaje);
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc(); 
            $personaje = new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['idInventario'],$fila['rutaImagen'],$fila['w'],$fila['h']);
            $rs->free();
            return $personaje;
        }
      return false;
    }

    //Guarda el personaje de ese usuario en la partida
    public static function guardarPersonaje($idPartida,$idUsuario,$idPersonaje){
        $result_array=array();
          $app = App::getSingleton();
          $conn = $app->conexionBd();
          //Insertar en ese registro, el idPersonaje
          $query = sprintf("INSERT INTO partida WHERE partida.idPartida =%s and partida.idUsuario =%s VALUES ()",$idPartida,$idUsuario);
          $rs = $conn->query($query);
          if ($rs && $rs->num_rows == 1) {
              $fila = $rs->fetch_assoc(); 
              $personaje= new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['idInventario'],$fila['rutaImagen'],$fila['w'],$fila['h']);
              $rs->free();
              return $fila;
            }

          return false;
    }

    //Devuelve un array con todos los personajes que se venden
    public static function getPersonajesTienda(){
        $personajes = array();
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM personaje";
        $rs = $conn->query($query);
        if($rs && $rs->num_rows > 0){
            while($fila = $rs->fetch_assoc()){ 
                $personaje = new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['idInventario'],$fila['rutaImagen'],$fila['w'],$fila['h']);
                array_push($personajes, $personaje);
            }
            $rs->free();
        }
        else{
            echo "<p>No hay personajes disponibles</p>";
        }
        return $personajes;
    }

     public function infoObjetoTienda(){
        parent::mostrarSupTienda();
        $fuerza = self::getFuerza();
        $vida = self::getVida();
        echo "<p><strong>Fuerza: </strong>$fuerza</p>
            <p><strong>Vida: </strong>$vida</p>";
    }

    private $fuerza;
    private $vida;
    private $idInventario;
    private $w;
    private $h;

    private function __construct($id,$fuerza,$nombre,$vida,$precio,$idInventario,$rutaImagen,$w,$h)
    {
        parent::__construct($id,$nombre,$precio,$rutaImagen);
        $this->fuerza=$fuerza;
        $this->vida=$vida;
        $this->idInventario=$idInventario;
        $this->w=$w;
        $this->h=$h;

    }

    public function getFuerza(){
        return $this->fuerza;
        
    }
    public function setFuerza($fuerza){
        $this->fuerza=$fuerza;
        
    }
    public function getVida(){
        return $this->vida;
        
    }
    public function setVida($vida){ 
        $this->vida=$vida;
    }
    public function getIdInventario(){
        return $this->idInventario;
    }

    private function getW(){
        return $this->w;
    }
    private function getH(){
        return $this->h;   
    }  
}