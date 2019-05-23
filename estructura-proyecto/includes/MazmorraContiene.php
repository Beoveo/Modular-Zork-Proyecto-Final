<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;

//Clase que crea un objeto con el cruce de las tablas Mazmorra y MapaContiene
//Devuelve un objeto con las mazmorras contenidas en el mapa.
class MazmorraContiene
{
    //carga las mazmorras de un determinado mapa
    public static function cargaMazmorras($idMapa)
    {
        $consulta=array();
        $mazmorras=array();
        $app = App::getSingleton(); 
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM mazmorras m,mapacontiene mc WHERE m.id=mc.idMazmorra AND mc.idMapa=%s ",$idMapa);
        $rs = $conn->query($query);
        if ($rs) {
            if ($rs->num_rows > 0) {
                while($fila = $rs->fetch_assoc()) {
                    array_push($mazmorras, new MazmorraContiene($fila['id'],$fila['nombre'],$fila['numSalidas'],$fila['numEnemigos'],$fila['recompensa'],$fila['rutaImagen'],$fila['historia'],$fila['mazmorraNorte'],$fila['mazmorraSur'],$fila['mazmorraEste'],$fila['mazmorraOeste'],$fila['mazmorraFinal'],$fila['mazmorraInicial'],$fila['x'],$fila['y'],$fila['w'],$fila['h']));
                    array_push($consulta, $fila);
                }
                $rs->free();
                return $consulta;
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

    //CREAR UNA CLASE DE MAZMORRA Y OTRA DE MAZMORRA CONTIENE.

    //Se debe poder crear un objeto que solo contenga los campos de la tabla Mazmorra
    public static function buscaMazmorraPorId($id)
  {
      $result_array=array();
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mazmorra WHERE mazmorra.id =%s",$id);
      $rs = $conn->query($query);
      if ($rs && $rs->num_rows == 1) {
        $fila = $rs->fetch_assoc(); 
        $mazmorra = new MazmorraContiene($fila['id'], $fila['nombre'], $fila['numSalidas'], $fila['numEnemigos'],$fila['recompensa'],$fila['rutaImagen'],$fila['historia'],$fila['mazmorraNorte'],$fila['mazmorraSur'],$fila['mazmorraEste'],$fila['mazmorraOeste'],$fila['mazmorraFinal'],$fila['mazmorraInicial'],$fila['x'],$fila['y'],$fila['w'],$fila['h']);
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
    private $mzNorte;
    private $mzSur;
    private $mzEste;
    private $mzOeste;
    private $x;
    private $y;
    private $w;
    private $h;

    private function __construct($id,$nombre,$numSalidas,$numEnemigos,$recompensa,$rutaImagen,$historia,$mzNorte,$mzSur,$mzEste,$mzOeste,$mazmorraFinal,$mazmorraInicial,$x,$y,$w,$h){
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
    
    
}