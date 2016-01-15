//ADD VAR

var run_trab = $('.run_trabajador');
var id_trab = $('.id_trabajador');
var nombre_trab = $('.nombre_trabajador');
var cargo_trab = $('.cargo_trabajador');
var password_trab = $('.password_trabajador');
var dir_trab = $('.dir_trabajador');
var tel_trab = $('.tel_trabajador');
var email_trab = $('.email_trabajador');
var comision_trab = $('.comision_trabajador');
var img_trab = $('.image_trabajador');

var btn_agregar_trab = $('#btn-agregar-trabajador');

//UPDATE VAR
var run_trab_up = $('.run_trabajador_up');
var id_trab_up = $('.id_trabajador_up');
var nombre_trab_up = $('.nombre_trabajador_up');
var cargo_trab_up = $('.cargo_trabajador_up');
var password_trab_up = $('.password_trabajador_up');
var dir_trab_up = $('.dir_trabajador_up');
var tel_trab_up = $('.tel_trabajador_up');
var email_trab_up = $('.email_trabajador_up');
var comision_trab_up = $('.comision_trabajador_up');
var img_trab_up = $('.image_trabajador_up');
var img_min_up = $('.img-min-trab');
var img_trab_hidden = $('#img-hidden-trabajador');

var btn_modif_trab = $('#btn-modificar-trab');
var run_hidden_trab = $('#run_hidden_trabajador');
var btn_modif_trab_modal = $('#btn-modificar-trabajador-modal');

var old_pass = $('.old-pass-worker');
var new_pass = $('.new-pass-worker');
var repeat_pass = $('.repeat-pass-worker');
var btn_modif_pass = $('#btn-modif-pass');

var btn_eliminar = $('#btn-eliminar-trabajador');


var base_url = $('#base_url').val();

//FUNCION PARA AGREGAR UN TRABAJADOR
btn_agregar_trab.click(function(){

	//CAPTURAR LAS VARIABLES EN UN FORMDATA
	var data = new FormData();
	data.append('run_trabajador_agregar',run_trab.val());
	data.append('id_trabajador_agregar',id_trab.val());
	data.append('nombre_trabajador_agregar',nombre_trab.val());
	data.append('cargo_trabajador_agregar',cargo_trab.val());
	data.append('password_trabajador_agregar',password_trab.val());
	data.append('dir_trabajador_agregar',dir_trab.val());
	data.append('tel_trabajador_agregar',tel_trab.val());
	data.append('email_trabajador_agregar',email_trab.val());
	data.append('comision_trabajador_agregar',comision_trab.val());
	data.append('image_trabajador_agregar', img_trab[0].files[0]);
	data.append('image_default_trabajador', 'default-user.png');

	//ENVIAR POR AJAX JQUERY
	$.ajax({
		data:data,
		url:base_url+'trabajadores/agregar',
		cache: false,
        contentType: false,
        processData: false,
        dataType:'json',
        type:'post',
        success:function(json){
        	//RECIBIR LA RESPUESTA DEL SERVIDOR
        	var jsonData = [
        		json.run_trab_valid,
        		json.id_trab_valid,		//0
        		json.nombre_trab_valid,	//1
        		json.cargo_trab_valid,	//2
        		json.password_trab_valid,	//3
        		json.dir_trab_valid,		//4
        		json.tel_trab_valid,		//5
        		json.email_trab_valid,	//6
        		json.comision_trab_valid,	//7
        		json.image_trab_valid		//8
        	];

        	var selector = [run_trab,id_trab,nombre_trab,cargo_trab,password_trab,
        		dir_trab,tel_trab,email_trab,comision_trab,img_trab];

        	var type = ['run_trabajador_agregar','id_trabajador_agregar','nombre_trabajador_agregar','cargo_trabajador_agregar',
        		'password_trabajador_agregar','dir_trabajador_agregar','tel_trabajador_agregar','email_trabajador_agregar',
        		'comision_trabajador_agregar','image_trabajador_agregar'];


        	for(var i = 0; i < jsonData.length; i++){
				if(typeof(jsonData[i]) == 'undefined'){
					//DO NOTHING
				}else{
					if(jsonData[i] != ''){
						if(jsonData[i] == 'err'){
							alertWithError(i);
						}else{
							redBorder(selector[i]);
							errorForm(jsonData[i], type[i], selector[i]);
						}
					}
				}//else
			}//for
			if(typeof(json.valid) == 'undefined'){

			}else{
				//comprobar si la variable es ok o err
				if(json.valid == 'ok'){
					alert('Trabajador agregado correctamente');
					cleanFormUpdate(selector);
					$('#modalAgregarTrabajador').modal('hide');
				}else{
					alert('hubo un problema al agregar al trabajador');
				}
			}
			readWorkers();
        }//success
	});

});


