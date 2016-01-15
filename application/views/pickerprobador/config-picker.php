<div class="container-fluid fondo-picker">
	<div class="col-sm-6 col-sm-offset-3">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
			<img src="<?php echo $host ?>assets/img/logo-nopadding.png" alt="" style="width:100%">
		</div>
		</div>
		<div class="text-center white-text">
			<h1 style="font-size:55px">
				<?php 
					echo $_SESSION['user_data']['name_user'];
					?>
			</h1>
			<h1 style="font-size:50px">Estamos a un paso de comenzar!</h1>
			<h3>Ingresa el ID de la tienda asociada a este modulo</h3>
		</div>
		<div class="form-group has-feedback margin-top-30">
			<input type="email" id="id-tienda-login-probador" class="form-control margin-top-20" placeholder="ID Tienda">
			<i class="glyphicon glyphicon-home form-control-feedback"></i>
		</div>
		<h3>Ingresa el ID de la tienda asociada a este modulo</h3>
		<div class="form-group has-feedback margin-top-30">
			<input type="email" id="id-tienda-login-probador" class="form-control margin-top-20" placeholder="ID Tienda">
			<i class="glyphicon glyphicon-home form-control-feedback"></i>
		</div>

		<div class="margin-top-20">
			<button id="btn-id-tienda-config" class="btn btn-lg btn-primary" style="width:100%">
				<span class="glyphicon glyphicon-ok"></span>
				Comenzar !
			</button>
		</div>
	</div>
</div>

<input type="hidden" value="<?php echo $_SESSION['user_data']['current_user'] ?>" id="email-user">
<input type="hidden" value="<?php echo $_SESSION['user_data']['id_user'] ?>" id="id-user">

<style>
	html,body{
		width:100%;
		height:100%;
	}
</style>