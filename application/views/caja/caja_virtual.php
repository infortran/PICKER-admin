<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Caja virtual</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	<style type="text/css">
		.margin-top-10{
			margin-top:10px;
		}
		.margin-top-20{
			margin-top:20px;
		}
		.margin-top-30{
			margin-top:30px;
		}
		.margin-top-40{
			margin-top:40px;
		}

		.border-shadow{
			box-shadow:0px 0px 20px rgba(0,0,0,.3);
			padding:10px;
		}
	</style>
</head>
<body>
	
	<div class="container margin-top-40">
		<div class="col-md-6 col-md-offset-3">
			<select class="form-control" id="select_probadores">
				<option value="1">Probador 1</option>
				<option value="2">Probador 2</option>
			</select>
		</div>

		<div class="col-md-6 col-md-offset-3 margin-top-10">
			<input type="text" class="form-control" placeholder="SKU Producto">
			<input type="text" class="form-control  margin-top-10" placeholder="Cantidad">
		</div>

		<div class="col-md-6 col-md-offset-3 margin-top-10">
			<button class="btn btn-primary">Agregar producto a probador</button>
			<button class="btn btn-danger">Quitar producto a probador</button>
		</div>
	</div>
	<div class="container-fluid">
		<button class="btn btn-info pull-right">Buscar productos</button>
	</div>

	<div class="container-fluid border-shadow margin-top-20">
		<div class="col-md-4 col-md-offset-4">
			<input type="text" placeholder="ID Admin" class="form-control">

		</div>
	</div>

<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
</body>
</html>