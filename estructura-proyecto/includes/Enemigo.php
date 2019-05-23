
<?php
/*
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;

//Clase que crea un objeto con todos los enemigos de una mazmorra
class EnemigoContiene
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
  private $id;
  private $nombre;
  private $fuerza;
  private $habilidad;
  private $vida;
  private $precio;
  private $rutaImagen;
  private $x;
  private $y;
  private $w;
  private $h;
  private $tipo;

  private function __construct($id,$nombre,$fuerza,$habilidad,$vida,$precio,$rutaImagen,$x,$y,$w,$h,$tipo)
  {
   $this->id=$id;
   $this->nombre=$nombre;
   $this->fuerza=$fuerza;
   $this->habilidad=$habilidad;
   $this->vida=$vida;
   $this->precio=$precio;
   $this->rutaImagen=$rutaImagen;
   $this->x=$x;
   $this->y=$y;
   $this->w=$w;
   $this->h=$h;
   $this->tipo=$tipo;
 }

 private function getNombre(){
  return $this->nombre;

}
private function getId(){
  return $this->id;

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
private function getPrecio(){
  return $this->precio;

}
private function getRutaImagen(){
  return $this->rutaImagen;

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


}*/?>