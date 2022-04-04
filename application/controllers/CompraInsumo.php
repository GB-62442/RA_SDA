<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CompraInsumo extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('CompraInsu_model');
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

			$this->form_validation->set_rules('idInsumo', 'id del insumo', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');
			$this->form_validation->set_rules('idPuntoVenta', 'id del punto de venta', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');
			$this->form_validation->set_rules('cantidad', 'cantidad del insumo', 'required|numeric|greater_than[0]|trim');
			$this->form_validation->set_rules('precio', 'precio del insumo', 'required|numeric|greater_than[0]|trim');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$idInsumo 	= $this->input->post("idInsumo");
				$idPuntoVenta 	= $this->input->post("idPuntoVenta");
				$precio 		= $this->input->post("precio");
				$cantidad 		= $this->input->post("cantidad");

				$data_comprasinsumo = array(
					"idInsumo" 	=> $idInsumo,
					"cantidad" 		=> $cantidad,
					"precio" 		=> $precio,
	
				);

				$data_puntoventainsumo = array(
					"idPuntoVenta" 	=> $idPuntoVenta,
					"idInsumo" 	=> $idInsumo,					
					"cantidad" 		=> $cantidad,
				);

				$is_affected_c = $this->CompraInsu_model->insertc($data_comprasinsumo);
				$is_affected_p = $this->CompraInsu_model->insertpv($data_puntoventainsumo);

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

			$this->form_validation->set_data($_GET)->set_rules('id', 'id del insumo', 'required|integer|greater_than_equal_to[1]|max_length[11]|trim');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$id 	= $this->input->get("id");
				$inicio = $this->input->get("inicio");
				$fin 	= $this->input->get("fin");

				$data = array(
					"id" 	=> $id,
					"inicio"=> $inicio,
					"fin"	=> $fin,
				);

				$data['res'] = $this->CompraInsu_model->getById($id, $inicio, $fin); 

			} 

        	$html = $this->load->view('public/private/tabla_CompraInsumo', $data, true);
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
				$resultData = $this->CompraInsu_model->getById($id, $inicio, $fin);
	 
				$spreadsheet = new Spreadsheet();
			 $sheet = $spreadsheet->getActiveSheet();
			 $sheet->setCellValue('A1', 'idInsumo');
			 $sheet->setCellValue('B1', 'nombreinsumo');
			 $sheet->setCellValue('C1', 'unidadMedida');
			 $sheet->setCellValue('D1', 'idProveedor');
			 $sheet->setCellValue('E1', 'nombreproveedor');
			 $sheet->setCellValue('F1', 'fecha');
			 $sheet->setCellValue('G1', 'cantidad');
	 
			 $start = 2;
			 foreach ($resultData as $row){
			  $sheet->setCellValue('A'.$start, $row->idInsumo);
			  $sheet->setCellValue('B'.$start, $row->nombreinsumo);
			  $sheet->setCellValue('C'.$start, $row->unidadMedida);
			  $sheet->setCellValue('D'.$start, $row->idProveedor);
			  $sheet->setCellValue('E'.$start, $row->nombreproveedor);
			  $sheet->setCellValue('F'.$start, $row->fecha);
			  $sheet->setCellValue('G'.$start, $row->cantidad);
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
	 
				 $writer = new Xlsx($spreadsheet);
	 
				 $filename = 'ComprasInusmos'.date('Ymd').'('.$inicio.'-'.$fin.').xlsx'; 
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
