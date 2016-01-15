<!-- Modal -->
<div id="modalAgregarTienda" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar una nueva tienda</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="" id="form_agregar_tienda"><br>
          <div class="col-md-5" id="img-uploader-div">
            <div class="img-miniatura-preview">
              <img class="img-preview" id="img-form-agregar" src="<?php echo base_url() ?>/assets/img/default-store.png" alt="" >
            </div><br>
            <input type="file" 
                  
                  accept="image/x-png, image/gif, image/jpeg" id="upload_img_agregar" name="upload_img_agregar"><br>
          </div>
          <div class="col-md-7">
              <label>Datos de la tienda</label>

             
              <input type="text" class="form-control" placeholder="Codigo de tienda" id="id_tienda_agregar"><br>

              
              <input type="text" class="form-control" placeholder="Nombre tienda" id="nombre_tienda_agregar"><br>

              
              <input type="text" class="form-control" placeholder="Jefe tienda" id="jefe_tienda_agregar"><br>
          </div>
          <div class="row">
            <div class="col-md-8">
              
              <input type="text" class="form-control" placeholder="Direccion" id="dir_tienda_agregar"><br>
            </div>
            <div class="col-md-4">
              
              <input type="text" class="form-control" placeholder="Sitio Web" id="web_tienda_agregar"><br>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-8">
             
              <input type="text" class="form-control" placeholder="Correo electronico" id="email_tienda_agregar"><br>
            </div>
            <div class="col-md-4">
          
              <input type="text" class="form-control" placeholder="Telefono" id="tel_tienda_agregar"><br>
            </div>
          </div>
          <div id="errores-validaciones"></div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btn-agregar-tienda">Finalizar</button></form>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-cerrar-agregar">Cerrar</button>
      </div>
    </div>

  </div>
</div>