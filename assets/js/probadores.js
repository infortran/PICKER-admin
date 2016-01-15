
function cargar_probador_dashboard(){
	$.ajax({
		url:base_url+'dashboard/loadviewdashboard/probadores_dashboard',
		success:function(data){
			$('#main-section').html(data);
			cargar_probadores();
		}
	});
}

function cargar_probadores(){
		$.ajax({
			url:base_url+'probadores/loadprobadores',
			success:function(data){
				$('.fila-busqueda-probador').after(data);
			}
		});
	}

function vista_agregar_probador(){

	base_url = $('#base_url').val();

	$.ajax({
		contentType:false,
		processData:false,
		url:base_url+'probadores/views_add',
		type:'post',
		success:function(data){
			$('#main-section').html(data);
			$('#alert-probador-ok').hide();
			$('#alert-probador-error').hide();
			cargar_tiendas_probadores();
		}
	});
}

function cargar_tiendas_probadores(){
	base_url = $('#base_url').val();

	$.ajax({
		contentType:false,
		processData:false,
		url:base_url+'probadores/cargar_tiendas_probadores',
		type:'post',
		success:function(data){

			$('#div-tiendas-probador').html(data);
		}
	});
}

function tiendaSeleccionada(id_tienda, cod_tienda){
	$('#id_tienda_probador_visible').html(cod_tienda);
	$('#id_tienda_asociada').val(id_tienda);
	$('#alert-probador-error').fadeOut(1000);
}

function modificar_probador(id_probador){
	base_url = $('#base_url').val();
	var data = new FormData();
	data.append('id_probador', id_probador);

	$.ajax({
		data:data,
		contentType:false,
		processData:false,
		url:base_url+'probadores/views_update',
		type:'post',
		success:function(data){
			$('#main-section').html(data);
			$('#alert-probador-ok').hide();
			$('#alert-probador-error').hide();
			cargar_tiendas_probadores();
		}
	});
}

function asociar_tienda_probador(id_tienda, cod_probador, activo){
	base_url = $('#base_url').val();
	var data = new FormData();
	
	data.append('id_tienda', id_tienda);
	data.append('cod_probador', cod_probador);
	data.append('probador_activado', activo);

	$.ajax({
		data:data,
		url:base_url+'probadores/asociar_tienda_probador',
		processData:false,
		contentType:false,
		cache:false,
		type:'post',
		dataType:'json',
		success:function(data){
			if(typeof(data.id_tienda_err) == 'undefined' ){
				//do nothing
			}else{
				switch(data.id_probador_err){
					case 'err001': $('#input_id_probador').css('border','1px solid red').attr('placeholder','Requerido');
					break;
					case 'err002': $('#input_id_probador').css('border','1px solid red').attr('placeholder','6 caracteres');;
					break;
					case 'err003': $('#input_id_probador').css('border','1px solid red').attr('placeholder','6 caracteres');;
					break;
				}
			}

			if(typeof(data.id_tienda_err) == 'undefined'){

			}else{
				switch(data.id_tienda_err){
					case 'err001':
						$('#alert-probador-error').fadeIn(1000);
						$('#span-alert-error-probadores').html('Debe seleccionar una tienda para poder crear un nuevo probador');
					break;
				}
			}

			if(typeof(data.valid) == 'undefined'){

			}else{
				switch(data.valid){
					case 'err_exist':
						$('#alert-probador-error').fadeIn(1000);
						$('#span-alert-error-probadores').html('Este codigo ya esta asignado, intenta con otro.');
						$('#input_id_probador').css('border','1px solid red');
					break;
					case 'create_ok':
						$('#alert-probador-ok').fadeIn(1000);
						setTimeout(function(){
							$('#alert-probador-ok').fadeOut(1000);
						},1000);
						setTimeout(cargar_probador_dashboard, 2500);
					break;
					case 'create_err':
						$('#alert-probador-error').fadeIn(1000);
						$('#span-alert-error-probadores').html('Hubo un error al crear el probador');
					break;
				}
			}
		}
	});
}

