<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Mapa
{
  
   public static function cargaMapas()
  {
      $result_array=array();
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapas");
      $rs = $conn->query($query);
      if ($rs) {
        if ($rs->num_rows > 0) {
            while($row = $rs->fetch_assoc()) {
            array_push($result_array, $row);
        }
          $rs->free();
      }
        echo json_encode($result_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); 
      }
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
    
  private $id;
  private $nombre;
  private $dificultad;
  private $precio;
  private $numMazmorras;
  private $recompensa;
  private $mazmorrasSuperadas;
  private $propietario;
  private $rutaImagen;
    
  private function __construct($id, $nombre, $precio, $numMazmorras,$recompensa,$mazmorrasSuperadas,$propietario,$rutaImagen )
  {
    $this->id = $id;
	$this->nombre = $nombre;
    $this->precio = $precio;
    $this->numMazmorras = $numMazmorras;
    $this->recompensa = $recompensa;
    $this->mazmorrasSuperadas = $mazmorrasSuperadas;
    $this->propietario = $propietario;
    $this->rutaImagen = $rutaImagen;
  }
    private function id(){
        return $this->id;
        
        
    }
    private function nombre(){
        
        return $this->nombre;
        
    }
    private function precio(){
        
       return $this->precio;
        
    }
    private function numMazmorras(){
    
        return $this->numMazmorras;
        
    }
    private function mazmorrasSuperadas(){
        
        
         return $this->mazmorrasSuperadas;
    }
    private function propietario(){
        
        
       return $this->precio;
    }
    private function rutaImagen(){
        
       return $this->rutaImagen;
        
    }
    private function recompensa(){
        
        return $this->recompensa;
        
    }

    
    
}