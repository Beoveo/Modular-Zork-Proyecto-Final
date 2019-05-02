var panel = $('#zork-area');

var currentRoom = "inicio";
var commands = ["Ir", "Recoger", "Inventario"];
var inventario = ["espada"];


$(document).on('click', '#start', function(e) {
  $('#subwrapper').prepend('<h2>Comenzamos!!</h2>');

  panel.empty()
  load();


})
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
    
   
    panel.append('<div id="target">Estos son los comandos posibles: </div>');
    panel.append("<p><ul>");
    for (var i = 0; i < commands.length; i++) {
        panel.append("<li>" + commands[i] + "</li>");
    }
    panel.append("</ul></p>");
  

}

function showinventario() {
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
        default:
            panel.append('<div id="target">Comando invalido!</div>');
    }
}

function load(){

        
        panel.append('<div id="target">' + rooms.inicio.description + '</div>');
        panel.append('<input id="user-input" placeholder="inserta tu comando.."></input>');

        panel.append('<img src="' + rooms[currentRoom].image + '" />');
        
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
