var btn_ir_agregar = $('#btn_agregar_producto');
var base_url = $('#base_url').val();
var vista_principal = $('#main-section');


var btn_info = $('#btn_info_add_prod');
var btn_precio = $('#btn_precio_add_prod');
var btn_cantidades = $('#btn_cantidad_add_prod');
var btn_imagenes = $('#btn_imagenes_add_prod');





//FORMULARIO AGREGAR


$(document).on('click','#btn-guardar-producto',function(){
	guardar_producto(false);
});

$(document).on('click', '#btn-modificar-producto', function(){
	guardar_producto(true);
});

function guardar_producto(modificar){
	var base_url = $('#base_url').val();
	var nombre_prod = $('#nombre-producto');
	var sku_prod = $('#sku-producto');
	var activo_prod = $('#producto-activado');
	var desc_breve_prod = $('#descrip-breve-producto');
	var descripcion_prod = $('#descripcion-producto');
	//precios
	var mayor_prod = $('#precio-mayor-producto');
	var venta_prod = $('#precio-venta-producto');
	var venta_iva_prod = $('#precio-venta-iva-producto');
	var impuesto_prod = $('#impuesto-select option:selected');
	//cantidades
	var cantidad_prod = $('#cantidad-producto');
	var txt_prod_stock = $('#txt-producto-stock');
	var txt_prod_nostock = $('#txt-producto-nostock');
	var prox_fecha_prod = $('#fecha-disponible-producto');
	//imagenes

	var datos = new FormData();
	datos.append('nombre_prod', nombre_prod.val());
	datos.append('sku_prod', sku_prod.val());
	datos.append('activo_prod', activo_prod.val());
	datos.append('desc_breve_prod', desc_breve_prod.val());
	datos.append('descripcion_prod', descripcion_prod.val());
	datos.append('mayor_prod', mayor_prod.val());
	datos.append('venta_prod', venta_prod.val());
	datos.append('venta_iva_prod', venta_iva_prod.val());
	datos.append('impuesto_prod', impuesto_prod.val());
	datos.append('cantidad_prod', cantidad_prod.val());
	datos.append('txt_prod_stock', txt_prod_stock.val());
	datos.append('txt_prod_nostock', txt_prod_nostock.val());
	datos.append('prox_fecha_prod', prox_fecha_prod.val());
	datos.append('modificar', modificar);
	

	$.ajax({
		url:base_url+'productos/guardar_producto',
		type:'post',
		data:datos,
		cache:false,
		dataType:'json',
		contentType:false,
		processData:false,
		success:function(data){
			var json = [
				data.nombre_err,
				data.sku_err,
				data.activo_err,
				data.desc_breve_err,
				data.descripcion_err,
				data.mayor_err,
				data.venta_err,
				data.venta_iva_err,
				data.impuesto_err,
				data.cantidad_err,
				data.txt_stock_err,
				data.txt_nostock_err,
				data.prox_fecha_err
			];

			var selector = [
				nombre_prod,
				sku_prod,
				activo_prod,
				desc_breve_prod,
				descripcion_prod,
				mayor_prod,
				venta_prod,
				venta_iva_prod,
				impuesto_prod,
				cantidad_prod,
				txt_prod_stock,
				txt_prod_nostock,
				prox_fecha_prod
			];
			
			for (var i = 0; i < json.length; i++){
				if(typeof(json[i]) == 'undefined'){
					//NOTHING
					
				}else{

					if(json[i] != ''){
						
						errorForm(json[i],selector[i]);
						redBorder(selector[i]);
					}
					
				}
			}

			if(typeof(data.valid) == 'undefined'){

			}else{
				/*if(data.valid == 'ok'){
					$('#alert-producto-ok').fadeIn(1200);
					setTimeout(loadProductView, 2000);
				}else{
					alert('hubo un error al agregar el producto');
				}*/

				switch(data.valid){
					case 'ok':
						$('#alert-producto-ok').fadeIn(1000);
						setTimeout(loadProductView, 3000);
						break;
					case 'err_sku':
						alert('SKU repetido');
						break;
					case 'err':
						$('#alert-producto-error').fadeIn(1000);
						setTimeout(function(){ 
							$('#alert-producto-error').fadeOut(1200);
						},2500);
					break;
				}
			}
		}
	});
}

function loadProductView(){
	$.ajax({
		url:base_url+'dashboard/loadviewdashboard/productos_dashboard',
		success:function(data){
			$('#main-section').html(data);
			loadProducts();
		}
	});
}



