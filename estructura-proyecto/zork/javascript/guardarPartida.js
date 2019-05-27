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
    //var personaje= mapaCargado.personaje;

        datos= {"idMapa":mapaSele,"arrayMz":arrayMzUsados,"personaje":mapaCargado.personaje.datosGuarda()};
        /*
        datos[0]=mapaSele;
        datos[1]=arrayMzUsados;
        datos[3]=mapaCargado.personaje.datosGuarda();
        */
     $.ajax({
          type: "POST",
          url: "guardarPartida.php",
          data: datos,
         success: function (msg){
            if(msg){
                panel.append("TU PARTIDA SE HA GUARDADO CORRECTAMENTE!!");
            }
            else 
                panel.append("Ha habido un problema al guardar tu partida :( ");
            }
    });
}
