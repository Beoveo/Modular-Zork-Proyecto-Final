//--------------------------------------------------------clase mapa----------------------------------------------------------
var Mapa=function(tamMazmorras,personajeMapa){
	var tamanio;
	var mazmorras;
	var personaje;
	var mazmorraActual;
	var mazmorraFinal;
	this.size=function(){
		return this.tamanio;
	}
	this.inicializa=function(){
		this.tamanio=tamMazmorras;
		this.personaje=personajeMapa;
		this.mazmorras=new Array();
	}
	this.setMazmorraAct=function(mazmorra){
		this.mazmorraActual=mazmorra;
	}
	this.getMazmorraAct=function(){
		
		return this.mazmorraAct;
	}
	this.esFinal=function(){
		return this.mazmorraFinal.getId()==this.mazmorraActual.getId();

	}
	this.getMazmorraFinal=function(){
		return this.mazmorraFinal;
	}
	this.setMazmorraFinal=function(idMazmorra){
		this.mazmorraFinal=idMazmorra;
		
	}

	this.insertaPersonaje=function(p){
		this.personaje=p;
	}

	this.insertaMazmorra=function(mazmorra){
		this.mazmorras.push(mazmorra);
	}
	this.getMazmorra=function(idMazmorra){
		var encontrado = false;
		var i = 0;
		var ret = -1;

		while(i<this.mazmorras.length && !encontrado){
			if(this.mazmorras[i].getId() == idMazmorra){
				encontrado = true;
				ret = this.mazmorras[i];
			}
			
			i++;
		}
		return ret;	
	}

	this.isInserted=function(idMazmorra){
		for(i=0;i<mazmorras.length;i++){
			if(mazmorras[i]==idMazmorra)return true;
		}
		return false;
	}

	this.getMapa=function(){
		
		return this.mazmorras;
	}
	this.cogeConsumible=function(consumible){
		this.personaje.interactuarConsumible(consumible);
		this.mazmorraActual.getListaConsumibles().pop();
	}
	this.tieneEnemigos=function(){
		if(this.mazmorraActual.getListaMonstruos().length!=0)
			return true;
		else{
			return false;
		}
	}
	this.buscaConsumibleEnMapa=function(idConsumible){
		for (var i = 0; i < this.mazmorras.length; i++) {
			var objeto=this.mazmorras[i].existeConsumible(idConsumible);
			if(objeto!=-1)
			return objeto;
		}

	}
};