function loadProducts(){
	$.ajax({
		url:base_url+'productos/loadproducts',
		success:function(data){
			$('.fila-busqueda').after(data);
		}
	});
}

$(document).on('click','#btn-subir-img-producto', function(e){
	e.preventDefault();
	//parametros necesarios para subir una imagen
	/*
		- ID DEL ADMIN 
		- ID DE LA TIENDA
		- ID DEL PRODUCTO AL QUE ESTAMOS SUBIENDO LA IMAGEN
	*/

	//checkear que la imagen esta dentro del input
	//enviar imagen al controlador
	//recibir una respuesta del controlador
});

function subir_img_producto(id_admin, id_producto){
	var imagen_producto = $('#file-img-producto');
	var url = base_url+'controlador';

	var data = new FormData();
	data.append('id_admin_producto', id_admin);
	data.append('id_producto', id_producto);
	data.append('img_producto', imagen_producto[0].files[0]);

	$.ajax({
		data:data,
		type:'post',
		url:url,
		contentType:false,
		cache:false,
		processData:false,
		dataType:'json',
		success:function(json){
			
		}
	});
}



$(document).on('click','#btn_info_add_prod',function(){
	buttonAddProduct('btn_info_add_prod','btn_precio_add_prod','btn_cantidad_add_prod','btn_imagenes_add_prod','btn_atributos_add_prod');
	
	switchAddProduct('informacion','precio','cantidades','atributos','imagenes');
});

$(document).on('click','#btn_precio_add_prod',function(){
	buttonAddProduct('btn_precio_add_prod','btn_info_add_prod','btn_cantidad_add_prod','btn_imagenes_add_prod','btn_atributos_add_prod');
	
	switchAddProduct('precio','informacion','cantidades','atributos','imagenes');
});

$(document).on('click','#btn_cantidad_add_prod',function(){
	buttonAddProduct('btn_cantidad_add_prod','btn_precio_add_prod','btn_info_add_prod','btn_imagenes_add_prod','btn_atributos_add_prod');
	
	switchAddProduct('cantidades','precio','informacion','atributos','imagenes');
});

$(document).on('click','#btn_atributos_add_prod',function(){
	buttonAddProduct('btn_atributos_add_prod','btn_precio_add_prod','btn_info_add_prod','btn_imagenes_add_prod','btn_cantidad_add_prod');
	
	switchAddProduct('atributos','precio','informacion','cantidades','imagenes');
	$('#contenedor-editor-atributos').hide();
});

$(document).on('click','#btn_imagenes_add_prod',function(){
	buttonAddProduct('btn_imagenes_add_prod','btn_precio_add_prod','btn_cantidad_add_prod','btn_info_add_prod','btn_atributos_add_prod');
	switchAddProduct('imagenes','precio','cantidades','atributos','informacion');
	$('.img-producto-dinamico').hide();
});

$(document).on('click','#btn-eliminar-img-previa-producto',function(e){
	e.preventDefault();
	$('.imagen-dinamica-producto img').attr('src', '');
	$('.img-producto-dinamico').toggle(800);
});

$(document).on('change','#select-atributo',function(){
	
	var atributo = $('#select-atributo option:selected').val();
	switch(atributo){
		case 'talla-op': talla_seleccionada();
			break;
		case 'color-op': color_seleccionado();
			break;
		case 'talla-calzado-op':
			break;
	}
});

function talla_seleccionada(){
	var html = '<option value="">---</option> \
		<option value="s">S</option> \
		<option value="m">M</option> \
		<option value="l">L</option> \
		<option value="xl">XL</option>';
		$('#select-valor-atributo').html(html);
}

function color_seleccionado(){
	var html = '<option value="">---</option> \
	<option value="">Amarillo</option> \
	<option value="">Azul</option> \
	<option value="">Beige</option> \
	<option value="">Blanco</option> \
	<option value="">Camel</option> \
	<option value="">Gris</option> \
	<option value="">Gris pardo</option> \
	<option value="">Marron</option> \
	<option value="">Naranja</option> \
	<option value="">Negro</option> \
	<option value="">Rojo</option> \
	<option value="">Rosa</option> \
	<option value="">Verde</option>';
	$('#select-valor-atributo').html(html);
}

