<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Mazmorras
{
  //carga las mazmorras de un determinado mapa
   public static function cargaMazmorras($idMapa)
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
                array_push($mazmorras, new Mazmorras($row['id'],$row['nombre'],$row['numSalidas'],$row['numEnemigos'],$row['recompensa'],$row['rutaImagen'],$row['historia'],$row['mazmorraNorte'],$row['mazmorraSur'],$row['mazmorraEste'],$row['mazmorraOeste'],$row['mazmorraFinal'],$row['mazmorraInicial']));
                    array_push($consulta, $row);
            }
            $rs->free();
            return $consulta;
          }
      }
      echo $conn->error;
      return false;
  } 


    private $id;
    private $nombre;
    private $numSalidas;
    private $numEnemigos;
    private $recompensa;
    private $rutaImagen;
    private $historia;
    private $mzNorte;
    private $mzSur;
    private $mzEste;
    private $mzOeste;
    private function __construct($id,$nombre,$numSalidas,$numEnemigos,$recompensa,$rutaImagen,$historia,$mzNorte,$mzSur,$mzEste,$mzOeste,$mazmorraFinal,$mazmorraInicial){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->numSalidas=$numEnemigos;
        $this->recompensa=$recompensa;
        $this->rutaImagen=$rutaImagen;
        $this->historia=$historia;
        
        $this->mzNorte=$mzNorte;
        $this->mzSur=$mzSur;
        $this->mzEste=$mzEste;
        $this->mzOeste=$mzOeste;
        
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
    
    private function getIdNorte(){
        return $this->mzNorte;
    }
    private function getIdSur(){

       return $this->mzSur;
    }
    private function getIdEste(){
       return $this->mzEste;
    }
    private function getIdOeste(){
        return $this->mzOeste;
        
    }
    
    
}