function modificar_tienda_probador(id_tienda, id_probador, cod_probador, activo){
	base_url = $('#base_url').val();
	var data = new FormData();
	
	data.append('id_probador', id_probador);
	data.append('id_tienda', id_tienda);
	data.append('cod_probador', cod_probador);
	data.append('probador_activado', activo);

	$.ajax({
		data:data,
		url:base_url+'probadores/modificar_tienda_probador',
		processData:false,
		contentType:false,
		cache:false,
		type:'post',
		dataType:'json',
		success:function(data){
			if(typeof(data.id_tienda_err) == 'undefined' ){
				//do nothing
			}else{
				switch(data.id_probador_err){
					case 'err001': $('#input_id_probador').css('border','1px solid red').attr('placeholder','Requerido');
					break;
					case 'err002': $('#input_id_probador').css('border','1px solid red').attr('placeholder','6 caracteres');;
					break;
					case 'err003': $('#input_id_probador').css('border','1px solid red').attr('placeholder','6 caracteres');;
					break;
				}
			}

			if(typeof(data.id_tienda_err) == 'undefined'){

			}else{
				switch(data.id_tienda_err){
					case 'err001':
						$('#alert-probador-error').fadeIn(1000);
						$('#span-alert-error-probadores').html('Debe seleccionar una tienda para poder crear un nuevo probador');
					break;
				}
			}

			if(typeof(data.valid) == 'undefined'){

			}else{
				switch(data.valid){
					case 'err_exist':
						$('#alert-probador-error').fadeIn(1000);
						$('#span-alert-error-probadores').html('Este codigo ya esta asignado, intenta con otro.');
						$('#input_id_probador').css('border','1px solid red');
					break;
					case 'update_ok':
						$('#alert-probador-ok').fadeIn(1000);
						setTimeout(function(){
							$('#alert-probador-ok').fadeOut(1000);
						},2000);
						setTimeout(cargar_probador_dashboard, 3000);
					break;
					case 'update_err':
						$('#alert-probador-error').fadeIn(1000);
						$('#span-alert-error-probadores').html('Hubo un error al modificar el probador');
					break;
				}
			}
		}
	});
}

$(document).on('click','#no-activo-probador',function(){
	$('#si-activo-probador').removeClass('active');
	$('#no-activo-probador').addClass('active');
	$('#probador_activado').val(0);
});

$(document).on('click','#si-activo-probador',function(){
	$('#no-activo-probador').removeClass('active');
	$('#si-activo-probador').addClass('active');
	$('#probador_activado').val(1);
});


$(document).on('click','#btn-refresh-tiendas-probador', function(){
	cargar_tiendas_probadores();
});

$(document).on('click','#btn-agregar-probador',function(){
	vista_agregar_probador();
});

$(document).on('click','#btn-guardar-probador',function(){
	var id_tienda = $('#id_tienda_asociada').val();
	var id_probador = $('#input_id_probador').val();
	var activo = $('#probador_activado').val();

	asociar_tienda_probador(id_tienda, id_probador, activo);
});

$(document).on('click','#btn-modificar-probador',function(){
	var id_tienda = $('#id_tienda_asociada').val();
	var cod_probador = $('#input_id_probador').val();
	var id_probador = $('#hidden_id_probador').val();
	var activo = $('#probador_activado').val();

	modificar_tienda_probador(id_tienda, id_probador, cod_probador, activo);
});

$(document).on('click','#close-alert-error',function(){
	$('#alert-probador-error').fadeOut(1000);
});

$(document).on('focusin','#input_id_probador',function(){
	onfocusin(this);
	$(this).attr('placeholder','Cod Probador');
	$(this).removeAttr('value');
});

$(document).on('focusout','#input_id_probador',function(){
	onfocusout(this);
	$(this).attr('placeholder','Cod Probador');
});

function onfocusin(selector){
	$(selector).css('border','1px solid #02a1ce');
}

function onfocusout(selector){
	$(selector).css('border','1px solid #cfcfcf');
}