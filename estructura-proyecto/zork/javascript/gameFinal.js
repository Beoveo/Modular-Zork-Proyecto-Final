var target = $('#target');

var commands = ["Ir", "Recoger", "Inventario", "Atacar", "Salir"];
var ctx, canvas;


/*
 * Parametros:
 * Objeto
 * Transparencia
 * Posicion con respecto al resto del canvas (over...)
 */
 
  function loadButton(){
    var i = 0;
	
    $('#target').append('<button id="north" value="Ir norte"></button>');
    $('#target').append('<button id="west" value="Ir oeste"></button>')
    $('#target').append('<button id="east" value="Ir este"></button>')
    $('#target').append('<button id="south" value="Ir sur"></button>')
    /*for (let elem in rooms[currentRoom].directions) {
            //$('#target').append(elem) 
            $('#target').append('<button id="'+elem+'" value="Ir '+ elem +'">'+ elem +'</button>')
            i += 1
   }*/
   $('#target').append('<button id="recoger" value="recoger"></button>');
   for (i = 2; i < commands.length; i++) {
        $('#target').append('<button id="buttonCom" value="'+ commands[i] +'">'+ commands[i] +'</button>');
    }

   $(document).ready(function () {
        $("button").click(function () {
            var valor = this.value;
            valor = valor.toLowerCase()
            playerInput(valor)
            //console.log(valor);
        });
    });
}


function draw(ctx, objeto, trans, composite){

          var img = new Image();
          img.src = objeto.rutaImagen;
          img.onload = function() {
                ctx.beginPath();
                ctx.globalCompositeOperation = composite;
                ctx.globalAlpha = trans;
                ctx.drawImage(img,objeto.x, objeto.y,objeto.w,objeto.h); //Deberia ser height y weight???
          };
}

 //esta funcion realmente llama a draw recorriendo aaray de objetos y monstruos
 //Las rutas de la bbdd deben ser /img/nombre.png
function drawObject(objeto){
    var trans = 0;
    var t = objeto.tipo;
        switch(t){
            case "consumible":
                trans = 1;
                break;
            case "enemigo":
                trans = objeto.vida/100;
                break;
            case "personaje":
                trans = objeto.vida/100;
                break;
            default:
                trans = 1;
                break;
        }
        draw(ctx,objeto,trans,"source-over");
}

function drawAll(ctx, objeto, trans, composite){
    for(var i=0;i<objeto.length;i++){
     var img = new Image();
          img.src = objeto.rutaImagen;
          img.onload = function() {
                ctx.beginPath();
                ctx.globalCompositeOperation = composite;
                ctx.globalAlpha = trans;
                ctx.drawImage(img,objeto.x, objeto.y, objeto.w, objeto.h);
          };
    }
} 


function changeRoom(dir) {

    $('#target').empty();
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    var act = null;
    var maz = mapaCargado.mazmorraActual;
    if (maz !== undefined) {
        
        switch(dir){
            case "norte":
                if(maz.mazmorraNorte !== null)
                    act = mapaCargado.mazmorras[maz.mazmorraNorte -1];
                break;
            case "sur":
                if(maz.mazmorraSur !== null)
                    act = mapaCargado.mazmorras[maz.mazmorraSur -1];
                break;
            case "este":
                if(maz.mazmorraEste !== null)
                    act = mapaCargado.mazmorras[maz.mazmorraEste-1];
                break;
            case "oeste":
                if(maz.mazmorraOeste !== null)
                    act = mapaCargado.mazmorras[maz.mazmorraOeste-1];
                break;
            default:
                break;
        }
        
        if(act != null){
            mapaCargado.mazmorraActual = act;
            $('#target').append('<div id="decript">' + mapaCargado.mazmorraActual.historiaPrincipal + '</div>');
			//loadButton();					///////////////////////////////////////////////////////botones
        }else{
            $('#target').append('<div id="error">No puedes ir por el ' + dir + ' , prueba otro camino!</div>');
            $('#target').append('<div id="decript">' + mapaCargado.mazmorraActual.historiaPrincipal + '</div>');
        }

    } else {
        $('#target').append('<div id="error">No existe ese camino!!</div>');
        $('#target').append('<div id="decript">' + mapaCargado.mazmorraActual.historiaPrincipal + '</div>');
    }

    //Pruebas
    if(mapaCargado.mazmorraActual.listaConsumibles !== null)
        console.log("aqui consumible: " + mapaCargado.mazmorraActual.listaConsumibles.length);
    if(mapaCargado.mazmorraActual.listaMonstruos !== null)
        console.log("aqui enemigos: " + mapaCargado.mazmorraActual.listaMonstruos.length);

	loadButton()
 //   $('#target').append('<input id="user-input" placeholder="inserta tu comando.."></input>');
 //   $('#user-input').focus();
    actualizaCanvas(mapaCargado, mapaCargado.mazmorraActual.idMazmorra);


    //Se carga de cero toda la mazmorra.
    //drawAll(ctx,act.listaConsumibles,1,"source-over");
    //drawAll(ctx,act.listaMonstruos,1,"source-over");
}

