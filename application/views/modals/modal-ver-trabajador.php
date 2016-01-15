<!--MODAL AGREGAR TRABAJADOR -->
<div id="modalVerTrabajador" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" style="border-radius:0px 0px 5px 5px;">
		<!--form id=""-->
			<div class="modal-body" style="border-radius:0p;">
				<div class="row div-image-trabajador">
					<img src="<?php echo base_url() ?>assets/img/default-user.png">
				</div>

				<h3 class="text-center" id="span-nombre-trabajador">Nombre</h3>
				<h4 class="text-center" id="span-id-trabajador">ID</h4>
				<div class="text-center margin-top-5">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					<span id="span-cargo-trabajador">cargo</span>
				</div>
				<div class="text-center margin-top-5">
					<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
					<span id="span-comision-trabajador">Comision</span>%
				</div>
				<div class="text-center margin-top-5">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
					<span id="span-correo-trabajador">Correo</span>
				</div>
				<div class="text-center margin-top-5">
					<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
					<span id="span-dir-trabajador">Direccion</span>
				</div>
				<div class="text-center margin-top-5">
					<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
					<span id="span-tel-trabajador">Telefono</span>
				</div>

			</div>
			<input type="hidden" id="trabajador-temp" value="">
			<div class="row">
				<div class="col-md-6">
					<button type="button" class="btn btn-default btn-full" id="btn-modificar-trabajador-modal"
					data-toggle="modal"
					data-target="#modalModificarTrabajador"
					 >Modificar</button>
				</div>
				<div class="col-md-6">
					<button type="button" class="btn btn-primary btn-full" id="btn-eliminar-trabajador">Eliminar</button>
				</div>
			</div>
		<!--/form-->
		</div>
	</div>
</div>