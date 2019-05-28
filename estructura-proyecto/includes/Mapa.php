<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\ObjetoTienda as Objeto;

class Mapa extends Objeto
{

    /************************************ MODIFICACIONES BEA **********************************************/
    //Modificarlo para que cree el mapa cogiendo el idUsuario
    public static function crearMapa($nombre,$dificultad,$numMazmorras,$recompensa,$idUsuario,$descripcion)
    {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("INSERT INTO mapas (nombre,dificultad,numMazmorras,recompensa,propietario,descripcion) VALUES ('%s','%s','%s' , '%s', '%s','%s')",
       $conn->real_escape_string($nombre), $conn->real_escape_string($dificultad),$conn->real_escape_string($numMazmorras),$conn->real_escape_string($recompensa),
       $conn->real_escape_string($idUsuario),$conn->real_escape_string($descripcion));

      $rs = $conn->query($query);
      if ($rs) {
        $query = sprintf("SELECT * FROM mapas WHERE id = (SELECT MAX(id) FROM mapas)");
        $rs = $conn->query($query);
        
        if ($rs && $rs->num_rows >0) {
         $fila = $rs->fetch_assoc(); 
         $mapa = new Mapa($fila['id'], $fila['nombre'], $fila['dificultad'], $fila['precio'], $fila['numMazmorras'],$fila['recompensa'],$fila['propietario'], $fila['rutaImagen'], $fila['descripcion'], $fila['valoracion'], $fila['numJugado'], $fila['terminadoCreado']);
         $rs->free();
         return $mapa;
       }
     }
     else{
      echo"$conn->error";
      return false;
    }
  }

    //Se usa para poder acceder al mapa creado y acceder a datos necesarios para crear mazmorras
  public static function ultimoMapaCreado()
  {
   $result_array=array();

   $app = App::getSingleton();
   $conn = $app->conexionBd();
   $query = sprintf("SELECT * FROM mapas WHERE id = (SELECT MAX(id) FROM mapas)");
   $rs = $conn->query($query);
   
   
   if ($rs && $rs->num_rows > 0) {
    while($row = $rs->fetch_assoc()) {
      array_push($result_array, $row);
    }
    $rs->free();
  }
  return $result_array;
}


public static function buscaMapaPorNombre($nombre)
{
  $app = App::getSingleton();
  $conn = $app->conexionBd();
  $query = sprintf("SELECT * FROM mapas WHERE nombre =%s",$conn->real_escape_string($nombre));
  $rs = $conn->query($query);
  if ($rs && $rs->num_rows == 1) {
    $fila = $rs->fetch_assoc(); 
    $mapa = new Mapa($fila['id'], $fila['nombre'], $fila['dificultad'], $fila['precio'], $fila['numMazmorras'],$fila['recompensa'],$fila['propietario'], $fila['rutaImagen'], $fila['descripcion'], $fila['valoracion'], $fila['numJugado'], $fila['terminadoCreado']);
    $rs->free();
    return $mapa;
  }
  return false;
}


    /************************************ MODIFICACIONES BEA **********************************************/
 
