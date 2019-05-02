$(document).ready(function() {
    $('#btn1').on('click', function(){
        $.ajax({
            type: "POST",
            url: "noticias.php",
            success: function(response) {
                $('#div-results').html(response);
            }
        });
    });
    $('#btn2').on('click', function(){
        $.ajax({
            type: "POST",
            url: "eventos.php",
            success: function(response) {
                $('#div-results').html(response);
            }
        });
    });
     $('#btn3').on('click', function(){
        $.ajax({
            type: "POST",
            url: "cofre.php",
            success: function(response) {
                $('#div-results').html(response);
            }
        });
    });
});
