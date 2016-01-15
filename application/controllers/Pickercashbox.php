<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickercashbox extends CI_Controller {

	var $web;

	function __construct(){
		parent::__construct();
		$this->load->model('Pcashbox_model');
		$this->web = base_url();
	}

	//FUNCION PRINCIPAL (primera en ejecutarse al abrir el controlador)
	public function index()
	{
	}

	public function get_pickers_from_database(){
		//if(isset($_SESSION['id_user']) && isset($_SESSION['current_user'])){
			//$id_admin = $this->input->post('id_admin');
			$id_admin = 1;
			$id_tienda = 3;
			$contador = 0;
			$probadores = $this->Pcashbox_model->get_pickers_from_database($id_tienda);
			

			if($probadores->result_array() == null){
				echo json_encode(array('err' => 'null'));
				exit();
			}
			$datos = array();
			foreach($probadores->result_array() as $probador){
				$nombre = 'picker_'.$contador;
				$data = array(
					'id_probador' => $probador['id_probador'],
					'id_tienda' => $probador['id_tienda'],
					
					'numero_probador' => $probador['numero_probador'],
					'estado_probador' => $probador['estado_probador'],
					'active_probador' => $this->Pcashbox_model->check_active_picker($id_admin, $probador['id_probador'])
					);
				//echo json_encode(array($nombre => $data));
				$contador++;
				$datos[$nombre] = $data;
			}

			echo json_encode($datos);
		//}else{
			//show_404();
		//}
	}

	public function get_product_by_sku(){
		//$id_admin = $this->input->post('id_admin');
		//$sku_producto = $this->input->post('sku_producto');

		$id_admin = "1"; //$_SESSION['id_user'];
		$sku_producto = "SKU001";

		$producto_seleccionado = $this->Pcashbox_model->get_prod_by_sku($id_admin,$sku_producto);

		$json_product = array(
			'id_prod' => $producto_seleccionado->id_prod,
			'sku_prod' => $producto_seleccionado->sku_prod,
			'id_adm_prod' => $producto_seleccionado->id_admin_producto,
			'nombre_prod' => $producto_seleccionado->nombre_prod,
			'activo_prod' => $producto_seleccionado->activo_prod,
			'desc_breve_prod' => $producto_seleccionado->desc_breve_prod,
			'descripcion_prod' => $producto_seleccionado->descripcion_prod,
			'precio_mayorista_prod' => $producto_seleccionado->precio_mayorista_prod,
			'precio_venta_prod' => $producto_seleccionado->precio_venta_prod,
			'precio_venta_iva_prod' => $producto_seleccionado->precio_venta_iva_prod,
			'impuesto_prod' => $producto_seleccionado->impuesto_prod,
			'txt_stock_prod' => $producto_seleccionado->texto_stock_prod,
			'txt_no_stock_prod' => $producto_seleccionado->texto_no_stock_prod,
			'fecha_disponible_prod' => $producto_seleccionado->fecha_disponible_prod,
			'cantidad_prod' => $producto_seleccionado->cantidad_prod
			);
		echo json_encode($json_product);
	}

	public function add_init_product(){
		//$id_admin = $_SESSION['id_user'];
		$id_probador = $this->input->post('id_probador');
		$sku_producto = $this->input->post('sku_producto');
		$cantidad_prod = $this->input->post('cantidad_prod');

		$id_admin = 1; //$_SESSION['id_user'];
		//$id_probador = 'PRO001';
		//$sku_producto = $sku;
		//$cantidad_prod = $cant;

		$prod_existe = $this->Pcashbox_model->producto_existe($id_admin, $sku_producto);
		if ($prod_existe == 0){
			//Error no existe producto sku invalido
			echo json_encode(array('valid' => '0'));
			exit();
		}else if($prod_existe == 2){
			//producto duplicado
			echo json_encode(array('valid' => '2'));
			exit();
		}

		$this->Pcashbox_model->agregar_al_carrito($id_admin, $id_probador, $sku_producto, $cantidad_prod);
		echo json_encode(array('valid' => 'ok'));

		//valido
	}

	public function leer_carrito(){
		$id_admin = 1;
		$id_probador = 'PRO001';
		$contador = 0;

		$id_probador = $this->input->post('id_probador');

		$carrito = $this->Pcashbox_model->leer_carrito($id_admin, $id_probador);
		foreach($carrito->result() as $producto){
			$nombre = 'prod_'.$contador;
			$sku_producto_sel = $producto->sku_producto;
			$producto_sel = $this->Pcashbox_model->get_prod_by_sku($id_admin, $sku_producto_sel);
			$data = array(
				'id_prod' => $producto_sel->id_prod,'sku_prod' => $producto_sel->sku_prod,
				'id_admin_prod' => $producto_sel->id_admin_producto, 'nombre_prod' => $producto_sel->nombre_prod,
				'activo_prod' => $producto_sel->activo_prod, 'desc_breve_prod' => $producto_sel->desc_breve_prod,
				'descripcion_prod' => $producto_sel->descripcion_prod, 'precio_mayorista_prod' => $producto_sel->precio_mayorista_prod,
				'precio_venta_prod' => $producto_sel->precio_venta_prod, 'precio_venta_iva_prod' => $producto_sel->precio_venta_iva_prod,
				'impuesto_prod' => $producto_sel->impuesto_prod, 'txt_stock_prod' => $producto_sel->texto_stock_prod,
				'txt_no_stock_prod' => $producto_sel->texto_no_stock_prod, 'cantidad_prod' => $producto_sel->cantidad_prod);
			$contador++;
			$datos[$nombre] = $data;
		}

		echo json_encode($datos);
	}
}