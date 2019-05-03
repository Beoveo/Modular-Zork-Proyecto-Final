var panel = $('#zork-area');

var currentRoom = "inicio";
var commands = ["Ir", "Recoger", "Inventario"];

var inventario = [];
var pruebaRooms = [];



$(document).on('click', '#start', function(e) {
    var p = $('#subwrapper').prepend('<h2>Comenzamos!! (teclea ayuda para mas info)</h2>');
    $(function(){ 

          $.ajax({ 

            method: "GET", 
            
            url: "zork/javascript/getrecord.php",

          }).done(function( data ) { 

                var result= $.parseJSON(data); 

                //var string= [];
                var myArray = [];
               

                console.log (result.length)
                if(result.length !== 0){
                   /* from result create a string of data and append to the div */
                    $.each( result, function( key, value ) { 
                      
                      //string[i] = value['idMap'] + value['idRoom'] + value['inventario']; 
                      myArray.push(value);
    
                          }); 
                      console.log(myArray[0]); 
                      console.log(myArray.length); 

                      //for(i=0; i<string.length; i++) alert(i + ': ' + string[i]); 
                    panel.empty()
                    choiceMap(myArray);
                    //load();
                }
            else{
                //panel.empty()
                alert("Error al cargar la base de datos")
                p.empty()
                
            }
           }); 
         
    }); 

    

})

function choiceMap (myArray){

    
    panel.append("Selecciona el mapa que quieras jugar")

    for(i=0; i<myArray.length; i++){
        panel.append("<form name=fmap>")
        panel.append('<input type="Radio" name="mapas" value="'+ i +'">Mapa: '+ i +'<br>')
    }
    panel.append('<br><button id="getvalue">Siguiente</button>') 
    panel.append("</form>")

    jQuery('#getvalue').on('click', function(e) {  
        selValue = document.querySelector('input[name = "mapas"]:checked').value;
        mapa = myArray[selValue]
        //console.log(mapa);
        inventario = mapa.inventario.split(",")
        
        panel.empty()
        load()
    });
}
function loadRooms(){ 
    $(function(){ 

          $.ajax({ 

            method: "GET", 
            
            url: "zork/javascript/getrecord2.php",

          }).done(function( data ) { 

                var result= $.parseJSON(data); 

            
                var myArray = [];
            

                console.log (result.length)
                if(result.length !== 0){
                   /* from result create a string of data and append to the div */
                    $.each( result, function( key, value ) { 
                        myArray.push(value);
                    }); 
                    console.log(myArray[0]); 
                    console.log(myArray.length); 

                    panel.empty()
                    //console.log(myArray);
                    
                }
            else{
                //panel.empty()
                alert("Error al cargar la base de datos")
                p.empty()
                
            }
           }); 
         
    }); 
}




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