//FUNCION PARA MODIFICAR UN TRABAJADOR
btn_modif_trab.click(function(){

	var data = new FormData();
	data.append('run_trabajador_agregar',run_trab_up.val());
	data.append('id_trabajador_agregar',id_trab_up.val());
	data.append('nombre_trabajador_agregar',nombre_trab_up.val());
	data.append('cargo_trabajador_agregar',cargo_trab_up.val());
	data.append('password_trabajador_agregar','nopassword');
	data.append('dir_trabajador_agregar',dir_trab_up.val());
	data.append('tel_trabajador_agregar',tel_trab_up.val());
	data.append('email_trabajador_agregar',email_trab_up.val());
	data.append('comision_trabajador_agregar',comision_trab_up.val());
	data.append('image_trabajador_agregar', img_trab_up[0].files[0]);
	data.append('image_default_trabajador', img_trab_hidden.val());

	$.ajax({
		data:data,
		url:base_url+'trabajadores/agregar',
		cache: false,
        contentType: false,
        processData: false,
        dataType:'json',
        type:'post',
        success:function(json){
        	var jsonData = [
        		json.run_trab_valid,
        		json.id_trab_valid,		//0
        		json.nombre_trab_valid,	//1
        		json.cargo_trab_valid,	//2
        			//3
        		json.dir_trab_valid,		//4
        		json.tel_trab_valid,		//5
        		json.email_trab_valid,	//6
        		json.comision_trab_valid,	//7
        		json.image_trab_valid		//8
        	];

        	var selector = [run_trab_up,id_trab_up,nombre_trab_up,cargo_trab_up,
        		dir_trab_up,tel_trab_up,email_trab_up,comision_trab_up,img_trab_up];

        	var type = ['run_trabajador_agregar','id_trabajador_agregar','nombre_trabajador_agregar','cargo_trabajador_agregar',
        		'dir_trabajador_agregar','tel_trabajador_agregar','email_trabajador_agregar',
        		'comision_trabajador_agregar','image_trabajador_agregar'];


        	for(var i = 0; i < jsonData.length; i++){
				if(typeof(jsonData[i]) == 'undefined'){
					//DO NOTHING
				}else{
					if(jsonData[i] != ''){
						if(jsonData[i] == 'err'){
							alertWithError(i);
						}else{
							redBorder(selector[i]);
							errorForm(jsonData[i], type[i], selector[i]);
						}
					}
				}//else
			}//for
			if(typeof(json.valid) == 'undefined'){
				//DO NOTHING
			}else{
				if(json.valid == 'ok'){
					alert('datos modificados correctamente');
					loadWorker(run_trab_up.val());
				}else if(json.valid == 'err_old'){
					redBorder(old_pass);
					old_pass.attr('placeholder','Contrasena erronea').val();
				}else if(json.valid == 'err_repeat'){
					redBorder(repeat_pass);
					repeat_pass.attr('placeholder','Las contrasenas deben coincidir').val();
				}else{
					alert('Hubo un error al tratar de cambiar la contrasena');
				}
			}
			readWorkers();
        }//success
	});

});

btn_modif_pass.click(function(){
	var data = new FormData();

	data.append('run',run_hidden_trab.val());
	data.append('old_pass',old_pass.val());
	data.append('new_pass',new_pass.val());
	data.append('repeat_pass',repeat_pass.val());

	$.ajax({
		data:data,
		url:base_url+'trabajadores/changeWorkerPass',
		cache: false,
        contentType: false,
        processData: false,
        dataType:'json',
        type:'post',
        success:function(json){
        	var jsonData = [
        		json.old_pass_valid,
        		json.new_pass_valid,		//0
        		json.repeat_pass_valid,	//11
        	];

        	var selector = [old_pass,new_pass,repeat_pass];

        	var type = ['old_pass','new_pass','repeat_pass'];


        	for(var i = 0; i < jsonData.length; i++){
				if(typeof(jsonData[i]) == 'undefined'){
					//DO NOTHING
				}else{
					if(jsonData[i] != ''){
						if(jsonData[i] == 'err_old'){
							alertWithError(i);//modificar la comprobacion del pass old repeat y err update-->
						}else{
							redBorder(selector[i]);
							errorForm(jsonData[i], type[i], selector[i]);
						}
					}
				}//else
			}//for
			//mensaje cuando se hayan hecho los cambios exitosamente-->
			//alert(json.valid);
			if(typeof(json.valid) == 'undefined'){
				//DO NOTHING
			}else{
				if(json.valid == 'ok'){
					alert('contrasena modificada correctamente');
					old_pass.css('border','1px solid #cfcfcf');
					new_pass.css('border','1px solid #cfcfcf');
					repeat_pass.css('border','1px solid #cfcfcf');
					var limpieza = [old_pass,new_pass,repeat_pass];
					cleanFormUpdate(limpieza);
					$('#panelChangePass').collapse('hide');

				}else if(json.valid == 'err_old'){
					redBorder(old_pass);
					old_pass.attr('placeholder','Contrasena erronea').val('');

				}else if(json.valid == 'err_repeat'){
					redBorder(repeat_pass);
					repeat_pass.attr('placeholder','Las contrasenas deben coincidir').val();

				}else if(json.valid == 'err_modif'){
					alert('no se ha modificado la contrasena');
				}else{
					alert('Hubo un error al tratar de cambiar la contrasena');
				}
			} 
			readWorkers();

        }//success
	});
});

