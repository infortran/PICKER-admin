<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	//FUNCION PRINCIPAL (primera en ejecutarse al abrir el controlador)
	public function index()
	{
		if(!empty($_SESSION['usuario'])){
			$data['title'] = 'Administracion';
			//cargar modelo segun base de datos
						
			$this->load->model('tienda_model');
			//ver si hay tiendas y pasarlo como variable
			$data['nro_tiendas'] = $this->tienda_model->contartiendas();
			if(! isset($_SESSION['id_tienda'])){
				$tiendas = $this->tienda_model->getStores($_SESSION['id_admin']);
				if(count($tiendas->result_array()) >  0){
					$tienda = $tiendas->row();
					$this->session->set_userdata('id_tienda', $tienda->id_tienda);
				}
				//$this->session->set_userdata('cod_tienda', $tienda->cod_tienda);
			}
		
			$this->load->view('templates/header',$data);	
				
			//CARGAR EL CONTENEDOR DINAMICO QUE RECIBE DATOS DE AJAX
			$this->load->view('templates/main-section');
			
			
			//MODALS
			$this->load->view('modals/modal-ver-tiendas');
			$this->load->view('modals/modar-agregar-tienda');
			$this->load->view('modals/modal-modificar-tienda');
			$this->load->view('modals/confirmar-eliminar-tienda');
			$this->load->view('modals/modal-logout');
			$this->load->view('modals/nueva-tienda-ok');
			
			$this->load->view('modals/modal-cuenta-ok');
			$this->load->view('modals/modal-cuenta');
			$this->load->view('modals/modal-ver-trabajador');
			$this->load->view('modals/modal-modificar-trabajador');
			
			$this->load->view('modals/modal-agregar-trabajador');

			$this->load->view('modals/modal-eliminar');

			$this->load->view('templates/footer');
		}else{
			header('location:'.base_url().'login');
		}
	}

	//Cargar el dropdown
	public function loadDropdownTiendas(){
		//$id_tienda_seleccionada = $_SESSION['id_tienda'];
		$html = '';
		$this->load->model('tienda_model');
		$tiendas = $this->tienda_model->getStores($_SESSION['id_admin']);
		//$tiendaSeleccionada = $this->tienda_model->getOneStore($_SESSION['id_admin'], $id_tienda_seleccionada);
		foreach($tiendas->result() as $tienda){
			$html .= '<li><a href="#" onclick="loadSessionDataStore('.$tienda->id_tienda.')">'.$tienda->nombre_tienda.'</a></li>';
		}
		$tiendaSeleccionada = $this->tienda_model->get_tienda($_SESSION['id_tienda']);

		$data = array(
			'html' => $html,
			'tienda' => $tiendaSeleccionada);
		echo json_encode($data);

	}

	//Cambiar variables de sesion para la tienda al pulsar el dropdown
	public function loadSessionDataStore(){
		$id_tienda = $this->input->post('id_tienda');
		$this->session->set_userdata('id_tienda', $id_tienda);
	}

	public function loadViewDashboard($view){
		$data = '';
		if($view == 'productos_dashboard'){
			$this->load->model('productos_model');

			//CALCULAR ACTIVOS
			$activos = $this->productos_model->count_active_products($_SESSION['id_admin'], $_SESSION['id_tienda']);
			$total = $this->productos_model->count_all_products($_SESSION['id_admin'], $_SESSION['id_tienda']);
			if($activos > 0){
				$porcentaje_activos = ($activos * 100) / $total;
			}else{
				$porcentaje_activos = 0;
			}
			
			//CALCULAR STOCK
			$sinstock = $this->productos_model->count_nostock_products($_SESSION['id_admin'], $_SESSION['id_tienda']);
			if($sinstock > 0){
				$porcentaje_sinstock = ($sinstock * 100) / $total;
			}else{
				$porcentaje_sinstock = 0;
			}
			
			//CALCULAR MARGEN BRUTO
			$gastos_totales = $this->productos_model->get_all_pormayor($_SESSION['id_admin'], $_SESSION['id_tienda']);
			$ingresos_totales = $this->productos_model->get_all_precioventa($_SESSION['id_admin'], $_SESSION['id_tienda']);
			if($gastos_totales > 0 && $ingresos_totales > 0){
				$margenbruto = ($ingresos_totales - $gastos_totales) / $ingresos_totales * 100;
			}else{
				$margenbruto = 0;
			}
			
			//CONTAR PRODUCTOS
			$count_products = $this->productos_model->count_products_by_admin($_SESSION['id_admin'], $_SESSION['id_tienda']);

			$data['count_products'] = $count_products;
			$data['porcentaje_activos'] = $porcentaje_activos;
			$data['porcentaje_sinstock'] = $porcentaje_sinstock;
			$data['margen_bruto'] = $margenbruto;
		}
		$viewLoaded = $this->load->view('dashboard/'.$view, $data, true);
		echo $viewLoaded;
	}

	public function loadKpiView(){
		$this->load->model('kpi_model');
		$this->load->model('productos_model');
		$this->load->model('probadores_model');
		//grafico de ventas por mes
		//pickers activos
		$data['pickers_activos'] = $this->probadores_model->count_probador_activo();
		//productos rechazados
		//productos fuera de stock
		$data['productos_fuera_stock'] = $this->productos_model->count_nostock_products($_SESSION['id_admin'], $_SESSION['id_tienda']);

		//clientes nuevos
		//total clientes

		//total ganado con picker
		$data['total_picker'] = $this->kpi_model->get_totales(true);
		//total ganado sin picker
		$data['total_no_picker'] = $this->kpi_model->get_totales(false);
		//rating de aprobcion del cliente

		//top10
		//recientes
		//vendidos
		//vistos
		//buscados

		echo $this->load->view('dashboard/kpi_dashboard', $data, true);
	}

	public function loadDefaultView(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$view = $this->load->view('templates/no-tienda','',true);
			echo $view;
		}
		
	}

	public function loadViewStores(){//metodo que lee todas las tarjetas y las carga en vertiendas
		$html = '';
		$this->load->model('tienda_model');
		$datos = $this->tienda_model->getstores($_SESSION['id_admin']);

		foreach ($datos->result_array() as $fila){

			$data['fila'] = $fila;			
			$html .= $this->load->view('modals/tarjeta-tienda', $data, true);
		}
		echo $html;
	}

	public function eliminartienda(){
		$id_tienda = $this->input->post('id');
		$id_admin = $_SESSION['id_admin'];

		if($id_tienda != ''){
			$this->load->model('tienda_model');
			$filasAfectadas = $this->tienda_model->eliminartienda($id_admin, $id_tienda);
			if($filasAfectadas > 0){
				echo 'ok';
			}else{
				echo 'errNo';
			}
		}else{
			echo $id;
		}
	}
	public function mostrartienda(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			$id_tienda = $this->input->post('id_tienda');
			
			$this->load->model('tienda_model');
			$tiendaSeleccionada = $this->tienda_model->getOneStore($id_tienda);
			$tiendaEnviada = $tiendaSeleccionada->row();
			echo json_encode($tiendaEnviada);
		}else{
			show_404();
		}
	}



	public function guardarTienda(){

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
		{
			//sanear variables
			$this->form_validation->set_rules('id_tienda','id_tienda','trim|required|min_length[3]|max_length[8]');
			$this->form_validation->set_rules('web_tienda','web_tienda','trim|required');
			$this->form_validation->set_rules('nombre_tienda','nombre_tienda','trim|required|min_length[3]');
			$this->form_validation->set_rules('jefe_tienda','jefe_tienda','trim|required|min_length[3]');
			$this->form_validation->set_rules('dir_tienda','dir_tienda','trim|required|min_length[3]');
			$this->form_validation->set_rules('email_tienda','email_tienda','trim|required|valid_email');
			$this->form_validation->set_rules('tel_tienda','tel_tienda','trim|required');

			//Configurar mensajes de errores
			$this->form_validation->set_message('required', '%s001');
			$this->form_validation->set_message('min_length', '%s002');
			$this->form_validation->set_message('max_length', '%s003');
			$this->form_validation->set_message('valid_email', '%s004');
			
			$this->form_validation->set_error_delimiters('','');

			//enviar variables a base de datos
			if($this->form_validation->run() == false){
				$id_tienda_valid = (form_error('id_tienda') != '') ? form_error('id_tienda') : '';
				$web_tienda_valid = (form_error('web_tienda') != '') ? form_error('web_tienda') : '';
				$nombre_tienda_valid = (form_error('nombre_tienda') != '') ? form_error('nombre_tienda') : '';
				$jefe_tienda_valid = (form_error('jefe_tienda') != '') ? form_error('jefe_tienda') : '';
				$dir_tienda_valid = (form_error('dir_tienda') != '') ? form_error('dir_tienda') : '';
				$email_tienda_valid = (form_error('email_tienda') != '') ? form_error('email_tienda') : '';
				$tel_tienda_valid = (form_error('tel_tienda') != '') ? form_error('tel_tienda') : '';
				

				$valids = array(
					'id_tienda_valid' => $id_tienda_valid,
					'web_tienda_valid' => $web_tienda_valid,
					'nombre_tienda_valid' => $nombre_tienda_valid,
					'jefe_tienda_valid' => $jefe_tienda_valid,
					'dir_tienda_valid' => $dir_tienda_valid,
					'email_tienda_valid' => $email_tienda_valid,
					'tel_tienda_valid' => $tel_tienda_valid
					);
				echo json_encode($valids);
			}else{
				//almacnar imagen y guardar registro en base de datos

				//nombre del input
				$file_element_name = 'upload_img_agregar';
    			

    			$config['upload_path'] = './assets/uploads/img';
    			$config['allowed_types'] = 'gif|jpg|png';
    			$config['max_size'] = 1024 * 5;
    			$config['encrypt_name'] = TRUE;

    			$this->load->library('upload', $config);

    			if ($this->upload->do_upload($file_element_name)){
    				$data = $this->upload->data();
           			$file_id = $data['file_name'];

    				if($file_id != ''){
    					//capturar variables
    					$id_tienda = $this->input->post('id_tienda');
    					$web_tienda = $this->input->post('web_tienda');
    					$nombre_tienda = $this->input->post('nombre_tienda');
    					$jefe_tienda = $this->input->post('jefe_tienda');
    					$dir_tienda = $this->input->post('dir_tienda');
    					$email_tienda = $this->input->post('email_tienda');
    					$tel_tienda = $this->input->post('tel_tienda');


    					$this->load->model('tienda_model');
    					$nuevaTienda = array(
    						'cod_tienda' => $id_tienda,
    						'id_admin' => $_SESSION['id_admin'],
    						'nombre_tienda' => $nombre_tienda,
    						'owner_tienda' => $jefe_tienda,
    						'dir_tienda' => $dir_tienda,
    						'email_tienda' => $email_tienda,
    						'web_tienda' => $web_tienda,
    						'tel_tienda' => $tel_tienda,
    						'img_tienda' => $file_id);
    					if($this->tienda_model->countOneStore($id_tienda) > 0){
    						$this->tienda_model->actualizarTienda($id_tienda, $nuevaTienda);
    					}else{
    						$this->tienda_model->agregartienda($nuevaTienda);
    					}

    					$valido = array(
    						'id_tienda_valid' => '',
    						'web_tienda_valid' => '',
    						'nombre_tienda_valid' => '',
    						'jefe_tienda_valid' => '',
    						'dir_tienda_valid' => '',
    						'email_tienda_valid' => '',
    						'tel_tienda_valid' => '',
    						'img_tienda_valid' => ''
    						);
    					echo json_encode($valido);
    				}else{
    					$novalido = array(
    						'id_tienda_valid' => '',
    						'web_tienda_valid' => '',
    						'nombre_tienda_valid' => '',
    						'jefe_tienda_valid' => '',
    						'dir_tienda_valid' => '',
    						'email_tienda_valid' => '',
    						'tel_tienda_valid' => '',
    						'img_tienda_valid' => 'errNameImg'
    						);
    					echo json_encode($novalido);
    				}
    			}else{
    				$id_tienda = $this->input->post('id_tienda');
    				$web_tienda = $this->input->post('web_tienda');
    				$nombre_tienda = $this->input->post('nombre_tienda');
    				$jefe_tienda = $this->input->post('jefe_tienda');
    				$dir_tienda = $this->input->post('dir_tienda');
    				$email_tienda = $this->input->post('email_tienda');
    				$tel_tienda = $this->input->post('tel_tienda');
    				$img_default = $this->input->post('img_default');
    				$modificar = $this->input->post('modificar');

    				$this->load->model('tienda_model');
    				$nuevaTienda = array(
    					'cod_tienda' => $id_tienda,
    					'id_admin' => $_SESSION['id_admin'],
    					'nombre_tienda' => $nombre_tienda,
    					'owner_tienda' => $jefe_tienda,
    					'dir_tienda' => $dir_tienda,
    					'email_tienda' => $email_tienda,
    					'web_tienda' => $web_tienda,
    					'tel_tienda' => $tel_tienda,
    					'img_tienda' => $img_default);
    				if($this->tienda_model->countOneStore($modificar) > 0){
    					$this->tienda_model->actualizarTienda($modificar, $nuevaTienda);
    				}else{
    					$this->tienda_model->agregartienda($nuevaTienda);
    				}

    				

    				$valido = array(
    					'id_tienda_valid' => '',
    					'web_tienda_valid' => '',
    					'nombre_tienda_valid' => '',
    					'jefe_tienda_valid' => '',
    					'dir_tienda_valid' => '',
    					'email_tienda_valid' => '',
    					'tel_tienda_valid' => '',
    					'img_tienda_valid' => ''
    					);
    				echo json_encode($valido);
    			}
			}
		}else{
			$novalido = array(
				'id_tienda_valid' => '',
				'web_tienda_valid' => '',
				'nombre_tienda_valid' => '',
				'jefe_tienda_valid' => '',
				'dir_tienda_valid' => '',
				'email_tienda_valid' => '',
				'tel_tienda_valid' => '',
				'img_tienda_valid' => 'errAjaxRequest'
				);
			echo json_encode($novalido);
		}
	}

	function checkSession(){
		if(! isset($_SESSION['id_user']) || ! isset($_SESSION['current_user'])){
			echo json_encode();
			exit();
		}
	}
}