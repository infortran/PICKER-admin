<!-- Modal -->
<div id="modalModifTienda" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modificar una tienda</h4>
			</div>
			<div class="modal-body">
				<form role="form" id="form_modificar_tienda"><br>
					<div class="col-md-5" id="img-uploader-div">
						<div class="img-miniatura-preview" id="preview-modif">
							<img class="img-preview" id="img-form-modificar" src="<?php echo base_url() ?>/assets/img/default-store.png" alt="">
							<input type="hidden" id="img_default_modificar" value="">
						</div><br>
						<input type="file" 

						accept="image/x-png, image/gif, image/jpeg" id="upload_img_modificar"><br>
					</div>
					<div class="col-md-7">
						<label>Datos de la tienda</label>


						<input type="text" class="form-control" placeholder="Codigo de tienda" id="id_tienda_modificar"><br>


						<input type="text" class="form-control" placeholder="Nombre tienda" id="nombre_tienda_modificar"><br>


						<input type="text" class="form-control" placeholder="Jefe tienda" id="jefe_tienda_modificar"><br>
					</div>
					<div class="row">
						<div class="col-md-8">

							<input type="text" class="form-control" placeholder="Direccion" id="dir_tienda_modificar"><br>
						</div>
						<div class="col-md-4">

							<input type="text" class="form-control" placeholder="Sitio Web" id="web_tienda_modificar"><br>
						</div>
					</div>

					<div class="row">
						<div class="col-md-8">

							<input type="text" class="form-control" placeholder="Correo electronico" id="email_tienda_modificar"><br>
						</div>
						<div class="col-md-4">

							<input type="text" class="form-control" placeholder="Telefono" id="tel_tienda_modificar"><br>
						</div>
					</div>


				</div>
				<div class="modal-footer">
					<input type="hidden" value="" id="codigo-tienda-a-modificar">
					<button type="submit" class="btn btn-success" id="btn-modificar-tienda">Finalizar</button></form>
					<button type="button" class="btn btn-default" data-dismiss="modal" id="btn-cerrar-modificar">Cerrar</button>
				</div>
			</div>
	</div>
</div>