/*$(document).on('click','#', function(){

});
*/

var base_url = $('#base_url').val();

$(document).on('click','#btn-lista-tendencias', function(){
	$('#btn-lista-tendencias').addClass('active');
	$('#btn-productos-tendencias').removeClass('active');
	cargar_vistas_tendencias('tendencias_dashboard');
});

$(document).on('click','#btn-productos-tendencias', function(){
	$('#btn-lista-tendencias').removeClass('active');
	$('#btn-productos-tendencias').addClass('active');
	cargar_vistas_tendencias('tendencias_productos_dashboard');
});

function cargar_vistas_tendencias(vista){
	$.ajax({
		url:base_url+'dashboard/loadviewdashboard/'+vista,
		success:function(data){
			$('#main-section').html(data);
			if(vista == 'tendencias_dashboard'){
				loadTendencias();
			}else{
				loadProdTendencias();
			}
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

function loadProdTendencias(){
	$.ajax({
		url:base_url+'tendencias/get_prod_tendencias',
		processData:false,
		contentType:false,
		dataType:'json',
		success:function(data){
			if(data.result == 'ok'){
				$('#tabla-prod-tendencias').after(data.html);
			}

			if(data.result == 'err'){
				$('#tabla-prod-tendencias').html(data.html);
			}
			
		}
	});
}