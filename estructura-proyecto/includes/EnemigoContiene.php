<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\ObjetoTienda as Objeto;

//Clase que crea un objeto con todos los enemigos de una mazmorra
class EnemigoContiene extends Objeto
{
    //Carga los de una mazmorra en un determinado mapa
  public static function cargaEnemigos($idMazmorra){
    $consulta=array();
    $enemigos=array();
    $app = App::getSingleton(); 
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM enemigo e,mazmorraenemigo m WHERE m.idMazmorra=%s AND e.id=m.idEnemigo",$idMazmorra);
    $rs = $conn->query($query);
    if ($rs) {
      if ($rs->num_rows > 0) {

        while($row = $rs->fetch_assoc()) {
          array_push($enemigos, new EnemigoContiene($row['id'],$row['nombre'],$row['fuerza'],$row['habilidad'],$row['vida'],$row['precio'],$row['rutaImagen'],
           $row['x'],$row['y'],$row['w'],$row['h'],$row['tipo']));
          array_push($consulta, $row);
        }

        $rs->free();
        return $consulta;
      }
    }
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
                $enemigo = new EnemigoContiene($fila['id'], $fila['nombre'], $fila['fuerza'], $fila['habilidad'], $fila['vida'],$fila['precio'], $fila['rutaImagen'],$fila['x'],$fila['y'],$fila['w'],$fila['h'],$fila['tipo']);
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
                $enemigo = new EnemigoContiene($fila['id'], $fila['nombre'], $fila['fuerza'], $fila['habilidad'], $fila['vida'],$fila['precio'], $fila['rutaImagen'],$fila['x'],$fila['y'],$fila['w'],$fila['h'],$fila['tipo']);
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
    private $x;
    private $y;
    private $w;
    private $h;
    private $tipo;

    private function __construct($id,$nombre,$fuerza,$habilidad,$vida,$precio,$rutaImagen,$x,$y,$w,$h,$tipo)
    {
        parent::__construct($id,$nombre,$precio,$rutaImagen);
        $this->fuerza=$fuerza;
        $this->habilidad=$habilidad;
        $this->vida=$vida;
        $this->x=$x;
        $this->y=$y;
        $this->w=$w;
        $this->h=$h;
        $this->tipo=$tipo;
    }


    private function getFuerza(){
        return $this->fuerza;

    }

    private function getHabilidad(){
        return $this->habilidad;

    }
    private function getVida(){
        return $this->nombre;

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

    private function getTipo(){
        return $this->tipo;

    }


}
