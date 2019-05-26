function quitaEnemigo(enemigo){
    var tipo=enemigo.getTipo();
    var infoObj=new infoObjeto(enemigo.getId(),tipo);
    infoObj.inicializa();
    insertaEnMzUsados(infoObj);
}
function quitaConsumible(consumible){
    var tipo=consumible.getTipo();
    var infoObj =new infoObjeto(consumible.getId(),tipo);
    infoObj.inicializa();
    insertaEnMzUsados(infoObj);
}
function insertaEnMzUsados(infoObj){
    var existe=existeMz(mapaCargado.mazmorraActual.getId());
    if(existe<0){
        var objMz = new arrayMzUsadas(mapaCargado.mazmorraActual.getId());
        objMz.inicializa();
        objMz.insertaObjeto(infoObj);
        arrayMzUsados.push(objMz);
    }
    else{
        arrayMzUsados[existe].insertaObjeto(infoObj);
    }
}
function existeMz(idMzAct){
    var i=0;
    while(i<arrayMzUsados.length){
       if (arrayMzUsados[i].getId()==idMzAct){
            return i;
        }
        i++;
    }
    return -1;
}
function guardarEstado(mapaSele){
        datos = {"idMapa":mapaSele,"arrayMz":arrayMzUsados, "personaje":mapaCargado.personaje};
     $.ajax({
          type: "POST",
          url: "guardarPartida.php",
          data: datos,
         success: function (msg){
             var result= $.parseJSON(msg); 
                            //var arstring= [];
             var myArray = [];
             if(result.length !== 0){
                var per = new Personaje(result.id,result.vida, result.nombre,result.fuerza,result.fuerza,2, result.rutaImagen,50,150,123,220);
                 per.inicializa();
                 rellenaMapa(per,mapaSele);
             }
        }
    });
}
