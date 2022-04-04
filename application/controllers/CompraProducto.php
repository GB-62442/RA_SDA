<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
		
		// get data 
				$resultData = $this->compraprod_model->getById($id, $inicio, $fin);
	 
				$spreadsheet = new Spreadsheet();
			 $sheet = $spreadsheet->getActiveSheet();
			 $sheet->setCellValue('A1', 'idProducto');
			 $sheet->setCellValue('B1', 'nombreproducto');
			 $sheet->setCellValue('C1', 'unidadMedida');
			 $sheet->setCellValue('D1', 'idProveedor');
			 $sheet->setCellValue('E1', 'nombreproveedor');
			 $sheet->setCellValue('F1', 'precioVenta');
			 $sheet->setCellValue('G1', 'costo');
			 $sheet->setCellValue('H1', 'fecha');
			 $sheet->setCellValue('I1', 'cantidad');
	 
			 $start = 2;
			 foreach ($resultData as $row){
			  $sheet->setCellValue('A'.$start, $row->idProducto);
			  $sheet->setCellValue('B'.$start, $row->nombreproducto);
			  $sheet->setCellValue('C'.$start, $row->unidadMedida);
			  $sheet->setCellValue('D'.$start, $row->idProveedor);
			  $sheet->setCellValue('E'.$start, $row->nombreproveedor);
			  $sheet->setCellValue('F'.$start, $row->precioVenta);
			  $sheet->setCellValue('G'.$start, $row->costo);
			  $sheet->setCellValue('H'.$start, $row->fecha);
			  $sheet->setCellValue('I'.$start, $row->cantidad);
			  $start = $start+1;
			 }
	 
			 $styleThinBlackBorderOutline = [
				 'borders' => [
					 'allBorders' => [
						 'borderStyle' => Border::BORDER_THIN,
						 'color' => ['argb' => 'FF000000'],
					 ],
				 ],
			 ];
				 //Font BOLD
				 $sheet->getStyle('A1:I1')->getFont()->setBold(true);		
				 $sheet->getStyle('A1:D10')->applyFromArray($styleThinBlackBorderOutline);
				 //Alignment
				 //fONT SIZE
				 $sheet->getStyle('A1:D10')->getFont()->setSize(12);
				 $sheet->getStyle('A1:G2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
	 
				 $sheet->getStyle('A2:D100')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
				 //Custom width for Individual Columns
				 $sheet->getColumnDimension('A')->setWidth(20);
				 $sheet->getColumnDimension('B')->setWidth(20);
				 $sheet->getColumnDimension('C')->setWidth(20);
				 $sheet->getColumnDimension('D')->setWidth(20);
				 $sheet->getColumnDimension('E')->setWidth(20);
				 $sheet->getColumnDimension('F')->setWidth(20);
				 $sheet->getColumnDimension('G')->setWidth(20);
				 $sheet->getColumnDimension('H')->setWidth(20);
				 $sheet->getColumnDimension('I')->setWidth(20);
	 
				 $writer = new Xlsx($spreadsheet);
	 
				 $filename = 'Comprasproductos'.date('Ymd').'('.$inicio.'-'.$fin.').xlsx'; 
				header("Content-Description: File Transfer"); 
				header("Content-Disposition: attachment; filename=$filename"); 
				header("Content-Type: application/vnd.ms-excel ");
	 
				$writer->save('php://output');
	 /*
	 object(stdClass)#23 (9) { ["idProducto"]=> string(1) "3" ["nombreproducto"]=> string(12) "Cookie Crisp" ["unidadMedida"]=> string(2) "gr" ["precioVenta"]=> string(4) "49.9" ["idProveedor"]=> string(1) "1" ["nombreproveedor"]=> string(35) "Grupo Bimbo, S.A.B. de C.V. editado" ["fecha"]=> string(19) "2022-03-31 18:58:33" ["cantidad"]=> string(2) "10" ["costo"]=> string(2) "12" }*/
	 
		 } 
	  
	 
	   }


}




?>
