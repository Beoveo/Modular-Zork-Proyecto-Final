//--------------------------------------------------------clase Consumible----------------------------------------------------------
var Consumible= function(id,categoria,nombre,fuerza,habilidad,vida,imagenConsumible,x,y,w,h,tipo){
	//cada consumible tendra una respuesta asociada por lo que en la base de datos debe estar pasada como parametro para cada consumible.
	//por ejemplo todos los onjetos consumibles se podran coger para añadirse al inventario.

	var categoria;
	var nombre;
	var fuerza;
	var habilidad;
	var vida;
	var rutaImagen;
	var id;
	var x;
	var y;
	var w;
	var h;
	var tipo;
	var id;


	this.inicializa= function(){
		this.categoria=categoria;
		this.nombre=nombre;
		this.fuerza=fuerza;
		this.habilidad=habilidad;
		this.vida=vida;
		this.rutaImagen=imagenConsumible;
		this.x=x;
		this.y=y;
		this.w=w;
		this.h=h;
		this.id=id;
		this.tipo=tipo;
	}
	//por defecto los efetos que no esten contemplados segun la categoria valdran 0 y no NULL.
	this.getFuerza=function(){
		return this.fuerza;
	}
	this.getNombre=function(){
		return this.nombre;
	}
	this.getCategoria=function(){

		return this.categoria;

	}
	this.getHabilidad=function(){

		return this.habilidad;

	}
	this.getVida=function(){
		return this.vida;
	}
	this.getId=function(){
		return this.id;
	}

	this.getTipo=function(){
		return this.tipo;
	}

};