<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class CompraProducto extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('compraprod_model');
	}

	public function getAll(){
		//if($this->session->userdata('login') == true){

			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;

			$res = $this->compraprod_model->getAll();

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

				$is_affected_c = $this->compraprod_model->insertc($data_comprasproducto);
				$is_affected_p = $this->compraprod_model->insertpv($data_puntoventaproducto);

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

				$data['res'] = $this->compraprod_model->getById($id, $inicio, $fin); 

			} 

        	$html = $this->load->view('public/private/tabla_CompraProductos', $data, true);
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

   		$filename = 'Comprasproductos'.date('Ymd').'('.$inicio.'-'.$fin.').csv'; 
   		header("Content-Description: File Transfer"); 
   		header("Content-Disposition: attachment; filename=$filename"); 
   		header("Content-Type: application/csv; ");
   
   // get data 
   		$resultData = $this->compraprod_model->getById($id, $inicio, $fin);

   		// file creation 
   		$file = fopen('php://output', 'w');
 
   		$col_names = array(
   			"idProducto",
   			"nombreproducto",
   			"unidadMedida",
   			"idProveedor",
   			"nombreproveedor",
   			"precioVenta",
   			"costo",
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
   		 	$row->precioVenta,
   		 	$row->costo,
   		 	$row->fecha,
   		 	$row->cantidad,
   		 );

     		fputcsv($file, array_values($temp), ';', ' ');

   		}

   		fclose($file); 
   		exit; 

/*
object(stdClass)#23 (9) { ["idProducto"]=> string(1) "3" ["nombreproducto"]=> string(12) "Cookie Crisp" ["unidadMedida"]=> string(2) "gr" ["precioVenta"]=> string(4) "49.9" ["idProveedor"]=> string(1) "1" ["nombreproveedor"]=> string(35) "Grupo Bimbo, S.A.B. de C.V. editado" ["fecha"]=> string(19) "2022-03-31 18:58:33" ["cantidad"]=> string(2) "10" ["costo"]=> string(2) "12" }*/

	} 
 

  }


}




?>