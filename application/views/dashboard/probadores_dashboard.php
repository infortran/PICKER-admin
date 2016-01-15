<div class="titulo-tienda col-md-12">
Picker Probadores
<button class="pull-right btn btn-default" id="btn-agregar-probador">
<span class="glyphicon glyphicon-plus" style="color:green"></span>
agregar</button>
</div>

<div class="scrollable col-md-12" style="background:#efefef" id="div-probadores">
	<!--Seccion superior-->
	<div class="col-md-12 margin-top-10 border-shadow">
		<div class="col-md-4 text-center">
			<div class="col-md-2">
				<span class="glyphicon glyphicon-barcode" style="font-size:2em;color:orange"></span>
			</div>
			<div class="col-md-6">
				<div>Pickers Utilizados</div>
				<div style="font-size:2em;color:orange"><?php //echo round($porcentaje_sinstock,1); ?>%</div>
			</div>
		</div>
		<div class="col-md-4 text-center">
			<div class="col-md-2">
				<span class="glyphicon glyphicon-tags" style="font-size:2em;color:blue"></span>
			</div>
			<div class="col-md-9">
				<div>Pickers Activos en tiempo real</div>
				<div style="font-size:2em;color:blue"><?php //echo round($margen_bruto,1); ?>%</div>
			</div>
		</div>
		<div class="col-md-4 text-center">
			<div class="col-md-2">
				<span class="glyphicon glyphicon-eye-open" style="font-size:2em;color:green"></span>
			</div>
			<div class="col-md-9">
				<div>Pickers inactivos en tiempo real</div>
				<div style="font-size:2em;color:green"><?php //echo round($porcentaje_activos,1); ?>%</div>
			</div>
		</div>
	</div>

	<div class=" col-md-12 nopadding border-shadow">
	<div class="col-md-12" style="padding:5px;background:#cfcfcf">
		<div class="col-md-10">
			Probadores <span class="badge">0</span>
		</div>
		<div class="col-md-2">
			

			<a href="#" data-toggle="tooltip" data-placement="top" title="Refrescar" >
				<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
			</a>


		</div>
	</div>

	

	<!--Tabla de productos-->
	<div class="col-md-12">
		<table class="table table-striped">
		<tr>
			<th></th>
			<th class="text-center">ID Probador</th>
			<th class="text-center">ID Tienda</th>
			<th class="text-center">Asociado</th>
			<th class="text-center">Activo</th>
			<th></th>
		</tr>
		<tr class="fila-busqueda-probador">
			<th><div class="text-center">--</div></th>
			<th><input type="text" class="form-control"></th><!--input buscar tienda-->
			
			<th><input type="text" class="form-control"></th><!--input buscar tienda-->
		
			<th>
				<select id="" class="form-control">
					<option value="">--</option>
					<option value="">Si</option>
					<option value="">No</option>
				</select>
			</th><!--input buscar asociado-->		
			<th>
				<select id="" class="form-control">
					<option value="">--</option>
					<option value="">Si</option>
					<option value="">No</option>
				</select>
			</th>
			<th><button class="btn btn-default">Buscar</button></th><!--btn buscar-->
		</tr>
 
<!--fila del resultado-->
		

		

		</table>
	</div>


</div>


