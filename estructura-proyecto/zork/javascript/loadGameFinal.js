var panel = $('#zork-area');

var inventario = [];
var mapaCargado = {};
var demo=0;
var cargado=0;

$(document).on('click', '#carga', function() {
    $(function(){ 
        panel.empty();
             $.ajax({ 
                        method: "GET", 
                        
                        url: "loadPartidas.php",
                        success: function( data ) { 
                           
                            var result= $.parseJSON(data); 
                            panel.append('<br><button id="getvalue">Siguiente</button>');

                            var myArray = [];
                           
                            if(result.length !== 0){
                               /* from result create a string of data and append to the div */
                                $.each( result, function( key, value ) { 
                                        myArray.push(value);
                                 }); 
                                  
                                panel.empty();
                                cargado=1;
                                demo=0;
                                choicePartida(myArray,cargado);
                            }
                            else{
                                alert("Error al cargar la base de datos");
                                p.empty();   
                            }
                        }

                      }); 
         
    }); 
})
$(document).on('click', '#prueba', function() {
	$(function(){ 
        panel.empty();
        //Descomentar cuando funcione personaje
        //selPersonaje(selValue, mapa, personajes);
        var demo=1;
        CargaPersonaje(1,1,demo);
         
    }); 
})
$(document).on('click', '#start', function(e) {
    
    $(function(){ 

          $.ajax({ 

            method: "GET", 
            
            url: "loadMapa.php",
            success: function( data ) { 
               
                var result= $.parseJSON(data); 
                panel.append('<br><button id="getvalue">Siguiente</button>');

                var myArrayMap = [];
               
                if(result.length !== 0){
                   /* from result create a string of data and append to the div */
                    $.each( result, function( key, value ) { 
                            myArrayMap.push(value);
                     }); 
                      
                    panel.empty();
                    cargado=0;
                    demo=0;
                    choiceMap(myArrayMap,demo,cargado);
                }
                else{
                    alert("Error al cargar la base de datos");
                    p.empty();   
                }
            }

          }); 
         
    }); 

    

})
function choicePartida(myArray,cargado){

    panel.append("Selecciona tu partida");
    panel.append("<form name=fmap>");

    for(i=0; i<myArray.length; i++){     
        panel.append('<legend><input type="Radio" name="partida" value="'
            + i +'">Partida: '+i+"</legend><p>inicio:   "+ myArray[i].fechaInicio+"</p> ");
    }
    panel.append('<p></p><button id="getvalue">Siguiente</button>'); 
    panel.append("</form>");

    jQuery('#getvalue').on('click', function(e) {  
        partidaSele = document.querySelector('input[name = "partida"]:checked').value;
        panel.empty();
        CargaPersonaje(myArray[partidaSele].idPartida,myArray[partidaSele].idPersonaje,myArray[partidaSele].idMapa,demo,cargado);
        //Descomentar cuando funcione personaje
        //selPersonaje(selValue, mapa, personajes);
        //loadPersonajes(mapaSele);
    });

}
function choiceMap (myArray,demo,cargado){

    panel.append("Selecciona el mapa que quieras jugar");
    panel.append("<form name=fmap>");

    for(i=0; i<myArray.length; i++){     
        panel.append('<legend><input type="Radio" name="mapas" value="'
        	+ myArray[i].id +'">Mapa: '+i+"</legend><p>Nombre:   "+ myArray[i].nombre+"</p> "+"<p>Dificultad:   "
        		+ myArray[i].dificultad +"</p>");
    }
    panel.append('<p></p><button id="getvalue">Siguiente</button>'); 
    panel.append("</form>");

    jQuery('#getvalue').on('click', function(e) {  
        mapaSele = document.querySelector('input[name = "mapas"]:checked').value;
        var mapa = myArray[mapaSele];
        panel.empty();
        //Descomentar cuando funcione personaje
        //selPersonaje(selValue, mapa, personajes);
		loadPersonajes(mapaSele,demo,cargado);
    });
}
function loadPersonajes(mapaSele,demo,cargado){
    $.ajax({ 

            method: "GET", 
            
            url: "loadPersonajes.php",
            success: function( data ) { 
               
                var result= $.parseJSON(data); 
                panel.append('<br><button id="getvalue">Siguiente</button>');

                var myArrayPerson = [];
               
                if(result.length !== 0){
                   /* from result create a string of data and append to the div */
                    $.each( result, function( key, value ) { 
                            myArrayPerson.push(value);
                     }); 
                      
                    panel.empty();
                    choicePersonaje(myArrayPerson,mapaSele,demo,cargado);
                }
                else{
                    alert("Error al cargar la base de datos");
                    p.empty();   
                }
            }

          }); 
}
function choicePersonaje(myArrayPerson,mapaSele,demo,cargado){

    panel.append("Selecciona el personaje con el que piensas jugar.");
    panel.append("<form name=fmap>");

    for(i=0; i<myArrayPerson.length; i++){     
        panel.append('<legend><input type="Radio" name="person" value="'
        	+ myArrayPerson[i].id +'">Personaje: '+myArrayPerson[i].nombre+"</legend>"+"<p>Fuerza:   "
        		+ myArrayPerson[i].fuerza +"</p>"+"<p>Habilidad:   "
        		+ myArrayPerson[i].habilidad +"</p>"+"<p>Vida:   "
        		+ myArrayPerson[i].vida +"</p>");
    }
    panel.append('<p></p><button id="getvalue">Siguiente</button>'); 
    panel.append("</form>");

    jQuery('#getvalue').on('click', function(e) {  
       var indexPer = document.querySelector('input[name = "person"]:checked').value;

        panel.empty();
        //var per = new Personaje(100, "Caballero",50,2, "img/pngZork/personaje1.png",50,150,123,220);
        CargaPersonaje(null,indexPer,mapaSele,demo,cargado);
    });
}


