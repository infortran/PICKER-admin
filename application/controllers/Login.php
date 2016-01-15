<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		if(!empty($_SESSION['usuario'])){
			header('location:'.base_url().'dashboard');
		}
		$this->load->view('admin_login');
	}

	public function verificardatos()
	{
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
				
		      
			$email = $this->input->post('email-user'); 
			$password = $this->input->post('password-user');

			if ($email != null && $password != null)
			{
				$this->load->model('login_model');
				if($this->login_model->check_admin($email,$password)){
					$this->load->model('Pprobador_model');
					$admin = $this->Pprobador_model->getUser($email);
					$id_admin = $admin->id_admin;
					$this->session->set_userdata('usuario',$email);
					$this->session->set_userdata('id_admin', $id_admin);
					echo 'ok';
				}else{
					echo 'error';
				}
			}else{
				header('location:'.base_url().'login');
			}
		}
		else {
			header('location:'.base_url().'login');
		}
	}

	public function logout()
	{
		
		unset($_SESSION['usuario']);
		session_destroy();
		header('location:'.base_url());
	}
} 