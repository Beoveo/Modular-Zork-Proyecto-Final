<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Partida
{
    
    //devuelve una lista con todos los mapas existentes
    public static function cargaMapas(){
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
        return $result_array;

      }
    }
    //devuelve todas las partidas de un determinado usuario
    public static function partidasUsuario($idUsuario){  
      $result_array=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapas,partida WHERE  partida.idUsuario=%s AND partida.idMapa=mapas.id",$idUsuario);
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
    //devuelve todas las partidas de un determinado usuario
    public static function mazmorrasPartida($idUsuario){  
      $result_array=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapas,partida WHERE  partida.idUsuario=%s AND partida.idMapa=mapas.id",$idUsuario);
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
   
    private $idUsuario;
    private $idMapa; 
    private $idPersonaje;
    private $inventario;
    
    private function __construct($idUsuario,$idMapa,$idPersonaje )
    {
   
        $this->idUsuario=$idUsuario;
        $this->idMapa=$idMapa;
        $this->idPersonaje=$idPersonaje;
    }
    private function size(){
        return  $this->tamanio;
    }
    private function getMazmorras(){
        
        return  $this->mazmorras;
    }
    private function setMazmorras($mazmorras){
        $this->mazmorras=$mazmorras;
        
    }
    private function getMazmorraAct(){
        return $this->mazmorras;
    }
    private function setMazmorraAct($mazmorra){
       $this->mazmorraAct=$mazmorra;
    }
    private function getMazmorraFinal(){
        return $this->mazmorraFinal;
    }
    private function setMazmorraFinal($mazmorra){
        $this->mazmorraFinal=$mazmorra;
    }

    
    
}