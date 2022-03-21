<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class MermaProducto extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('MermaProd_model');
	}

	public function getAll(){
		//if($this->session->userdata('login') == true){

			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;

			$res = $this->MermaProd_model->getAll();

			if($res != NULL){
				$respuesta['resultado'] = 'true';
				$respuesta['mensaje'] = 'Registros obtenidos con éxito';
				$respuesta['respuesta'] = $res;
			}
			
			echo json_encode($respuesta);
		//}
	}

	public function insert(){
		//if($this->session->userdata('login') == true){

			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;

			$this->form_validation->set_rules('idProducto', 'id del producto', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');
			$this->form_validation->set_rules('cantidad', 'cantidad de la merma', 'required|numeric|greater_than[0]|trim');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$idProducto 	= $this->input->post("idProducto");
				$cantidad 	= $this->input->post("cantidad");

				$data = array(
					"idProducto" 	=> $idProducto,
					"cantidad" 	=> $cantidad,
				);

				$is_affected = $this->MermaProd_model->insert($data);

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


	public function tabla(){
		//if($this->session->userdata('login') == true){
		$data['res'] = null; 

			$this->form_validation->set_data($_GET)->set_rules('id', 'id del producto', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$id 	= $this->input->get("id");

				$data = array(
					"id" 	=> $id,
				);

				$data['res'] = $this->MermaProd_model->getById($id); 

			} 

        	$html = $this->load->view('public/private/tabla_MermaProductos', $data, true);
        	echo $html; 				
            
		//}
	}


}




?>