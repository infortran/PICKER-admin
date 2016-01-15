$(document).ready(function(){

	$("body").tooltip({ selector: '[data-toggle=tooltip]' });
	//vars
	var base_url = $('#base_url').val();
	var nro_tiendas = $('#nro_tiendas').val();
	//init views
	readKpi();
	loadDropdownTiendas();

	//btn kpi
	$('#btn-aside-kpi').click(function(){
		buttonSelected('btn-div-kpi','btn-div-cuenta','btn-div-vendedores','btn-div-productos','btn-div-probadores','btn-div-tendencias');
		readKpi();
	});

	//btn vendedores
	
	//btn productos
	$('#btn-aside-productos').click(function(){
		buttonSelected('btn-div-productos','btn-div-cuenta','btn-div-kpi','btn-div-vendedores','btn-div-probadores','btn-div-tendencias');
		readView('productos_dashboard');
	});

	//btn probadores
	$('#btn-aside-probadores').click(function(){
		buttonSelected('btn-div-probadores','btn-div-cuenta','btn-div-kpi','btn-div-vendedores','btn-div-productos','btn-div-tendencias');
		readView('probadores_dashboard');
	});

	$('#btn-aside-tendencias').click(function(){
		buttonSelected('btn-div-tendencias','btn-div-probadores','btn-div-cuenta','btn-div-kpi','btn-div-vendedores','btn-div-productos');
		readView('tendencias_dashboard');
	});

	


	//btn navbar tiendas para mostrar el modal-ver-tiendas
	$('#btn-navbar-tiendas').click(function(){
		$('#alerta-tienda-eliminada').hide();
		loadStoreView();
	});

	//BOTON Y FUNCION ELIMINAR ELEMENTOS
	$('#btn-conf-eliminar').click(function(){
		var id = $('#codigo-objeto-eliminar').val();
		var object = $('#objeto-eliminar').val();
		eliminar(object,id);
	});



	function eliminar(objeto,id){
		
		var msjeAlert;
		switch(objeto){
			case '0':
				var url = base_url+'dashboard/eliminartienda';
				msjeAlert = 'Tienda eliminada';
			break;
			case '1':
				var url = base_url+'trabajadores/delete';
				msjeAlert = 'Trabajador eliminado';
			break;
			case '2':
				var url = base_url+'productos/delete';
				msjeAlert = 'Producto eliminado';
			break;
			default: var url = ''; msjeAlert = 'error';
		}
		
		var data = new FormData();
		data.append('id', id);

		$.ajax({
			data:data,
			cache:false,
			contentType:false,
			processData:false,
			type:'post',
			url:url,
			dataType:'json',
			success:function(json){
				
				$('#modalEliminar').modal('hide');
			}
		});
	}

	function loadProducts(){
		$.ajax({
			url:base_url+'productos/loadproducts',
			success:function(data){
				$('.fila-busqueda-producto').after(data);
			}
		});
	}

	function loadTendencias(){
		$.ajax({
			url:base_url+'tendencias/get_tendencias',
			processData:false,
			contentType:false,
			dataType:'json',
			success:function(data){
				if(data.result == 'ok'){
					$('#tabla-tendencias').after(data.html);
				}

				if(data.result == 'err'){
					$('#tabla-tendencias').html(data.html);
				}
				
			}
		});
	}

	function loadProbador(){
		$.ajax({
			url:base_url+'probadores/loadprobadores',
			success:function(data){
				$('.fila-busqueda-probador').after(data);
			}
		});
	}

	$('#btn-aceptar-tienda-ok').click(function(){
		$('#modalTiendaOk').modal("hide");
		$('#modalAgregarTienda').modal('hide');
		cleanForm('agregar');
		loadStoreView();
		loadDropdownTiendas();
	});

	$('#btn-cerrar-agregar').click(function(){
		cleanForm('agregar');
	});

	$('#btn-cerrar-modificar').click(function(){
		cleanForm('modificar');
	});
	

	//funcion botones visual
	function buttonSelected(a,b,c,d,e,f){
		$('#'+a).addClass('btn-div-selected');
		$('#'+b).removeClass('btn-div-selected');
		$('#'+c).removeClass('btn-div-selected');
		$('#'+d).removeClass('btn-div-selected');
		$('#'+e).removeClass('btn-div-selected');
		$('#'+f).removeClass('btn-div-selected');
	}

	//LEER LAS VISTAS DEL DASHBOARD
	function readView(view){
		if(nro_tiendas > 0){
			$.ajax({
				url:base_url+'dashboard/loadviewdashboard/'+view,
				type:'post',
				success:function(data){
					$('#main-section').html(data);
					if(view == 'productos_dashboard')
					{
						loadProducts();
					}

					if(view == 'probadores_dashboard')
					{
						loadProbador();
					}

					if(view == 'tendencias_dashboard')
					{
						loadTendencias();
					}
				}
			});
		}else{
			$.ajax({
				url:base_url+'dashboard/loaddefaultview',
				type:'post',
				success:function(data){
					$('#main-section').html(data);
				}
			});
		}
	}

	function readKpi(){
		if(nro_tiendas > 0){
			$.ajax({
				url:base_url+'dashboard/loadkpiview',
				type:'post',
				success:function(data){
					$('#main-section').html(data);
				}
			});
		}else{
			$.ajax({
				url:base_url+'dashboard/loaddefaultview',
				type:'post',
				success:function(data){
					$('#main-section').html(data);
				}
			});
		}
	}

	
	//Cargar las tarjetas tienda en el body del modal tiendas
	function loadStoreView(){
		$.ajax({
			url:base_url+'dashboard/loadviewstores',
			type:'post',
			success:function(data){
				$('#modal-body-tiendas').html(data);
			}
		});
	}

	
	$('#id_tienda_agregar').focusin(function(){
		$(this).css('border','1px solid #02a1ce').attr('placeholder','Codigo de tienda');
	});
	$('#id_tienda_agregar').focusout(function(){
		$(this).css('border','1px solid #cfcfcf');
	});

	$('#nombre_tienda_agregar').focusin(function(){
		$(this).css('border','1px solid #02a1ce').attr('placeholder','Nombre de tienda');
	});
	$('#nombre_tienda_agregar').focusout(function(){
		$(this).css('border','1px solid #cfcfcf');
	});

	$('#jefe_tienda_agregar').focusin(function(){
		$(this).css('border','1px solid #02a1ce').attr('placeholder','Jefe de tienda');
	});
	$('#jefe_tienda_agregar').focusout(function(){
		$(this).css('border','1px solid #cfcfcf');
	});

	$('#dir_tienda_agregar').focusin(function(){
		$(this).css('border','1px solid #02a1ce').attr('placeholder','Direccion');
	});
	$('#dir_tienda_agregar').focusout(function(){
		$(this).css('border','1px solid #cfcfcf');
	});

	$('#web_tienda_agregar').focusin(function(){
		$(this).css('border','1px solid #02a1ce').attr('placeholder','Sitio Web');
	});
	$('#web_tienda_agregar').focusout(function(){
		$(this).css('border','1px solid #cfcfcf');
	});

	$('#email_tienda_agregar').focusin(function(){
		$(this).css('border','1px solid #02a1ce').attr('placeholder','Correo electronico');
	});
	$('#email_tienda_agregar').focusout(function(){
		$(this).css('border','1px solid #cfcfcf');
	});

	$('#tel_tienda_agregar').focusin(function(){
		$(this).css('border','1px solid #02a1ce').attr('placeholder','Telefono');
	});
	$('#tel_tienda_agregar').focusout(function(){
		$(this).css('border','1px solid #cfcfcf');
	});

	$('#form_agregar_tienda').submit(function(e){
		e.preventDefault();

		var _id_tienda = $('#id_tienda_agregar').val();
		var _nombre_tienda = $('#nombre_tienda_agregar').val();
		var _jefe_tienda = $('#jefe_tienda_agregar').val();
		var _dir_tienda = $('#dir_tienda_agregar').val();
		var _email_tienda = $('#email_tienda_agregar').val();
		var _web_tienda = $('#web_tienda_agregar').val();
		var _tel_tienda = $('#tel_tienda_agregar').val();

		var datos = new FormData();
		datos.append('id_tienda',_id_tienda);
		datos.append('nombre_tienda',_nombre_tienda);
		datos.append('jefe_tienda',_jefe_tienda);
		datos.append('dir_tienda',_dir_tienda);
		datos.append('email_tienda',_email_tienda);
		datos.append('web_tienda',_web_tienda);
		datos.append('tel_tienda',_tel_tienda);
		datos.append('upload_img_agregar', $('#upload_img_agregar')[0].files[0] );
		datos.append('img_default', 'default-store.png');

		$.ajax({
			data:datos,
			cache: false,
            contentType: false,
            processData: false,
			type:'post',
			dataType:'json',
			url:base_url+'dashboard/guardartienda',
			success:function(data){
				if(data.id_tienda_valid != ''){
					$('#id_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('id',data.id_tienda_valid,'Codigo tienda',10)).val('');
				}

				if(data.nombre_tienda_valid != ''){
					$('#nombre_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('nombre',data.nombre_tienda_valid,'Nombre tienda',0)).val('');
				}

				if(data.jefe_tienda_valid != ''){
					$('#jefe_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('jefe',data.jefe_tienda_valid,'Jefe tienda',0)).val('');
				}

				if(data.dir_tienda_valid != ''){
					$('#dir_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('dir',data.dir_tienda_valid,'Direccion',0)).val('');
				}

				if(data.web_tienda_valid != ''){
					$('#web_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('web',data.web_tienda_valid,'Sitio web',0)).val('');
				}

				if(data.email_tienda_valid != ''){
					$('#email_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('email',data.email_tienda_valid,'Email',0)).val('');
				}

				if(data.tel_tienda_valid != ''){
					$('#tel_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('tel',data.tel_tienda_valid,'Telefono',0)).val('');
				}

				if(data.img_tienda_valid == ''){
					$('#modalTiendaOk').modal('show');//cargar modal en la vista
				}

				if(data.img_tienda_valid == 'errNameImg'){
					alert('no hay una nueva imagen');
				}

				if(data.img_tienda_valid == 'errNoImg'){
					alert('Por favor ingrese una imagen valida');
				}

				if(data.img_tienda_valid == 'errAjaxRequest'){
					alert('error en la peticion Ajax');
				}
				
			}

		});
	});

	$('#form_modificar_tienda').submit(function(e){
		e.preventDefault();

		var _id_tienda = $('#id_tienda_modificar').val();
		var _nombre_tienda = $('#nombre_tienda_modificar').val();
		var _jefe_tienda = $('#jefe_tienda_modificar').val();
		var _dir_tienda = $('#dir_tienda_modificar').val();
		var _email_tienda = $('#email_tienda_modificar').val();
		var _web_tienda = $('#web_tienda_modificar').val();
		var _tel_tienda = $('#tel_tienda_modificar').val();
		var _img_default = $('#img_default_modificar').val();
		var modificar = $('#codigo-tienda-a-modificar').val();
		
		
		var datos = new FormData();
		datos.append('id_tienda',_id_tienda);
		datos.append('nombre_tienda',_nombre_tienda);
		datos.append('jefe_tienda',_jefe_tienda);
		datos.append('dir_tienda',_dir_tienda);
		datos.append('email_tienda',_email_tienda);
		datos.append('web_tienda',_web_tienda);
		datos.append('tel_tienda',_tel_tienda);
		datos.append('upload_img_agregar', $('#upload_img_modificar')[0].files[0] );
		datos.append('img_default', _img_default);
		datos.append('modificar', modificar);

		$.ajax({
			data:datos,
			cache: false,
            contentType: false,
            processData: false,
			type:'post',
			dataType:'json',
			url:base_url+'dashboard/guardartienda',
			success:function(data){
				if(data.id_tienda_valid != ''){
					$('#id_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('id',data.id_tienda_valid,'Codigo tienda',10)).val('');
				}

				if(data.nombre_tienda_valid != ''){
					$('#nombre_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('nombre',data.nombre_tienda_valid,'Nombre tienda',0)).val('');
				}

				if(data.jefe_tienda_valid != ''){
					$('#jefe_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('jefe',data.jefe_tienda_valid,'Jefe tienda',0)).val('');
				}

				if(data.dir_tienda_valid != ''){
					$('#dir_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('dir',data.dir_tienda_valid,'Direccion',0)).val('');
				}

				if(data.web_tienda_valid != ''){
					$('#web_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('web',data.web_tienda_valid,'Sitio web',0)).val('');
				}

				if(data.email_tienda_valid != ''){
					$('#email_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('email',data.email_tienda_valid,'Email',0)).val('');
				}

				if(data.tel_tienda_valid != ''){
					$('#tel_tienda_agregar').css('border','1px solid red').attr('placeholder', errorForm('tel',data.tel_tienda_valid,'Telefono',0)).val('');
				}

				if(data.img_tienda_valid == ''){
					$('#modalTiendaOk').modal('show');//cargar modal en la vista
				}

				if(data.img_tienda_valid == 'errNameImg'){
					alert('no hay una nueva imagen');
				}

				if(data.img_tienda_valid == 'errNoImg'){
					alert('Por favor ingrese una imagen valida');
				}

				if(data.img_tienda_valid == 'errAjaxRequest'){
					alert('error en la peticion Ajax');
				}
				
			}

		});
	});

	function errorForm(type, val, name, max_length){
		var error = '';
		switch (val){
			case type+'_tienda001':error = name+' es requerido';
			break;
			case type+'_tienda002':error = 'El minimo de caracteres permitidos es 3';
			break;
			case type+'_tienda003':error = 'El maximo de caracteres permitidos es '+max_length;
			break;
			case type+'_tienda004':error = 'formato de correo no valido';
			break;
			default:error = 'Error desconocido';
		}
		return error;
	}


	function cleanForm(form){
		$('#id_tienda_'+form).val('');
		$('#nombre_tienda_'+form).val('');
		$('#jefe_tienda_'+form).val('');
		$('#dir_tienda_'+form).val('');
		$('#web_tienda_'+form).val('');
		$('#email_tienda_'+form).val('');
		$('#tel_tienda_'+form).val('');
		$('#upload_img_'+form).val('');
		$('#img-form-'+form).attr('src', base_url+'assets/img/default-store.png');
	}

	function loadDropdownTiendas(){
		
		$.ajax({
			url:base_url+'dashboard/loadDropdownTiendas',
			type:'post',
			cache:false,
			contentType:false,
			processData:false,
			dataType:'json',
			success:function(data){
				$('#dropdown-tiendas').html(data.html);
				var tienda = data.tienda;
				$('#dropdown-nombre-tienda').html(tienda.nombre_tienda);
				$('#dropdown-nombre-tienda').val(tienda.id_tienda);
			}
		});
	}

	



	$('#btn-confirmar-eliminar').click(function(){
		var _id_tienda = $('#codigo-tienda-a-eliminar').val();
		var data = new FormData();
		data.append('id',_id_tienda);
		
		$.ajax({
			url:base_url+'dashboard/eliminartienda/',
			type:'post',
			data:data,
			contentType:false,
			processData:false,
			success:function(data){
				if(data == 'ok'){
					$('#alerta-tienda-eliminada').fadeIn(600);				
					$('#modal-confirmar-eliminar-tienda').modal('hide');
					loadStoreView();
					loadDropdownTiendas();

					setTimeout(function(){
						$('#alerta-tienda-eliminada').fadeOut(1000);
					},2000);

				}
				if(data == 'errNo'){
					alert('no se puede eliminar la tienda');
					$('#modal-confirmar-eliminar-tienda').modal('hide');
				}
				if(data == 'errId'){
					alert('Ha introducido un ID no valido');
					
					$('#modal-confirmar-eliminar-tienda').modal('hide');
				}	
				alert(data);
			}
		});
	});

	//FUNCION PARA PREVISUALIZAR LA IMAGEN
	function previewImage(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('.img-preview').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$('#upload_img_agregar').change(function(){
		previewImage(this);
	});

	$('#upload_img_modificar').change(function(){
		previewImage(this);
	});


});

function loadSessionDataStore(id_tienda){
		
		var data = new FormData();
		data.append('id_tienda', id_tienda);

		$.ajax({
			data:data,
			type:'post',
			url:base_url+'dashboard/loadsessiondatastore',
			processData:false,
			contentType:false,
			cache:false,
			success:function(data){
				
				location.href = base_url+'dashboard';
			}
		});
	}

function modalEliminar(id){	
	$('#codigo-tienda-a-eliminar').val(id);
	$('#modal-confirmar-eliminar-tienda').modal('show');
}

function modalModificar(id){
	$('#codigo-tienda-a-modificar').val(id);
	$('#modalModifTienda').modal('show');
	loadEditStore(id);
}

//Cargar los datos de una tienda en el modal para modificar
function loadEditStore(id){
	var base_url = $('#base_url').val();
	
	var data = new FormData();
	data.append('id_tienda', id);
	$.ajax({
		type:'post',
		data:data,
		processData:false,
		contentType:false,
		cache:false,
		dataType:'json',
		url:'dashboard/mostrartienda/',
		success:function(tienda){
			var img = base_url+'assets/uploads/img/'+tienda.img_tienda;
			
			$('#id_tienda_modificar').val(tienda.cod_tienda);
			$('#nombre_tienda_modificar').val(tienda.nombre_tienda);
			$('#jefe_tienda_modificar').val(tienda.owner_tienda);
			$('#dir_tienda_modificar').val(tienda.dir_tienda);
			$('#web_tienda_modificar').val(tienda.web_tienda);
			$('#email_tienda_modificar').val(tienda.email_tienda);
			$('#tel_tienda_modificar').val(tienda.tel_tienda);
			$('#preview-modif img').attr('src', img);
			$('#img_default_modificar').val(tienda.img_tienda);
		}
	});
}

