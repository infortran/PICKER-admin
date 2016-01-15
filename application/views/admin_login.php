<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login - PICKER</title>
	<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style-login.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head> 
<body>
	
	<form class="form-center form-login" role="form">
		<div class="form-header">
			<div><img class="img-responsive" src="<?php echo base_url(); ?>assets/img/logo-picker.png" alt=""></div>
		</div>
		<div class="form-body">
			<div class="form-group">
				<input type="email" placeholder="Usuario" class="form-control" id="email-user-login" required>
			</div>
			<div class="form-group padding-top-20">
				<input type="password" placeholder="Password" class="form-control" id="password-user-login"  required>
			</div>
			<div class="form-group">
				<button type="button" id="btn-login-admin" class="btn btn-primary margin-top-20">Ingresar</button>
			</div>

			<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

			<div class="form-group" id="msj-login"></div>
		</div>
	</form>

</body>
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script-->
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/login.js"></script>
</html>