function cargar_tabla_atributos(id_producto){
	var data = new FormData();
	data.append('id_producto',id_producto);
	$.ajax({
		contentType:false,
		processData:false,
		data:data,
		type:'post',
		url:base_url+'productos/cargar_tabla_atributos',
		success:function(data){
			if(data == ''){
				$('#alert-table-atributos').show();
			}else{
				$('#alert-table-atributos').hide();
			}
			$('#table-atributos').after(data);
		}
	});
}

function ir_agregar_producto(){
	
	$.ajax({
		url:base_url+'productos/add_product',
		success:function(data){
			vista_principal.html(data);
			viewAddProduct();
			$('#alert-producto-ok').hide();
			
		}
	});
} 
function ir_modificar_producto(id_producto){
	var data = new FormData();
	data.append('id_producto', id_producto);
	
	$.ajax({
		url:base_url+'productos/update_product',
		contentType:false,
		processData:false,
		cache:false,
		data:data,
		type:'post',
		dataType:'json',
		success:function(data){
			vista_principal.html(data.html);
			var producto = data.producto;
			viewUpdateProduct(producto);
			$('#alert-producto-ok').hide();
			$('#alert-producto-error').hide();
			cargar_tabla_atributos(id_producto);
			
		}
	});
}

function viewAddProduct(){
	$.ajax({
		url:base_url+'productos/views_add',
		success:function(data){
			$('.div-dinamico-agregar-productos').html(data);
			switchAddProduct('informacion','precio','cantidades','atributos','imagenes');
		}
	});
}

function viewUpdateProduct(producto){
	$.ajax({
		url:base_url+'productos/views_update',
		success:function(data){
			$('.div-dinamico-modificar-productos').html(data);
			switchAddProduct('informacion','precio','cantidades','atributos','imagenes');

			$('#nombre-producto').val(producto.nombre_prod);
			$('#sku-producto').val(producto.sku_prod);
			//$('#producto-activado').val(producto.;
			$('#descrip-breve-producto').val(producto.desc_breve_prod);
			$('#descripcion-producto').val(producto.descripcion_prod);
			//precios
			$('#precio-mayor-producto').val(producto.precio_mayorista_prod);
			$('#precio-venta-producto').val(producto.precio_venta_prod);
			$('#precio-venta-iva-producto').val(producto.precio_venta_iva_prod);
			//$('#impuesto-select option:selected');
			//cantidades
			$('#cantidad-producto').val(producto.cantidad_prod);
			$('#txt-producto-stock').val(producto.texto_stock_prod);
			$('#txt-producto-nostock').val(producto.texto_no_stock_prod);
			//$('#fecha-disponible-producto').val(producto.;
		}
	});
}



function buttonAddProduct(id1,id2,id3,id4,id5){
	$('#'+id1+' li').addClass('active');
	$('#'+id2+' li').removeClass('active');
	$('#'+id3+' li').removeClass('active');
	$('#'+id4+' li').removeClass('active');
	$('#'+id5+' li').removeClass('active');
}

function switchAddProduct(a,b,c,d,e){
	$('#div-producto-'+a).removeClass('display-none');
	$('#div-producto-'+b).addClass('display-none');
	$('#div-producto-'+c).addClass('display-none');
	$('#div-producto-'+d).addClass('display-none');
	$('#div-producto-'+e).addClass('display-none');
}