btn_modif_trab_modal.click(function(){

	var trabajador = $('#trabajador-temp').val();
	var url = base_url+'trabajadores/getWorker';
	
	var data = new FormData();
	data.append('run_trabajador',trabajador);

	//cargar los datos de la db en el formulario

	//LEER DESDE BASE DE DATOS
	$.ajax({
		type:'post',
		url:base_url+'trabajadores/getWorker',
		data:data,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',
		success:function(json){
			var img = base_url+'assets/uploads/img/'+json.img_trabajador;
			//RETORNAR UN JSON
			run_trab_up.val(json.run_trabajador);
			run_hidden_trab.val(json.run_trabajador);
			id_trab_up.val(json.id_trabajador);
			nombre_trab_up.val(json.nombre_trabajador);
			cargo_trab_up.val(json.cargo_trabajador);
			dir_trab_up.val(json.dir_trabajador);
			tel_trab_up.val(json.tel_trabajador);
			email_trab_up.val(json.email_trabajador);
			comision_trab_up.val(json.comision_trabajador);
			img_trab_hidden.val(json.img_trabajador);
			img_min_up.attr('src',img);

		}
	});

});

btn_eliminar.click(function(){
	var trabajador = $('#trabajador-temp').val();
	$('#codigo-objeto-eliminar').val(trabajador);
	$('#objeto-eliminar').val(1);
	$('#modal-eliminar').modal('show');
});

$('#modalEliminar').on('hide.bs.modal',function(){
	readWorkers();
});


$('#btn-aside-vendedores').click(function(){
	buttonSel('btn-div-vendedores','btn-div-cuenta','btn-div-kpi','btn-div-productos','btn-div-probadores');
	readWorkers();
	//funcion que activa y desactiva el link de carga

});

//MODAL VER TRABAJADOR
function loadWorker(idWorker){
	var base_url = $('#base_url').val();

	var id = new FormData();
	id.append('run_trabajador',idWorker);

	$.ajax({
		data:id,
		cache:false,
		contentType:false,
		processData:false,
		type:'post',
		url:base_url+'trabajadores/getWorker',
		dataType:'json',
		success:function(json){
			var img = base_url+'assets/uploads/img/'+json.img_trabajador;
			$('#span-nombre-trabajador').text(json.nombre_trabajador);
			$('#span-id-trabajador').text(json.id_trabajador);
			$('#span-cargo-trabajador').text(json.cargo_trabajador);
			$('#span-comision-trabajador').text(json.comision_trabajador);
			$('#span-correo-trabajador').text(json.email_trabajador);
			$('#span-dir-trabajador').text(json.dir_trabajador);
			$('#span-tel-trabajador').text(json.tel_trabajador);
			$('.div-image-trabajador img').attr('src',img);
			$('#trabajador-temp').val(json.run_trabajador);
		}
	});
}

//LEER TODOS LOS TRABAJADORES EN LA PAGINA PRINCIPAL
function readWorkers(){
	var nro_tiendas = $('#nro_tiendas').val();
	var base_url = $('#base_url').val();

	if(nro_tiendas > 0){
		url = base_url+'trabajadores';
	}else{
		url = base_url+'dashboard/loaddefaultview';
	}
	$.ajax({
		url:url,
		type:'post',
		cache:false,
		success:function(data){
			$('#main-section').html(data);
			$.ajax({
				url:base_url+'trabajadores/get_rows_workers',
				type:'post',
				cache:false,
				beforeSend:function(){
					$('.loading').show();
				},
				success:function(data){
					$('.loading').hide();
					$('.worker-row').after(data);
				}
			});
		}
	});

	
}



