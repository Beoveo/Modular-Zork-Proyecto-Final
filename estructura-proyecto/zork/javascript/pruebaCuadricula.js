//Objeto que coge nuestro canvas
function draw(ctx, objeto, trans, composite){

          var img = new Image();
          img.src = objeto;
          img.onload = function() {
                ctx.beginPath();
                ctx.globalCompositeOperation = composite;
                ctx.globalAlpha = trans;
                ctx.drawImage(img,0, 0,720,410); //Deberia ser height y weight???
          };
}

$(document).on('click', '#create', function(e) {
  $('#zork-area').empty();
  //$('#zork-area').append('<img id ="imgFondo" src="img/mazmorras/lab.png" alt=""/>');
    $('#zork-area').append('<canvas id="mycanvas" width="720" height="410" style="border:2px solid #000000;"></canvas>');
    var ctx =  document.getElementById("mycanvas").getContext("2d");

    draw(ctx,"img/mazmorras/lab.png",1,"destination-over");

    var mouse = false;
    
    var canvas = document.getElementById("mycanvas");
    var contenedor = document.getElementById("subwrapper");
    var cuadritos = [];
    var sizeCuadro = {ancho: 102, alto: 102};
    var color = "";

    //        ctx.globalCompositeOperation = "source-over"; Para pintarlo encima

 if (ctx) {
      function dibujaGrid(disX, disY, anchoLinea, color) {

        ctx.strokeStyle = color;
        ctx.lineWidth = anchoLinea;
        var columnas = [];
        var filas = [];
        for (i = disX; i < canvas.width; i += disX) {
          //ctx.globalCompositeOperation = "source-over";
          ctx.beginPath();
          ctx.stroke();
          ctx.moveTo(i, 0);
          ctx.lineTo(i, canvas.height);
          columnas.push(i);
        }
        for (i = disY; i < canvas.height; i += disY) {
          //ctx.globalCompositeOperation = "source-over";
          ctx.beginPath();
          ctx.moveTo(0, i);
          ctx.lineTo(ctx.canvas.width, i);
          ctx.stroke();
          filas.push(i);
        }
        columnas.push(0);
        filas.push(0);
        for (x = 0; x < columnas.length; x++) {
          for (y = 0; y < filas.length; y++) {
            cuadritos.push([columnas[x], filas[y], disX, disY]);
          }
        }
      }

      function fillCell(x, y) {
        ctx.fillStyle = "#1FF94C";
        ctx.globalAlpha=0.4; //Transparente
        ctx.globalCompositeOperation = "source-over";
        for (i = 0; i < cuadritos.length; i++) {
          var cuadro = cuadritos[i];
          if (
            x > cuadro[0] &&
            x < cuadro[0] + cuadro[2] &&
            y > cuadro[1] &&
            y < cuadro[1] + cuadro[3]
          ) {
            ctx.fillRect(
              cuadro[0],
              cuadro[1],
              sizeCuadro.ancho,
              sizeCuadro.alto
            );
            break;
          }
        }
        dibujaGrid(sizeCuadro.ancho, sizeCuadro.alto, 0.4, "#44414B");
      }

      canvas.onmousemove = function(e) {
        if (mouse) {
          var canvaspos = canvas.getBoundingClientRect();
          fillCell(e.clientX - canvaspos.left, e.clientY - canvaspos.top);
        }
      };

      canvas.onclick = function(e) {
        var canvaspos = canvas.getBoundingClientRect();
        fillCell(e.clientX - canvaspos.left, e.clientY - canvaspos.top);
      };

      canvas.onmousedown = function() {
        mouse = true;
      };

      canvas.onmouseup = function() {
        mouse = false;
      };

      /*
      inputSizeCuadros.addEventListener(
        "change",
        function() {
          cuadritos = [];
          sizeCuadro.ancho = parseInt(this.value);
          sizeCuadro.alto = parseInt(this.value);
          ctx.clearRect(0, 0, canvas.width, canvas.height);
          dibujaGrid(sizeCuadro.ancho, sizeCuadro.alto, 1, "#44414B");
        },
        false
      );
*/
      //canvas.width = contenedor.offsetWidth;
      dibujaGrid(sizeCuadro.ancho, sizeCuadro.alto, 1, "#44414B");
    } else {
      alert("No se pudo cargar el contexto");
    }
});


