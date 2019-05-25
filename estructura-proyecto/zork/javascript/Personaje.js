//--------------------------------------------------------clase Personaje----------------------------------------------------------
var Personaje= function(vida,nombre,fuerza,hibilidad,inventario,imagen,x,y,w,h){ //Esta cruzado con partida por eso sabemos su posicion

	var vidaAct;
	var vidaMax;
	var inventario;
	var rutaImagen;
	var fuerza;
	var nombre;
	var habilidad;
	var mazMorraActual;
	var factorTrasparencia;
	var llave;
	var x;
	var y;
	var w;
	var h;

	this.inicializa=function(){
		this.inventario= [];
		this.vidaMax=vida;
		this.vidaAct=vida;
		this.nombre=nombre;
		this.fuerza=fuerza;
		this.rutaImagen=imagen;
		this.habilidad=habilidad;
		this.x = x;
		this.y=y;
		this.w=w;
		this.h=h;
		this.factorTrasparencia=1;
		this.habilidad=0;
		this.llave=0;
	}
	this.cargaInv=function(inventario){
		for (var i = 0; i < inventario.length; i++) {
			this.inventario.push(inventario[i]);
		}
	}

	this.restaVida=function(daño){
		this.vidaAct=parseInt(this.vidaAct) - parseInt(daño);
		this.actualizaTraspa();
	}
	this.actualizaTraspa=function(){
		
		this.factorTrasparencia=this.vidaAct/this.vidaMax;
		
	}

	this.getVida=function(){
		return this.vidaAct;
	}
	this.getVidaMax=function(){
		
		return this.vidaMax;
	}

	this.getFuerza=function(){
		return this.fuerza;
		
	}
	this.sumVidaMax= function(vida){
		this.vidaAct = parseInt(this.vidaAct) + parseInt(vida);
		this.actualizaTraspa();
	}
	this.sumFuerza= function(fuerzaObjeto){

		this.fuerza=parseInt(this.fuerza)+parseInt(fuerzaObjeto);
	}
	this.insertaInventario=function(consumible){
		this.inventario.push(consumible);
	}
	this.consumePocion=function(consumible){
		if(this.vidaAct < this.vidaMax ){
			this.vidaAct=parseInt(this.vidaAct)+parseInt(consumible.getVida());
			this.eliminaInventario(consumible.getId());
		}
		else{
			this.fuerza=parseInt(this.fuerza)+parseInt(consumible.getFuerza());
			this.habilidad=parseInt(this.habilidad)+parseInt(consumible.getHabilidad());
			this.vidaMax=parseInt(this.vidaMax)+parseInt(consumible.getVida());
		}
		
	}
	//Suma todos los campos del consumible para actualizar el estado del jugador en nivel de caracteristicas
	this.interactuarConsumible=function(consumible){
		if(consumible.getCategoria()=="key"){
			this.llave=1;
		}
		else if(consumible.getCategoria()!="salud"){
			this.fuerza=parseInt(this.fuerza)+parseInt(consumible.getFuerza());
			this.habilidad=parseInt(this.habilidad)+parseInt(consumible.getHabilidad());
			this.vidaMax=parseInt(this.vidaMax)+parseInt(consumible.getVida());
		}
		this.insertaInventario(consumible);
		
	}
	this.eliminaInventario=function(idConsum){
		for (var j = 0; j < this.inventario.length; j++) {
			if(this.inventario[j]!=null && this.inventario[j].getId()==idConsum){
				this.inventario.splice(j,1);
			}
		}
	}
	this.ataca=function(monstruo){
		this.restaVida(monstruo.getAtaque());
		monstruo.perderVida(this.fuerza);
	}
	this.tieneLLave=function(){
		return this.llave;
		
	}

};
