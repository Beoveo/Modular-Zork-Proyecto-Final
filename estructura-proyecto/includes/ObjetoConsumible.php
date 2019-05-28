<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\ObjetoTienda as Objeto;

class ObjetoConsumible extends Objeto
{
    //Comprobar que se le pasa un objeto Objeto, falta comprobar lo de admin
    public function cargarObjeto()
    {
        //Si existe un objeto con ese nombre
        $nombre = parent::getNombre();
        if($objName = self::buscaObjetoPorNombre($nombre)){
            echo "Ese nombre ya existe. Intentalo de nuevo."; 
        }else{
            //Si no está, lo inserta y lo devuelve.
            $app = App::getSingleton();
            $conn = $app->conexionBd();
            $rutaImg = parent::getRutaImagen();
            $precio = parent::getPrecio();
            $categoria = self::getCategoria();
            $fuerza = self::getFuerza();
            $habilidad = self::getHabilidad();
            $vida = self::getVida();
            $w = self::getW();
            $h = self::getH();
            $tipo = self::getTipo();
            //Obtiene el último id y lo incrementa para incluir otro consumible 
            $query = sprintf("INSERT INTO consumibles (nombre,categoria,fuerza,habilidad,vida,precio,rutaImagen, w,h,tipo) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", $conn->real_escape_string($nombre), $conn->real_escape_string($categoria),$conn->real_escape_string($fuerza),$conn->real_escape_string($habilidad),$conn->real_escape_string($vida),$conn->real_escape_string($precio),$conn->real_escape_string($rutaImg),$conn->real_escape_string($w),$conn->real_escape_string($h),$conn->real_escape_string($tipo));

            $rs = $conn->query($query);
            if ($rs) {
                return $obj = self::buscaObjetoPorNombre($nombre);
                $rs->free();
            }
            else{
                echo"$conn->error";
                return false;
            }
        }
    }

    //carga objetos de una determinada mazmorra
    public static function cargaObjetosMazmorra($idMazmorra)
    {
        $consulta = array();
        $consumibles = array();
        $app = App::getSingleton(); 
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM consumibles c, mazmorraconsumibles m WHERE m.idMazmorra=%s AND c.id=m.idConsumible",$idMazmorra);
        $rs = $conn->query($query);
        if ($rs) {
            if ($rs->num_rows > 0) {

                while($row = $rs->fetch_assoc()) {
                    array_push($consumibles, new ObjetoConsumible($row['id'],$row['nombre'],$row['categoria'],$row['fuerza'],$row['habilidad'],$row['vida'],$row['precio'],$row['rutaImagen'],
                    $row['x'],$row['y'],$row['w'],$row['h'],$row['tipo']));
                    array_push($consulta,$row);
                }

                $rs->free();
                return $consulta;
            }
        }
    }

    //Busca solo por nombre porque lo mismo no tiene id. 
    public static function buscaObjetoPorNombre($nombre)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM consumibles WHERE nombre='%s'",$conn->real_escape_string($nombre));

        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();

            //Si la consulta devuelve 1 fila, crea el objeto y lo devuelve con los datos recogidos (Si existe, lo devuelve)
            $obj = new ObjetoConsumible($fila['id'], $fila['nombre'], $fila['categoria'], $fila['fuerza'], $fila['habilidad'], $fila['vida'], $fila['precio'],$fila['rutaImagen'],
            0,0,$fila['w'],$fila['h'],$fila['tipo']);
            $rs->free();
            return $obj;
        }
    return false;
    }

    //Busca solo por nombre porque lo mismo no tiene id. 
    public static function buscaObjetoPorId($id)
    {
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM consumibles WHERE id='%s'",$conn->real_escape_string($id));

        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();

            //Si la consulta devuelve 1 fila, crea el objeto y lo devuelve con los datos recogidos (Si existe, lo devuelve)
            $obj = new ObjetoConsumible($fila['id'], $fila['nombre'], $fila['categoria'], $fila['fuerza'], $fila['habilidad'], $fila['vida'], $fila['precio'],$fila['rutaImagen'],
                0,0,$fila['w'],$fila['h'],$fila['tipo']);
            $rs->free();
            return $obj;
        }
        return false;
    }

    public static function getConsumibleTienda()
    {
        $objetos = array();
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM consumibles WHERE categoria != 'key'");
        $rs = $conn->query($query);
        if($rs && $rs->num_rows > 0){
            while($fila = $rs->fetch_assoc()){ 
                $objeto = new ObjetoConsumible($fila['id'], $fila['nombre'], $fila['categoria'], $fila['fuerza'], $fila['habilidad'], $fila['vida'], $fila['precio'],$fila['rutaImagen'],0,0,$fila['w'],$fila['h'],$fila['tipo']);
                array_push($objetos, $objeto);
            }
            $rs->free();
        }else{
            echo "<p>No hay consumibles disponibles</p>";
        }
        return $objetos;
    }

   public function infoObjetoTienda(){
        parent::mostrarSupTienda();
        $fuerza = self::getFuerza();
        $vida = self::getVida();
        $habilidad = self::getHabilidad();
        $categoria = self::getCategoria();
        echo "<h2>Detalles</h2>
            <p><em>Fuerza: </em>$fuerza</p>
            <p><em>Vida: </em>$vida</p>
            <p><em>Habilidad: </em>$habilidad</p>
            <p><em>Categoria: </em>$categoria</p>";
    }

    private $categoria;
    private $fuerza;
    private $habilidad;
    private $vida;
    private $x;
    private $y;
    private $w;
    private $h;
    private $tipo;

    public function __construct($id, $nombre, $categoria, $fuerza,$habilidad,$vida,$precio,$rutaImg,$x,$y,$w,$h,$tipo)
    {
        parent::__construct($id,$nombre,$precio,$rutaImg);
        $this->categoria = $categoria;
        $this->fuerza = $fuerza;
        $this->habilidad = $habilidad;
        $this->vida = $vida;
        $this->x=$x;
        $this->y=$y;
        $this->w=$w;
        $this->h=$h;
        $this->tipo=$tipo;
    }


    private function getFuerza(){
        return $this->fuerza;

    }

    private function getCategoria(){
        return $this->categoria;

    }

    private function getHabilidad(){
        return $this->habilidad;

    }
    private function getVida(){
        return $this->vida;
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


