<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;

//Clase que crea un objeto con todos los consumibles, enemigos, mazmorras y personaje del mapa
class MapaContiene
{

    //Carga las mazmorras en un determinado mapa pasado por parametro, el seleccionado.
    public static function construyeMapa($idMapa){
        $mazmorras= MazmorraContiene::cargaMazmorras($idMapa);
        $array=json_decode(json_encode($mazmorras));
        if(sizeof($array)>0){
            $i=0;
            $consumibles= array();
            $enemigos=array();
            while($i<sizeof($mazmorras)){
                $consumible=ObjetoConsumible::cargaObjetosMazmorra($array[$i]->idMazmorra);
                if($consumible!=null){
                    $consumibles[$i]=$consumible;
                }

                $enemigo=EnemigoContiene::cargaEnemigos($array[$i]->idMazmorra);
                if($enemigo!=null){
                    $enemigos[$i]=$enemigo;
                }

                $i++;
            }
            $tamanio=sizeof($mazmorras);
            $mapa = array('tamanio'=>$tamanio,'mazmorras' => $mazmorras, 'enemigos' => $enemigos, 'objetos' => $consumibles);
            return $mapa;
        }
        else echo "no es posible construir el mapa";

    } 
    
    private $tamanio;
    private $mazmorras;
    private $consumibles;
    private $enemigos;
    private $personaje;

    
    private function __construct($tamanio,$mazmorras,$consumibles,$enemigos,$personaje)
    {
        $this->tamanio=$tamanio;
        $this->mazmorras=$mazmorras;
        $this->consumibles=$consumibles;
        $this->enemigos=$enemigos;
        $this->personaje=$personaje;
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