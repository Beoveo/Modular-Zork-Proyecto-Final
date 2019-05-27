<?php

namespace es\ucm\fdi\aw;

class FormularioObjetosConsumibles extends Form
{

    //Consumibles,enemigo,mapa
    //Consumible: id,nombre,fuerza,habilidad,vida,precio,idInventario
    //Enemigo: id,nombre,fuerza,habilidad, vida,precio
    //Mapa: idMapa, nombre,dificultad,precio, numMazmorras,recompensa, propietario->Luego rellenar formulario de mazmorras
    public function __construct()
    {
        parent::__construct('formObj');
    }

    //Consumible
    protected function generaCamposFormulario ($datos)
    {
        $nombre = "nombre";
        $categoria = "enemigo/arma/pocion";
        $fuerza = 0;
        $habilidad = 0;
        $vida = 0;
        $precio = 0;
        $h = 0;
        $w = 0;
        $rutaImg = "ruta.png";

        if ($datos) {
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
            $fuerza = isset($datos['fuerza']) ? $datos['fuerza'] : $fuerza;
            $vida = isset($datos['vida']) ? $datos['vida'] : $vida;
            $precio = isset($datos['precio']) ? $datos['precio'] : $precio;
            $categoria = isset($datos['categoria']) ? $datos['categoria'] : $categoria;
            $habilidad = isset($datos['habilidad']) ? $datos['habilidad'] : $habilidad;
            $rutaImg = isset($datos['rutaImg']) ? $datos['rutaImg'] : $rutaImg;
        }
        $camposFormulario=<<<EOF
            <fieldset>
            <legend>Añade el Objeto Consumible</legend>
            <p><label>Nombre:</label> <input type="text" name="nombre" placeholder="$nombre"/></p>
            <p><label>Categoria:</label> <input type="text" name="categoria" placeholder="$categoria"/></p>
            <p><label>Fuerza:</label> <input type="number" name="fuerza" placeholder="$fuerza"/></p>
            <p><label>Habilidad:</label> <input type="number" name="habilidad" placeholder="$habilidad"/></p>
            <p><label>Vida:</label> <input type="number" name="vida" placeholder="$vida"/></p>
            <p><label>Alto:</label> <input type="number" name="alto" placeholder="$h"/></p>
            <p><label>Ancho:</label> <input type="number" name="ancho" placeholder="$w"/></p>
            <p><label>Precio:</label> <input type="number" name="precio" placeholder="$precio"/></p>
            <p><label>Imagen:</label> <input type="text" name="rutaImg" placeholder="$rutaImg"/></p>
            <button type="submit">Cargar</button>
            </fieldset>
EOF;
        return $camposFormulario;
    }

    /**
    * Procesa los datos del formulario.
    */
    protected function procesaFormulario($datos)
    {
        $result = array();
        $ok = true;
        $nombre = $datos['nombre'] ?? '' ;
        if ( !$nombre || ObjetoConsumible::buscaObjetoPorNombre($nombre)) {
            $result[] = 'El nombre del objeto no es válido';
            $ok = false;
        }

        //Coger el objeto de Objeto y acceder al resto de atributos
        $categoria = $datos['categoria'] ?? '' ;
        $fuerza = $datos['fuerza'] ?? '' ;
        $habilidad = $datos['habilidad'] ?? '' ;
        $vida = $datos['vida'] ?? '' ;
        $precio = $datos['precio'] ?? '' ;
        $rutaImg = $datos['rutaImg'] ?? '' ;
        $alto = $datos['alto'] ?? '' ; 
        $ancho = $datos['ancho'] ?? '' ;

        if ( $ok ) {
            $objConsumible = new \es\ucm\fdi\aw\ObjetoConsumible(-1,$nombre,$categoria,$fuerza,$habilidad, 0, 0, $alto, $ancho,$vida,$precio,$rutaImg, "Consumibles");
            $obj = $objConsumible->cargarObjeto();
            if ( $obj ) {
            //Carga una nueva ventana de administrar
                $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/admin.php');
            }else {
            //Sacar mensajes de error
                $result[] = 'El objeto no es válido.';
            }
        }
        return $result;
    }
}