function previewImage(input){
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('.imagen-dinamica-producto img').attr('src', e.target.result);
			$('.img-producto-dinamico').toggle(900);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

$(document).on('change','#file-img-producto',function(){
	previewImage(this);
	$('.imagen-dinamica-producto img').css('display','block');
});



$(document).on('click','#no-activo-producto',function(){
	$('#si-activo-producto').removeClass('active');
	$('#no-activo-producto').addClass('active');
	$('#producto-activado').val(0);
});

$(document).on('click','#si-activo-producto',function(){
	$('#no-activo-producto').removeClass('active');
	$('#si-activo-producto').addClass('active');
	$('#producto-activado').val(1);
});

//FUNCIONES PARA EL AUTO CALCULADO DE LOS PRECIOS 

$(document).on('keyup','#precio-venta-producto',function(){
	
	var iva = $('#impuesto-select option:selected').val();
	var venta = $('#precio-venta-producto').val();
	var venta_iva = (venta * iva) / 100;
	var venta_mas_iva = parseFloat(venta) + parseFloat(venta_iva);
	
	if(isNaN(venta_mas_iva)){
		$('#precio-venta-iva-producto').val('');
		$('.precio-final-span').html('0');
	}else{
		$('#precio-venta-iva-producto').val(venta_mas_iva);
		$('.precio-final-span').html(venta_mas_iva);
		$('.precio-sin-iva-span').html(venta);
	}
	
});

$(document).on('keyup','#precio-venta-iva-producto',function(){
	
	var iva = $('#impuesto-select option:selected').val();
	var venta_mas_iva = $('#precio-venta-iva-producto').val();
	var conversion = '1.'+iva;
	var venta_sin_iva = parseFloat(venta_mas_iva) / parseFloat(conversion);
	
	
	if(isNaN(venta_sin_iva)){
		$('#precio-venta-producto').val('');
		$('.precio-sin-iva-span').html('0');
	}else{
		$('#precio-venta-producto').val(venta_sin_iva);
		$('.precio-final-span').html(venta_mas_iva);
		$('.precio-sin-iva-span').html(venta_sin_iva);
	}
	
});





/*========== SISTEMA DE ERRORES =================*/

function errorForm(val, selector){
	var error = '';
	switch (val){
		case 'err001':error = 'Campo requerido';
		break;
		case 'err002':error = 'Minimo de caracteres';
		break;
		case 'err003':error = 'Maximo de caracteres';
		break;
		case 'err004':error = 'formato de correo no valido';
		break;
		case 'err005':error = 'Las contraseñas deben coincidir';
		break;
		case 'err006':error = 'El campo debe ser numérico';
		break;
		default:error = 'Error desconocido';
	}
	$(selector).attr('placeholder',error).val('');
}

//FUNCION PARA ESTABLECER BORDES ROJOS DE UN INPUT
function redBorder(selector){
	$(selector).css('border','1px solid red');
}

/*============ FUNCIONES FOCUS IN Y OUT =============*/

$(document).on('focusin','#nombre-producto',function(){onfocusin(this)});
$(document).on('focusin','#sku-producto',function(){onfocusin(this)});
$(document).on('focusin','#producto-activado',function(){onfocusin(this)});
$(document).on('focusin','#descrip-breve-producto',function(){onfocusin(this)});
$(document).on('focusin','#descripcion-producto',function(){onfocusin(this)});
//precios
$(document).on('focusin','#precio-mayor-producto',function(){onfocusin(this)});
$(document).on('focusin','#precio-venta-producto',function(){onfocusin(this)});
$(document).on('focusin','#precio-venta-iva-producto',function(){onfocusin(this)});

//cantidades
$(document).on('focusin','#cantidad-producto',function(){onfocusin(this)});
$(document).on('focusin','#txt-producto-stock',function(){onfocusin(this)});
$(document).on('focusin','#txt-producto-nostock',function(){onfocusin(this)});
$(document).on('focusin','#fecha-disponible-producto',function(){onfocusin(this)});

$(document).on('focusout','#nombre-producto',function(){onfocusout(this);$(this).attr('placeholder','')});
$(document).on('focusout','#sku-producto',function(){onfocusout(this);$(this).attr('placeholder','')});
$(document).on('focusout','#producto-activado',function(){onfocusout(this);$(this).attr('placeholder','')});
$(document).on('focusout','#descrip-breve-producto',function(){onfocusout(this);$(this).attr('placeholder','')});
$(document).on('focusout','#descripcion-producto',function(){onfocusout(this);$(this).attr('placeholder','')});
//precios
$(document).on('focusout','#precio-mayor-producto',function(){onfocusout(this);$(this).attr('placeholder','')});
$(document).on('focusout','#precio-venta-producto',function(){onfocusout(this);$(this).attr('placeholder','')});
$(document).on('focusout','#precio-venta-iva-producto',function(){onfocusout(this);$(this).attr('placeholder','')});

//cantidades
$(document).on('focusout','#cantidad-producto',function(){onfocusout(this);$(this).attr('placeholder','')});
$(document).on('focusout','#txt-producto-stock',function(){onfocusout(this);$(this).attr('placeholder','')});
$(document).on('focusout','#txt-producto-nostock',function(){onfocusout(this);$(this).attr('placeholder','')});
$(document).on('focusout','#fecha-disponible-producto',function(){onfocusout(this);$(this).attr('placeholder','')});



function onfocusin(selector){
	$(selector).css('border','1px solid #02a1ce');
}

function onfocusout(selector){
	$(selector).css('border','1px solid #cfcfcf');
}