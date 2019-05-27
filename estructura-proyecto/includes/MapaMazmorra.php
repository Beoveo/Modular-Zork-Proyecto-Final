<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;

//Clase que crea un objeto con todos los consumibles, enemigos, mazmorras y personaje del mapa
class MapaMazmorra
{
     /************************************ MODIFICACIONES BEA **********************************************/
    //Array necesita el idMapa, idMazmorras
    public static function guardarConexiones($idMapa,$idMazmorra,$mazmorraNorte,$mazmorraEste,$mazmorraSur,$mazmorraOeste,$mazmorraInicial,$mazmorraFinal){  //guarda las conexiones entre mazmorras, mazmorraNorte,Sur....
      $result_array=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();

      $query = sprintf("INSERT INTO mapacontiene (idMapa,idMazmorra,mazmorraNorte,mazmorraEste,mazmorraSur,mazmorraOeste,mazmorraInicial,mazmorraFinal) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s')",
      $conn->real_escape_string($idMapa), $conn->real_escape_string($idMazmorra),$conn->real_escape_string($mazmorraNorte),$conn->real_escape_string($mazmorraEste),$conn->real_escape_string($mazmorraSur),$conn->real_escape_string($mazmorraOeste),$conn->real_escape_string($mazmorraInicial) ,$conn->real_escape_string($mazmorraFinal));
      
      $rs = $conn->query($query);
       if ($rs){
     	  $rs->free();
     	  }else
          echo $conn->error;
      }

      /************************************ MODIFICACIONES BEA **********************************************/
    
    private $idMapa;
    private $idMazmorra;
    private $mazmorraNorte;
    private $mazmorraSur;
    private $mazmorraEste;
    private $mazmorraOeste;
    private $mazmorraInicial;    
    private $mazmorraFinal;
    
    public function __construct($idMapa,$idMazmorra,$mazmorraNorte,$mazmorraSur,$mazmorraEste,$mazmorraOeste, $mazmorraInicial,$mazmorraFinal)
    {
        $this->idMapa=$idMapa;
        $this->idMazmorra=$idMazmorra;
        $this->mazmorraNorte=$mazmorraNorte;
        $this->mazmorraSur=$mazmorraSur;
        $this->mazmorraEste=$mazmorraEste;
        $this->mazmorraOeste=$mazmorraOeste;
        $this->mazmorraInicial=$mazmorraInicial;
        $this->mazmorraFinal=$mazmorraFinal;

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
    private function getConsumibles(){
        return $this->consumibles;
    }
    private function getEnemigos(){
        return $this->enemigos;
    }

    private function getPersonaje(){
        return $this->personaje;
    }
    
}