function showinventario() {
     // crear un dom hijo, appendchild, para luego borrarlo
    //Esta variable inventario esta en loadGame
    if (inventario.length === 0) {
        panel.append('<div id="target" >No llevas nada !</div>');
        return; //Que devuelva algo.
    }

    panel.append('<div id="target">Este es tu inventario: </div>');
    panel.append("<p><ul>");

    for (var i = 0; i < inventario.length; i++) 
        panel.append("<li>" + inventario[i] + "</li>");

    panel.append("</ul></p>");  
}


function pickUpThings(objeto){
    
    $('#target').empty();
    if (objeto !== undefined) {
        //Le pasamos el tipo de objeto
        switch(objeto.tipo){
            case "consumible":
                inventario.push(objeto);
                mapaCargado.mazmorraActual.listaConsumibles.pop();
                break;
            case "enemigo":
                inventario.push(objeto);
                mapaCargado.mazmorraActual.listaMonstruos.pop();
                break;
            default:
                break;
        }

        $('#target').append('<div id="decript">' + mapaCargado.mazmorraActual.historiaPrincipal + '</div>');
    } else {
        $('#target').append('<div id="error">Ese objeto no esta en esta habitacion!</div>');
    }
	
	loadButton();			/////////////////////////////////////////////botones

    //$('#target').append('<input id="user-input" placeholder="inserta tu comando.."></input>');
    //$('#user-input').focus();
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    actualizaCanvas(mapaCargado,mapaCargado.mazmorraActual.idMazmorra);

    console.log(inventario);
}


/*el mounstruo debera tener una vida cargada desde la base de datos*/
function atacar(arma){
    
    if(arma !== undefined && mapaCargado.mazmorraActual.listaMonstruos.length !== 0){ // s iexiste mounstruo
           var index = inventario.indexOf(arma);
           if(index != -1 ){//comprobar si existe arma seleccionada
                 mapaCargado.mazmorraActual.listaMonstruos[0].vida -= 25;
                 if(mapaCargado.mazmorraActual.listaMonstruos[0].vida <= 0)
                    mapaCargado.mazmorraActual.listaMonstruos.pop();
            }
    }

    //comprobar vida personaje, si muere limpiar y volver a cargar
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    actualizaCanvas(mapaCargado,mapaCargado.mazmorraActual.idMazmorra);
}

function playerInput(input) {
    var command = input.split(" ")[0];
    switch (command) {
        case "ir":
            var dir = input.split(" ")[1]; // norte, sur, este, oeste
            changeRoom(dir);
            break;
        case "ayuda":
            showHelp();
            break;
        case "inventario":
            showinventario();
            break;
        case "recoger":
            //SE PRESUPONE QUE SOLO HAY UN OBJETO
            if(mapaCargado.mazmorraActual.listaConsumibles !== null && mapaCargado.mazmorraActual.listaConsumibles.length !== 0)
                pickUpThings(mapaCargado.mazmorraActual.listaConsumibles[0]);
            break;
        case "atacar":
            var arma = input.split(" ")[1];
            atacar(arma);
            break;
        default:
            $('#target').append('<div id="target">Comando invalido!</div>');
    }
}


function actualizaCanvas(mapa,mazmorraAct){
    var maz =mapa.mazmorras[mazmorraAct - 1];
    draw(ctx,maz,1, "destination-over");
            //Comprobar en todos que no es nulo
            if(mapa.personaje !== null)
                draw(ctx,mapa.personaje,mapa.personaje.vidaAct/100, "source-over");

            if(maz.listaConsumibles !== null && maz.listaConsumibles.length !== 0)
                drawObject(maz.listaConsumibles[0]);

            if(maz.listaMonstruos !== null && maz.listaMonstruos.length !== 0)
                drawObject(maz.listaMonstruos[0]);
}





function startGame(){

        panel.append('<canvas id="canvas" height="453" width="600"></canvas>');        

        canvas =document.getElementById('canvas');
        ctx = canvas.getContext('2d');

        if(mapaCargado !== null || mapaCargado.mazmorraActual !== null){
            //console.log(mapaCargado.mazmorraActual.idMazmorra);
            actualizaCanvas(mapaCargado,mapaCargado.mazmorraActual.idMazmorra);

			
			
			
            panel.append('<div id="target"></div>');
            $('#target').append('<div id="decript">' + mapaCargado.mazmorraActual.historiaPrincipal + '</div>');
            //$('#target').append('<input id="user-input" placeholder="inserta tu comando.."></input>');
            //$('#user-input').focus();
			loadButton()					///////////////////////////////////////////////////////botones
			

            $(document).keypress(function(key) {
                if (key.which === 13 && $('#user-input').is(':focus')) {
                    var value = $('#user-input').val().toLowerCase();
                    $('#user-input').val("");
                    playerInput(value);
                }
            });

        }
}


function luchaFinal(){
    $('#target').empty();
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    $('#target').append('<input id="user-input" placeholder="inserta tu comando.."></input>');
    $('#user-input').focus();

    draw(ctx,mapaCargado.mazmorraFinal,1, "destination-over");
    draw(ctx,personaje,personaje.vida/100, "source-over");
    drawObject(mapaCargado.mazmorraFinal.listaConsumibles);
    drawObject(mapaCargado.mazmorraFinal.listaMonstruos); 
}