    public static function buscaMapaPorId($idMapa)
    {
        $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapas WHERE id =%s",$conn->real_escape_string($idMapa));
      $rs = $conn->query($query);
      if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc(); 
      $mapa = new Mapa($fila['id'], $fila['nombre'], $fila['dificultad'], $fila['precio'], $fila['numMazmorras'],$fila['recompensa'],$fila['propietario'], $fila['rutaImagen'], $fila['descripcion'], $fila['valoracion'], $fila['numJugado'], $fila['terminadoCreado']);
      $rs->free();
      return $mapa;
        }
      return false;
    }

    //Devuelve un array con todos los mapas que ya estan terminados
    public static function getMapasTerminados()
    {
        $mapas = array();
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mapas WHERE terminadoCreado = 1");
      $rs = $conn->query($query);
      if($rs && $rs->num_rows > 0){
        while($fila = $rs->fetch_assoc()){ 
        $mapa = new Mapa($fila['id'], $fila['nombre'], $fila['dificultad'], $fila['precio'], $fila['numMazmorras'],$fila['recompensa'],$fila['propietario'], $fila['rutaImagen'], $fila['descripcion'], $fila['valoracion'], $fila['numJugado'], $fila['terminadoCreado']);
          array_push($mapas, $mapa);
        }
        $rs->free();
      }
        else{
            echo "<p>No hay mapas disponibles</p>";
        }
        return $mapas;
    }

    //Devuelve un array de los mapas comprados por un usuario $idUser que ya estan terminados
    public static function getMapasCompradosTerminados($idUser)
    {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * 
            FROM mapas m INNER JOIN comprados c ON m.id = idObjeto
            WHERE c.tipo = 'mapa' and terminadoCreado = 1 and c.idUsuario = %s",$conn->real_escape_string($idUser));
      $rs = $conn->query($query);
      if($rs){
        $mapas = array();
        while($fila = $rs->fetch_assoc()){ 
        $mapa = new Mapa($fila['id'], $fila['nombre'], $fila['dificultad'], $fila['precio'], $fila['numMazmorras'],$fila['recompensa'],$fila['propietario'], $fila['rutaImagen'], $fila['descripcion'], $fila['valoracion'], $fila['numJugado'], $fila['terminadoCreado']);
          array_push($mapas, $mapa);
        }
        $rs->free();
        return $mapas;
      }
      return false;
    }

    //Devuelve el nombre del propietario del mapa
    public function getNombPropietario(){
        $app = App::getSingleton();
        $conn = $app->conexionBd();
        $IDpropietario = self::getPropietario();
        $query = sprintf("SELECT nombre FROM usuarios WHERE id = %s",$conn->real_escape_string($IDpropietario));
        $consulta = $conn->query($query);
        if($consulta->num_rows > 0){
            $fila = $consulta->fetch_assoc();
            $nombPropietario = $fila['nombre'];
        }else{
            $nombPropietario = "Anonimo";
        }
        return $nombPropietario;
    }

    //Muestra la información del mapa en la tienda
    public function infoObjetoTienda(){
        parent::mostrarSupTienda();
        $dificultad = self::getDificultad();
        $numMazmorras = self::getNumMazmorras();
        $recompensa = self::getRecompensa();
        $nombPropietario = self::getNombPropietario();
        $descripcion = self::getDescripcion();
        $valoracion = self::getValoracion();
        echo "<h2>Detalles</h2>
            <p><em>Dificultad: </em>$dificultad</p>
            <p><em>Número de mazmorras: </em>$numMazmorras</p>
            <p><em>Recompensa: </em>$recompensa</p>
            <p><em>Propietario: </em>$nombPropietario</p>
            <p><em>Descripción: </em>$descripcion</p>
            <p><em>Valoración: </em>$valoracion</p>";
    }
    

    private $dificultad;
    private $numMazmorras;
    private $recompensa;
    private $propietario;
    private $descripcion;
    private $valoracion;
    private $numJugado;
    private $terminadoCreado;
    
    private function __construct(int $id,string $nombre,int $dificultad,float $precio,int $numMazmorras,int $recompensa,int $propietario, string $rutaImagen,$descripcion,int $valoracion,int $numJugado,int $terminadoCreado)
    {
      parent::__construct($id,$nombre,$precio,$rutaImagen);
      $this->dificultad = $dificultad;
      $this->numMazmorras = $numMazmorras;
      $this->recompensa = $recompensa;
      $this->propietario = $propietario;
      $this->descripcion = $descripcion;
      $this->valoracion = $valoracion;
      $this->numJugado = $numJugado;

    }

    private function getDificultad()
    {
      return $this->dificultad;
    }

    private function getNumMazmorras()
    {
      return $this->numMazmorras;
    }

    private function getRecompensa()
    {
      return $this->recompensa;
    }

    private function getPropietario()
    {
      return $this->propietario;
    }

    private function getDescripcion()
    {
      return $this->descripcion;
    }

    private function getValoracion()
    {
      return $this->valoracion;
    }

    private function getNumJugado()
    {
      return $this->numJugado;
    }

    private function getTerminadoCreado()
    {
      return $this->terminadoCreado;
    }
}