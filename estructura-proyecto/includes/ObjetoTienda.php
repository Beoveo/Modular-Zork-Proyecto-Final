<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
abstract class ObjetoTienda
{
	public function mostrarSimpleInfo($type){
        $iden = self::getId();
        $nombre = self::getNombre();
        $precio = self::getPrecio();
        $imagen = self::getRutaImagen();
        echo "<a href='tiendaObjeto.php?id=$iden&type=$type'>
            <li class='item'>
                <div class='imgen'>
                    <img class='imgObj' src='$imagen'/>
                </div>
                <div class='info'>
                    <p>$nombre<em></p>
                    <p>$precio zorkians</em></p>
                </div>
            </li>
        </a>";
    }

    public function mostrarSupTienda(){
    	$imagen = self::getRutaImagen();
    	$nombre = self::getNombre();
    	$precio = self::getPrecio();
        $formBotCompra = new \es\ucm\fdi\aw\FormularioBotonComprar();
    	echo "<div class='supTienda'>
				<div class='imgCompra'><img class='imgCompra' src='$imagen'/></div>
				<div class='infoCompra'>
					<h1>$nombre</h1>
					<h2 class='precio'>$precio zorkians</h2>
                    <div id='errorTienda'>".$formBotCompra->gestiona()."</div></div></div>";
    }

	protected $id;
    protected $nombre;
    protected $precio;
	protected $rutaImagen;

	public function __construct($id,$nombre,$precio,$rutaImagen){
		$this->id=$id;
    	$this->nombre=$nombre;
  		$this->precio=$precio;
		$this->rutaImagen=RUTA_IMGS.$rutaImagen;
	}

	protected function getId(){
        return $this->id;
    }

    protected function getRutaImagen(){
        return $this->rutaImagen;
    }

	protected function getPrecio(){
        return $this->precio;
    }

    protected function getNombre(){
        return $this->nombre;
    }

}  