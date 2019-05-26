//--------------------------------------------------------clase Personaje----------------------------------------------------------
var arrayMzUsadas= function(idMazmorra){
	var idMazmorra;
	var arrayObjetos;
	this.inicializa=function(){
		this.idMazmorra=idMazmorra;
		this.arrayObjetos=[];

	}
	this.insertaObjeto=function(infoObjeto){
		this.arrayObjetos.push(infoObjeto);
	}
	this.setId=function(idMazmorra){

		this.idMazmorra=idMazmorra;
	}
	this.getId=function(){

		return this.idMazmorra;
	}

};

