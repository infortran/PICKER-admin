<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_totales($is_picker){
		$this->db->where('id_tienda', $_SESSION['id_tienda']);
		if($is_picker){
			$this->db->where('picker_venta', '1');
		}else{
			$this->db->where('picker_venta', '0');
		}
		$ventas_totales = $this->db->get('ventas');
		$conteo_ventas = count($ventas_totales);
		if($conteo_ventas > 0){
			$total_venta = 0;
			foreach($ventas_totales->result() as $venta){
				$total_venta += $venta->total_venta;
			}

			return $total_venta;
		}else{
			return 0;
		}
	}
}