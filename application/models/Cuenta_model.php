<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();

	}

	function getAdmin($email){
		$this->db->where('email_admin', $email);
		$result = $this->db->get('administrador');
		return $result->row();
	}

	function checkPasswordAdmin($email,$password){
		$where = 'email_admin = "'.$email.'"';
		$this->db->where($where);
		$result = $this->db->get('administrador');
		$result = $result->row();
		if($result != ''){
			if ($result->password_admin == $password){

				return true;
			}else{
				return false;
			}
		}else{
			return 'err';
		}
		
	}

	function updateAdmin($mail,$admin){
		$where = 'email_admin = "'.$mail.'"';
		$this->db->where($where); 
		return $this->db->update('administrador',$admin);
	}


}