<!-- Modal -->
<div id="modalLogout" class="modal" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cerrar sesion</h4>
      </div>
      <div class="modal-body">
        <p>Esta seguro que desea cerrar la sesion?</p>
      </div>
      <div class="modal-footer">
        <form action="<?php echo base_url(); ?>login/logout">
           <button type="submit" class="btn btn-danger">Cerrar sesion</button>
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>

  </div>
</div>