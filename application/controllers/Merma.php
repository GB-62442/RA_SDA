<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Merma extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Merma_model');
	}

	public function getAll(){
		//if($this->session->userdata('login') == true){

			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Ocurrio un error durante la petición';
			$respuesta['respuesta'] = null;

			$res = $this->Merma_model->getAll();

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
			$this->form_validation->set_rules('cantidad', 'cantidad de la merma', 'required|numeric|greater_than[0]|trim');

			if($this->form_validation->run()/* &&  $this->input->is_ajax_request()*/){
				$idInsumo 	= $this->input->post("idInsumo");
				$cantidad 	= $this->input->post("cantidad");

				$data = array(
					"idInsumo" 	=> $idInsumo,
					"cantidad" 	=> $cantidad,
				);

				$is_affected = $this->Merma_model->insert($data);

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

				$data['res'] = $this->Merma_model->getById($id,  $inicio, $fin); 

			} 

        	$html = $this->load->view('public/private/tabla_MermaInsumo', $data, true);
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
				$resultData = $this->Merma_model->getById($id, $inicio, $fin);
	 
			$spreadsheet = new Spreadsheet();
			 $sheet = $spreadsheet->getActiveSheet();
			 $sheet->setCellValue('A1', 'idInsumo');
			 $sheet->setCellValue('B1', 'nombreinsumo');
			 $sheet->setCellValue('C1', 'unidadMedida');
			 $sheet->setCellValue('D1', 'idProveedor');
			 $sheet->setCellValue('E1', 'nombreproveedor');
			 $sheet->setCellValue('F1', 'cantidad');
			 $sheet->setCellValue('G1', 'fecha');
	 
	 
			 $start = 2;
				foreach ($resultData as $row){
				 $sheet->setCellValue('A'.$start, $row->idInsumo);
				 $sheet->setCellValue('B'.$start, $row->nombreinsumo);
				 $sheet->setCellValue('C'.$start, $row->unidadMedida);
				 $sheet->setCellValue('D'.$start, $row->idProveedor);
				 $sheet->setCellValue('E'.$start, $row->nombreproveedor);
				 $sheet->setCellValue('F'.$start, $row->cantidad);
				 $sheet->setCellValue('G'.$start, $row->fecha);
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
				 $sheet->getStyle('A1:G1')->getFont()->setBold(true);		
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
	 
			 $filename = 'MermasInsumo'.date('Ymd').'('.$inicio.'-'.$fin.').xlsx'; 
			 header("Content-Description: File Transfer"); 
			 header("Content-Disposition: attachment; filename=$filename"); 
			 header("Content-Type: application/vnd.ms-excel ");
	 
			 $writer->save('php://output');
	 
		 } 
	  
	 
	   }





}

?>
