
	<div class="col-md-9 border-shadow nopadding margin-top-10 display-none" id="div-producto-informacion">
		<div style="background:#cfcfcf">
			<span class="glyphicon glyphicon-info-sign" style="margin-left:10px"></span>
			<span style="font-size:20px">Informacion</span>
		</div>
		<br>
		<label for="" class="col-sm-4 text-right">Nombre</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="nombre-producto"><br>
		</div>
		<label for="" class="col-sm-4 text-right">Codigo de referencia</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="sku-producto"><br>
		</div>
		<label for="" class="col-sm-4 text-right">Activado</label>
		<div class="col-sm-8">
			<div class="btn-group" role="group" aria-label="...">
				<button type="button" class="btn btn-default active" id="si-activo-producto">Si</button>

				<button type="button" class="btn btn-default" id="no-activo-producto">No</button>
			</div>
		</div>
		<label for="" class="col-sm-4 text-right margin-top-10">Breve descripcion</label>
		<div class="col-sm-8">
			<textarea class="form-control margin-top-10" id="descrip-breve-producto"></textarea>
		</div>

		<label for="" class="col-sm-4 text-right margin-top-10">Descripcion</label>
		<div class="col-sm-8" style="margin-bottom:30px">
			<textarea rows="9" class="form-control margin-top-10" id="descripcion-producto"></textarea>
		</div>

		<input type="hidden" value="1" id="producto-activado">
	</div>