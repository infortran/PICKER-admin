var email_admin = $('#email_admin');
var nombre_admin = $('#nombre_admin');
var apellido_admin = $('#apellido_admin');
var old_password_admin = $('#old_password_admin');
var new_password_admin = $('#new_password_admin');
var repeat_password_admin = $('#repeat_password_admin');
var img_default_admin = $('#img_admin_hidden');
var image_admin = $('#image_admin');
var modal_cuenta_ok = $('#modalCuentaOk');



$('#form_admin').submit(function(e){
	e.preventDefault();

	//capturar variables
	var formData = new FormData();
	formData.append('email_admin',email_admin.val());
	formData.append('nombre_admin',nombre_admin.val());
	formData.append('apellido_admin',apellido_admin.val());
	formData.append('old_password_admin',old_password_admin.val());
	formData.append('new_password_admin',new_password_admin.val());
	formData.append('repeat_password_admin',repeat_password_admin.val());
	formData.append('image_admin', image_admin[0].files[0] );
	formData.append('img_default_user',img_default_admin.val());

	
	$.ajax({
		url:'cuenta/updateadmin',
		data:formData,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',
		type:'post',
		success:function(data){
			
			//COMPROBACION DE ERRORES DEL FORMULARIO REQUIRED(001) MINLENGTH(002) MATCHES(005)
			admin = [data.email_admin_valid,
			data.nombre_admin_valid,
			data.apellido_admin_valid,
			data.old_password_admin_valid,
			data.new_password_admin_valid,
			data.repeat_password_admin_valid, 
			data.image_admin_valid,
			data.update];

			selector = [email_admin,nombre_admin,apellido_admin,old_password_admin,
			new_password_admin,repeat_password_admin,image_admin];

			names = ['email_admin','nombre_admin','apellido_admin','old_password_admin',
			'new_password_admin','repeat_password_admin','image_admin','update'];

	
			//BORDES ROJOS AL QUE TENGA ERROR
			for(var i = 0; i < admin.length; i++){
				if(typeof(admin[i]) == 'undefined'){
					//DO NOTHING
				}else{
					if(admin[i] != 'ok'){
						if(admin[i] == 'err'){
							alertWithError(i,old_password_admin);
						}else{
							redBorder(selector[i]);
							errorForm(admin[i], names[i], selector[i]);
						}
					}
				}
			}

			
			//COMPROBAR OK
			if(admin[0] == 'ok' && admin[1] == 'ok' && admin[2] == 'ok' && admin[3] == 'ok' && admin[4] == 'ok' && admin[5] == 'ok' && admin[6] == 'ok' && admin[7] == 'ok'){
				modal_cuenta_ok.modal('show');
			}
		}
	});
});

//btn cuenta
$('#btn-aside-cuenta').click(function(){
	var email = $('#email_admin').attr('placeholder');
	$('#modalCuenta').modal('show');
	loadAdmin(email);
});

$('#closeAccount').click(function(){
	old_password_admin.val('');
});

$('#image_admin').change(function(){
	previewImage(this);
});

$('#btn-aceptar-cuenta-ok').click(function(){
	modal_cuenta_ok.modal('hide');
});



function errorForm(val, type, selector){
	var error = '';
	switch (val){
		case type+'001':error = 'Campo requerido';
		break;
		case type+'002':error = 'Minimo de caracteres';
		break;
		case type+'004':error = 'formato de correo no valido';
		break;
		case type+'005':error = 'Las contraseñas deben coincidir';
		break;
		default:error = 'Error desconocido';
	}
	selector.attr('placeholder',error).val('');
}

function redBorder(selector){
	$(selector).css('border','1px solid red');
}

function alertWithError(error,selector){

	switch(error){
		case 3: redBorder(selector);selector.attr('placeholder','Contrasena erronea').val('');
		break;
		case 6:alert('Hay un problema con la imagen que estas subiendo');
		break;
		case 7:alert('error al tratar de subir los datos al servidor');
		break;
		default:alert('Error desconocido');
	}
}



function previewImage(input){
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('.img-preview').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}


function loadAdmin(email){
	var base_url = $('#base_url').val();
	
	var mail = {email_admin:email}
	$.ajax({
		data:mail,
		cache: false,
        contentType: false,
        processData: false, 
        dataType:'json',
		type:'post',
		url:base_url+'cuenta',
		success:function(data){
			var img = base_url+'assets/uploads/img/'+data.image_admin;
			
			$('#email_admin').val(data.email_admin);
			$('#nombre_admin').val(data.nombre_admin);
			$('#apellido_admin').val(data.apellido_admin);
			$('#image_admin_src').attr('src', img);
			$('#img_admin_hidden').val(data.image_admin);
		}
	})
}

nombre_admin.focusin(function(){onfocusin(this,'Nombre');}).focusout(function(){onfocusout(this)});
apellido_admin.focusin(function(){onfocusin(this,'Apellido');}).focusout(function(){onfocusout(this)});
old_password_admin.focusin(function(){onfocusin(this,'Antigua contrasena');}).focusout(function(){onfocusout(this)});
new_password_admin.focusin(function(){onfocusin(this,'Nueva contrasena');}).focusout(function(){onfocusout(this)});
repeat_password_admin.focusin(function(){onfocusin(this,'Repetir contrasena');}).focusout(function(){onfocusout(this)});


function onfocusin(selector,human_name){
	$(selector).css('border','1px solid #02a1ce').attr('placeholder',human_name);
}

function onfocusout(selector){
	$(selector).css('border','1px solid #cfcfcf');
}