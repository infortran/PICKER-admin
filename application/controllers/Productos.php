<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('productos_model');
	}

	//FUNCION PRINCIPAL (primera en ejecutarse al abrir el controlador)
	public function index()
	{

	}

	public function add_product(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$html = $this->load->view('productos/agregar_producto','',true);
			echo $html;
		}else{
			show_404();
		}
	}

	public function update_product(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){

			$id_producto = $this->input->post('id_producto');

			$producto = $this->productos_model->get_product($id_producto);

			$html = $this->load->view('productos/modificar_producto','',true);

			echo json_encode(array('html' => $html, 'producto' => $producto));
		}else{
			show_404();
		}
	}

	public function views_add(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$data_precio['var_data'] = 'precio';
			$data_cantidades['var_data'] = 'cantidades';
			$data_atributos['var_data'] = 'atributos';
			$data_imagenes['var_data'] = 'imagenes';

			$html = '';

			$html .= $this->load->view('productos/agregar_producto_informacion','',true);

			$html .= $this->load->view('productos/agregar_producto_disabled',$data_precio,true);
			
			$html .= $this->load->view('productos/agregar_producto_disabled',$data_cantidades,true);

			$html .= $this->load->view('productos/agregar_producto_disabled',$data_atributos,true);
			
			$html .= $this->load->view('productos/agregar_producto_disabled',$data_imagenes,true);			
			
			echo $html;
		}else{
			show_404();
		}
	}

	public function views_update(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$html = '';

			$data['id_admin'] = $_SESSION['id_admin'];

			$html .= $this->load->view('productos/agregar_producto_informacion','',true);

			$html .= $this->load->view('productos/agregar_producto_precio','',true);
			
			$html .= $this->load->view('productos/agregar_producto_cantidades','',true);

			$html .= $this->load->view('productos/agregar_producto_atributos','',true);
			
			$html .= $this->load->view('productos/agregar_producto_imagenes',$data,true);			
			
			echo $html;
		}else{
			show_404();
		}
	}

	//Cargar productos en la pagina principal dashboard productos
	public function loadproducts(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$html = '';
			$products = $this->productos_model->loadproducts($_SESSION['id_admin'], $_SESSION['id_tienda']);
			
			foreach ($products->result_array() as $row) {
				$data['row'] = $row;
				$html .= $this->load->view('productos/fila_producto',$data,true);
			}
			echo $html;
		}else{
			show_404();
		}
	}

	public function guardar_producto(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$this->form_validation->set_rules('nombre_prod', 'err','required|trim|min_length[4]');
			$this->form_validation->set_rules('sku_prod', 'err','required|trim|min_length[4]');
			$this->form_validation->set_rules('activo_prod', 'err','required|trim');
			$this->form_validation->set_rules('desc_breve_prod', 'err','required|trim|min_length[4]');
			$this->form_validation->set_rules('descripcion_prod', 'err','required|trim|min_length[4]');
			$this->form_validation->set_rules('mayor_prod', 'err','required|trim|min_length[4]|numeric');
			$this->form_validation->set_rules('venta_prod', 'err','required|trim|min_length[4]|numeric');
			$this->form_validation->set_rules('venta_iva_prod', 'err','required|trim|min_length[4]|numeric');
			$this->form_validation->set_rules('impuesto_prod', 'err','required|trim');
			$this->form_validation->set_rules('cantidad_prod', 'err','required|trim|numeric');
			$this->form_validation->set_rules('txt_prod_stock', 'err','required|trim|min_length[4]');
			$this->form_validation->set_rules('txt_prod_nostock', 'err','required|trim|min_length[4]');
			$this->form_validation->set_rules('prox_fecha_prod', 'err','required|trim|min_length[4]');

			$this->form_validation->set_message('required', '%s001');
			$this->form_validation->set_message('min_length', '%s002');
			$this->form_validation->set_message('max_length', '%s003');
			$this->form_validation->set_message('numeric', '%s006');
			$this->form_validation->set_error_delimiters('','');

			if($this->form_validation->run() == false){
				$error = array(
						'nombre_err' => form_error('nombre_prod'),
						'sku_err' => form_error('sku_prod'),
						'activo_err' => form_error('activo_prod'),
						'desc_breve_err' => form_error('desc_breve_prod'),
						'descripcion_err' => form_error('descripcion_prod'),
						'mayor_err' => form_error('mayor_prod'),
						'venta_err' => form_error('venta_prod'),
						'venta_iva_err' => form_error('venta_iva_prod'),
						'impuesto_err' => form_error('impuesto_prod'),
						'cantidad_err' => form_error('cantidad_prod'),
						'txt_stock_err' => form_error('txt_prod_stock'),
						'txt_nostock_err' => form_error('txt_prod_nostock'),
						'prox_fecha_err' => form_error('prox_fecha_prod')
					);
				echo json_encode($error);
				exit();
			}


		
			$nombre = $this->input->post('nombre_prod');
			$sku = $this->input->post('sku_prod');
			$activo = $this->input->post('activo_prod');
			$desc_breve = $this->input->post('desc_breve_prod');
			$descripcion = $this->input->post('descripcion_prod');
			$mayor = $this->input->post('mayor_prod');
			$venta = $this->input->post('venta_prod');
			$venta_iva = $this->input->post('venta_iva_prod');
			$impuesto = $this->input->post('impuesto_prod');
			$cantidad = $this->input->post('cantidad_prod');
			$txt_stock = $this->input->post('txt_prod_stock');
			$txt_nostock = $this->input->post('txt_prod_nostock');
			$prox_fecha = $this->input->post('prox_fecha_prod');

			$modificar = $this->input->post('modificar');

			//CHECKEAR SI EL SKU ESTA REPETIDO PARA EL MISMO USUARIO
			$repeat_sku = $this->productos_model->check_sku($sku,$_SESSION['id_admin']);
			if($repeat_sku == 1){
				echo json_encode(array('valid'=>'err_sku'));
				exit();
			}

			$data = array(
				'nombre_prod' => $nombre,
				'id_admin_producto' => $_SESSION['id_admin'],
				'sku_prod' => $sku,
				'activo_prod' => $activo,
				'desc_breve_prod' => $desc_breve,
				'descripcion_prod' => $descripcion,
				'precio_mayorista_prod' => $mayor,
				'precio_venta_prod' => $venta,
				'precio_venta_iva_prod' => $venta_iva,
				'impuesto_prod' => $impuesto,
				'cantidad_prod' => $cantidad,
				'texto_stock_prod' => $txt_stock,
				'texto_no_stock_prod' => $txt_nostock,
				'fecha_disponible_prod' => $prox_fecha
				);
			if($modificar){
				if($this->productos_model->modificar_prod($data)){
					echo json_encode(array('valid' => 'ok'));
				}else{
					echo json_encode(array('valid' => 'err'));
				}
			}else{
				if($this->productos_model->agregar_nuevo_prod($data)){
					echo json_encode(array('valid' => 'ok'));
				}else{
					echo json_encode(array('valid' => 'err'));
				}
			}
		}else{
			show_404();
		}
	}

	public function agregar_img_producto(){
		$id_admin = $this->input->post('id_admin_producto');
		$id_producto = $this->input->post('id_producto');
		$img_producto = $this->input->post('img_producto');

		
	}

	public function cargar_tabla_atributos(){
		$id_producto = $this->input->post('id_producto');
		$combinaciones = $this->productos_model->cargar_tabla_atributos($id_producto);
		$html = '';
		if(count($combinaciones->result_array()) > 0){
			foreach($combinaciones->result() as $combinacion){
				$html .= '<tr>
				<td>'.$combinacion->color_producto.'</td>
				<td>'.$combinacion->talla_producto.'</td>
				<td><button class="btn btn-default" onclick="modificar_atributos('.$id_producto.')" >Modificar</button></td>
				</tr>';
			}
		}
		echo $html;
	}

}