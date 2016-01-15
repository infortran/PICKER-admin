//var url = 'http://172.20.10.2:8080/picker/'; 
//var url = 'http://192.168.1.37:8080/picker/';
var url = $('#base_url').val();
var loop;

/*$(document).ready(function(){
	loadStandby();
	loop = setInterval(function(){
		//alert('set interval working');
		checkStatus();
	}
	, 3000);
});	*/

$(document).ready(function(){
	$('#login-type-alert').hide();
	loadMainView();

});

$(document).on('click','#btn-login-probador',function(){
	check_login();
});

$(document).on('click','#btn-id-tienda-config',function(){
	asociar_id_tienda();
});



function check_login(){
	var direccion = url+'pickerprobador/check_login';
	var data = new FormData();
	data.append('email', $('#email-login-probador').val());
	data.append('password', $('#password-login-probador').val());

	$.ajax({
		data:data,
		url:direccion,
		processData:false,
		contentType:false,
		cache:false,
		dataType:'json',
		type:'post',
		success:function(data){
			if(typeof(data.err_email) == 'undefined') {
			}else{
				if(data.err_email == 'err001'){
					errorLogin('El campo Email es obligatorio',false);
				}
				if(data.err_email == 'err004'){
					errorLogin('El formato de correo no es válido',false);
				}
			}

			if(typeof(data.err_pass) == 'undefined') {
			}else{
				if(data.err_pass == 'err001'){
					errorLogin('El campo Password es obligatorio',false);
				}
			}

			if(typeof(data.valid) == 'undefined') {
			}else{
				if(data.valid == 'err_pass'){
					errorLogin('La contraseña es incorrecta',false);
				}
				if(data.valid == 'err_user'){
					errorLogin('Este usuario no esta registrado',false);
				}
				if(data.valid == 'ok'){
					errorLogin('Datos ingresados correctamente', true);
					setTimeout(function(){
						location.href = url+'pickerprobador/config';
					},3500);
				}
			}


		}
	});
}

function asociar_id_tienda(){
	var direccion = url+'pickerprobador/asociar_id_tienda';
	var data = new FormData();
	data.append('email_user', $('#email-user').val());
	data.append('id_tienda', $('#id-tienda-login-probador').val());
	data.append('id_user', $('#id-user').val());

	$.ajax({
		data:data,
		url:direccion,
		contentType:false,
		processData:false,
		cache:false,
		type:'post',
		dataType:'json',
		success:function(data){

		}
	});
}


function errorLogin(text, success){
	if(success){
		$('#login-type-alert').removeClass('alert-danger').addClass('alert-info');
		$('#login-icon-alert').removeClass('glyphicon-remove-circle').addClass('glyphicon-ok-circle');
	}else{
		$('#login-type-alert').removeClass('alert-info').addClass('alert-danger');
		$('#login-icon-alert').removeClass('glyphicon-ok-circle').addClass('glyphicon-remove-circle');
	}
	$('#login-text-alert').html(text);
	$('#login-type-alert').toggle(500);
}

function loadStandby(){
	$.ajax({
		url:url+'pickerprobador/loadstandby',
		success:function(data){
			$('#standby').html(data);
		}
	});
}

function checkStatus(){
	$.ajax({
		url:url+'pickerprobador/checkstatus',
		success:function(data){
			//alert('success');
			if(data == 1)
			{
				//alert('data = 1');
				clearInterval(loop);
				$('#standby').fadeOut(1200);
				setTimeout(loadMainView, 2000);
			}
		},error:function(){
			alert('error al ejecutar el ajax');
		}
	});
	
}

function loadMainView(){
	$.ajax({
		url:url+'pickerprobador/loadmainview',
		contentType:false,
		cache:false,
		processData:false,
		dataType:'json',
		success:function(data){
			$('#picker-head').html(data.picker_head);
			$('#picker-left').html(data.picker_left);
			$('#picker-center').html(data.picker_center);
			$('#picker-right').html(data.picker_right);
		}
	});
}

$(document).on('focusin','#email-login-probador',function(){
	$('#login-type-alert').fadeOut(500);
});

$(document).on('focusin','#password-login-probador',function(){
	$('#login-type-alert').fadeOut(500);
});