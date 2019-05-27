<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\ObjetoTienda as Objeto;
class Personaje extends Objeto
{

    public static function guardaInventario($personaje){

        $app = App::getSingleton();
        $conn = $app->conexionBd();
        //return sizeof($personaje['idInventario']);
        for($z=0;$z<sizeof($personaje['inventario']);$z++){
            $idInventario=self::buscaInventarioPorId();
            $idConsumible=$personaje['inventario'][$z]['id'];
            $query = sprintf("INSERT INTO inventariocontiene(idInventario,idConsumible) values ('%s','%s')",$conn->real_escape_string($idInventario),$conn->real_escape_string($idConsumible));
            $rs = $conn->query($query);
        }

        
        if($rs)
            return true;
        else
            return false;

    }
    public static function buscaInventarioPorId(){
        $idPartida=$_SESSION['idPartida'];
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM inventario WHERE inventario.idPartida=%s",$idPartida);
        $rs = $conn->query($query);
        if($rs && $rs->num_rows == 1){
            $fila = $rs->fetch_assoc();
            return $fila['id'];

        }
        return false;
    }
    public static function cargaPersonajes()
    {

        $result_array=array();
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM personaje");
        $rs = $conn->query($query);
        if ($rs) {
            if ($rs->num_rows > 0) {
                while($row = $rs->fetch_assoc()) {
                    array_push($result_array, $row);
                }
                $rs->free();
            }
            return $result_array;

        }
    }
    //Modificar  
    public static function getPersonaje($idPersonaje)
    {

        $result_array=array();
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM personaje WHERE personaje.id =%s",$idPersonaje);
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc(); 
            $personaje= new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['rutaImagen'],$fila['w'],$fila['h']);
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
            $personaje = new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['rutaImagen'],$fila['w'],$fila['h']);
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
              $personaje= new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['rutaImagen'],$fila['w'],$fila['h']);
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
                $personaje = new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['rutaImagen'],$fila['w'],$fila['h']);
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
        echo "<h2>Detalles</h2>
            <p><em>Fuerza: </em>$fuerza</p>
            <p><em>Vida: </em>$vida</p>";
    }

    private $fuerza;
    private $vida;
    private $w;
    private $h;

    public function __construct($id,$fuerza,$nombre,$vida,$precio,$rutaImagen,$w,$h)
    {
        parent::__construct($id,$nombre,$precio,$rutaImagen);
        $this->fuerza=$fuerza;
        $this->vida=$vida;
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