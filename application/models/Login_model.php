<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();

	}


	public function check_admin($mail, $pass){
		//Obtener al usuario por su correo
		
		$this->db->where('email_admin', $mail);
		$query = $this->db->get('administrador');
		$usuario = $query->result_array();

		//si el usuario existe continuamos 
		if($usuario != null)
		{
			$passComp = $usuario[0];
			//si el password corresponde autorizamos el ingreso
			if($passComp['password_admin'] == $pass)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}//Creado para recibir respuesta de usuario incorrecto y pass incorrecto
	
}