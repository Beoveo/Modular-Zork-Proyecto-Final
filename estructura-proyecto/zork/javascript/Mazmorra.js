//--------------------------------------------------------clase mazmorra----------------------------------------------------------
var Mazmorra= function(idMazmorra,monstruos, consumibles,historia,numSalidas,recompensa,mazmorraNorte,mazmorraSur,mazmorraEste,mazmorraOeste,rutaImagen,x,y,w,h){
	var listaConsumibles=new Array();
	var listaMonstruos=new Array();
	var listaRespuestas=new Array();
	var objetosUsados = new Array();//aqui se guardaran todos los objetos que se hayan quitado de la mazmorra
	var historiaPrincipal;
	var numSalidas;
	var recompensa;
	//argumento para saber si es la ultima mazmorra para poder terminar el juego de forma exitosa.
	var ultima;
	var idMazmorra;
	var mazmorraNorte;
	var mazmorraSur;
	var mazmorraEste;
	var mazmorraOeste;
	var rutaImagen;
	var x;
	var y;
	var w;
	var h;

	this.inicializa= function(){
		this.listaConsumibles=consumibles;
		this.listaMonstruos=monstruos;
		this.numSalidas=numSalidas;
		this.historiaPrincipal=historia;
		this.idMazmorra=idMazmorra;
		this.mazmorraNorte=mazmorraNorte;
		this.mazmorraSur=mazmorraSur;
		this.mazmorraOeste=mazmorraOeste;
		this.mazmorraEste=mazmorraEste;
		this.rutaImagen=rutaImagen;
		this.x=x;
		this.y=y;
		this.w=w;
		this.h=h;
	}
	this.getImagen=function(){
		return this.rutaImagen;
		
	}
	this.getNorte=function(){
		return this.mazmorraNorte;
	}
	this.getSur=function(){
		return this.mazmorraSur;
	}

	this.getEste=function(){	
		return this.mazmorraEste;
		
	}
	this.getOeste=function(){
		return this.mazmorraOeste;
		
	}
	this.getId=function (){
		return this.idMazmorra;
		
	}
	this.getHistoriaPrincipal=function(){
		return this.historiaPrincipal;

	}
	this.getListaMonstruos=function(){
		return this.listaMonstruos;
	}
	this.eliminaMonstruo=function(idMonstruo){
		for (var j = 0; j < this.listaMonstruos.length; j++) {
			if(this.listaMonstruos[j]!=null && this.listaMonstruos[j].getId()==idMonstruo){
				this.listaMonstruos.splice(j,1);
			}
		}
	}
	this.eliminaConsumible=function(idConsumible){
		for (var j = 0; j < this.listaConsumibles.length; j++) {
			if(this.listaConsumibles[j]!=null && this.listaConsumibles[j].getId()==idConsumible){
				this.listaConsumibles.splice(j,1);
			}
		}
	}
	this.existeConsumible=function(idConsumible){
		if(this.listaConsumibles!=null){
			for (var j = 0; j < this.listaConsumibles.length; j++) {
				if(this.listaConsumibles[j]!=null && this.listaConsumibles[j].getId()==idConsumible){
					return this.listaConsumibles[j];
				}
			}
		}
		return -1;
	}
	this.getListaConsumibles= function(){
		return this.listaConsumibles;

	}
	this.getListaRespuestas = function(){
		return this.listaRespuestas;

	}
	this.setHistoriaPrincipal = function(historia){
		this.historiaPrincipal=historia;
	}
	this.getRecompensa= function(){
		return this.recompensa;
	}
	//devuelve si es la mazmorra de salida.
	this.esFin= function(){
		return this.ultima;
	}


};


