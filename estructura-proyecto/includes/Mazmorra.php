<?php
/*
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;

//Clase que crea un objeto mazmorra
class Mazmorras
{
  //carga las mazmorras de un determinado mapa
   public static function guardaMazmorra($idMazmorra)
  {
      $consulta=array();
      $mazmorras=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mazmorras,mapacontiene WHERE mazmorras.id=mapacontiene.idMazmorra AND mapacontiene.idMapa=%s ",$idMapa);
      $rs = $conn->query($query);
      if ($rs) {
            if ($rs->num_rows > 0) {
                while($row = $rs->fetch_assoc()) {
                array_push($mazmorras, new Mazmorras($row['id'],$row['nombre'],$row['numSalidas'],$row['numEnemigos'],$row['recompensa'],$row['rutaImagen'],$row['historia'],$row['mazmorraNorte'],$row['mazmorraSur'],$row['mazmorraEste'],$row['mazmorraOeste'],$row['mazmorraFinal'],$row['mazmorraInicial'],$row['x'],
                  ,$row['y'],$row['w'],$row['h']));
                    array_push($consulta, $row);
            }
            $rs->free();
            return $consulta;
          }
      }
      echo $conn->error;
      return false;
  } 

   
    public static function buscaMazmorraPorId($id)
  {
      $result_array=array();
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mazmorra WHERE mazmorra.id =%s",$id);
      $rs = $conn->query($query);
      if ($rs && $rs->num_rows == 1) {
        $fila = $rs->fetch_assoc(); 
        $mazmorra = new Mazmorras($fila['id'], $fila['nombre'], $fila['numSalidas'], $fila['numEnemigos'],$fila['recompensa'],$fila['rutaImagen'],$fila['historia']);
        $rs->free();
        return $mazmorra;
      }
      
      return false;
  }  


    private $id;
    private $nombre;
    private $numSalidas;
    private $numEnemigos;
    private $recompensa;
    private $rutaImagen;
    private $historia;
    private $x;
    private $y;
    private $w;
    private $h;

    private function __construct($id,$nombre,$numSalidas,$numEnemigos,$recompensa,$rutaImagen,$historia,$x,$y,$w,$h){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->numSalidas=$numEnemigos;
        $this->recompensa=$recompensa;
        $this->rutaImagen=$rutaImagen;
        $this->historia=$historia;
        $this->x=$x;
        $this->y=$y;
        $this->w=$w;
        $this->h=$h;  
    }

    public function getId(){ 
        return $this->id;
    }
    private function getNombre(){ 
       return $this->nombre;
    }
    private function getNumSalidas(){
        return $this->numSalidas;
    }
    private function getRecompensa(){
       return $this->recompensa;
    }
    private function getRutaImagen(){
        
        return $this->rutaImagen;
    }
    private function getHistoria(){
        return $this->historia;
    }

    private function getX(){
        return $this->x;
    }
    private function getY(){
       return $this->y;
    }
    private function getW(){
       return $this->w;
    }
    private function getH(){
        return $this->h;   
    }
    
    
}*/