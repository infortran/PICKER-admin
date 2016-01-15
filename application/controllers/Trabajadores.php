<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trabajadores extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('trabajadores_model');
	}

	//MOSTRAR LA LISTA DE VENDEDORES EN LA PANTALLA PRINCIPAL
	public function index()
	{
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			echo $this->load->view('dashboard/trabajadores_dashboard','',true);
		}else{
			show_404();
		}
	}

	public function get_rows_workers(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$html = '';
			
			$workers = $this->trabajadores_model->getWorkers();
			foreach ($workers->result_array() as $row) {
				$data['row'] = $row;
				$html .= $this->load->view('trabajadores/worker-row',$data,true);
			}
			echo $html;
		}else{
			show_404();
		}
	}

	public function getWorker(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$run = $this->input->post('run_trabajador');
			$worker = $this->trabajadores_model->getWorkerByRun($run);
			echo json_encode($worker->row());
		}else{
			show_404();
		}
	}

	public function changeWorkerPass(){ 
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			
			$this->form_validation->set_rules('old_pass','old_pass','required|trim|min_length[8]|max_length[20]');
			$this->form_validation->set_rules('new_pass','new_pass','required|trim|min_length[8]|max_length[20]');
			$this->form_validation->set_rules('repeat_pass','repeat_pass','required|trim|min_length[8]|max_length[20]');

			//FILTERING
			$this->form_validation->set_message('required', '%s001');
			$this->form_validation->set_message('min_length', '%s002');
			$this->form_validation->set_message('max_length', '%s003');
			$this->form_validation->set_error_delimiters('','');

			if($this->form_validation->run() == false){
				//ERROR EN LA VALIDACION enviar un json con errores
				$error = array(
					
					'old_pass_valid' => form_error('old_pass'),
					'new_pass_valid' => form_error('new_pass'),
					'repeat_pass_valid' => form_error('repeat_pass')
					);
				echo json_encode($error);
			}else{
				//VALIDADO CONTINUA EL SISTEMA
				//recibir las variables
				$run = $this->input->post('run');
				$oldpass = $this->input->post('old_pass');
				$newpass = $this->input->post('new_pass');
				$repeatpass = $this->input->post('repeat_pass');

				//confirmar el password en la base de datos
				if($this->trabajadores_model->confirmPass($run,$oldpass)){
					$data = array(
						'password_trabajador' => $newpass
						);

					if($oldpass == $newpass){
						echo json_encode(array('valid' => 'err_modif'));
					}else{
						if($newpass == $repeatpass){
							if($this->trabajadores_model->updateWorker($run,$data)){
								echo json_encode(array('valid' => 'ok'));
							}else{
								echo json_encode(array('valid' => 'err_update'));
							}
						}else{
							echo json_encode(array('valid' => 'err_repeat'));
						}
					}
					
					
				}else{
					echo json_encode(array('valid' => 'err_old'));
				}
			}

		}else{
			show_404();
		}
	}

	public function agregar()
	{
		//ajax request check
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			//VAR FILTERING
			$this->form_validation->set_rules('run_trabajador_agregar','run_trabajador_agregar','required|trim|min_length[9]|max_length[11]');
			$this->form_validation->set_rules('id_trabajador_agregar','id_trabajador_agregar','required|trim|min_length[5]');
			$this->form_validation->set_rules('nombre_trabajador_agregar','nombre_trabajador_agregar','required|trim|min_length[3]');
			$this->form_validation->set_rules('cargo_trabajador_agregar','cargo_trabajador_agregar','required|trim|min_length[3]');
			$this->form_validation->set_rules('password_trabajador_agregar','password_trabajador_agregar','required|trim|min_length[8]');
			$this->form_validation->set_rules('dir_trabajador_agregar','dir_trabajador_agregar','required|trim|min_length[6]');
			$this->form_validation->set_rules('tel_trabajador_agregar','tel_trabajador_agregar','required|trim|min_length[6]');
			$this->form_validation->set_rules('email_trabajador_agregar','email_trabajador_agregar','required|trim|valid_email');
			$this->form_validation->set_rules('comision_trabajador_agregar','comision_trabajador_agregar','required|trim');
			//RESULT FILTERING
			$this->form_validation->set_message('required', '%s001');
			$this->form_validation->set_message('min_length', '%s002');
			$this->form_validation->set_message('max_length', '%s003');
			$this->form_validation->set_message('valid_email', '%s004');

			$this->form_validation->set_error_delimiters('','');
			//FILTER RUN
			if($this->form_validation->run() == false){
				//false error on validation show on array json
				$errorForm = array(
					'run_trab_valid' => form_error('run_trabajador_agregar'),
					'id_trab_valid' => form_error('id_trabajador_agregar'),
					'nombre_trab_valid' => form_error('nombre_trabajador_agregar'),
					'cargo_trab_valid' => form_error('cargo_trabajador_agregar'),
					'password_trab_valid' => form_error('password_trabajador_agregar'),
					'dir_trab_valid' => form_error('dir_trabajador_agregar'),
					'tel_trab_valid' => form_error('tel_trabajador_agregar'),
					'email_trab_valid' => form_error('email_trabajador_agregar'),
					'comision_trab_valid' => form_error('comision_trabajador_agregar')
					);
				echo json_encode($errorForm);
			}else{
				//true continue with validations
				$file_element_name = 'image_trabajador_agregar';
    			

    			$config['upload_path'] = './assets/uploads/img';
    			$config['allowed_types'] = 'gif|jpg|png';
    			$config['max_size'] = 1024 * 5;
    			$config['encrypt_name'] = TRUE;

    			$this->load->library('upload', $config);
    			if ($this->upload->do_upload($file_element_name)){
    				//SUBIDA CON NUEVA IMAGEN
    				$data = $this->upload->data();
    				$file_id = $data['file_name'];

    				if($file_id != ''){
    					$image_trabajador = $file_id;
    					
    				}else{
						//ERROR EN NOMBRE DE IMAGEN
						$novalido = array('image_trab_valid' => 'err');
    					echo json_encode($novalido);
    					exit();
					}
    			}else{
    				//SUBIDA CON IMAGEN POR DEFECTO
    				$image_trabajador = $this->input->post('image_default_trabajador');
    			}
    		
    			//capturar variables
    			$run_trabajador = $this->input->post('run_trabajador_agregar');
    			$id_trabajador = $this->input->post('id_trabajador_agregar');
    			$nombre_trabajador = $this->input->post('nombre_trabajador_agregar');
    			$cargo_trabajador = $this->input->post('cargo_trabajador_agregar');
    			$password_trabajador = $this->input->post('password_trabajador_agregar');
    			$dir_trabajador = $this->input->post('dir_trabajador_agregar');
    			$tel_trabajador = $this->input->post('tel_trabajador_agregar');
    			$email_trabajador = $this->input->post('email_trabajador_agregar');
    			$comision_trabajador = $this->input->post('comision_trabajador_agregar');

    			
				
				//VALIDACION COMPLETA
    			
    			if($this->trabajadores_model->checkWorker($run_trabajador) > 0){//validar si existe el id
    					$datos = array(
    						'run_trabajador' => $run_trabajador,
    						'id_trabajador' => $id_trabajador,
    						'nombre_trabajador' => $nombre_trabajador,
    						'cargo_trabajador' => $cargo_trabajador,
    						'dir_trabajador' => $dir_trabajador,
    						'tel_trabajador' => $tel_trabajador,
    						'email_trabajador' => $email_trabajador,
    						'comision_trabajador' => $comision_trabajador,
    						'img_trabajador' => $image_trabajador);		
    				
    				

    				if($this->trabajadores_model->updateWorker($run_trabajador,$datos)){//si existe, hacer el update
    					$valido = array('valid' => 'ok');

    				}else{//si no, salio mal el update
    					$valido = array('valid' => 'err');
    				}
    			}else{
    				//TRABAJADOR NO EXISTE nuevo trabajador
    				$datos = array(
    				'run_trabajador' => $run_trabajador,
    				'id_trabajador' => $id_trabajador,
    				'nombre_trabajador' => $nombre_trabajador,
    				'cargo_trabajador' => $cargo_trabajador,
    				'password_trabajador' => $password_trabajador,
    				'dir_trabajador' => $dir_trabajador,
    				'tel_trabajador' => $tel_trabajador,
    				'email_trabajador' => $email_trabajador,
    				'comision_trabajador' => $comision_trabajador,
    				'img_trabajador' => $image_trabajador);

    				if($this->trabajadores_model->insertWorker($datos)){//si no existe, hacer el insert
    					$valido = array('valid' => 'ok');
    				}else{//si no, salio mal el insert
    					$valido = array('valid' => 'err');
    				}
    			}	
    			echo json_encode($valido);
			}
		}else{
			show_404();
		}
	}

	public function delete(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$run = $this->input->post('id');
			if($this->trabajadores_model->deleteWorker($run) > 0){
				echo json_encode(array('delete' => 'ok'));
			}else{
				echo json_encode(array('delete' => 'err'));
			}
		}else{
			show_404();
		}
	}
}