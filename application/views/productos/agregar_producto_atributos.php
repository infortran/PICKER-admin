<div class="col-md-9 border-shadow nopadding margin-top-10" id="div-producto-atributos">
	<div style="background:#cfcfcf">
		<span class="glyphicon glyphicon-plus-sign"></span>
		<span style="font-size:20px">Atributos</span>
	</div>
	<div class="padding-10">
	<div id="contenedor-editor-atributos">
		<div class="row margin-top-35">
			<label for="" class="col-sm-4 text-right" >Atributo</label>
			<div class="col-sm-3">
				<select id="select-atributo" class="form-control">
					<option value="talla-op">Talla</option>
					<option value="color-op">Color</option>
					<option value="talla-calzado-op">Talla Calzado</option>
				</select>
			</div>
		</div>

		<div class="row margin-top-35">
			<label for="" class="col-sm-4 text-right">Valor</label>
			<div class="col-sm-5" id="contenedor-valor-atributo">
				<select class="form-control" id="select-valor-atributo">
					<option>---</option>
					<option value="s-op">S</option>
					<option value="m-op">M</option>
					<option value="l-op">L</option>
					<option value="xl-op">XL</option>
				</select>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-default" id="btn-agregar-atributo">
				<span class="glyphicon glyphicon-plus"></span>
				Añadir </button>
			</div>
		</div>

		<div class="row margin-top-35">
			<label for="" class="col-sm-4 text-right"></label>
			<div class="col-sm-5">
				<textarea class="form-control" id="" cols="30" rows="7"></textarea>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-default" id="btn-eliminar-atributo">
				<span class="glyphicon glyphicon-minus"></span>
				Eliminar</button>
			</div>
		</div>
	</div>


		<div class="row" id="contenedor-lista-atributos">
			<div class="col-md-12">
				<table class="table border-shadow">
				<tr id="table-atributos">
					<th>Color</th>
					<th>Talla</th>
					<th width="100">--</th>
				</tr>
				</table>

				<div class="alert alert-info" style="border-left:4px solid" id="alert-table-atributos">
					<span class="glyphicon glyphicon-alert"></span>
						No hay ninguna combinacion de atributos
				</div>
			</div>
		</div>
		
		<div class="col-sm-12 padding-10">
			<button class="btn btn-default pull-right">
			<span class="glyphicon glyphicon-plus-sign"></span>
			Agregar combinacion</button>
		</div>
	</div>
	
</div>