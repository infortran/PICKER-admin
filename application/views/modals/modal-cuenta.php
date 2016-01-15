<!-- Modal -->
<div id="modalCuenta" class="modal fade" role="dialog">
	<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	<form id="form_admin">

	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Cuenta</h4>
	    </div>


    <div class="modal-body" style="max-height:400px">
        <div class="row">


            <div class="col-md-3">
                <div class="img-cuenta border-shadow nopadding">
                  <img id="image_admin_src" class="img-preview" src="<?php echo base_url() ?>assets/img/default-user.png">
                  <input type="hidden" value="default-user.png" id="img_admin_hidden">
                </div>
                <div class="upload-contenedor">
                	<input type="file" accept="image/x-png, image/gif, image/jpeg" id="image_admin" >
                </div>
            </div>


            <div class="col-md-9">
                <label>Email (nombre de usuario)</label>
                <input type="email" class="form-control" placeholder="" id="email_admin" disabled>

                <div class="row">
                	<div class="col-md-6">
                    	<label>Nombre</label>
                    	<input type="text" class="form-control" placeholder="" id="nombre_admin">
                	</div>
	                <div class="col-md-6">
	                    <label>Apellido</label>
	                    <input type="text" class="form-control" placeholder="" id="apellido_admin">
	                </div>
                </div><br>
                <input type="password" class="form-control" placeholder="Antigua contrasena" id="old_password_admin"><br>
                <input type="password" class="form-control" placeholder="Nueva contrasena" id="new_password_admin"><br>
                <input type="password" class="form-control" placeholder="Repetir contrasena" id="repeat_password_admin"><br>
            </div>
        </div>   
    </div>     
      
    <div class="modal-footer">
        <button id="closeAccount" class="btn btn-default pull-right btn-margin-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
    </div>
    </form>
    </div>
    </div>
</div>