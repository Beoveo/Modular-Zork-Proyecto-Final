<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\Usuario as Usuario;

class Compra
{

	public static function crea($type, $id ){
		//Buscar id usuario
		$userNombre = App::getSingleton()->nombreUsuario();
		$user=Usuario::buscaUsuario($userNombre);
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

	public function realizarCompra(){
		$ok = false;
		//Añadir la compra a la tabla comprado
		$app = App::getSingleton();
    	$conn = $app->conexionBd();
    	
    	$idUser = $this->IDUser;
    	$idObjeto = $this->idObjeto;
    	$type = $this->type;
    	$precio = $this->precio;

    	$query = "SELECT * FROM comprados WHERE idUsuario = $idUser and idObjeto = $idObjeto";
    	$rs = $conn->query($query);
    	if($rs && $rs->num_rows == 0){
    		$query = "INSERT INTO comprados(idUsuario,idObjeto,tipo,precio)
    				VALUES($idUser,$idObjeto,$type,$precio)";
    	}else{
    		return false;
    	}
    	$res = $conn->query($query);
		if($res){
			//Restar el dinero al usuario
			$queryUser = "UPDATE usuarios SET monedas=monedas-$precio WHERE id = $idUser";
			$rsUser = $conn->query($queryUser);
			if($rsUser){
				return true;
			}
		}
		return false;
	}

private $IDUser;

private $type;

private $idObjeto;

private $precio;

private function __construct($user, $tipo, $idObjeto,$precio){
	$this->IDUser = $user;
	$this->type = $tipo;
	$this->idObjeto = $idObjeto;
	$this->precio = $precio;
}

public function IDUser(){
	return $this->IDUser;
}

public function type(){
	return $this->type;
}

public function idObjeto(){
	return $this->idObjeto;
}

public function precio(){
	return $this->precio;
}
}