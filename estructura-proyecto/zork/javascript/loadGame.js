var panel = $('#zork-area');

var inventario = [];
var rooms = {};



$(document).on('click', '#start', function(e) {
    var p = $('#subwrapper').prepend('<h2>Comenzamos! (teclea ayuda para mas info)</h2>');
    $(function(){ 

          $.ajax({ 

            method: "GET", 
            
            url: "zork/javascript/getrecord.php",

          }).done(function( data ) { 

                var result= $.parseJSON(data); 


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
        
        inventario = mapa.inventario.split(",")
        
        panel.empty()
        sqlRooms(selValue)
    });
}

function sqlRooms(selValueMap){ 
    $(document).ready(function() {
        
         $.ajax({ 

            method: "GET", 
            
            url: "zork/javascript/getrecord2.php",

            success: function(msg){
                var result= $.parseJSON(msg); 


                //var string= [];
                var myArray = [];
                
                if(result.length !== 0){
                   /* from result create a string of data and append to the div */
                    $.each( result, function( key, value ) {
                        if( value.nivel === selValueMap){
                            myArray.push(value);
                        }
                        
    
                    }); 
                    console.log(myArray); 
                    console.log(myArray.length); 
                    //console.log("tipo dato " + typeof rooms)

                    loadRoom(myArray);
                }
                else{
                    //panel.empty()
                    alert("Error al cargar la base de datos")
                    p.empty()
                
                }
            }
        });
    
    });
}

function loadRoom(myArray){
    //console.log(rooms)
    
    for(i=0; i < myArray.length; i++){
        rooms[myArray[i].nameRoom] = {};
        rooms[myArray[i].nameRoom].description = myArray[i].description;
        rooms[myArray[i].nameRoom].directions = {}

        direccion = myArray[i].direccion.split(",")
        destino = myArray[i].destino.split(",")

        for(j=0; j < direccion.length; j++){
            rooms[myArray[i].nameRoom].directions[direccion[j]] = destino[j]
        }
        rooms[myArray[i].nameRoom].image = myArray[i].imagen
        rooms[myArray[i].nameRoom].pickUp = []
        rooms[myArray[i].nameRoom].pickUp.push(myArray[i].pickUp)


    }
    console.log(rooms)
    startGame()

}
