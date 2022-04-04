<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class Usuario extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Usuario_model');
	}

	public function getAll(){
		//if($this->session->userdata('login') == true){

			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;

			$res = $this->Usuario_model->getAll();

			if($res != NULL){
				$respuesta['resultado'] = 'true';
				$respuesta['mensaje'] = 'Registros obtenidos con éxito';
				$respuesta['respuesta'] = $res;
			}
			
			echo json_encode($respuesta);
		//}
	}

	public function get(){
		//if($this->session->userdata('login') == true){
			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;
           
        		$post_id       = $this->input->post('id'); 

			$datos_post = array();
			
            $this->form_validation->set_data($datos_post)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 
		
            if ($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/) {
                 $res = $this->Usuario_model->getById($post_id); 

				if($res != NULL){

				$respuesta['resultado'] = 'true';
				$respuesta['mensaje'] = 'Registros obtenidos con éxito';
				$respuesta['respuesta'] = $res;

				}

             }


            /*Si la validación de campos es incorrecta*/
            else {
            	$this->form_validation->set_error_delimiters('','');
				$respuesta['error'] = validation_errors();
            }
			
            echo json_encode($respuesta);

		//}
	}

	public function getsesiones(){
		//if($this->session->userdata('login') == true){
			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;
           
        		$post_id       = $this->input->post('id'); 

			$datos_post = array();
			
            $this->form_validation->set_data($datos_post)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 
		
            if ($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/) {
                 $res = $this->Usuario_model->getSesionesById($post_id, $inicio, $fin); 

				if($res != NULL){

				$respuesta['resultado'] = 'true';
				$respuesta['mensaje'] = 'Registros obtenidos con éxito';
				$respuesta['respuesta'] = $res;

				}

             }


            /*Si la validación de campos es incorrecta*/
            else {
            	$this->form_validation->set_error_delimiters('','');
				$respuesta['error'] = validation_errors();
            }
			
            echo json_encode($respuesta);

		//}
	}


	public function tablasesiones(){
		//if($this->session->userdata('login') == true){
		$data['res'] = null; 

			$this->form_validation->set_data($_GET)->set_rules('id', 'id del producto', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$id 	= $this->input->get("id");
				$inicio = $this->input->get("inicio");
				$fin 	= $this->input->get("fin");

				$data = array(
					"id" 	=> $id,
					"inicio"=> $inicio,
					"fin"	=> $fin,
				);

				$data['res'] = $this->Usuario_model->getSesionesById($id, $inicio, $fin); 

			} 

        	$html = $this->load->view('public/private/tabla_sesiones', $data, true);
        	echo $html; 				
            
		//}
	}


	public function insert(){
		//if($this->session->userdata('login') == true){

			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;

			$this->form_validation->set_rules('nombre', 'nombre del Usuario', 'required|htmlspecialchars|max_length[50]|trim');
			$this->form_validation->set_rules('rol', 'rol', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');
			$this->form_validation->set_rules('pass', 'pass del Usuario', 'required|htmlspecialchars|max_length[50]|trim');
			$this->form_validation->set_rules('pass_r', 'pass_r del Usuario', 'required|htmlspecialchars|max_length[50]|trim|matches[pass]');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$nombre 		= $this->input->post("nombre");
				$rol 		= $this->input->post("rol");
				$pass 		= $this->input->post("pass");

				$pass 		= md5($pass);

				$data = array(
					"nombre" 		=> $nombre,
					"rol" 		=> $rol,
					"pass" 		=> $pass,
				);

				$is_affected = $this->Usuario_model->insert($data);

				if($is_affected != NULL){
					$respuesta['resultado'] = 'true';
					$respuesta['mensaje'] = 'El registro se insertó correctamente';
				}

			}

            /*Si la validación de campos es incorrecta*/
            else {
            	$this->form_validation->set_error_delimiters('','');
				$respuesta['error'] = validation_errors();
            }
			
            echo json_encode($respuesta);

		//}
	}

	public function edit(){
		//if($this->session->userdata('login') == true){

			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;

			$this->form_validation->set_rules('idUsuario', 'usuario', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');
			$this->form_validation->set_rules('nombre', 'nombre del Usuario', 'required|htmlspecialchars|max_length[50]|trim');
			$this->form_validation->set_rules('rol', 'rol', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');
			$this->form_validation->set_rules('pass', 'pass del Usuario', 'htmlspecialchars|max_length[50]|trim');
			$this->form_validation->set_rules('pass_r', 'pass_r del Usuario', 'htmlspecialchars|max_length[50]|trim|matches[pass_r]');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$idUsuario 	= $this->input->post("idUsuario");
				$nombre 		= $this->input->post("nombre");
				$rol 		= $this->input->post("rol");
				$pass 		= $this->input->post("pass");


				//revisar que exista el registro
				$res = $this->Usuario_model->getById($idUsuario); 

				if($res != NULL){
					$data = array(
						"idUsuario" 	=> $idUsuario,
						"nombre" 		=> $nombre,
						"rol" 		=> $rol,
					);

					if($pass != null){
						$pass 		= md5($pass);
						$data['pass']	= $pass;
					}

					$is_affected = $this->Usuario_model->update($data, $idUsuario);

					if($is_affected != NULL){
						$respuesta['resultado'] = 'true';
						$respuesta['mensaje'] = 'El registro se actualizó correctamente';
					}else{
						$respuesta['mensaje'] = 'No fue posible modificar el registro';
					}

				}

			}

            /*Si la validación de campos es incorrecta*/
            else {
            	$this->form_validation->set_error_delimiters('','');
				$respuesta['error'] = validation_errors();
            }
			
            echo json_encode($respuesta);

		//}
	}


	public function delete(){
		//if($this->session->userdata('login') == true){

			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;

			$this->form_validation->set_rules('idUsuario', 'id del Usuario', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$idUsuario		= $this->input->post("idUsuario");

				//revisar que exista el registro
				$res = $this->Usuario_model->getById($idUsuario); 

				if($res != NULL){

					$is_affected = $this->Usuario_model->deleteById($idUsuario);

					if($is_affected != NULL){
						$respuesta['resultado'] = 'true';
						$respuesta['mensaje'] = 'El registro se elimino correctamente';
					}else{
						$respuesta['mensaje'] = 'No fue posible eliminar el registro';
					}

				}

			}

            /*Si la validación de campos es incorrecta*/
            else {
            	$this->form_validation->set_error_delimiters('','');
				$respuesta['error'] = validation_errors();
            }
			
            echo json_encode($respuesta);

		//}
	}

	public function tabla(){
		//if($this->session->userdata('login') == true){
            
        $data['res'] = $this->Usuario_model->getAll(); 

        $html = $this->load->view('public/private/tabla_usuarios', $data, true);
        echo $html; 				
            
		//}
	}


}




?>