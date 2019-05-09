<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Mapa
{
  
   public static function cargaMazmorras($idMapa)
  {
      $result_array=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapacontiene , mazmorras  WHERE mapacontiene.idMapa=%s AND mapacontiene.idMazmorra=mazmorras.id",$idMapa);
      $rs = $conn->query($query);
      if ($rs) {
        if ($rs->num_rows > 0) {
                while($row = $rs->fetch_assoc()) {
                array_push($result_array, $row);
        }

                $rs->free();
        }
        return $resultArray;

      }
      
      echo $conn->error;
      return false;
  } 
    public static function buscaMapaPorId($id)
  {
      $result_array=array();
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapas WHERE mapas.id =%s",$id);
      $rs = $conn->query($query);
      if ($rs && $rs->num_rows == 1) {
		  $fila = $rs->fetch_assoc(); 
		  $mapa = new Mapa($fila['id'], $fila['nombre'], $fila['precio'], $fila['numMazmorras'],$fila['recompensa'],$fila['mazmorrasSuperadas'],$fila['propietario'], $fila['rutaImagen']);
		  $rs->free();
		  return $mapa;
        }
      
      return false;
  }  
    
    private $tamanio;
    private $mazmorras;
    private $mazmorraAct;
    private $mazmorraFinal;
    
    private function __construct(tamanio,mazmorras,mazmorraAct,mazmorraFinal )
    {
   
        $this->tamanio;
        $this->mazmorras=mazmorras;
        $this->mazmorraActual=;
        $this->mazmorraFinal=
    }
    private function size(){
        
    }
    private function getMazmorras(){
        
        
    }
    private function setMazmorras(){
        
        
    }
    private function getMazmorraAct(){
        
    }
    private function setMazmorraAct(){
        
    }
    private function getMazmorraFinal(){
        
    }
    private function setMazmorraFinal(){
        
    }

    
    
}