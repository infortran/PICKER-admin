<div class="col-md-9 border-shadow nopadding margin-top-10" id="div-producto-<?php echo $var_data ?>">
	<div  style="background:#cfcfcf">
		
		<?php switch($var_data){
			case 'precio': ?> <span class="glyphicon glyphicon-usd" style="margin-left:10px"></span>
			<?php break;
			case 'cantidades': ?> <span class="glyphicon glyphicon-equalizer" style="margin-left:10px"></span>
			<?php break;
			case 'atributos': ?> <span class="glyphicon glyphicon-tags" style="margin-left:10px"></span>
			<?php break;
			case 'imagenes': ?> <span class="glyphicon glyphicon-picture" style="margin-left:10px"></span>
			<?php break;
			} ?>
		<span style="font-size:20px"><?php echo ucfirst($var_data) ?></span>
		
	</div>

	<div class="padding-10">
		<div class="alert alert-info" style="border-left:4px solid">
		<span class="glyphicon glyphicon-alert"></span>
		<span>Debe guardar el producto para agregar <?php echo $var_data ?></span>
		</div>
	</div>
</div>