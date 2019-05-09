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
            data: JSON.stringify(e),
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
        mapa = myArray[selValue]
        
        //inventario = mapa.inventario.split(",")
        
        panel.empty()
        rellenaMapa(selValue)
    });
}

function loadConsumibles(idMazmorra){
	

 	
	 var myArray = [];

         $.ajax({ 

            method: "GET", 
            
            url: "loadConsumibles.php?idMazmorra=" + idMazmorra

            }).done(function(msg){
                var result= $.parseJSON(msg); 
                //var arstring= [];
               
     
                   /* from result create a string of data and append to the div */
                    $.each( result, function( key, value ) {
 
                            myArray.push(value);  
                    });	
			 var consumibles=[];
				for(i=0;i<myArray.length;i++){
					var consumible=new Consumible(myArray[i].id,myArray[i].categoria,myArray[i].nombre,myArray[i].fuerza,myArray[i].habilidad,myArray[i].vida,myArray[i].rutaImagen);
					consumible.inicializa();
					consumibles.push(consumible);
				}
			 	setConsumibles(consumibles);
			});
			

}




function loadEnemigos(idMazmorra){
         $.ajax({ 

            method: "GET", 
            
            url: "loadEnemigos.php?idMazmorra=" + idMazmorra
		 	}).done (function(msg){
                var result= $.parseJSON(msg); 
                //var arstring= [];
                var myArray = [];
     
                   /* from result create a string of data and append to the div */
                    $.each( result, function( key, value ) {
 
                            myArray.push(value);  
                    });
				var monstruos=[];
				for(i=0;i<myArray.length;i++){
					var monstruo=new Monstruo(myArray[i].vida, myArray[i].fuerza,myArray[i].rutaImagen,myArray[i].nombre);
					monstruo.inicializa();
					monstruos.push(monstruo);
				}
				setMonstuos(monstruos);
			});
			
}

function rellenaMapa(selValueMap){ 
	var mazmorra;
	var mapa;

         $.ajax({ 

            method: "GET", 
            
            url: "loadMazmorras.php?idMapa=" + selValueMap 
		 }).done (function(msg){
                var result= $.parseJSON(msg); 
                //var arstring= [];
                var myArray = [];
                if(result.length !== 0){
                   /* from result create a string of data and append to the div */
                    $.each( result, function( key, value ) {
 
                            myArray.push(value);  
                    }); 
					mapa= new Mapa(myArray.length);
					mapa.inicializa();
					for(i=0;i<myArray.length;i++){
						var enemigos;
						var consumibles;
						loadConsumibles(myArray[i].idMazmorra);
						loadEnemigos(myArray[i].idMazmorra);
						console.log(monstruosGlobal);
						console.log(consumiblesGlobal);
						mazmorra=new 
						Mazmorra(myArray[i].idMazmorra,monstruosGlobal,consumiblesGlobal,myArray[i].historia,myArray[i].numSalidas,myArray[i].recompensa,myArray[i].mazmorraNorte,myArray[i].mazmorraSur,myArray[i].mazmorraEste,myArray[i].mazmorraOeste,myArray[i].rutaImagen);
						mazmorra.inicializa();
						if(myArray[i].mazmorraInicial==1){
							mapa.setMazmorraAct(mazmorra);//inicial al inicio del juego
						}
						else if(myArray[i].mazmorraFinal==1){
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
		for(i=0;i<mazmorras.length;i++){
			if(mazmorras[i]==idMazmorra)return mazmorras[i];
		}
		
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
var Mazmorra= function(idMazmorra,monstruos, consumibles,historia,numSalidas,recompensa,mazmorraNorte,mazmorraSur,mazmorraEste,mazmorraOeste,rutaImagen){
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


	this.inicializa= function(){
		this.categoria=categoria;
		this.nombre=nombre;
		this.fuerza=fuerza;
		this.habilidad=habilidad;
		this.vida=vida;
		this.imagen=imagenConsumible;

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
this.inicializa=function(){
	this.vida=vida;
	this.ataque=ataque;
	this.imagenMonstruo=imagenMonstruo;
	this.nombre=nombre;
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
var Personaje= function(vida,nombre,fuerza,inventario,imagen){

	var vidaAct;
	var vidaMax;
	var inventario;
	var imagen;
	var fuerza;
	var nombre;
	var fuerza;
	var mazMorraActual;

	this.inicializa=function(){
		this.vidaMax=vida;
		this.vidaAct=vida;
		this.nombre=nombre;
		this.fuerza=fuerza;
		this.imagen=imagen;
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


