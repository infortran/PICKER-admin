<div class="col-md-9 border-shadow  nopadding margin-top-10" id="div-producto-precio">
	<div style="background:#cfcfcf">
		<span class="glyphicon glyphicon-plus-sign"></span>
		<span style="font-size:20px">Precio</span>
	</div>
<div class="padding-10">
	<div class="alert alert-success" role="alert">
		Los montos son calculados automaticamente por el sistema
	</div>

	<div class="row margin-top-10">
		<label for="" class="col-sm-4 text-right">Precio mayorista sin IVA</label>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="peso1input">$</span>
				<input type="text" class="form-control" aria-describedby="peso1input" id="precio-mayor-producto">
			</div>
		</div>
	</div>

	<div class="row margin-top-10">
		<label for="" class="col-sm-4 text-right">Precio de producto sin IVA</label>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="peso2input">$</span>
				<input type="text" class="form-control" aria-describedby="peso2input" id="precio-venta-producto">
			</div>
		</div>
	</div>


	<div class="row margin-top-15">
		<label for="" class="col-sm-4 text-right margin-top-10">Impuestos del producto</label>
		<div class="col-sm-4">
			<select class="form-control" id="impuesto-select">
				<option>ninguno</option>
				<option value="19" selected="selected">19%, impuesto compra y ventas</option>
			</select>
		</div>
		<div class="col-sm-4 margin-top-5">
			<span class="glyphicon glyphicon-plus" style="color:green"></span>
			<a href="#">Nuevo impuesto</a>
		</div>
	</div>

	<div class="row margin-top-15">
		<label for="" class="col-sm-4 text-right margin-top-5">Precio de producto con IVA</label>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="peso3input">$</span>
				<input type="text" class="form-control" aria-describedby="peso3input" id="precio-venta-iva-producto">
			</div>
		</div>
	</div>

	<div class="alert alert-info margin-top-20" role="alert">
		Precio final de venta = $<span class="precio-final-span">0</span> + IVA incluido./ $<span class="precio-sin-iva-span">0</span> sin impuestos.
	</div>
</div>
</div>