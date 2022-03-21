<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class CompraProducto extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('CompraProd_model');
	}

	public function getAll(){
		//if($this->session->userdata('login') == true){

			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;

			$res = $this->CompraProd_model->getAll();

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
			$this->form_validation->set_rules('idPuntoVenta', 'id del punto de venta', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');
			$this->form_validation->set_rules('cantidad', 'cantidad del producto', 'required|numeric|greater_than[0]|trim');
			$this->form_validation->set_rules('precio', 'precio del producto', 'required|numeric|greater_than[0]|trim');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$idProducto 	= $this->input->post("idProducto");
				$idPuntoVenta 	= $this->input->post("idPuntoVenta");
				$precio 		= $this->input->post("precio");
				$cantidad 		= $this->input->post("cantidad");

				$data_comprasproducto = array(
					"idProducto" 	=> $idProducto,
					"cantidad" 		=> $cantidad,
					"precio" 		=> $precio,
	
				);

				$data_puntoventaproducto = array(
					"idPuntoVenta" 	=> $idPuntoVenta,
					"idProducto" 	=> $idProducto,					
					"cantidad" 		=> $cantidad,
				);

				$is_affected_c = $this->CompraProd_model->insertc($data_comprasproducto);
				$is_affected_p = $this->CompraProd_model->insertpv($data_puntoventaproducto);

				if($is_affected_c != NULL && $is_affected_p != NULL){
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
            
        $data['res'] = $this->CompraProd_model->getAll(); 

        $html = $this->load->view('public/private/tabla_MermaProds', $data, true);
        echo $html; 				
            
		//}
	}


}




?>