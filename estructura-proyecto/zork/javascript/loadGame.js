var panel = $('#zork-area');

var inventario = [];
var rooms = {};
var monstruosGlobal= new Array();
var consumiblesGlobal=new Array();




$(document).on('click', '#start', function(e) {
    
   // var p = $('#subwrapper').prepend('<h2>Comenzamos! (teclea ayuda para mas info)</h2>');
    $(function(){ 

          $.ajax({ 

            method: "GET", 
            
            url: "loadMapa.php",
            success: function( data ) { 
               
                var result= $.parseJSON(data); 
                 panel.append('<br><button id="getvalue">Siguiente</button>') 

                //var string= [];
                var myArrayMap = [];
               

                //console.log (result.length)
                if(result.length !== 0){
                   /* from result create a string of data and append to the div */
                    $.each( result, function( key, value ) { 
                      
                      //string[i] = value['idMap'] + value['idRoom'] + value['inventario']; 
                      myArrayMap.push(value);
    
                          }); 
                      //console.log(myArrayMap[0]); 
                      //console.log(myArrayMap.length); 

                      //for(i=0; i<string.length; i++) alert(i + ': ' + string[i]); 
                    panel.empty()
                    choiceMap(myArrayMap);
                    //load();
                }
                else{
                    //panel.empty()
                    alert("Error al cargar la base de datos")
                    p.empty()
                
                }
            }

          }); 
         
    }); 

    

})

function choiceMap (myArray){

    
    panel.append("Selecciona el mapa que quieras jugar")
    panel.append("<form name=fmap>")
    for(i=0; i<myArray.length; i++){
        
        panel.append('<legend><input type="Radio" name="mapas" value="'+ myArray[i].id +'">Mapa: '+i+"</legend><p>Nombre:   "+ myArray[i].nombre+"</p> "+"<p>Dificultad:   "+myArray[i].dificultad +"</p>")
    }
    panel.append('<p></p><button id="getvalue">Siguiente</button>') 
    panel.append("</form>")

    jQuery('#getvalue').on('click', function(e) {  
        selValue = document.querySelector('input[name = "mapas"]:checked').value;
        mapa = myArray[selValue];        
        panel.empty();
        rellenaMapa(selValue);
    });
}

function loadConsumibles(consum){
var consumibles=[];
	for(j=0;j<consum.length;j++){
		var consumible=new Consumible(consum[j].id,consum[j].categoria,consum[j].nombre,consum[j].fuerza,consum[j].habilidad,consum[j].vida,consum[j].rutaImagen);
		consumible.inicializa();
		consumibles.push(consumible);
	}
	return consumibles;
			

}

function loadEnemigos(enem){
	var monstruos=[];
	for(z=0;z<enem.length;z++){
		var monstruo=new Monstruo(enem[z].vida, enem[z].fuerza,enem[z].rutaImagen,enem[z].nombre);
		monstruo.inicializa();
		monstruos.push(monstruo);
	}
	return monstruos;
}


