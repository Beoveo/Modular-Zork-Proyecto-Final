    <html> 
    <head> 
       <title>AJAX jQuery Example with PHP MySQL</title> 
       <style type="text/css">
        body{
          font-family: Verdana, Geneva, sans-serif;
        }
      .container{
          width: 50%;
          margin: 0 auto;
      } 
     
     table, tr, th, td {
        border: 1px solid #e3e3e3;
        padding: 10px;
     }
     
    </style> 

    </head> 

    <body>
     
     <div class = "container" > 

        <h3><u>AJAX jQuery Example with PHP MySQL</u></h3>

        <p><strong>Click on button to display users records from database</strong></p> 
        
        <div id="records"></div> 
        
        <p>
            <input type="button" id = "getusers" value = "Fetch Records" />
        </p>
      
    </div> 

    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
   
    <script type="text/javascript"> 

        $(function(){ 

          //$("#getusers").on('click', function(){ 

          $.ajax({ 

            method: "GET", 
            
            url: "getrecord.php",

          }).done(function( data ) { 

            var result= $.parseJSON(data); 

            var string='<table width="100%"><tr> <th>idMap</th><th>idRoom</th> <th>inventario</th><tr>';
     
           /* from result create a string of data and append to the div */
            $.each( result, function( key, value ) { 
              
              string += "<tr> <td>"+value['idMap'] + "</td><td>"+value['idRoom']+'</td><td>'+value['inventario']+'</td> '; 
                  }); 

                 string += '</table>'; 

              $("#records").html(string); 

           }); 
        //}); 
    }); 
    </script> 
    </body>
    </html>