<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion_pullpo extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->model('Pprobador_model');
		//$this->web = base_url();
	}

	//FUNCION PRINCIPAL (primera en ejecutarse al abrir el controlador)
	public function index()
	{
		$this->load->view('admin_pullpo/login');
	}
}