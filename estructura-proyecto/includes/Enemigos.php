<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Enemigos
{
    //Carga los de una mazmorra en un determinado mapa
    public static function cargaEnemigos($idMazmorra){
        $consulta=array();
        $enemigos=array();
        $app = App::getSingleton(); 
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM enemigo,mazmorraenemigo WHERE mazmorraenemigo.idMazmorra=%s AND enemigo.id=mazmorraenemigo.idEnemigo",$idMazmorra);
        $rs = $conn->query($query);
        if ($rs) {
            if ($rs->num_rows > 0) {

                while($row = $rs->fetch_assoc()) {
                    array_push($enemigos, new Enemigos($row['id'],$row['nombre'],$row['habilidad'],$row['vida'],$row['precio'],$row['rutaImagen']));
                    array_push($consulta, $row);
                }

                $rs->free();
                return $consulta;
            }
        }
        return false;
    }
    private $id;
    private $nombre;
    private $habilidad;
    private $vida;
    private $precio;
    private $rutaImagen;

    private function __construct($id,$nombre,$habilidad,$vida,$precio,$rutaImagen)
    {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->habilidad=$habilidad;
        $this->vida=$vida;
        $this->precio=$precio;
        $this->rutaImagen=$rutaImagen;
    }
    private function getNombre(){
        return $this->nombre;
        
    }
        private function getId(){
        return $this->id;
        
    }
        private function getHabilidad(){
        return $this->habilidad;
        
    }
        private function getVida(){
        return $this->nombre;
        
    }
    private function getPrecio(){
        return $this->precio;
        
    }
    private function getRutaImagen(){
        return $this->rutaImagen;
        
    }
    
    
}