<div class="titulo-tienda col-md-12">
<div class="col-md-10">Productos</div>
<div class="col-md-2">
	<button class="btn btn-default" onclick="ir_agregar_producto()" style="margin-left:20px">
		<span class="glyphicon glyphicon-plus" style="color:green"></span>
		agregar
	</button>
</div>
 
</div>

<div class="scrollable col-md-12" id="div-productos"><!--ID PARA AGREGAR VIA jQuery.HTML EL RESULTADO-->

<!--Seccion superior-->
	<div class="col-md-12 margin-top-10 border-shadow">
		<div class="col-md-4 text-center">
			<div class="col-md-2">
				<span class="glyphicon glyphicon-barcode" style="font-size:2em;color:orange"></span>
			</div>
			<div class="col-md-6">
				<div>Productos sin stock</div>
				<div style="font-size:2em;color:orange"><?php echo round($porcentaje_sinstock,1); ?>%</div>
			</div>
		</div>
		<div class="col-md-4 text-center">
			<div class="col-md-2">
				<span class="glyphicon glyphicon-tags" style="font-size:2em;color:blue"></span>
			</div>
			<div class="col-md-8">
				<div>Promedio margen bruto</div>
				<div style="font-size:2em;color:blue"><?php echo round($margen_bruto,1); ?>%</div>
			</div>
		</div>
		<div class="col-md-4 text-center">
			<div class="col-md-2">
				<span class="glyphicon glyphicon-eye-open" style="font-size:2em;color:green"></span>
			</div>
			<div class="col-md-6">
				<div>Productos Visibles</div>
				<div style="font-size:2em;color:green"><?php echo round($porcentaje_activos,1); ?>%</div>
			</div>
		</div>
	</div>

<div class=" col-md-12 nopadding border-shadow">
	<div class="col-md-12" style="padding:5px;background:#cfcfcf">
		<div class="col-md-10">
			Productos <span class="badge"><?php echo $count_products; ?></span>
		</div>
		<div class="col-md-2">
			<a href="#" data-toggle="tooltip" data-placement="top" title="Agregar un nuevo producto" style="margin-right:10px">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			</a>

			<a href="#" data-toggle="tooltip" data-placement="top" title="Importar productos" style="margin-right:10px" >
				<span class="glyphicon glyphicon-download" aria-hidden="true"></span>
			</a>

			<a href="#" data-toggle="tooltip" data-placement="top" title="Exportar productos" style="margin-right:10px" >
				<span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
			</a>

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
			<th class="text-center">ID</th>
			<th class="text-center">imagen</th>
			<th class="text-center">Nombre</th>
			<!--th class="text-center">Referencia</th-->
			<th class="text-center">Categoria</th>
			<th class="text-center">Precio base</th>
			<th class="text-center">Precio final</th>
			<th class="text-center">Cantidad</th>
			<th class="text-center">Estado</th>
			<th></th>
		</tr>
		<tr class="fila-busqueda-producto">
			<th><div class="text-center">--</div></th>
			<th width="50"><input type="text" class="form-control"></th><!--input buscar id-->
			<th><div class="text-center">--</div></th>
			<th><input type="text" class="form-control"></th><!--input buscar nombre-->
			<!--th><input type="text" class="form-control"></th-->
			<th width="120"><input type="text" class="form-control"></th><!--input buscar categoria-->
			<th width="120"><input type="text" class="form-control"></th><!--input buscar precio base-->
			<th width="120"><div class="text-center">--</div></th>
			<th width="80"><input type="text" class="form-control"></th><!--input buscar cantidad-->
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
</div>
