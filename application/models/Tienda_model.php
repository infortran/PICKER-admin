<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();

	}

	public function contartiendas(){
		$nro_tiendas = $this->db->get('tiendas');
		$nro_tiendas = $nro_tiendas->result_array();
		$conteo = count($nro_tiendas);
		return $conteo;
	}



	public function agregartienda($datos){//array : boolean
		return $this->db->insert('tiendas',$datos);
	}

	public function actualizarTienda($id,$datos){//array : boolean
		$this->db->where('id_tienda',$id);
		return $this->db->update('tiendas',$datos);
	}

	public function modificartienda($idtienda){//id int : boolean
		
	}

	public function eliminartienda($id_admin, $idtienda){//id int : boolean
		$this->db->where('id_admin', $id_admin);
		$this->db->delete('tiendas',array('id_tienda' => $idtienda));
		return $this->db->affected_rows();
	}

	//obtener todos los datos de las tiendas en un array
	//el valor retornado debe ser procesado con result_array() method
	public function getstores($id_admin){
		$this->db->where('id_admin', $id_admin);
		return $this->db->get('tiendas');
	}

	public function getOneStore($id_tienda){
		$this->db->where('id_admin', $_SESSION['id_admin']);
		$this->db->where('id_tienda', $id_tienda);
		return $this->db->get('tiendas');
	}

	public function countOneStore($id){
		$this->db->where('id_admin', $_SESSION['id_admin']);
		$this->db->where('id_tienda', $id);
		$tiendaExiste = $this->db->get('tiendas');
		$tiendaExiste = $tiendaExiste->result_array();
		$tiendaExiste = count($tiendaExiste);
		return $tiendaExiste;
	}

	public function get_tienda($id_tienda){
		$this->db->where('id_tienda', $id_tienda);
		$tienda = $this->db->get('tiendas');
		$tienda = $tienda->row();
		return $tienda;
	}
}