<div class="container-fluid" style="box-shadow:inset 0px 0px 20px rgba(90,172,255,.5); padding:10px;margin:10px;border-radius:8px">
	<div class="col-md-3">
		<div class="miniatura"><img class="" src="<?php echo base_url() ?>assets/uploads/img/<?php echo $tienda->img_tienda ?>"></div>
	</div>
	<div class="col-md-3" style="font-size:20px;margin-top:25px"><?php echo $tienda->nombre_tienda ?></div>
	<div class="col-md-3" style="font-size:20px;margin-top:25px"><?php echo $tienda->cod_tienda ?></div>
	<div class="col-md-3">
		<button class="btn btn-info margin-top-20" onclick="tiendaSeleccionada('<?php echo $tienda->id_tienda ?>', '<?php echo $tienda->cod_tienda ?>' )">
			<span class="glyphicon glyphicon-check"></span>
			<span>Asociar con tienda</span>
		</button>
	</div>
</div>