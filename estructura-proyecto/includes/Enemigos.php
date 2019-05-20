<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\ObjetoTienda as Objeto;

class Enemigos extends Objeto
{
    //Carga los de una mazmorra en un determinado mapa
    public static function cargaEnemigos($idMazmorra){
        $consulta=array();
        $enemigos=array();
        $app = App::getSingleton(); 
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM enemigo,mazmorraenemigo WHERE mazmorraenemigo.idMazmorra=%s AND enemigo.id=mazmorraenemigo.idEnemigo",$idMazmorra);
        $rs = $conn->query($query);
        if ($rs) {
            if ($rs->num_rows > 0) {

                while($row = $rs->fetch_assoc()) {
                    array_push($enemigos, new Enemigos($fila['id'], $fila['nombre'], $fila['fuerza'], $fila['habilidad'], $fila['vida'],$fila['precio'], $fila['rutaImagen']));
                    array_push($consulta, $row);
                }

                $rs->free();
                return $consulta;
            }
        }
        return false;
    }

    public static function getEnemigosTienda()
    {
        $enemigos = array();
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM enemigo";
        $rs = $conn->query($query);
        if($rs && $rs->num_rows > 0){
            while($fila = $rs->fetch_assoc()){ 
                $enemigo = new Enemigos($fila['id'], $fila['nombre'], $fila['fuerza'], $fila['habilidad'], $fila['vida'],$fila['precio'], $fila['rutaImagen']);
                array_push($enemigos, $enemigo);
            }
            $rs->free();
        }else{
            echo "<p>No hay enemigos disponibles</p>";
        }
        return $enemigos;
    }

    public static function getEnemigo($id){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM enemigo WHERE id = $id";
        $rs = $conn->query($query);
        if($rs && $rs->num_rows == 1){
            while($fila = $rs->fetch_assoc()){ 
                $enemigo = new Enemigos($fila['id'], $fila['nombre'], $fila['fuerza'], $fila['habilidad'], $fila['vida'],$fila['precio'], $fila['rutaImagen']);
            }
            $rs->free();
            return $enemigo;
        }else{
            echo "<p>Enemigos no disponibles</p>";
        }
        return false;
    }

    public function infoObjetoTienda(){
        parent::mostrarSupTienda();
        $fuerza = self::getFuerza();
        $vida = self::getVida();
        $habilidad = self::getHabilidad();
        echo "<p><strong>Fuerza: </strong>$fuerza</p>
            <p><strong>Vida: </strong>$vida</p>
            <p><strong>Habilidad: </strong>$habilidad</p>";
    }

    private $fuerza;
    private $habilidad;
    private $vida;

    private function __construct($id,$nombre,$fuerza,$habilidad,$vida,$precio,$rutaImagen)
    {
        parent::__construct($id,$nombre,$precio,$rutaImagen);
        $this->fuerza=$fuerza;
        $this->vida=$vida;
        $this->habilidad=$habilidad;
    }

    private function getFuerza(){
        return $this->fuerza;
    }
    
    private function getHabilidad(){
        return $this->habilidad;
    }

    private function getVida(){
        return $this->vida;
    }

}