<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendencias_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_tendencias(){
		$this->db->where('id_tienda', $_SESSION['id_tienda']);
		return $this->db->get('tendencias');
	}
}