var panel = $('#zork-area');

var inventario = [];
var mazActualizadas = [];


$(document).on('click', '#crear', function(e) {
    
    $(function(){ 

          $.ajax({ 

            method: "GET", 
            
            url: "loadMazmorras.php",
            success: function( data ) { 
               
                var result= $.parseJSON(data); 
                panel.append('<br><button id="getvalue">Siguiente</button>');

                var myArrayMap = [];
               
                if(result.length !== 0){
                   //deberia tener acceso al num de mazmorras
                    $.each( result, function( key, value ) { 
                            myArrayMap.push(value);
                     }); 
                      
                    panel.empty();

                    gestionaSeleccion(myArrayMap);
                }
                else{
                    alert("Error al cargar la base de datos");
                    p.empty();   
                }
            }
          });  
    }); 
});



function gestionaSeleccion(myArrayMap){
	myArrayMap[2] = [];
	myArrayMap[3]=[];
    seleccionaMazmorras(myArrayMap,myArrayMap[1][0].numMazmorras);
}




//le puedo pasar al array un tercer array que guarde las mazmorras seleccionadas.
function seleccionaMazmorras(array,n){
	if(n > 0){
	    panel.append("Selecciona la mazmorra que quieras crear");
	    panel.append("<form name=fmazmorra>");

	    for(var i=0; i<array[0].length; i++){     
	        panel.append('<legend><input type="Radio" name="mazmorras" value="'
	        	+ array[0][i].id +'">Mazmorra: '+i+"</legend><p>Nombre:   "+ array[0][i].nombre+"</p> ");
	    }
	    panel.append('<p></p><button id="getvalue">Siguiente</button>'); 
	    panel.append("</form>");

	    var maz;

	    jQuery('#getvalue').on('click', function(e) {
	    	var j =  array[1][0].numMazmorras - n;
	    	if(j < array[1][0].numMazmorras) {
	       		 selValue = document.querySelector('input[name = "mazmorras"]:checked').value;
	        	 var maz= array[0][selValue-1];
	        	 panel.empty();
	        	 array[2][j] =maz; 
	        	  
	        	 guardarSeleccion(array[2][j]);
	        	 guardaInfoNuevaMazmorra(array,n);
	        	 
	    	}
	    });


	}else{
		panel.append('<p></p><button id="sig">Continuar</button>'); 
		jQuery('#sig').on('click', function(e) {
	    	panel.empty();
	    	gestionaConexion(array);
	    });
		
	}
}

//Crear funcion que haga llamada a AJAX, que cargue las mazmorras seleccionadas con su id nuevo
function guardaInfoNuevaMazmorra(array,n){
	$.ajax({ 
			 method: "GET", 
			 url: "loadCargaMazmorra.php",
			 success: function (msg){
			 		
					var result= $.parseJSON(msg); 
	
					var myArray = [];
					if(result.length !== 0){
					   /* from result create a string of data and append to the div */
						$.each( result, function( key, value ) {
								myArray.push(value);
								
						}); 
						var obj = myArray[0];
						array[3].push(obj);
						seleccionaMazmorras(array,n-1);
					}
					else{
						alert("Error al cargar la base de datos");
						p.empty();
					}
			 }
            }); 
}

function gestionaConexion(myArrayMap){

	//Debe sacar los id actualizados
	panel.append("<h1> LISTA DE MAZMORRAS SELECCIONADAS DISPONIBLES </h1>");
	for(var i=0; i<myArrayMap[3].length;i++){
		var aux = myArrayMap[3][i];
		panel.append("<p>Id Mazmorra "+i+" : " + myArrayMap[3][i].id +"</p>");
	}

	crearConexiones(); //Incluye las conexiones con las otras mazmorras

	panel.append('<p></p><button id="sig">Continuar</button>'); 
		jQuery('#sig').on('click', function(e) {
	    	panel.empty();
	    	gestionaConexion(myArrayMap);
	    });
}

function crearConexiones(){
	 $.ajax({ 
			 method: "POST", 
			 url: "loadConexion.php",
			 success: function (msg){

					var result= $.parseJSON(msg); 
					panel.append(result);
			}
            }); 
}

//Despues de guardar, mostrar para pintar en las mazmorras los consumibles
function guardarSeleccion(mazmorra){ 
	
         $.ajax({ 
			 method: "GET", 
			 url: "loadCrearMazmorras.php",
			 data: {nombre:mazmorra.nombre,rutaImagen:mazmorra.rutaImagen,w:mazmorra.w,h:mazmorra.h},
			 success: function (msg){

					var result= $.parseJSON(msg); 
					var res;
					var myArray = [];
					if(result.length !== 0){
					   /* from result create a string of data and append to the div */
						$.each( result, function( key, value ) {
								myArray.push(value);
						}); 
					}
					else{
						alert("Error al cargar la base de datos");
						p.empty();
					}
			 }
            }); 
   
}

//--------------------------------------------------------clase mapa----------------------------------------------------------
var Mapa=function(tamMazmorras,personajeMapa){
	var tamanio;
	var mazmorras;
	var personaje;
	var mazmorraAct;
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
	
	
}

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
	this.vida-=daño;
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

//--------------------------------------------------------clase Personaje----------------------------------------------------------
var Personaje= function(vida,nombre,fuerza,inventario,imagen,x,y,w,h){ //Esta cruzado con partida por eso sabemos su posicion

	var vidaAct;
	var vidaMax;
	var inventario;
	var rutaImagen;
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
		this.rutaImagen=imagen;
		this.x = x;
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
		return parseInt(this.vidaAct);
	}

	this.getFuerza=function(){
		return this.fuerza;

	}
	this.sumVidaMax= function(vida){

		this.vidaAct = this.vidaAct + vida;
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
	

};


