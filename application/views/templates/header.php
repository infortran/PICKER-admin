<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Sistema de administración de PICKER">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/picker.ico" />
	<meta name="author" content="Freddy Perez, Infortran">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo $title; ?> - PICKER</title>
	<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style-dashboard.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pace-theme.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-default" style="margin-bottom:0">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">
						<img class="nopadding" src="<?php echo base_url(); ?>assets/img/picker_logo_ext.png" alt="PICKER Admin" style="width:100px;height:20px">
					</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav"></ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li><button class="btn btn-default" id="btn-navbar-tiendas" style="margin-top:9px" data-toggle="modal" data-target="#modalVerTiendas">Ver tiendas</button></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="dropdown-nombre-tienda">Nombre Tienda <span class="caret"></span></a>
							<ul class="dropdown-menu" id="dropdown-tiendas">

							</ul>
						</li>

					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<form>
		<input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
		<input type="hidden" value="<?php echo $nro_tiendas; ?>" id="nro_tiendas">
		</form>
	</header>

	<aside class="col-md-2" id="aside-desktop">
		<div id="btn-div-kpi" class="col-md-12 text-center btn-div-aside btn-div-selected">
			<a href="#" id="btn-aside-kpi">KPI</a>
		</div>
		<div id="btn-div-vendedores" class="col-md-12 text-center btn-div-aside">
			<a href="#" id="btn-aside-vendedores">Trabajadores</a>
		</div>
		<div id="btn-div-productos" class="col-md-12 text-center btn-div-aside">
			<a href="#" id="btn-aside-productos">Productos</a>
		</div>
		<div id="btn-div-tendencias" class="col-md-12 text-center btn-div-aside">
			<a href="#" id="btn-aside-tendencias">Tendencias</a>
		</div>
		<div id="btn-div-probadores" class="col-md-12 text-center btn-div-aside">
			<a href="#" id="btn-aside-probadores">Probadores</a>
		</div>
		<div id="btn-div-cuenta" class="col-md-12 text-center btn-div-aside">
			<a href="#" id="btn-aside-cuenta">Cuenta</a>
		</div>
		<div id="btn-div-salir" class="col-md-12 text-center btn-div-aside">
			<a href="" data-toggle="modal" data-target="#modalLogout">Salir</a>
		</div>
	</aside>

