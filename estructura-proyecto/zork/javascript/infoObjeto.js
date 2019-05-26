var infoObjeto=function(id,tipo){
	var id;
	var tipo;
	this.inicializa=function(){
		this.tipo=tipo;
		this.id=id;
	}
	this.setId=function(id){
		this.id=id;
	}
	this.setTipo=function(tipo){
		this.tipo=tipo;
	
	}

};