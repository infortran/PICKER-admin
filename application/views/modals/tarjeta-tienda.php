<div id="lista-de-tiendas">
          <div class="row border-shadow">
            <div class="col-md-2">
            <span style="font-size:18px" class="text-center"><?php echo $fila['cod_tienda']; ?></span>
              <div class="miniatura">
                <img src="<?php echo base_url() ?>assets/uploads/img/<?php echo $fila['img_tienda'] ?>">
              </div>
              <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                <span><?php echo $fila['tel_tienda']; ?></span>
            </div>
            <div class="col-md-8 margin-top-15 nopadding">
              <div class="col-md-5">
                  <h4><?php echo $fila['nombre_tienda']; ?></h4>
                  <h5><?php echo $fila['owner_tienda']; ?></h5>
                  <a href="http://<?php echo $fila['web_tienda'] ?>"><h6><?php echo $fila['web_tienda']; ?></h6></a>
              </div>
              <div class="col-md-7 margin-top-10">
                <label>Direccion</label>
                <p><?php echo $fila['dir_tienda']; ?><p>
                
                <label>Email</label>
                <span><?php echo $fila['email_tienda']; ?></span>
              </div>
            
            </div>
            <div class="col-md-2 nopadding margin-top-20">
              <div class="col-md-12">
                <button class="btn btn-success btn-mismo-width"
                onclick="modalModificar('<?php echo urldecode($fila['id_tienda']) ?>')">Editar Tienda</button>
              </div>
              <div class="col-md-12">
                <button class="btn btn-danger btn-mismo-width margin-top-10" 
                onclick="modalEliminar('<?php echo urldecode($fila['id_tienda']) ?>')">Eliminar Tienda</button>
              </div>
            </div>
          </div>
          
</div>