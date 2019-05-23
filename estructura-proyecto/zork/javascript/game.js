var currentRoom = "inicio";
var commands = ["Ir", "Recoger", "Inventario"];

function changeRoom(dir) {
    panel.empty()
    if (rooms[currentRoom].directions[dir] !== undefined) {
        currentRoom = rooms[currentRoom].directions[dir]
        panel.append('<div id="target">' + rooms[currentRoom].description + "</div>");
    } else {
        panel.append('<div id="target">No pueder ir por ese camino!</div>');
    }

    panel.append('<input id="user-input" placeholder="inserta tu comando.."></input>');
    panel.append('<img src="' + rooms[currentRoom].image + '" />');


}

function showHelp() {
    // crear un dom hijo, appendchild, para luego borrarlo
   
    panel.append('<div id="target">Estos son los comandos posibles: </div>');
    panel.append("<p><ul>");
    for (var i = 0; i < commands.length; i++) {
        panel.append("<li>" + commands[i] + "</li>");
    }
    panel.append("</ul></p>");
  

}

function showinventario() {
     // crear un dom hijo, appendchild, para luego borrarlo
    if (inventario.length === 0) {
        panel.append('<div id="target" >No llevas nada !</div>');
        return;
    }
    panel.append('<div id="target">Este es tu inventario: </div>');
    panel.append("<p><ul>");
    for (var i = 0; i < inventario.length; i++) {
        panel.append("<li>" + inventario[i] + "</li>");
    }
    panel.append("</ul></p>");
   
}

function pickUpThings(things){
    
    panel.empty()
    console.log(rooms[currentRoom].pickUp[0])
    if (rooms[currentRoom].pickUp[0] === things) {
        inventario.push(rooms[currentRoom].pickUp[0])
        //delete rooms[currentRoom].pickUp[things];
         rooms[currentRoom].pickUp.pop();

        panel.append('<div id="target">' + rooms[currentRoom].description + "</div>");
    } else {
        panel.append('<div id="target">Ese objeto no esta en esta habitacion!</div>');
    }

    panel.append('<input id="user-input" placeholder="inserta tu comando.."></input>');
    panel.append('<img src="' + rooms[currentRoom].image + '" />');


}
/*
function playerInput(input) {
    var command = input.split(" ")[0];
    switch (command) {
        case "ir":
            var dir = input.split(" ")[1];
            changeRoom(dir);
            break;
        case "ayuda":
            showHelp();
            break;
        case "inventario":
            showinventario();
            break;
        case "recoger":
            var things = input.split(" ")[1];
            pickUpThings(things);
            break;
        default:
            panel.append('<div id="target">Comando invalido!</div>');

    }
}
*/
function rellenaMazmorraAct(mapa,listaOpciones){
    var mazmorra=mapa.mazmorraActual;
        console.log("mazmorraAct",mazmorra);
        var listaEnemigos;
        var listaConsumibles;
        listaEnemigos=mazmorra.listaMonstruos;
        listaConsumibles=mazmorra.listaConsumibles;
        if(mazmorra.getNorte()!=null){
            
            listaOpciones.push(mazmorra.mazmorraNorte);
            
        }
        if(mazmorra.getSur()!=null){
            
            listaOpciones.push(mazmorra.mazmorraSur);
            
        }
        if(mazmorra.getEste()!=null){
            
            listaOpciones.push(mazmorra.mazmorraEste);
            
        }
        if(mazmorra.getOeste()!=null){
            
            listaOpciones.push(mazmorra.mazmorraOeste);
            
        }
        if(listaConsumibles.length!=0){
            for(i=0;i<listaConsumibles.length;i++)
                listaOpciones.push(listaConsumibles.pop());
        }
        if(listaEnemigos.length!=0){
            for(i=0;i<listaEnemigos.length;i++)
                listaOpciones.push(listaEnemigos.pop());
        }
    
        return mazmorra;
}
function startGame(mapa){
        var listaOpciones=[];
        var mazmorraAct=rellenaMazmorraAct(mapa,listaOpciones);
        console.log("opciones",listaOpciones);

        //si queremos ir al norte por ejemplo,para moverse por el mapa
        var maz = mapa.getMazmorra(mazmorraAct.getNorte());
        mapa.setMazmorraAct(maz);
        
        //panel.append('<div id="target">' + rooms.inicio.description + '</div>');
       // panel.append('<input id="user-input" placeholder="inserta tu comando.."></input>');

        panel.append('<img src=" ' + mazmorraAct.getImagen() + ' " />');
        
        /*for (let elem in rooms[currentRoom].directions) {
            panel.append(elem) 
            panel.append('<input id="user-input" type="button" value="Ir '+ elem +'">')
       }

        $(document).on('click', '#user-input', function(e) {
            for (let elem in rooms[currentRoom].directions) {
            panel.append(elem) 
            panel.append('<input id="user-input" type="button" value="Ir '+ elem +'">')
            }
            var value = $('#user-input').val().toLowerCase();

                $('#user-input').val("");
                playerInput(value);
        })*/
        $(document).keypress(function(key) {
            if (key.which === 13 && $('#user-input').is(':focus')) {
                var value = $('#user-input').val().toLowerCase();
                $('#user-input').val("");
                playerInput(value);

            }
        })

    $(document).ready(function() {
        


    })
}
