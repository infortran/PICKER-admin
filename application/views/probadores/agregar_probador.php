<div class="titulo-tienda col-md-12">
<div class="col-md-8">
	
	<a style="color:#fff;cursor:pointer">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true" data-toggle="tooltip" title="Volver"></span>
	</a>
	Agregar probador
	
</div>

<button class="btn btn-success pull-right" id="btn-guardar-probador">
	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
	Guardar
</button>
<!--button class="btn btn-success pull-right" style="margin-right:5px">
	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
	Guardar y continuar
</button-->
</div>



<div class="scrollable col-md-12" id="div-agregar-probador">

<div class="margin-10 alert alert-success" id="alert-probador-ok">
	<span class="glyphicon glyphicon-ok-sign"></span>
	<span>Probador agregado satisfactoriamente</span>
	<span class="glyphicon glyphicon-remove pull-right"></span>
</div>

<div class="margin-10 alert alert-danger" id="alert-probador-error">
	<span class="glyphicon glyphicon-remove-sign"></span>
	<span id="span-alert-error-probadores">Este probador ya existe</span>
	<span class="glyphicon glyphicon-remove pull-right hover-pointer" id="close-alert-error"></span>
</div>

	<div class="margin-top-20 border-shadow col-md-4 col-md-offset-4">

	<form>
		<div class="text-center" style="font-weight:bold">Ingrese un código de probador</div><br>
		<div class="col-md-6 col-md-offset-3"><input type="text" class="form-control" placeholder="Cod Probador" id="input_id_probador"></div><br>
		<div class="col-md-12 text-center" style="font-weight:bold;margin-top:20px">ID de tienda asociada</div>
		<div class="col-md-12 text-center" style="font-size:30px" id="id_tienda_probador_visible">--- ---</div>
		<div class="col-md-8 col-md-offset-2">
		<label>Activo</label>
			<div class="btn-group" role="group" aria-label="...">
				<button type="button" class="btn btn-default active" id="si-activo-probador">Si</button>

				<button type="button" class="btn btn-default" id="no-activo-probador">No</button>
			</div>
		</div>
		<input type="hidden" id="id_tienda_asociada" value="">
		<input type="hidden" id="probador_activado" value="1">
	</form>
	</div>

	<div class="border-shadow nopadding col-md-12" >
		<div style="padding:5px;background:#cfcfcf">
			<span class="glyphicon glyphicon-home"></span>
			<span style="font-size:17px">Seleccione una tienda para asociar con su Probador</span>
			<a href="#" class="pull-right" style="margin-right:10px" data-toggle="tooltip" data-placement="top" title="Refrescar" id="btn-refresh-tiendas-probador">
				<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
			</a>
		</div>
		<div class="col-md-12" id="div-tiendas-probador">
			
		</div>
	</div>

</div>