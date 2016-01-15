<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Controller {

	//MOSTRAR LA CUENTA (metodo principal)
	public function index()
	{
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			 
		//capturar el email enviado por session
			$email = $_SESSION['usuario'];

		//buscar los datos de este mail y cargar en formulario
			$this->load->model('cuenta_model');
			$adminSelected = $this->cuenta_model->getAdmin($email);

		//enviar resultado json
			echo json_encode($adminSelected);
		}else{
			show_404();
		}
	}

	public function updateAdmin(){
		if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' || $_SERVER['HTTP_X_REQUESTED_WITH'] == 'xmlhttprequest'){
			

			//sanear variables
			$this->form_validation->set_rules('email_admin','email_admin','required|valid_email|trim');
			$this->form_validation->set_rules('nombre_admin','nombre_admin','required|min_length[3]|trim');
			$this->form_validation->set_rules('apellido_admin','apellido_admin','required|min_length[3]|trim');
			$this->form_validation->set_rules('old_password_admin','old_password_admin','required|min_length[4]|trim');
			$this->form_validation->set_rules('new_password_admin','new_password_admin','min_length[8]|matches[repeat_password_admin]|trim');
			$this->form_validation->set_rules('repeat_password_admin','repeat_password_admin','min_length[8]|trim|matches[new_password_admin]');

			$this->form_validation->set_error_delimiters('', '');

			$this->form_validation->set_message('required', '%s001');
			$this->form_validation->set_message('min_length', '%s002');
			$this->form_validation->set_message('max_length', '%s003');
			$this->form_validation->set_message('valid_email', '%s004');
			$this->form_validation->set_message('matches', '%s005');

			if($this->form_validation->run() == false){
				$email_admin_valid = (form_error('email_admin') != '') ? form_error('email_admin') : 'ok';
				$nombre_admin_valid = (form_error('nombre_admin') != '') ? form_error('nombre_admin') : 'ok';
				$apellido_admin_valid = (form_error('apellido_admin') != '') ? form_error('apellido_admin') : 'ok';
				$old_password_admin_valid = (form_error('old_password_admin') != '') ? form_error('old_password_admin') : 'ok';
				$new_password_admin_valid = (form_error('new_password_admin') != '') ? form_error('new_password_admin') : 'ok';
				$repeat_password_admin_valid = (form_error('repeat_password_admin') != '') ? form_error('repeat_password_admin') : 'ok';
				
				//ERRORES DE VALIDACION DE FORMULARIO
				$err_validate = array(
					'email_admin_valid' => $email_admin_valid,
					'nombre_admin_valid' => $nombre_admin_valid,
					'apellido_admin_valid' => $apellido_admin_valid,
					'old_password_admin_valid' => $old_password_admin_valid,
					'new_password_admin_valid' => $new_password_admin_valid,
					'repeat_password_admin_valid' => $repeat_password_admin_valid);
				
				echo json_encode($err_validate);
				
			}else{
				//FORMULARIO VALIDADO
				$this->load->model('cuenta_model');
				//si todo va bien comprobar que la contraseña ingresada es la que pertenece al admin
				$email = $this->input->post('email_admin');
				$old_password = $this->input->post('old_password_admin');


				//COMPROBACION DEL PASSWORD
				if($this->cuenta_model->checkPasswordAdmin($email,$old_password)){//si es el mismo = true = 0
																				  //si es distinto = false = 1
																				  //si es un nuevo usuario = false? = 2
					$file_element_name = 'image_admin';

					$config['upload_path'] = './assets/uploads/img';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 1024 * 5;
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					//VERIFICACION DE IMAGEN NPOR DEFECTO
					if ($this->upload->do_upload($file_element_name)){
						$data = $this->upload->data();
						$file_id = $data['file_name'];

						//VERIFICACION DE NOMBRE DE ARCHIVO
						if($file_id != ''){
    					//capturar variables
							$email_admin = $this->input->post('email_admin');
							$nombre_admin = $this->input->post('nombre_admin');
							$apellido_admin = $this->input->post('apellido_admin');
							$old_password_admin = $this->input->post('old_password_admin');
							$new_password_admin = $this->input->post('new_password_admin');
							$repeat_password_admin = $this->input->post('repeat_password_admin');
					
							//decidir si el password se cambia o no
							if($new_password_admin == $repeat_password_admin && $new_password_admin != '' && $repeat_password_admin != ''){
								$admin = array(
								'nombre_admin' => $nombre_admin,
								'apellido_admin' => $apellido_admin,
								'password_admin' => $new_password_admin,
								'image_admin' => $file_id);
							}else{
								$admin = array(
								'nombre_admin' => $nombre_admin,
								'apellido_admin' => $apellido_admin,
								'image_admin' => $file_id);
							}							
							
							
							
							//VALIDACION COMPLETA
							if($this->cuenta_model->updateAdmin($email_admin,$admin)){
								//SI SE ACTUALIZA TODO VALIDO
								$valido = array(
									'email_admin_valid' => 'ok',
									'nombre_admin_valid' => 'ok',
									'apellido_admin_valid' => 'ok',
									'old_password_admin_valid' => 'ok',
									'new_password_admin_valid' => 'ok',
									'repeat_password_admin_valid' => 'ok',
									'image_admin_valid' => 'ok',
									'update' => 'ok'
									);
							}else{
								//SI NO ENVIA ERROR UPDATE
								$valido = array(
									'email_admin_valid' => 'ok',
									'nombre_admin_valid' => 'ok',
									'apellido_admin_valid' => 'ok',
									'old_password_admin_valid' => 'ok',
									'new_password_admin_valid' => 'ok',
									'repeat_password_admin_valid' => 'ok',
									'image_admin_valid' => 'ok',
									'update' => 'err'
									);
							}
							echo json_encode($valido);
						}else{

							//ERROR EN NOMBRE DE IMAGEN
							$novalido = array(
    						'email_admin_valid' => 'ok',
    						'nombre_admin_valid' => 'ok',
    						'apellido_admin_valid' => 'ok',
    						'old_password_admin_valid' => 'ok',
    						'new_password_admin' => 'ok',
    						'repeat_password_admin_valid' => 'ok',
    						'image_admin_valid' => 'err'
    						);
    					echo json_encode($novalido);
						}
					}else{
						//SUBIR LOS DATOS CON IMAGEN POR DEFECTO
						$email_admin = $this->input->post('email_admin');
						$nombre_admin = $this->input->post('nombre_admin');
						$apellido_admin = $this->input->post('apellido_admin');
						$old_password_admin = $this->input->post('old_password_admin');
						$new_password_admin = $this->input->post('new_password_admin');
						$repeat_password_admin = $this->input->post('repeat_password_admin');
						$img_default_user = $this->input->post('img_default_user');

						$this->load->model('cuenta_model');


						if($new_password_admin == $repeat_password_admin && $new_password_admin != '' && $repeat_password_admin != ''){
							$admin = array(
								'nombre_admin' => $nombre_admin,
								'apellido_admin' => $apellido_admin,
								'password_admin' => $new_password_admin,
								'image_admin' => $img_default_user);
						}else{
							$admin = array(
								'nombre_admin' => $nombre_admin,
								'apellido_admin' => $apellido_admin,
								'image_admin' => $img_default_user);
						}	
						
						
						if($this->cuenta_model->updateAdmin($email_admin,$admin)){
							$valido = array(
								'email_admin_valid' => 'ok',
								'nombre_admin_valid' => 'ok',
								'apellido_admin_valid' => 'ok',
								'old_password_admin_valid' => 'ok',
								'new_password_admin_valid' => 'ok',
								'repeat_password_admin_valid' => 'ok',
								'image_admin_valid' => 'ok',
								'update' => 'ok'
								);
						}else{
							$valido = array(
								'email_admin_valid' => 'ok',
								'nombre_admin_valid' => 'ok',
								'apellido_admin_valid' => 'ok',
								'old_password_admin_valid' => 'ok',
								'new_password_admin_valid' => 'ok',
								'repeat_password_admin_valid' => 'ok',
								'image_admin_valid' => 'ok',
								'update' => 'err'
								);
						}
						echo json_encode($valido);
					}

					
				}else{
					//significa que el password es incorrecto
					$err_validate = array(
					'email_admin_valid' => 'ok',
					'nombre_admin_valid' => 'ok',
					'apellido_admin_valid' => 'ok',
					'old_password_admin_valid' => 'err',
					'new_password_admin_valid' => 'ok',
					'repeat_password_admin_valid' => 'ok'
					);
					echo json_encode($err_validate);
				}
			}
		}else{
			//error en AJAX REQUEST
			echo 'ajax_err';
		}
	}

	public function addAdmin(){

	}



}