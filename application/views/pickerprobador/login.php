

<div class="container-fluid fondo-picker">

	<div class="col-sm-6 col-sm-offset-3 radius">
		<form>
		<div class="col-sm-6 col-sm-offset-3 nopadding margin-top-10">
			<img src="<?php echo $host ?>assets/img/logo-nopadding.png" alt="" style="width:100%">
		</div>



		<div class="text-center" style="font-size:30px;color:white">PROBADOR</div>

		<div id="login-type-alert" class="alert alert-info" style="overflow:hidden">
			<div id="login-icon-alert" class="glyphicon glyphicon-ok-circle" style="font-size:25px;float:left"></div>
			<div id="login-text-alert" style="margin-top:4px;margin-left:10px;width:90%;float:left">
				Datos ingresados correctamente
			</div>

		</div>


		<div class="col-sm-12 margin-top-20">
			<div class="form-group has-feedback">
				<input type="email" id="email-login-probador" class="form-control margin-top-20" placeholder="Email">
				<i class="glyphicon glyphicon-envelope form-control-feedback"></i>
			</div>
			<div class="form-group has-feedback">
				<input type="password" id="password-login-probador" class="form-control margin-top-20" placeholder="Password">
				<i class="glyphicon glyphicon-lock form-control-feedback"></i>
			</div>
			
		</div>

		<div>
			<button type="button" id="btn-login-probador" class="btn btn-lg btn-primary" style="width:100%">
				<span class="glyphicon glyphicon-ok"></span>
				Ingresar
			</button>
		</div>
			
		</form>
	</div>
</div>

<style>
	html,body{
		width:100%;
		height:100%;
	}
</style>