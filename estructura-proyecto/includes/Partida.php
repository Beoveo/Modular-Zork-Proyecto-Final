<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Partida
{
    public static function insertaPartida($idMapa,$idPersonaje){
      $usuarioAct = $_SESSION['nombre'];
      $usuarioAct=Usuario::buscaUsuarioPorNombre($usuarioAct);
      if($usuarioAct){
        $usId=$usuarioAct->id();
          $result_array=array();
          $app = App::getSingleton(); 
          $conn = $app->conexionBd();
          $query = sprintf("INSERT INTO partida(idUsuario,idMapa,idPersonaje)VALUES(%s,%s ,%s)",$usId,$idMapa,$idPersonaje);
          $rs = $conn->query($query);
          if($rs){
            $idPartida= self::utlimaInsertada();
            $usuarioAct->setIdPartida($idPartida);
            return $partida=new Partida($idPartida,$usId,$idMapa,$idPersonaje);
          }
          else
           echo $conn->error;
       }
    }
    public static function utlimaInsertada(){
        $result_array=array();
        $app = App::getSingleton(); 
        $conn = $app->conexionBd();
        $query = sprintf("SELECT idPartida FROM partida WHERE idPartida=(SELECT MAX(idPartida) FROM partida)");
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
              $fila = $rs->fetch_assoc();
              $ret=$fila['idPartida'];
            $rs->free();
         return $ret;
      }
    

    }
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


    private $idPartida;
    private $idUsuario;
    private $idMapa; 
    private $idPersonaje;
    private $inventario;
    
    private function __construct($idPartida,$idUsuario,$idMapa,$idPersonaje )
    {
        $this->idPartida=$idPartida;
        $this->idUsuario=$idUsuario;
        $this->idMapa=$idMapa;
        $this->idPersonaje=$idPersonaje;
    }
    public function id(){
      return $this->id;
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