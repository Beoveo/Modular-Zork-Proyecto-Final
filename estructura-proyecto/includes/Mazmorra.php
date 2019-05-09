<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Mazmorras
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
            echo json_encode($result_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); 

          }
      }
      echo $conn->error;
      return false;
  } 
    public static function mazmorraDirNorte($idMapa,$idMazmorra){
    $result_array=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapacontiene , mazmorras  WHERE mapacontiene.idMapa=%s AND mapacontiene.idMazmorra=%s AND mapacontiene.mazmorraNorte=mazmorras.id",$idMapa,$idMazmorra);
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
    public static function mazmorraDirSur($idMapa,$idMazmorra){
            $result_array=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapacontiene , mazmorras  WHERE mapacontiene.idMapa=%s AND mapacontiene.idMazmorra=%s AND mapacontiene.mazmorraSur=mazmorras.id",$idMapa,$idMazmorra);
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
    public static function mazmorraDirEste($idMapa,$idMazmorra){
            $result_array=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapacontiene , mazmorras  WHERE mapacontiene.idMapa=%s AND mapacontiene.idMazmorra=%s AND mapacontiene.mazmorraEste=mazmorras.id",$idMapa,$idMazmorra);
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
    public static function mazmorraDirOeste($idMapa,$idMazmorra){
            $result_array=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapacontiene , mazmorras  WHERE mapacontiene.idMapa=%s AND mapacontiene.idMazmorra=%s AND mapacontiene.mazmorraOeste=mazmorras.id",$idMapa,$idMazmorra);
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
    public static function buscaMazmorraPorId($id)
  {
      $result_array=array();
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mazmorra WHERE mazmorra.id =%s",$id);
      $rs = $conn->query($query);
      if ($rs && $rs->num_rows == 1) {
		  $fila = $rs->fetch_assoc(); 
		  $mapa = new Mapa($fila['id'], $fila['nombre'], $fila['numSalidas'], $fila['numEnemigos'],$fila['recompensa'],$fila['rutaImagen'],$fila['historia']);
		  $rs->free();
		  return $mapa;
        }
      
      return false;
  }  
    private $idMnorte;
    private $idMsur;
    private $idMeste;
    private $idMoeste;
    private $idMapa;
    private $idMazmorraInicial;
    private function __construct($idMapa,$idMazmorraInicial,$idMnorte,$idMsur,$idMeste,$idMoeste){
        $this->idMnorte=$idMnorte;
        $this->idMsur=$idMsur;
        $this->idMeste=$idMeste;
        $this->idMoeste=$idMoeste;
        $this->idMapa=$idMapa;
        $this->idMazmorraInicial=$idMazmorraInicial;
    }
    private function mzNorte(){
        return $this->idMnorte;
        
    }
    private function mzInicial(){
        return $this->idMazmorraInicial;
    }
    private function mzSur(){
       return $this->idMsur;
        
    }
    private function mzEste(){
       return $this->idMeste;
    }
    private function mzOeste(){
       return $this->idMoeste;
        
    }
    private function idMapa(){
        
        return $this->idMapa;
    }
//  private $id;
//  private $nombre;
//  private $dificultad;
//  private $precio;
//  private $numMazmorras;
//  private $recompensa;
//  private $mazmorrasSuperadas;
//  private $propietario;
//  private $rutaImagen;
//    
//  private function __construct($id, $nombre, $precio, $numMazmorras,$recompensa,$mazmorrasSuperadas,$propietario,$rutaImagen )
//  {
//    $this->id = $id;
//	$this->nombre = $nombre;
//    $this->precio = $precio;
//    $this->numMazmorras = $numMazmorras;
//    $this->recompensa = $recompensa;
//    $this->mazmorrasSuperadas = $mazmorrasSuperadas;
//    $this->propietario = $propietario;
//    $this->rutaImagen = $rutaImagen;
//  }
//    private function id(){
//        return $this->id;
//        
//        
//    }
//    private function nombre(){
//        
//        return $this->nombre;
//        
//    }
//    private function precio(){
//        
//       return $this->precio;
//        
//    }
//    private function numMazmorras(){
//    
//        return $this->numMazmorras;
//        
//    }
//    private function mazmorrasSuperadas(){
//        
//        
//         return $this->mazmorrasSuperadas;
//    }
//    private function propietario(){
//        
//        
//       return $this->precio;
//    }
//    private function rutaImagen(){
//        
//       return $this->rutaImagen;
//        
//    }
//    private function recompensa(){
//        
//        return $this->recompensa;
//        
//    }

    
    
}