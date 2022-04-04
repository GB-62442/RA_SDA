<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class Recetas extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Recetas_model');
	}

	public function getAll(){
		//if($this->session->userdata('login') == true){
			//con la sesion podemos guardar el punto de venta?
			$res = $this->Recetas_model->getAll(1);
			//$res = $this->Recetas_model->getAll();

			if($res != NULL){
				$respuesta = array();
				$respuesta['resultado'] = 'true';
				$respuesta['mensaje'] = 'Registros obtenidos con éxito';
				$respuesta['respuesta'] = $res;
				$this->output->set_content_type( "application/json" );
				echo json_encode($respuesta);
			}
			else{
				$respuesta = array();
				$respuesta['resultado'] = 'false';
				$respuesta['mensaje'] = 'Hubo un error al obtener los registros de recetas';
				$this->output->set_content_type( "application/json" );
				echo json_encode($respuesta);
			}

		//}
	}

	public function getInsumos(){
		//checamos el punto de venta
		

		$res = $this->Recetas_model->getInsumos(1);

		if($res != NULL){
				$respuesta = array();
				$respuesta['resultado'] = 'true';
				$respuesta['mensaje'] = 'Registros obtenidos con éxito';
				$respuesta['respuesta'] = $res;
				$this->output->set_content_type( "application/json" );
				echo json_encode($respuesta);
			}
			else{
				$respuesta = array();
				$respuesta['resultado'] = 'false';
				$respuesta['mensaje'] = 'Hubo un error al obtener los registros de recetas';
				$this->output->set_content_type( "application/json" );
				echo json_encode($respuesta);
			}
	}

	public function insertReceta(){
				$presentacion 	= $this->input->post("presentacion");
				$nombre 		= $this->input->post("nombre");
				$precioVenta 	= $this->input->post("precio_venta");
				$arreglo_insumo = $this->input->post("arreglo_insumo");
				$arreglo_cantidad = $this->input->post("arreglo_cantidad");

				$res = $this->Recetas_model->insertarReceta($nombre, $precioVenta, $presentacion, $arreglo_insumo, $arreglo_cantidad);
	}

	public function obtenerReceta(){
		$id_receta 	= (int)$this->input->post("id_receta");
		$res = $this->Recetas_model->obtenerReceta($id_receta);

		if($res != NULL){
			$respuesta = array();
			$respuesta['resultado'] = 'true';
			$respuesta['mensaje'] = 'Registros obtenidos con éxito';
			$respuesta['respuesta'] = $res;
			$this->output->set_content_type( "application/json" );
			echo json_encode($respuesta);
		}
		else{
			$respuesta = array();
			$respuesta['resultado'] = 'false';
			$respuesta['mensaje'] = 'Hubo un error al obtener los registros de recetas';
			$this->output->set_content_type( "application/json" );
			echo json_encode($respuesta);
		}
	}

	public function actualizarReceta(){
		$id_receta 		= $this->input->post("id_receta"); 
		$presentacion 	= $this->input->post("presentacion");
		$nombre 		= $this->input->post("nombre");
		$precioVenta 	= $this->input->post("precio_venta");
		$arreglo_insumo = $this->input->post("arreglo_insumo");
		$arreglo_cantidad = $this->input->post("arreglo_cantidad");
		$res = $this->Recetas_model->actualizarReceta( $id_receta, $nombre, $precioVenta, $presentacion, $arreglo_insumo, $arreglo_cantidad);
	}

	public function eliminarReceta(){
		$id_receta 		= $this->input->post("id_receta"); 
		$res = $this->Recetas_model->eliminarReceta($id_receta);
	}

}
?>
