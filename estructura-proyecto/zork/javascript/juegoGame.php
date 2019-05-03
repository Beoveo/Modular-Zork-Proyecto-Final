 <div id="contenido">
<h1>Modular Zork</h1>
    <div id="subwrapper">
        <div id="zork-area">
          
            <button id="start">Start</button>
        </div>
    </div>
</div>
        
        <div id="records"></div> 
        

    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
   
    <script type="text/javascript"> 

        $(function(){ 

          //$("#getusers").on('click', function(){ 

          $.ajax({ 

            method: "GET", 
            
            url: "getrecord.php",

          }).done(function( data ) { 

            var result= $.parseJSON(data); 

            var string= [];
            var myArray = [];
            var i = 0;

           /* from result create a string of data and append to the div */
            $.each( result, function( key, value ) { 
              
              string[i] = value['idMap'] + value['idRoom'] + value['inventario']; 
              myArray.push(value);
              i += 1;
                  }); 

                 //string += '</table>'; 
              // tres tipos de representacion
              $("#records").html(string);
              
              console.log(myArray[0]); 

              for(i=0; i<string.length; i++) alert(i + ': ' + string[i]); 

           }); 
        //}); 
    }); 
    </script> 

 