function rellenaMapa(selValueMap){ 
	var mazmorra;
	var mapa;

         $.ajax({ 
			 method: "GET", 
			 url: "loadMapa.php?idMapa=" + selValueMap ,
			 success: function (msg){

					var result= $.parseJSON(msg); 
					//var arstring= [];
					var myArray = [];
					if(result.length !== 0){
					   /* from result create a string of data and append to the div */
						$.each( result, function( key, value ) {

								myArray.push(value);  
						}); 
						// en la posicion 0 del myArray llega el tamaño del mapa
						// en la posicion 1 del myArray llega el array de mazmorras
						// en la posicion 2 del myArray llega el array de enemigos
						// en la posicion 3 del myArray llega el array de consumibles
						var tamanioMapa= myArray[0];

						//Falta guardar otros datos de mapa como x,y,w,h
						mapa= new Mapa(tamanioMapa);
						mapa.inicializa();

						var monstruos=[];
						var consumibles=[];
						for(i=0;i<tamanioMapa;i++){
							if(myArray[2][i] != null){
								monstruos=loadEnemigos(myArray[2][i]);
							}

							if(myArray[3][i] != null){
								consumibles=loadConsumibles(myArray[3][i]);
							}

							mazmorra=new Mazmorra(myArray[1][i].idMazmorra,monstruos,consumibles,myArray[1][i].historia,myArray[1][i].numSalidas,myArray[1][i].recompensa,myArray[1][i].mazmorraNorte,myArray[1][i].mazmorraSur,myArray[1][i].mazmorraEste,myArray[1][i].mazmorraOeste,myArray[1][i].rutaImagen);
							mazmorra.inicializa();
							if(myArray[1][i].mazmorraInicial==1){
								mapa.setMazmorraAct(mazmorra);//inicial al inicio del juego
							}
							else if(myArray[1][i].mazmorraFinal==1){
								mapa.setMazmorraFinal(mazmorra);

							}
							mapa.insertaMazmorra(mazmorra);
						}

						startGame(mapa);
						//loadRoom(myArray);
					}
					else{
						//panel.empty()
						alert("Error al cargar la base de datos")
						p.empty()

					}
					//si queremos ir al norte por ejemplo,para moverse por el mapa
					//mazmorraActual= mapa.getMazmorra(mazmorra.getIdNorte());
					//mapa.setMazmorraActual(mazmorraActual);
			 }
            });
      
    
}
//ALBERTO JS
//--------------------------------------------------------clase mapa----------------------------------------------------------
var Mapa=function(tamMazmorras){
	var tamanio;
	var mazmorras;
	var mazmorraAct;
	var mazmorraFinal;

	this.size=function(){
		return this.tamanio;
	}
	this.inicializa=function(){
		this.tamanio=tamMazmorras;
		this.mazmorras=new Array();
	}
	this.setMazmorraAct=function(mazmorra){
		this.mazmorraActual=mazmorra;
	}
	this.getMazmorraAct=function(){
		
		return this.mazmorraAct;
	}
	this.getMazmorraFinal=function(){
		return this.mazmorraFinal;
	}
	this.setMazmorraFinal=function(idMazmorra){
		this.mazmorraFinal=idMazmorra;
		
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
	
	
}
//ALBERTO JS
//--------------------------------------------------------clase mazmorra----------------------------------------------------------
var Mazmorra= function(idMazmorra,monstruos, consumibles,historia,numSalidas,recompensa,mazmorraNorte,mazmorraSur,mazmorraEste,mazmorraOeste,rutaImagen,x,y,w,h){
	var listaConsumibles=new Array();
	var listaMonstruos=new Array();
	var listaRespuestas=new Array();
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
//ALBERTO JS
//--------------------------------------------------------clase Consumible----------------------------------------------------------
var Consumible= function(id,categoria,nombre,fuerza,habilidad,vida,imagenConsumible){
	//cada consumible tendra una respuesta asociada por lo que en la base de datos debe estar pasada como parametro para cada consumible.
	//por ejemplo todos los onjetos consumibles se podran coger para añadirse al inventario.

	var categoria;
	var nombre;
	var fuerza;
	var habilidad;
	var vida;
	var imagen;
	var id;
	var x;
	var y;
	var w;
	var h;

	this.inicializa= function(){
		this.categoria=categoria;
		this.nombre=nombre;
		this.fuerza=fuerza;
		this.habilidad=habilidad;
		this.vida=vida;
		this.imagen=imagenConsumible;
		this.x=x;
		this.y=y;
		this.w=w;
		this.h=h;
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

};

//ALBERTO JS
//--------------------------------------------------------clase Monstruo----------------------------------------------------------
var Monstruo= function(vida, ataque,imagenMonstruo,nombre){
	//en la base de datos los monstruos tendran unas respuestas asociadas fijas, ya que a un monstruo solo se le puede atacar o huir de el.

var vida;
var ataque;
var imagenMonstruo;
var listaRespuestas;
var nombre;
var x;
var y;
var w;
var h;

this.inicializa=function(){
	this.vida=vida;
	this.ataque=ataque;
	this.imagenMonstruo=imagenMonstruo;
	this.nombre=nombre;
	this.x=x;
	this.y=y;
	this.w=w;
	this.h=h;
	//this.listaRespuestas=respuestas;
}
this.getNombre=function(){
	
	return this.nombre;
}

this.perderVida=function(daño){
	this.vida-=daño;
}
this.getAtaque =function(){
	return this.ataque;
}
this.getListaRespuestas= function(){

	return this.listaRespuestas;
}

};
//ALBERTO JS
//--------------------------------------------------------clase Personaje----------------------------------------------------------
var Personaje= function(vida,nombre,fuerza,inventario,imagen,x,y,w,h){

	var vidaAct;
	var vidaMax;
	var inventario;
	var imagen;
	var fuerza;
	var nombre;
	var fuerza;
	var mazMorraActual;
	var x;
	var y;
	var w;
	var h;

	this.inicializa=function(){
		this.vidaMax=vida;
		this.vidaAct=vida;
		this.nombre=nombre;
		this.fuerza=fuerza;
		this.imagen=imagen;
		this.x=x;
		this.y=y;
		this.w=w;
		this.h=h;
		this.cargaInv(inventario);
	}
	this.cargaInv=function(inventario){
		for (var i = 0; i < inventario.length; i++) {
			this.inventario.push(inventario[i]);
		}
	}

	this.restavida=function(daño){
		this.vidaAct-=daño;
	}

	this.getVida=function(){
		return this.vida;
	}
	this.sumVidaMax= function(vida){
		this.vidaMax+=vida;
	}
	this.sumFuerza= function(fuerzaObjeto){
		this.fuerza+=fuerzaObjeto;
	}
	this.insertaInventario=function(consumible){
		this.inventario.push(consumible.getId());
	}
	//Suma todos los campos del consumible para actualizar el estado del jugador en nivel de caracteristicas
	this.interactuarConsumible=function(consumible){
		if(consumible.getCategoria()!="pocion"){
			if(this.vidaAct < vidaMax )
				this.vidaAct+=consumible.getVida();
		}
		else{
			this.fuerza+=consumible.getVida();
			this.habilidad+=consumible.getHabilidad();
			this.vidaMax+=consumible.getVida();
		}
		eliminaInventario(consumible.getId());
	}
	this.eliminaInventario=function(idConsum){
		for (var j = 0; j < this.inventario.length; j++) {
			if(this.inventario[j]==idConsum){
				this.inventario.splice(j,1);
			}
		}
	}
	this.getFuerza=function(){
		return this.fuerza();

	}

};