//COLORES AZULES DE LOS BOTONES 
function buttonSel(a,b,c,d,e){
	$('#'+a).addClass('btn-div-selected');
	$('#'+b).removeClass('btn-div-selected');
	$('#'+c).removeClass('btn-div-selected');
	$('#'+d).removeClass('btn-div-selected');
	$('#'+e).removeClass('btn-div-selected');
}

//PREVISUALIZACION DE LA MINIATURA AL SUBIR UNA IMAGEN
function previewImage(input){
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('.img-preview').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

//si hay cambios en el input activar la funcion para mostrar imagen en miniatura
$('.image_trabajador').change(function(){
	previewImage(this);
});


function errorForm(val, type, selector){
	var error = '';
	switch (val){
		case type+'001':error = 'Campo requerido';
		break;
		case type+'002':error = 'Minimo de caracteres';
		break;
		case type+'003':error = 'Maximo de caracteres';
		break;
		case type+'004':error = 'formato de correo no valido';
		break;
		case type+'005':error = 'Las contraseñas deben coincidir';
		break;
		default:error = 'Error desconocido';
	}
	selector.attr('placeholder',error).val('');
}

//FUNCION PARA ESTABLECER BORDES ROJOS DE UN INPUT
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

//BORDES VERDES PARA IGUALDAD DE CAMPOS DE CONTRASEÑA
repeat_pass.keyup(function(){
	if(new_pass.val() == repeat_pass.val()){
		new_pass.css('border','1px solid green');
		repeat_pass.css('border','1px solid green');
	}
});

//FOCUS IN Y FOCUS OUT DE LOS INPUT

id_trab.focusin(function(){onfocusin(this,'ID Trabajador')}).focusout(function(){onfocusout(this)});
nombre_trab.focusin(function(){onfocusin(this,'Nombre completo')}).focusout(function(){onfocusout(this)});
cargo_trab.focusin(function(){onfocusin(this,'Cargo')}).focusout(function(){onfocusout(this)});
dir_trab.focusin(function(){onfocusin(this,'Direccion')}).focusout(function(){onfocusout(this)});
tel_trab.focusin(function(){onfocusin(this,'Telefono')}).focusout(function(){onfocusout(this)});
email_trab.focusin(function(){onfocusin(this,'Correo electronico')}).focusout(function(){onfocusout(this)});
password_trab.focusin(function(){onfocusin(this,'Contrasena')}).focusout(function(){onfocusout(this)});
comision_trab.focusin(function(){onfocusin(this,'Comision')}).focusout(function(){onfocusout(this)});

id_trab_up.focusin(function(){onfocusin(this,'ID Trabajador')}).focusout(function(){onfocusout(this)});
nombre_trab_up.focusin(function(){onfocusin(this,'Nombre completo')}).focusout(function(){onfocusout(this)});
cargo_trab_up.focusin(function(){onfocusin(this,'Cargo')}).focusout(function(){onfocusout(this)});
dir_trab_up.focusin(function(){onfocusin(this,'Direccion')}).focusout(function(){onfocusout(this)});
tel_trab_up.focusin(function(){onfocusin(this,'Telefono')}).focusout(function(){onfocusout(this)});
email_trab_up.focusin(function(){onfocusin(this,'Correo electronico')}).focusout(function(){onfocusout(this)});
comision_trab_up.focusin(function(){onfocusin(this,'Comision')}).focusout(function(){onfocusout(this)});

old_pass.focusin(function(){onfocusin(this,'Ingrese antigua contrasena')}).focusout(function(){onfocusout(this)});
new_pass.focusin(function(){onfocusin(this,'Ingrese nueva contrasena')}).focusout(function(){onfocusout(this)});
repeat_pass.focusin(function(){onfocusin(this,'Verificar nueva contrasena')}).focusout(function(){
	if(new_pass.val() == repeat_pass.val()){
		repeat_pass.css('border','1px solid green');
	}else{
		repeat_pass.css('border','1px solid #cfcfcf');
		new_pass.css('border','1px solid #cfcfcf');
	}
});

function onfocusin(selector,human_name){
	$(selector).css('border','1px solid #02a1ce').attr('placeholder',human_name);
}

function onfocusout(selector){
	$(selector).css('border','1px solid #cfcfcf');
}

//limpiar formulario
function cleanFormUpdate(selector){
	for(var i = 0; i < selector.length; i++){
		selector[i].val('');
	}
}