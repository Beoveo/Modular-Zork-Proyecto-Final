<div id="sidebar-left">
<script type="text/javascript" src="includes/comun/dinamic.js"></script>

	<div class= "container--tabs">
		<section class="row">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-1">Noticias</a></li>
			<li class=""><a href="#tab-2">Eventos</a></li>
			<li class=""><a href="#tab-3">Cofre</a></li>
		</ul>
		<div class="tab-content">
			<div id="tab-1" class="tab-pane active"> 
				<?php require("noticias.php");	?>			
			</div> 
			<div id="tab-2" class="tab-pane">
				<h3>Eventos</h3>
				<?php require("eventos.php");	?>				
			</div>
			<div id="tab-3" class="tab-pane">
				<h3>Cofre</h3>
				<?php require("cofre.php");	?>			
			</div>
		</div>
	</section>  
	</div>
</div>