<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Probadores_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function loadprobadores($id_tienda){
		$this->db->where('id_tienda', $id_tienda);
		return $this->db->get('probadores');
	}

	public function count_all_probadores($id_admin){
		$this->db->where('id_admin', $id_admin);
		$res = $this->db->get('probadores');
		return count($res->result());
	}

	public function count_probador_activo(){
		$this->db->where('id_tienda', $_SESSION['id_tienda']);
		$this->db->where('estado_probador', '1');
		$activos = $this->db->get('probadores');
		return count($activos->result());
	}

	public function cargar_tiendas_probador(){
		$this->db->where('id_admin', $_SESSION['id_admin']);
		return $this->db->get('tiendas');
	}

	//CREAR UN NUEVO PROBADOR
	public function guardar_probador($data){
		return $this->db->insert('probadores', $data);
	}

	public function modificar_probador($id_probador, $data){
		$this->db->where('id_probador', $id_probador);
		return $this->db->update('probadores', $data);
	}

	public function probador_ya_existe($cod_probador, $id_tienda){
		$this->db->where('cod_probador', $cod_probador);
		$this->db->where('id_tienda', $id_tienda);
		$probadores = $this->db->get('probadores');
		if(count($probadores->row()) > 0){
			return true;
		}else{
			return false;
		}
	}

	public function modificar_probador_ya_existe($id_probador, $cod_probador, $id_tienda){
		$this->db->where('cod_probador', $cod_probador);
		$this->db->where('id_tienda', $id_tienda);
		$probador = $this->db->get('probadores');
		$prob = $probador->row();
		
		if(count($prob) > 0){
			if($prob->id_probador == $id_probador){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}

	public function get_probador_tienda($id_probador){
		$this->db->where('id_probador', $id_probador);
		$probador = $this->db->get('probadores');
		$pro_sel = $probador->row();
		$this->db->where('id_tienda', $pro_sel->id_tienda);
		$tienda = $this->db->get('tiendas');
		return array('probador' => $probador->row(), 'tienda' => $tienda->row());
	}
}