<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Personaje
{
    public static function getPersonaje($idPersonaje){

        $result_array=array();
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM personaje WHERE personaje.id =%s",$idPersonaje);
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc(); 
            $personaje= new Personaje($fila['id'],$fila['fuerza'],$fila['nombre'],$fila['vida'],$fila['precio'],$fila['idInventario'],$fila['rutaImagen'],$fila['precio'],);
            $rs->free();
            return $fila;
        }

      return false;
    }
    
    private $id;
    private $fuerza;
    private $nombre;
    private $vida;
    private $precio;
    private $idInventario;
    private $rutaImagen;

    private function __construct($id,$fuerza,$nombre,$vida,$precio,$idInventario,$rutaImagen)
    {
        $this->id=$id;
        $this->fuerza=$fuerza;
        $this->nombre=$nombre;
        $this->vida=$vida;
        $this->precio=$precio;
        $this->idInventario=$idInventario;
        $this->rutaImagen=$rutaImagen;

    }
    public function getId(){
        return $this->id;
    }
    public function gerFuerza(){
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
    public function getRutaImagen(){
        return $this->rutaImagen;
    }   
}