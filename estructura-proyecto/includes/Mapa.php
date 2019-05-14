<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Mapa
{

    //Carga las mazmorras en un determinado mapa pasado por parametro, el seleccionado.
   public static function construyeMapa($idMapa)
   {
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
      	$app = App::getSingleton();
    	$conn = $app->conexionBd();
    	$query = sprintf("SELECT * FROM mapas WHERE id =%s",$idMapa);
    	$rs = $conn->query($query);
    	if ($rs && $rs->num_rows == 1) {
			$fila = $rs->fetch_assoc(); 
			$mapa = new Mapa($fila['id'], $fila['nombre'], $fila['dificultad'], $fila['precio'], $fila['numMazmorras'],$fila['recompensa'],$fila['propietario'], $fila['rutaImagen'], $fila['descripcion'], $fila['valoracion'], $fila['numJugado'], $fila['terminadoCreado']);
			$rs->free();
			return $mapa;
        }
    	return false;
    }

    public static function getMapasTerminados()
    {
    	$app = App::getSingleton();
    	$conn = $app->conexionBd();
    	$query = "SELECT * FROM mapas WHERE terminadoCreado = 1";
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

    public static function getMapasCompradosTerminados($idUser)
    {
    	$app = App::getSingleton();
    	$conn = $app->conexionBd();
    	$query =   "SELECT * 
    				FROM mapas m INNER JOIN comprados c ON m.id = idObjeto
    				WHERE c.tipo = 'mapa' and terminadoCreado = 1 and c.idUsuario = $idUser";
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

    public function mostrarDetalles()
    {
    	$app = App::getSingleton();
    	$conn = $app->conexionBd();
		//Busca el numbre del propietario
		$IDpropietario = self::getPropietario();
		$query = "SELECT nombre FROM usuarios WHERE id = $IDpropietario";
		$consulta = $conn->query($query);
		if($consulta->num_rows > 0){
			$fila = $consulta->fetch_assoc();
			$nombPropietario = $fila['nombre'];
		}else{
			$nombPropietario = "Anonimo";
		}
		$dificultad = self::getDificultad();
		$numMazmorras = self::getNumMazmorras();
		$recompensa = self::getRecompensa();
		$descripcion = self::getDescripcion();
		$valoracion = self::getValoracion();
		echo "<p><strong>Dificultad: </strong>$dificultad</p>
			<p><strong>Número de mazmorras: </strong>$numMazmorras</p>
			<p><strong>Recompensa: </strong>$recompensa</p>
			<p><strong>Propietario: </strong>$nombPropietario</p>
			<p><strong>Descripción: </strong>$descripcion</p>
			<p><strong>Valoración: </strong>$valoracion</p>";
    }
    
    private $id;
    private $nombre;
    private $dificultad;
    private $precio;
    private $numMazmorras;
    private $recompensa;
    private $propietario;
    private $rutaImagen;
    private $descripcion;
    private $valoracion;
    private $numJugado;
    private $terminadoCreado;
    
    private function __construct(int $id,string $nombre,int $dificultad,float $precio,int $numMazmorras,int $recompensa,int $propietario, string $rutaImagen,$descripcion,int $valoracion,int $numJugado,int $terminadoCreado)
    {
     	$this->id = $id;
     	$this->nombre = $nombre;
     	$this->dificultad = $dificultad;
     	$this->precio = $precio;
     	$this->numMazmorras = $numMazmorras;
     	$this->recompensa = $recompensa;
     	$this->propietario = $propietario;
     	$this->rutaImagen = $rutaImagen;
     	$this->descripcion = $descripcion;
     	$this->valoracion = $valoracion;
     	$this->numJugado = $numJugado;

    }
  
    private function getId()
    {
    	return $this->id;
    }

    private function getNombre()
    {
    	return $this->nombre;
    }

    private function getDificultad()
    {
    	return $this->dificultad;
    }
    
    private function getPrecio()
    {
    	return $this->precio;
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

    private function getRutaImagen()
    {
    	return $this->rutaImagen;
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

    
      /*private function size(){
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
    }*/
}