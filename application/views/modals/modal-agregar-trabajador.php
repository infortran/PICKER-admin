<!--MODAL AGREGAR TRABAJADOR -->
<div id="modalAgregarTrabajador" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<!--form id=""-->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Agregar un trabajador</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<div class="img-trabajador nopadding border-shadow" style="margin-left:15px">
							<img class="img-preview" src="<?php echo base_url() ?>assets/img/default-user.png" alt="">
						</div>
						<div class="upload-contenedor" style="margin-left:30px">
							<input type="file" class="image_trabajador">
						</div>
					</div>
					<div class="col-md-8 margin-top-20">
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="form-control run_trabajador" placeholder="R.U.N">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control id_trabajador" placeholder="ID Trabajador"><br>
							</div>
						</div>
						
						<input type="text" class="form-control nombre_trabajador" placeholder="Nombre completo"><br>
						<input type="text" class="form-control cargo_trabajador" placeholder="Cargo"><br>
						<input type="password" class="form-control password_trabajador" placeholder="Contrasena"><br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control email_trabajador" placeholder="Correo electronico"><br>
						<input type="text" class="form-control dir_trabajador" placeholder="Direccion"><br>
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control tel_trabajador" placeholder="Telefono"><br>
						<input type="text" class="form-control comision_trabajador" placeholder="Comision"><br>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn-agregar-trabajador">Agregar Trabajador</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		<!--/form-->
		</div>
	</div>
</div>