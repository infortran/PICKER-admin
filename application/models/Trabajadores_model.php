<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trabajadores_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function checkWorker($run){//RETURN INT
		$this->db->where('run_trabajador',$run);
		$query = $this->db->get('trabajadores');
		$res = $query->result();
		return count($res);
	}

	public function getWorkerByRun($run){//RETURN WORKER
		$this->db->where('run_trabajador',$run);
		return $this->db->get('trabajadores');
	}

	public function getWorkers(){
		return $this->db->get('trabajadores');
	}

	public function insertWorker($data){
		return $this->db->insert('trabajadores',$data);
	}

	public function updateWorker($run, $data){
		$this->db->where('run_trabajador',$run);
		return $this->db->update('trabajadores',$data);
	}

	public function confirmPass($run,$old_pass){
		$this->db->where('run_trabajador',$run);
		$query = $this->db->get('trabajadores');
		$query = $query->row();
		if($old_pass == $query->password_trabajador){
			return true;
		}else{
			return false;
		}
	}

	public function deleteWorker($run){
		$this->db->where('run_trabajador',$run);
		$this->db->delete('trabajadores');
		return $this->db->affected_rows();
	}

}