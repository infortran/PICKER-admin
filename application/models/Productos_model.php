<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_product($id_prod){
		$this->db->where('id_prod', $id_prod);
		$producto = $this->db->get('productos');
		return $producto->row();
	}

	public function loadproducts($id_admin, $id_tienda){
		
		$this->db->where('id_tienda', $id_tienda);
		return $this->db->get('productos');
	}

	public function load_img_products($id){
		$this->db->where($id,'id_producto');
		return $this->db->get('img_productos');
	}

	public function count_all_products($id_admin, $id_tienda){
	
		$this->db->where('id_tienda',$id_tienda);
		$res = $this->db->get('productos');
		return count($res->result());
	}

	public function count_products_by_admin($id_admin,$id_tienda){
		
		$this->db->where('id_tienda',$id_tienda);
		$resultado = $this->db->get('productos');
		return count($resultado->result());
	}

	public function count_active_products($id_admin,$id_tienda){
		$this->db->where('activo_prod',1);
		
		$this->db->where('id_tienda',$id_tienda);
		$res = $this->db->get('productos');
		return count($res->result());
	}

	public function count_inactive_products($id_admin,$id_tienda){
		$this->db->where('activo_prod',0);
		
		$this->db->where('id_tienda',$id_tienda);
		$res = $this->db->get('productos');
		return count($res->result());
	}

	public function count_nostock_products($id_admin,$id_tienda){
		$this->db->where('cantidad_prod',0);
		
		$this->db->where('id_tienda',$id_tienda);
		$res = $this->db->get('productos');
		return count($res->result());
	}

	public function get_all_pormayor($id_admin,$id_tienda){
		
		$this->db->where('id_tienda',$id_tienda);
		$mayor = $this->db->get('productos');
		$total_mayorista = 0;
		foreach($mayor->result_array() as $prod){
			$total_mayorista += $prod['precio_mayorista_prod']; 
		}
		return $total_mayorista;
	}

	public function get_all_precioventa($id_admin,$id_tienda){
		
		$this->db->where('id_tienda',$id_tienda);
		$venta = $this->db->get('productos');
		$total_venta = 0;
		foreach($venta->result_array() as $prod){
			$total_venta += $prod['precio_venta_prod']; 
		}
		return $total_venta;
	}

	public function agregar_nuevo_prod($data){
		try{
			$this->db->insert('productos',$data);
			return true;
		}catch(Exception $e){
			return false;
		}
	}

	public function check_sku($sku,$id_admin,$id_tienda){
		$this->db->where('sku_prod',$sku);
		
		$this->db->where('id_tienda',$id_tienda);
		
		$productos = $this->db->get('productos');
		$sku_count = count($productos->result());
		if($sku_count > 0){
			return $sku_count;
		}else{
			return 0;
		}
	}

	public function cargar_tabla_atributos($id_producto){
		$this->db->where('id_producto', $id_producto);
		return $this->db->get('combinacion_producto');
	}

}