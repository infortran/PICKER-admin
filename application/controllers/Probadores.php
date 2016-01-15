<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Probadores extends CI_Controller {
	

	function __construct(){
		parent::__construct();
		$this->load->model('Probadores_model');
	}

	public function loadprobadores(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$html = '';
			$probadores = $this->Probadores_model->loadprobadores($_SESSION['id_tienda']);
			
			foreach ($probadores->result_array() as $row) {
				$data['row'] = $row;
				$html .= $this->load->view('probadores/fila-probador',$data,true);
			}
			echo $html;
		}else{
			echo $_SESSION['id_tienda'];
		}
	}

	public function views_add(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$html = '';

			$html .= $this->load->view('probadores/agregar_probador','',true);

			echo $html;
		}else{
			show_404();
		}
	}

	public function views_update(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){

			$id_probador = $this->input->post('id_probador');

			$probador = $this->Probadores_model->get_probador_tienda($id_probador);
			$data['probador'] = $probador['probador'];
			$data['tienda'] = $probador['tienda'];

			$html = '';

			$html .= $this->load->view('probadores/modificar_probador',$data,true);

			echo $html;
		}else{
			show_404();
		}
	}

	public function cargar_tiendas_probadores(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$html = '';

			$tiendas = $this->Probadores_model->cargar_tiendas_probador();

			foreach($tiendas->result() as $tienda){
				$data['tienda'] = $tienda;
				$html .= $this->load->view('probadores/fila-tienda-probador',$data,true);
			}

			echo $html;
		}else{
			show_404();
		}
	}

	public function asociar_tienda_probador(){
		$this->form_validation->set_rules('id_tienda', 'err', 'trim|required');
		$this->form_validation->set_rules('cod_probador', 'err', 'trim|required|min_length[6]|max_length[6]');

		$this->form_validation->set_message('required', '%s001');
		$this->form_validation->set_message('min_length', '%s002');
		$this->form_validation->set_message('max_length', '%s003');
		$this->form_validation->set_message('numeric', '%s006');
		$this->form_validation->set_error_delimiters('','');

		if($this->form_validation->run() == false){
			$error = array(
						'id_tienda_err' => form_error('id_tienda'),
						'id_probador_err' => form_error('cod_probador')
					);
				echo json_encode($error);
				exit();
		}

		$id_tienda = $this->input->post('id_tienda');
		$cod_probador = $this->input->post('cod_probador');
		$probador_activo = $this->input->post('probador_activado');

		//detectar si el probador ya existe
		if($this->Probadores_model->probador_ya_existe($cod_probador, $id_tienda)){
			echo json_encode(array('valid' => 'err_exist'));
			exit();
		}

		$data = array(
			'cod_probador' => $cod_probador,
			'id_tienda' => $id_tienda,
			'estado_probador' => $probador_activo);

		if($this->Probadores_model->guardar_probador($data)){
			echo json_encode(array('valid' => 'create_ok'));
		}else{
			echo json_encode(array('valid' => 'create_err'));
		}
		
	}

	public function modificar_tienda_probador(){
		$this->form_validation->set_rules('id_tienda', 'err', 'trim|required');
		$this->form_validation->set_rules('cod_probador', 'err', 'trim|required|min_length[6]|max_length[6]');

		$this->form_validation->set_message('required', '%s001');
		$this->form_validation->set_message('min_length', '%s002');
		$this->form_validation->set_message('max_length', '%s003');
		$this->form_validation->set_message('numeric', '%s006');
		$this->form_validation->set_error_delimiters('','');

		if($this->form_validation->run() == false){
			$error = array(
						'id_tienda_err' => form_error('id_tienda'),
						'id_probador_err' => form_error('cod_probador')
					);
				echo json_encode($error);
				exit();
		}

		$id_tienda = $this->input->post('id_tienda');
		$id_probador = $this->input->post('id_probador');
		$cod_probador = $this->input->post('cod_probador');
		$probador_activo = $this->input->post('probador_activado');

		//detectar si el probador ya existe
		/*if($this->Probadores_model->probador_ya_existe($cod_probador, $id_tienda)){
			echo json_encode(array('valid' => 'err_exist'));
			exit();
		}*/

		//si el probador existe dejarlo pasar pero si existe en otro probador no dejarlo pasar
		//buscar el probador con el id
		//verificar si el cod de probador es el mismo 
		//si no es el mismo verificar que no se encuentre en el resto de la base de datos

		//o

		//tomar el codigo del probador y verificar si el id de probador es el mismo en una busqueda sql
		//where cod_probador
		//get probadores
		//prob->id_prob = id_probador

		if($this->Probadores_model->modificar_probador_ya_existe($id_probador, $cod_probador, $id_tienda)){
			echo json_encode(array('valid' => 'err_exist'));
			exit();
		}

		$data = array(
			'cod_probador' => $cod_probador,
			'id_tienda' => $id_tienda,
			'estado_probador' => $probador_activo);

		if($this->Probadores_model->modificar_probador($id_probador, $data)){
			echo json_encode(array('valid' => 'update_ok'));
		}else{
			echo json_encode(array('valid' => 'update_err'));
		}
		
	}
}