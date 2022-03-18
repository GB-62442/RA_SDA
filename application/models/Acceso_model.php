 <?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class Acceso_model extends CI_Model{

	public function login($email){
		$this->db->where('nombre', $email);
		$rs = $this->db->get('usuario');

		return $rs->num_rows() == 1 ? $rs->row() : NULL;
	}

	public function register($data_user){
		if($this->db->insert('usuario', $data_user)){
			//Si se insertó
			$lastId = $this->db->insert_id();
			$this->db->where('id_use', $lastId);
			$rs = $this->db->get('usuario');

			return $rs->num_rows() == 1 ? $rs->row() : NULL;
		}
		else{
			//No se insertó
			return NULL;
		}
	}

}
?>