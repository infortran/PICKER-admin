<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pcashbox_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_prod_by_sku($id_admin,$sku_prod){
		$this->db->where('id_admin_producto', $id_admin);
		$this->db->where('sku_prod', $sku_prod);
		$producto = $this->db->get('productos');
		return $producto->row();
	}

	public function leer_carrito($id_admin, $id_probador){
		$this->db->where('id_admin', $id_admin);
		$this->db->where('id_probador', $id_probador);
		return $this->db->get('carrito');
	}

	public function agregar_al_carrito($id_admin, $id_probador, $sku_producto, $cantidad_prod){
		$data = array(
			'id_admin' => $id_admin,
			'id_probador' => $id_probador,
			'sku_producto' => $sku_producto,
			'cantidad_prod' => $cantidad_prod
			);
		$this->db->where('sku_producto',$sku_producto);
		$this->db->where('id_admin', $id_admin);
		$this->db->where('id_probador', $id_probador);
		$carrito = $this->db->get('carrito');

		if(count($carrito->row()) > 0){
			$carro = $carrito->row();
			$nueva_cantidad = $carro->cantidad_prod + $cantidad_prod;
			$this->db->where('sku_producto', $sku_producto);
			$this->db->where('id_admin', $id_admin);
			$this->db->where('id_probador', $id_probador);
			$this->db->update('carrito', array('cantidad_prod' => $nueva_cantidad));
		}else{
			$this->db->insert('carrito', $data);
		}
		
	}

	public function producto_existe($id_admin,$sku_producto){
		$this->db->where('id_admin_producto',$id_admin);
		$this->db->where('sku_prod',$sku_producto);
		$prod = $this->db->get('productos');
		if(count($prod->row()) == 0){
			return 0;
		}else{
			$contar_prod = count($prod->row());
			if($contar_prod > 1){
				return 2;
			}else{
				return 1;
			}
		}
	}

	public function get_pickers_from_database($id_tienda){
		//$this->db->where('id_tienda',$id_tienda);
		$this->db->where('id_tienda',$id_tienda);
		return $this->db->get('probadores');
	}

	public function check_active_picker($id_admin, $id_probador){
		$this->db->where('id_probador_activo',$id_probador);
		$this->db->where('id_admin_activo', $id_admin);
		$result = $this->db->get('pickers_activos');
		if(count($result->result_array()) > 0){
			//PICKER ACTIVO TRUE
			return true;
		}else{
			//PICKER ACTIVO FALSE
			return false;
		}
	}
}