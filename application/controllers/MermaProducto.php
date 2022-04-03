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
				$inicio = $this->input->get("inicio");
				$fin 	= $this->input->get("fin");

				$data = array(
					"id" 	=> $id,
					"inicio"=> $inicio,
					"fin"	=> $fin,
				);

				$data['res'] = $this->MermaProd_model->getById($id, $inicio, $fin); 

			} 

        	$html = $this->load->view('public/private/tabla_MermaProductos', $data, true);
        	echo $html; 				
            
		//}
	}



  public function exportCSV(){ 
   // file name 

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

   		$filename = 'MermasProducto'.date('Ymd').'('.$inicio.'-'.$fin.').csv'; 
   		header("Content-Description: File Transfer"); 
   		header("Content-Disposition: attachment; filename=$filename"); 
   		header("Content-Type: application/csv; ");
   
   // get data 
   		$resultData = $this->MermaProd_model->getById($id, $inicio, $fin);

   		// file creation 
   		$file = fopen('php://output', 'w');
 
   		$col_names = array(
   			"idProducto",
   			"nombreproducto",
   			"unidadMedida",
   			"idProveedor",
   			"nombreproveedor",
   			"fecha",
   			"cantidad"
   		); 

     	fputcsv($file, array_values($col_names), ';', ' ');
   		foreach ($resultData as $row){
   		 $temp = array(
   		 	$row->idProducto,
   		 	$row->nombreproducto, 
   		 	$row->unidadMedida, 
   		 	$row->idProveedor,
   		 	$row->nombreproveedor,
   		 	$row->fecha,
   		 	$row->cantidad,
   		 );

     		fputcsv($file, array_values($temp), ';', ' ');

   		}

   		fclose($file); 
   		exit; 

	} 
 

  }


}




?>