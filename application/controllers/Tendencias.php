<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendencias extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('tendencias_model');
	}

	//FUNCION PRINCIPAL (primera en ejecutarse al abrir el controlador)
	public function index()
	{
	}

	public function get_tendencias(){
		$tendencias = $this->tendencias_model->get_tendencias();
		$html = '';
		$result = '';
		if(count($tendencias->result_array()) > 0){
			foreach($tendencias->result() as $tendencia){
				$html .= '<tr>
					<td>'.$tendencia->id_tendencia.'</td>
					<td>'.$tendencia->nombre_tendencia.'</td>
					<td>'.$tendencia->descripcion_tendencia.'</td>
					<td><button class="btn btn-default">Modificar</button></td>
				</tr>';
			}
			$result = 'ok';
		}else{
			$html .= '<div class="alert alert-info" style="border-left:4px solid">
			<span class="glyphicon glyphicon-alert"></span>
			No hay tendencias</div>';
			$result = 'err';
		}
		echo json_encode(array('result' => $result, 'html' => $html));
	}

	public function get_prod_tendencias(){
		$tendencias = $this->tendencias_model->get_prod_tendencias();
		$html = '';
		$result = '';
		if(count($tendencias->result_array()) > 0){
			foreach($tendencias->result() as $tendencia){
				$html .= '<tr>
					<td>'.$tendencia->id_tendencia_producto.'</td>
					<td>'.$tendencia->id_producto.'</td>
					<td>'.$tendencia->id_tendencia.'</td>
					<td><button class="btn btn-default">Modificar</button></td>
				</tr>';
			}
			$result = 'ok';
		}else{
			$html .= '<div class="alert alert-info" style="border-left:4px solid">
			<span class="glyphicon glyphicon-alert"></span>
			No hay tendencias</div>';
			$result = 'err';
		}
		echo json_encode(array('result' => $result, 'html' => $html));
	}

}