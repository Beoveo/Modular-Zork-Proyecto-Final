<div id="contenido">
<h1>Modular Zork</h1>
    <div id="subwrapper">
        <div id="zork-area"> 
            <?php
            if(!isset($_SESSION["login"])){
            ?>
                <h1>¡REGISTRATE!</h1>
                <p>Para poder guardar tu progreso, puntuar en el ranking y probar otros mapas que no sean de demostración,debes <em>estar registrado</em> .</p>
                    <button id="prueba">Empieza tu prueba</button>
            <?php
            }
            else{
            ?>
                <button id="carga">Cargar partida</button>
                <button id="start">Nueva partida</button>
            <?php   
            }   
            ?>
            
        </div>
    </div>
</div>