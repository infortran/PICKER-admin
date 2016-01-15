$(document).ready(function(){

	var base_url = $('#base_url').val();
	$('#btn-login-admin').click(function(){
		var data = new FormData();
		data.append('email-user',$('#email-user-login').val());
		data.append('password-user',$('#password-user-login').val());
		
		$.ajax({
			url: base_url+'login/verificardatos',
			type: 'post',
			data: data,
			processData:false,
			cache:false,
			contentType:false,
			success:function(data){
				
				//loader fade out
				if(data == 'ok'){
					
					$('#msj-login').html('<div id="login-ok"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Datos ingresados correctamente</span>');
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
					$('#msj-login').html('<div id="login-error"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Usuario o Contrasena incorrectos</span>');
					$('#login-error').css({
						'padding':'5px',
						'border':'3px solid red',
						'background':'#cfcfcf',
						'border-radius':'2px'
					});
				}
			}
		});

	});	

});

