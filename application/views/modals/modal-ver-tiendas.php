<!-- Modal -->
<div id="modalVerTiendas" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Administrador de tiendas</h4>
      </div>
      

      <div class="modal-body scrollable" id="modal-body-tiendas" style="max-height:400px">
        <!--LEER DE LA BASE DE DATOS SI HAY TIENDAS, SI NO HAY MOSTRAR MENSAJE DE AGREGAR-->
       <div class="col-md-12">
        <div class="alert alert-warning margin-top-10" id="alerta-tienda-eliminada">Tienda eliminada</div>
      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarTienda">Agregar una tienda</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>