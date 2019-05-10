<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Mapa
{

    //Carga las mazmorras en un determinado mapa pasado por parametro, el seleccionado.
   public static function construyeMapa($idMapa){
       $mazmorras= Mazmorras::cargaMazmorras($idMapa);
       $array=json_decode(json_encode($mazmorras));
       if(sizeof($array)>0){
           $i=0;
           $objetos= array();
           $enemigos=array();
            while($i<sizeof($mazmorras)){
                $objeto=ObjetoConsumible::cargaObjetosMazmorra($array[$i]->idMazmorra);
                if($objeto!=null){
                    $objetos[$i]=$objeto;
                }
                
                $enemigo=Enemigos::cargaEnemigos($array[$i]->idMazmorra);
                if($objeto!=null){
                    $enemigos[$i]=$enemigo;
                }
               
                $i++;
            }
            $tamanio=sizeof($mazmorras);
            $mapa = array('tamanio'=>$tamanio,'mazmorras' => $mazmorras, 'enemigos' => $enemigos, 'objetos' => $objetos);
            return $mapa;
       }
       else echo "no es posible construir el mapa";
 
   } 
    public static function buscaMapaPorId($idMapa)
  {
      $result_array=array();
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapas WHERE mapas.id =%s",$idMapa);
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
    private $consumibles;
    private $enemigos;

    
    private function __construct($tamanio,$mazmorras,$consumibles,$enemigos )
    {
   
        $this->tamanio=$tamanio;
        $this->mazmorras=$mazmorras;
        $this->consumibles=$consumibles;
        $this->enemigos=$enemigos;
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


    
    
}