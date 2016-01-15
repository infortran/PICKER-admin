<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php
	header("content-type: application/x-javascript");
	$token = 1234567890;
	$script = "$(document).ready(function(){

	$('#form-login').submit(function(e){
		e.preventDefault();

		var base_url = $('#base_url').val();
		var token = ' ".$token."';
		alert(token);
		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: $(this).serialize(),
			beforeSend:function(){
				//loader show
			},
			success:function(data){
				//loader fade out
				if(data == 'ok'){
					
					$('#msj-login').html('<div id='login-ok'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Datos ingresados correctamente</span>');
					$('#login-ok').css({
						'padding':'5px',
						'border':'3px solid green',
						'background':'#cfcfcf',
						'border-radius':'2px'
					});
					setInterval(function(){ 
						location.href = base_url+'dashboard'
					}, 2000);
				}else{
					$('#msj-login').html('<div id='login-error'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Usuario o Contrasena incorrectos</span>');
					$('#login-error').css({
						'padding':'5px',
						'border':'3px solid red',
						'background':'#cfcfcf',
						'border-radius':'2px'
					});
				}
			}
		});//AJAX

	});//SUBMIT

});//READY";



echo 'alert("HOLA ALE");';
?>