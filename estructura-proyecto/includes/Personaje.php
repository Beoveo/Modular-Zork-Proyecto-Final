<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\ObjetoTienda as Objeto;

class Personaje extends Objeto
{
    public static function getPersonaje($idPersonaje) {

        $result_array=array();
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM personaje WHERE personaje.id =%s",$idPersonaje);
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc(); 
            $personaje = new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['idInventario'],$fila['rutaImagen'],$fila['habilidad']);
            $rs->free();
            return $personaje;
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
                $personaje = new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['idInventario'],$fila['rutaImagen'],$fila['habilidad']);
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
        $habilidad = self::getHabilidad();
        echo "<p><strong>Fuerza: </strong>$fuerza</p>
            <p><strong>Vida: </strong>$vida</p>
            <p><strong>Habilidad: </strong>$habilidad</p>";
    }
    
    private $fuerza;
    private $vida;
    private $idInventario;
    private $habilidad;

    private function __construct($id,$fuerza,$nombre,$vida,$precio,$idInventario,$rutaImagen,$habilidad)
    {
        parent::__construct($id,$nombre,$precio,$rutaImagen);
        $this->fuerza=$fuerza;
        $this->vida=$vida;
        $this->idInventario=$idInventario;
        $this->habilidad = $habilidad;
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

    public function getHabilidad(){
        return $this->habilidad;
    }

    
}