function CargaPersonaje(idPartida,indexPer,mapaSele,demo,cargado){
    $.ajax({ 
         method: "GET", 
         url: "loadPersonajes.php?idPersonaje=" + indexPer ,
         success: function (msg){

         var result= $.parseJSON(msg); 
                        //var arstring= [];
         var myArray = [];
         if(result.length !== 0){
            var per = new Personaje(result.id,result.vida, result.nombre,result.fuerza,result.fuerza,2, result.rutaImagen,50,150,123,220);
             per.inicializa();
             rellenaMapa(idPartida,per,mapaSele,demo,cargado);

         }
    }

    });
      
        

}
function consultaCargados(mapa,idPartida,mapaSele){

    $.ajax({ 
        method: "GET", 
        url: "consultaCargados.php?idPartida="+idPartida ,
        success: function (msg){
            var result= $.parseJSON(msg); 
            var myArray = [];
            if(result.length !== 0){
                /* from result create a string of data and append to the div */
                $.each( result, function( key, value ) {
                    myArray.push(value);  
                }); 
                for (var i = 0; i < myArray[1].length; i++) {
                        var ret =mapa.buscaConsumibleEnMapa(myArray[1][i].idConsumible);
                        if(ret!=-1){
                            mapa.personaje.interactuarConsumible(ret);
                        }
                }
                for (var i = 0; i < myArray[0].length; i++) {
                    var mazmorra= mapa.getMazmorra(myArray[0][i].idMazmorra);
                    if(myArray[0][i].tipoObjeto=="consumible"){
                        mazmorra.eliminaConsumible(myArray[0][i].idObjeto);

                    }
                    else if(myArray[0][i].tipoObjeto=="enemigo"){
                         mazmorra.eliminaMonstruo(myArray[0][i].idObjeto);
                        
                    }
                }

                mapaCargado = mapa;
                startGame(mapaSele);
            }
         }
    });
}
//Funcionalidad de juego
function loadConsumibles(consum){
//Guardar en partida.inventario
var consumibles=[];
	for( var j=0;j<consum.length;j++){
		var c = new Consumible(consum[j].id,consum[j].categoria,consum[j].nombre,
			consum[j].fuerza,consum[j].habilidad,consum[j].vida,consum[j].rutaImagen,
			consum[j].x, consum[j].y,consum[j].w,consum[j].h,consum[j].tipo);
		c.inicializa();
		consumibles.push(c);
	}
	return consumibles;
}

function loadEnemigos(enem){
	var monstruos=[];
	for(var z=0;z<enem.length;z++){
		var m=new Monstruo(enem[z].id,enem[z].vida, enem[z].fuerza,enem[z].rutaImagen,
			enem[z].nombre,enem[z].x,enem[z].y,enem[z].w,enem[z].h,enem[z].tipo);
		m.inicializa();
		monstruos.push(m);
	}
	return monstruos;
}


function rellenaMapa(idPartida,personaje,mapaSele,demo,cargado){ 
	var mazmorra;
	var mapa;

         $.ajax({ 
			 method: "GET", 
			 url: "loadMapa.php?idPersonaje="+personaje.getId()+"&idMapa=" + mapaSele+"&demo="+demo+ "&cargado="+cargado ,
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
						//var personaje = myArray[4];
						var per = personaje;
						
						mapa= new Mapa(tamanioMapa,per);
						mapa.inicializa();

						var monstruos=[];
						var consumibles=[];
						//var personaje;

						for(i=0;i<tamanioMapa;i++){
							monstruos = null;
							consumibles = null;
							if(myArray[2][i] != null){
								monstruos=loadEnemigos(myArray[2][i]);
							}

							if(myArray[3][i] != null){
								consumibles=loadConsumibles(myArray[3][i]);
							}
							

							mazmorra=new Mazmorra(myArray[1][i].idMazmorra,monstruos,consumibles,myArray[1][i].historia,
								myArray[1][i].numSalidas,myArray[1][i].recompensa,myArray[1][i].mazmorraNorte,myArray[1][i].mazmorraSur,
								myArray[1][i].mazmorraEste,myArray[1][i].mazmorraOeste,myArray[1][i].rutaImagen, myArray[1][i].x,
								myArray[1][i].y,myArray[1][i].w,myArray[1][i].h);
							mazmorra.inicializa();
							if(myArray[1][i].mazmorraInicial==1){
								mapa.setMazmorraAct(mazmorra);//inicial al inicio del juego
							}
							else if(myArray[1][i].mazmorraFinal==1){
								mapa.setMazmorraFinal(mazmorra);
							}
							mapa.insertaMazmorra(mazmorra);
						}

						//Le pasamos el objeto mapa a nuestra variable global en game.js
						
                        if(cargado){
                            consultaCargados(mapa,idPartida,mapaSele);
                        }
                        else{
                          mapaCargado = mapa;
						  startGame(mapaSele);
                        }
					}
					else{
						alert("Error al cargar la base de datos");
						p.empty();
					}
					//si queremos ir al norte por ejemplo,para moverse por el mapa
					//mazmorraActual= mapa.getMazmorra(mazmorra.getIdNorte());
					//mapa.setMazmorraActual(mazmorraActual);
			 }
            });
      
    
}

