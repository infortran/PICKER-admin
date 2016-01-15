<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pprobador_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	} 

	public function checkstatus($id_picker){
		$this->db->where('id_probador', $id_picker);
	}


	//FUNCION PARA COMPROBAR EL USERNAME Y EL PASS CON EL DE LA DB (listo)
	public function check_user_login($user, $pass){
		$this->db->where('email_admin', $user);
		$usuario = $this->db->get('administrador');
		$usuario = $usuario->row();

		if($usuario != null){
			if($usuario->password_admin == $pass){
				return 0;
			}else{
				return 1;
			}
		}else{
			return 2;
		}
	}

	public function getUser($email){
		$this->db->where('email_admin',$email);
		$name = $this->db->get('administrador');
		return $name->row();
	}

	//buscar todas las tiendas que coincidan con el id de usuario
	//verificar si la tienda esta dentro de las del usuario
	public function asociar_probador_con_tienda($id_admin, $id_tienda, $id_probador){
		$this->db->where('id_tienda',$id_tienda);
		$this->db->where('id_admin',$id_admin);
		$tienda = $this->db->get('tiendas');
		$conteo = count($tienda);
		if($conteo > 0){
			//al tener un conteo mayor a 0 sabremos que hay una tienda con estos identificadores
			$this->db->where('id_probador', $id_probador);
			$data = array('id_tienda', $id_tienda);
			$this->db->update('probadores', $data);
			return true;
		}else{
			//de lo contrario no hay tiendas con este id de admin e id de tienda

			return false;
		}
	}

	public function if_picker_exists($id_picker){
		$this->db->where('id_probador',$id_picker);
		$picker_exists = $this->db->get('probadores');
		$picker_count = count($picker_exists);
		if($picker_count > 0){
			return true;
		}else{
			return false;
		}
	}

	public function get_pickers_from_database($id_tienda){
		//$this->db->where('id_tienda',$id_tienda);
		$this->db->where('id_tienda',$id_tienda);
		return $this->db->get('probadores');
	}

	public function check_active_picker($id_admin, $id_probador){
		$this->db->where('id_probador_activo',$id_probador);
		$this->db->where('id_admin_activo', $id_admin);
		$result = $this->db->get('pickers_activos');
		if(count($result->result_array()) > 0){
			//PICKER ACTIVO TRUE
			return true;
		}else{
			//PICKER ACTIVO FALSE
			return false;
		}
	}

	public function add_picker_to_active($id_admin, $id_probador){
		$data = array(
			'id_admin_activo' => $id_admin,
			'id_probador_activo' => $id_probador
		);

		$this->db->where('id_admin_activo', $id_admin);
		$this->db->where('id_probador_activo', $id_probador);
		$res = $this->db->get('pickers_activos');
		if(count($res->result_array()) > 0){
			return false;
		}else{
			$this->db->insert('pickers_activos',$data);
			return true;
		}
	}

	public function delete_picker_from_active($id_admin, $id_probador){

		$this->db->where('id_admin_activo', $id_admin);
		$this->db->where('id_probador_activo', $id_probador);
		$res = $this->db->get('pickers_activos');
		
		if(count($res->result_array()) == 0){
			return false;
		}else{
			$this->db->where('id_admin_activo', $id_admin);
			$this->db->where('id_probador_activo', $id_probador);
			$this->db->delete('pickers_activos');
			return true;
		}
	}

	public function products_on_cart($id_tienda, $id_probador){
		$this->db->where('id_tienda', $id_tienda);
		$this->db->where('id_probador', $id_probador);
		return $this->db->get('carrito');
	}

	public function get_prod_by_sku($id_tienda,$sku_prod){
		$this->db->where('id_tienda', $id_tienda);
		$this->db->where('sku_prod', $sku_prod);
		$producto = $this->db->get('productos');
		return $producto->row();
	}

	public function get_prod_by_id($id){
		$this->db->where('id_prod', $id);
		$producto = $this->db->get('productos');
		return $producto->row();
	}

	public function cargar_tiendas($id_admin){
		$this->db->where('id_admin', $id_admin);
		return $this->db->get('tiendas');
	}

	public function get_probador_from_cod_picker($cod_picker, $cod_tienda, $id_user){
		$this->db->where('cod_tienda', $cod_tienda);
		$this->db->where('id_admin', $id_user);
		$tienda = $this->db->get('tiendas');
		$tienda = $tienda->row();
		
		$this->db->where('cod_probador', $cod_picker);
		$this->db->where('id_tienda', $tienda->id_tienda);
		
		return $this->db->get('probadores');	
	}

	public function check_tienda($tienda, $admin){
		$this->db->where('cod_tienda', $tienda);
		$this->db->where('id_admin', $admin);
		$tienda = $this->db->get('tiendas');
		$tienda = $tienda->row();
		if(count($tienda) > 0){
			return false;
		}else{
			return true;
		}
	}

	public function get_tienda_from_id($id_tienda){
		$this->db->where('id_tienda', $id_tienda);
		return $this->db->get('tiendas');		
	}

	public function check_active_picker_by_tienda($id_tienda, $id_probador_activo){
		$this->db->where('id_tienda', $id_tienda);
		$this->db->where('id_probador_activo', $id_probador_activo);
		$probadores = $this->db->get('pickers_activos');
		if(count($probadores->result_array()) > 0){
			return true;
		}else{
			return false;
		}
	}


	/**=========== FUNCIONES DE LOCK ACTIVITY ============*/
	public function get_probador_by_cod($cod, $tienda){
		$this->db->where('cod_probador', $cod);
		$this->db->where('id_tienda', $tienda);
		return $this->db->get('probadores');
	}

	public function get_productos_from_carrito($id_tienda, $id_probador){
		$this->db->where('id_tienda', $id_tienda);
		$this->db->where('id_probador', $id_probador);
		return $this->db->get('carrito');
	}

	public function get_product_by_id($id_producto){
		$this->db->where('id_prod', $id_producto);
		return $this->db->get('productos');
	}

	public function get_tendencia_by_prod_id($id_prod){
		$this->db->where('id_producto', $id_prod);
		return $this->db->get('tendencia_producto');
	}

	public function get_prods_by_tendencia($id){
		$this->db->where('id_tendencia', $id);
		return $this->db->get('tendencia_producto');
	}
}