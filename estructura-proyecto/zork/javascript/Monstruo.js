
//--------------------------------------------------------clase Monstruo----------------------------------------------------------
var Monstruo= function(vida, ataque,imagenMonstruo,nombre,x,y,w,h,tipo){
	//en la base de datos los monstruos tendran unas respuestas asociadas fijas, ya que a un monstruo solo se le puede atacar o huir de el.

var vida;
var ataque;
var rutaImagen;
var listaRespuestas;
var nombre;
var x;
var y;
var w;
var h;
var tipo;

this.inicializa=function(){
	this.vida=vida;
	this.ataque=ataque;
	this.rutaImagen=imagenMonstruo;
	this.nombre=nombre;
	this.x = x;
	this.y=y;
	this.w=w;
	this.h=h;
	this.tipo=tipo;

	//this.listaRespuestas=respuestas;
}
this.getNombre=function(){
	return this.nombre;
}

this.perderVida=function(daño){
	this.vida=parseInt(this.vida)-parseInt(daño);
}
this.getAtaque =function(){
	return this.ataque;
}
this.getListaRespuestas= function(){
	return this.listaRespuestas;
}
this.getVida = function(){
	return this.vida
}

};


