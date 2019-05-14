<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\Usuario as Usuario;

class Compra
{

	public static function crea($type, $id )
	{
		//Buscar id usuario
		$userNombre = App::getSingleton()->nombreUsuario();
		$user=Usuario::buscaUsuarioPorNombre($userNombre);
		if ($user) {
			$IDUser = $user->id();
			$app = App::getSingleton();
    		$conn = $app->conexionBd();
    		$query = "SELECT precio FROM $type WHERE id = $id";
    		$rs = $conn->query($query);
    		if ($rs && $rs->num_rows == 1) {
      			$fila = $rs->fetch_assoc();
				$compra = new Compra($IDUser, $type, $id, $fila['precio']);
				$rs->free();
				return $compra;
			}
		}else 
			echo "No has iniciado sesión";
        return false;
	}

	//Si el usuario ya ha comprado el objeto
	private function objetoNoComprado($conn){
		$idUser = self::IDUser();
		$idObjeto = self::idObjeto();
		$tipo = self::type();
		$query = "SELECT * FROM comprados WHERE idObjeto = $idObjeto AND tipo = '$tipo' and idUsuario = $idUser";
		$consulta = $conn->query($query);
		return ($consulta && $consulta->num_rows == 0);
	}

	//Si el usuario tiene suficientes monedas
	private function monedasSuficientes($conn){
		$idUser = self::IDUser();
    	$precio = self::precio();
    	$queryMonedas = "SELECT monedas FROM usuarios WHERE id = $idUser";
    	$rsMonedas = $conn->query($queryMonedas);echo $conn->error;
    	if($rsMonedas && $rsMonedas->num_rows == 1){
    		$filaMonedas = $rsMonedas->fetch_assoc();
    		if($filaMonedas['monedas'] > $precio){
    			return true;
    		}
    	}
    	return false;
	}

	public function realizarCompra()
	{
		$app = App::getSingleton();
    	$conn = $app->conexionBd();
    	
    	if(self::objetoNoComprado($conn)){
    		if(self::monedasSuficientes($conn)){
    			$idUser = self::IDUser();
		    	$precio = self::precio();
				$idObjeto = self::idObjeto();
		    	$tipo = self::type();
		    	//Inserta la compra en la tabla comprados
		    	$query = "INSERT INTO comprados(idUsuario,idObjeto,tipo,precio)
		    			  VALUES($idUser,$idObjeto,'$tipo',$precio)";
		    	$res = $conn->query($query);echo $conn->error;
				if($res){
					//Restar el dinero al usuario
					$queryUser = "UPDATE usuarios SET monedas=monedas-$precio WHERE id = $idUser";
					$rsUser = $conn->query($queryUser);
					if($rsUser){
						return true;
					}else{
						//Si falla el restar las monedas del user, eliminar la compra
						$queryD = "DELETE FROM comprados WHERE idUsuario = $idUser and idObjeto = $idObjeto";
						$conn->query($queryD);
					}
				}else{
					echo "<p>Error en la base de datos</p>";
				}
    		}else{
    			echo "<p>No tienes monedas suficientes para comprar este objeto</p>";
    		}
    	}else{
    		echo "<p>Ya tienes este objeto</p>";
    	}
		
		return false;
	}

	private $IDUser;

	private $type;

	private $idObjeto;

	private $precio;

	private function __construct($user, $tipo, $idObjeto,$precio)
	{
		$this->IDUser = $user;
		$this->type = $tipo;
		$this->idObjeto = $idObjeto;
		$this->precio = $precio;
	}

	public function IDUser()
	{
		return $this->IDUser;
	}

	public function type()
	{
		return $this->type;
	}

	public function idObjeto()
	{
		return $this->idObjeto;
	}

	public function precio()
	{
		return $this->precio;
	}
}