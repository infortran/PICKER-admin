<!--MODAL MODIFICAR TRABAJADOR -->
<div id="modalModificarTrabajador" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Modificar trabajador</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<div class="img-trabajador nopadding border-shadow" style="margin-left:15px">
							<img class="img-preview img-min-trab" src="" alt="">
						</div>
						<div class="upload-contenedor" style="margin-left:30px">
							<input type="file" class="image_trabajador_up ">
							<input type="hidden" id="img-hidden-trabajador" value="">
						</div>
					</div>
					<div class="col-md-8 margin-top-20">
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="form-control run_trabajador_up" placeholder="R.U.N" disabled>
								<input type="hidden" value="" id="run_hidden_trabajador">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control id_trabajador_up" placeholder="ID Trabajador"><br>
							</div>
						</div>
						
						<input type="text" class="form-control nombre_trabajador_up" placeholder="Nombre completo"><br>
						<input type="text" class="form-control cargo_trabajador_up" placeholder="Cargo"><br>
						
						<!--Campos de contraseña-->
						<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#panelChangePass" aria-expanded="false" aria-controls="collapseExample">
						Cambiar contrasena
						</button><br><br>
						<div class="collapse" id="panelChangePass">
							<div class="well">
								
								<input type="password" class="form-control old-pass-worker" placeholder="Ingrese antigua contrasena">
								<br>
								<input type="password" class="form-control new-pass-worker" placeholder="Ingrese nueva contrasena">
								<br>
								<input type="password" class="form-control repeat-pass-worker" placeholder="Verificar nueva contrasena">
								<br>
								<button type="button" class="btn btn-danger" id="btn-modif-pass">Cambiar contrasena</button>
							</div>
						</div>
						<!--final-->
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<input type="email" class="form-control email_trabajador_up" placeholder="Correo electronico"><br>
						<input type="text" class="form-control dir_trabajador_up" placeholder="Direccion"><br>
					</div>
					<div class="col-md-6">
						<input type="tel" class="form-control tel_trabajador_up" placeholder="Telefono"><br>
						<input type="text" class="form-control comision_trabajador_up" placeholder="Comision"><br>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-modificar-trab">Modificar Trabajador</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>


		</div>
	</div>
</div>