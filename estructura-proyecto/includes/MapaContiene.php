<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;

//Clase que crea un objeto con todos los consumibles, enemigos, mazmorras y personaje del mapa
class MapaContiene implements \JsonSerializable
{

    //Carga las mazmorras en un determinado mapa pasado por parametro, el seleccionado.
    public static function construyeMapa($idMapa){
        $mazmorras= MazmorraContiene::cargaMazmorras($idMapa);
        $array=json_decode(json_encode($mazmorras));
        if(sizeof($array)>0){
                $i=0;
                $consumibles= array();
                $enemigos=array();
                if(sizeof($array)>0){
                    $i=0;
                    $objetos= array();
                    $enemigos=array();
                    while($i<sizeof($mazmorras)){
                        $objeto=ObjetoConsumible::cargaObjetosMazmorra($array[$i]->idMazmorra);
                        if($objeto!=null){
                            $objetos[$i]=$objeto;
                        }
                        
                        $enemigo=EnemigoContiene::cargaEnemigos($array[$i]->idMazmorra);
                        if($enemigo!=null){
                            $enemigos[$i]=$enemigo;
                        }
                        $i++;
                    }
                $tamanio=sizeof($mazmorras);
                $mapaPruebe= new MapaContiene($tamanio,$mazmorras,$enemigos,$objetos);
                return $mapaPruebe;
            }
        }
        else echo "no es posible construir el mapa";

    } 
    public function jsonSerialize()
    {
        $o = new \stdClass();
        $o->tamanio=$this->tamanio;
        $o->mazmorras=$this->mazmorras;
        $o->enemigos=$this->enemigos;
        $o->consumibles=$this->consumibles;
        return $o;
    }
    private $tamanio;
    private $mazmorras;
    private $consumibles;
    private $enemigos;


    
    private function __construct($tamanio,$mazmorras,$enemigos,$consumibles)
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