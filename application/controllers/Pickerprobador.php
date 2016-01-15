<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickerprobador extends CI_Controller {

	var $web;

	function __construct(){
		parent::__construct();
		$this->load->model('Pprobador_model');
		$this->web = base_url();
	}

	//FUNCION PRINCIPAL (primera en ejecutarse al abrir el controlador)
	public function index()
	{
	}

	//LOGIN FRAGMENT
	public function check_login_and_get_user_data(){
		$this->form_validation->set_rules('email','err','required|trim|valid_email');
		$this->form_validation->set_rules('password','err','required|trim');
		$this->form_validation->set_message('required','%s001');
		$this->form_validation->set_message('valid_email', '%s004');
		$this->form_validation->set_error_delimiters('','');

		if($this->form_validation->run() == false){
			$error = array(
				'err_email' => form_error('email'),
				'err_password' => form_error('password')
			);
			echo json_encode($error);
			exit();
		}

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user_valid = $this->Pprobador_model->check_user_login($email,$password);

		switch($user_valid){
			case 0: 
				$data_user = $this->Pprobador_model->getUser($email);
				$name = $data_user->nombre_admin;
				$lastname = $data_user->apellido_admin;
				$id_user = $data_user->id_admin;

				$android_data = array(
					'user_id' => $id_user,
					'user_name' => $name,
					'user_last_name' => $lastname,
					'user_email' => $email,
					);
				echo json_encode(array(
						'valid' => 'ok',
						'data' => $android_data
					));
			break;
			case 1: echo json_encode(array('valid'=>'err_pass')) ;
			break;
			case 2: echo json_encode(array('valid'=>'err_user')) ;
			break;
			default: echo json_encode(array('valid'=>'err_unk'));
		}
	}

	public function verificar_producto_inicial(){
		$id_tienda = $this->input->post('id_tienda');
		$cod_probador = $this->input->post('id_probador');

		//$id_tienda = '7';
		//$cod_probador = 'PRO007';

		$probador_seleccionado = $this->Pprobador_model->get_probador_by_cod($cod_probador, $id_tienda);

		if(count($probador_seleccionado->result_array()) > 0){
			$prob = $probador_seleccionado->row();
			$carrito = $this->Pprobador_model->get_productos_from_carrito($id_tienda, $prob->id_probador);
			if(count($carrito->result_array()) > 0){
				//en el carrito tendremos el id del producto y su cantidad
				//necesitamo obtener una tendencia de acuerdo a ese producto por lo tanto
				//debemos buscar en la tabla tendenciaproducto con el id del producto y obtener su tendencia
				//luego debemos buscar todos los productos con esa tendencia y presentar su id
				//con ese id lograremos obtener el resto de los datos de los productos
				$producto_carrito = $carrito->row();

				$tendencia = $this->Pprobador_model->get_tendencia_by_prod_id($producto_carrito->id_producto);

				if(count($tendencia->result_array()) > 0){
					$id_tendencia = $tendencia->row();
					$id_tendencia = $id_tendencia->id_tendencia;

					$productos_tendencias = $this->Pprobador_model->get_prods_by_tendencia($id_tendencia);
					$contador = 0;
					$data = array();
					
					foreach($productos_tendencias->result() as $prod){
						$prod_sel_from_prods = $this->Pprobador_model->get_product_by_id($prod->id_producto);
						$prod_sel_from_prods = $prod_sel_from_prods->row();
						if($prod->id_producto != $producto_carrito->id_producto && $prod_sel_from_prods->id_tienda == $id_tienda){
							$nombre = 'prod_'.$contador;
							$data[$nombre] = $prod_sel_from_prods;
						}
						
						$contador++;
					}
					echo json_encode(array('valid' => 'ok', 'productos_relacionados' => $data));
				}else{
					//no hay tendencias
					//echo 'no hay tendencias';
					echo json_encode(array('valid' => 'err_tendencias'));
				}
			}else{
				//no hay productos en el carrito
				//echo 'no hay productos en carrito';
				echo json_encode(array('valid' => 'err_prods'));
			}
		}else{
			//no hay probadores con estos id
			//echo 'no hay probadores con estos ids';
			echo json_encode(array('valid' => 'err_probs'));
		}

		/*if($this->Pprobador_model->check_active_picker_by_tienda($id_tienda, $id_probador)){
			echo json_encode(array('valid' => 'ok'));
		}else{
			echo json_encode(array('valid' => 'err'));
		}*/
		
	}

	//CONFIG TIENDA FRAGMENT
	public function ingresar_id_picker(){

		//$this->form_validation->set_rules('id_tienda','err','required|max_legth[20]');
		$this->form_validation->set_rules('id_picker','err','required|max_length[6]');

		$this->form_validation->set_message('required','%s001');
		$this->form_validation->set_message('max_length', '%s007');
		$this->form_validation->set_error_delimiters('','');

		if($this->form_validation->run() == false){
			echo json_encode(
				array(
					'err_id_picker' => form_error('id_picker')
					)
			);
			exit();
		}

		
		$cod_picker = $this->input->post('id_picker');
		$id_user = $this->input->post('id_user');
		$cod_tienda = $this->input->post('id_tienda');
		
		

		//comprobar tienda
		if($this->Pprobador_model->check_tienda($cod_tienda, $id_user)){
			echo json_encode(array('valid' => 'errTienda'));
			exit();
		}
		//comprobar probador
		$probador = $this->Pprobador_model->get_probador_from_cod_picker($cod_picker, $cod_tienda, $id_user);
		
		if(count($probador->result_array()) > 0){
			$select_probador = $probador->row();
			$tienda = $this->Pprobador_model->get_tienda_from_id($select_probador->id_tienda);
			$tienda_nueva = $tienda->row();
			
			$data = array(
				'id_tienda' => $tienda_nueva->id_tienda,
				'cod_tienda' => $tienda_nueva->cod_tienda,
				'nombre_tienda' => $tienda_nueva->nombre_tienda
				);
			echo json_encode(array('valid' => 'ok', 'data' => $data));
		}else{
			echo json_encode(array('valid' => 'errNoPicker'));
		}
	}


	

	public function add_picker_to_active(){
		$id_admin = $this->input->post('id_admin');
		$id_probador = $this->input->post('id_probador');

		$activar = $this->Pprobador_model->add_picker_to_active($id_admin, $id_probador);

		echo json_encode(array('activar' => $activar));
		
	}

	public function finalizar_venta_probador(){
		$id_admin = $this->input->post('id_admin');
		$id_probador = $this->input->post('id_probador');

		$desactivar = $this->Pprobador_model->delete_picker_from_active($id_admin, $id_probador);

		echo json_encode(array('desactivar' => $desactivar));
	}

	public function products_on_cart(){
		//$id_tienda = 1;
		//$id_probador = 2;
		$id_tienda = $this->input->post('id_tienda');
		$id_probador = $this->input->post('id_probador');

		$contador = 0;
		$cantidad_en_carro = 0;

		$probador_en_uso = $this->Pprobador_model->get_probador_by_cod($id_probador,$id_tienda);
		if(count($probador_en_uso->result_array()) == 0){
			echo json_encode(array('valid' => 'err_probador'));
			exit();
		}
		$probador_en_uso = $probador_en_uso->row();
		$carrito = $this->Pprobador_model->products_on_cart($id_tienda,$probador_en_uso->id_probador);
		$count_carrito = count($carrito->result_array());
		if($count_carrito == 0){
			echo json_encode(array('valid' => 'err_carrito'));
			exit();
		}
		foreach($carrito->result() as $productOnCart){
			$nombre = 'prod_'.$contador;
			$id_producto = $productOnCart->id_producto;
			$cantidad_cada_prod = $productOnCart->cantidad_prod;
			$cantidad_en_carro += $cantidad_cada_prod;
			$prod_seleccionado = $this->Pprobador_model->get_prod_by_id($id_producto);
			if(count($prod_seleccionado) == 0){
				echo json_encode(array('valid' => 'err_producto'));
				exit();
			}
			$json_product = array(
				'id_prod' => $prod_seleccionado->id_prod,
				'sku_prod' => $prod_seleccionado->sku_prod,
				'nombre_prod' => $prod_seleccionado->nombre_prod,
				'activo_prod' => $prod_seleccionado->activo_prod,
				'desc_breve_prod' => $prod_seleccionado->desc_breve_prod,
				'descripcion_prod' => $prod_seleccionado->descripcion_prod,
				'precio_mayorista_prod' => $prod_seleccionado->precio_mayorista_prod,
				'precio_venta_prod' => $prod_seleccionado->precio_venta_prod,
				'precio_venta_iva_prod' => $prod_seleccionado->precio_venta_iva_prod,
				'impuesto_prod' => $prod_seleccionado->impuesto_prod,
				'txt_stock_prod' => $prod_seleccionado->texto_stock_prod,
				'txt_no_stock_prod' => $prod_seleccionado->texto_no_stock_prod,
				'fecha_disponible_prod' => $prod_seleccionado->fecha_disponible_prod,
				'cantidad_prod' => $prod_seleccionado->cantidad_prod
				);
			$datos[$nombre] = $json_product;
			$contador++;
		}
		$datos['cantidad_prod_on_cart'] = $cantidad_en_carro;
		$datos['id_tienda'] = $id_tienda;
		$datos['id_probador'] = $id_probador;
		$datos['sku_producto'] = $count_carrito;
		echo json_encode($datos);
	}

	public function cargar_tiendas(){
		$id_admin = $this->input->post('id_admin');
		$contador = 0;

		$tiendas = $this->Pprobador_model->cargar_tiendas($id_admin);
		$count_tiendas = count($tiendas->result());

		foreach ($tiendas->result() as $tienda) {
			$nombre = 'tienda_'.$contador;
			$json_tienda = array(
				'id_tienda' => $tienda->id_tienda,
				'cod_tienda' => $tienda->cod_tienda,
				'nombre_tienda' => $tienda->nombre_tienda,
				'owner_tienda' => $tienda->owner_tienda,
				'dir_tienda' => $tienda->dir_tienda,
				'tel_tienda' => $tienda->tel_tienda,
				'web_tienda' => $tienda->web_tienda,
				'email_tienda' => $tienda->email_tienda
				);
			$datos[$nombre] = $json_tienda;
			$contador++;
		}
		echo json_encode($datos);

	}

	public function cargar_producto_por_id(){
		$id = $this->input->post('id_producto');
		//$id = 20;
		$producto = $this->Pprobador_model->get_prod_by_id($id);
		if(count($producto) == 0){
			echo json_encode(array('valid' => 'err_producto'));
			exit();
		}
		echo json_encode($producto);
	}
}