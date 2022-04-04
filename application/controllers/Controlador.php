<?php
class Controlador extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if($this->session->userdata('login') != true){
			$data['scripts'][]          = 'app/private/modules/acceso';

			$this->load->view( "public/componentes/public_header_f" );
			$this->load->view( "public/login", $data );
			$this->load->view( "public/componentes/footer_f");
		}
		else{
			redirect(base_url().'controlador/puntosVenta');
		}
	}

	public function restablecer(){
		$data['scripts'][]          = 'app/private/modules/acceso';

		$this->load->view( "public/componentes/public_header_f" );
		$this->load->view( "public/restablecer", $data );
		$this->load->view( "public/componentes/footer_f");
	}

	public function puntosVenta(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/puntosVenta';
			$data['rol']				= $this->session->userdata('rol') == 1 ? 1 : 0;

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/puntosVenta", $data );
			$this->load->view( "public/componentes/footer_f");
		}
		else{
			redirect(base_url().'acceso/logout');
		}
	}

	public function detalleptventa(){
		if($this->session->userdata('login') == true && $this->session->userdata('rol') == 1){
			$data['scripts'][]          = 'app/private/modules/f_puntoVenta';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/forma_puntosventa", $data );
			$this->load->view( "public/componentes/footer_f");
		}
		else{
			redirect(base_url().'acceso/logout');
		}
	}	

	public function insumos(){
		if($this->session->userdata('login') == true){

			$data['scripts'][]          = 'app/private/modules/insumos';


			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/insumos", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}

	public function detalleinsumo(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_insumo';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/forma_insumos", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}	
	
	public function mermainsumo(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_mermainsumo';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/forma_merma_insumo", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}


	public function historialmermainsumo(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_hmermainsumo';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/historico_merma_insumo", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}	

	public function comprainsumo(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_comprainsumo';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/forma_compra_insumo", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}	

	public function historialcomprainsumo(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_hcomprainsumo';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/historico_compra_insumo", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}

	public function recetas(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/recetas';
			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/recetas", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}		

	}

	public function detallereceta(){
		if($this->session->userdata('login') == true){
			$this->load->model('Acceso_model');
			//mandamos el ID de usuario
			$res = $this->Acceso_model->getPuntosVenta(1);
			$punto_ventaS = $this->input->get('punto_venta');
			$data['scripts'][] = 'app/private/modules/detalle_recetas';
			foreach ($res as $punto_venta) {
				if($punto_venta->idPuntoVenta == $punto_ventaS) {
					//cargar el modelo para hacer el if de si esos puntos de venta le corresponden
					$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
					$this->load->view( "public/private/forma_receta", $data );
					$this->load->view( "public/componentes/footer_f");
				}else{
					$data['scripts'][]          = 'app/private/modules/recetas';
					$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
					$this->load->view( "public/private/recetas", $data );
					$this->load->view( "public/componentes/footer_f");
				}
			}
		}else{
			redirect('/', 'refresh');
		}		

	}

	public function productos(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/productos';

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/productos", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}

	public function detalleproducto(){
	if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_producto';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/forma_productos", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}

	public function mermaproducto(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_mermaproducto';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/forma_merma_productos", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}


	public function historialmermaproducto(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_hmermaproducto';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/historico_merma_productos", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}	

	public function compraproducto(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_compraproducto';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/forma_compra_productos", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}	


	public function historialcompraproducto(){
	if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_hcompraproducto';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/historico_compra_productos", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}	

	public function usuarios(){
		if($this->session->userdata('login') == true && $this->session->userdata('rol') == 1){
			$data['scripts'][]          = 'app/private/modules/usuarios';

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/usuarios", $data );
			$this->load->view( "public/componentes/footer_f");
		}
		else{
			redirect(base_url().'acceso/logout');
		}
	}

	public function detalleusuario(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_usuario';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/forma_usuarios", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}

	public function historialsesiones(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_hsesiones';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];

		        	$this->load->model('Usuario_model');

		        	$data['res']					= $this->Usuario_model->getSesionesById($post_id, "", "");	
		        }

			} 
		

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/historico_sesion", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}	

	public function proveedores(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/proveedores';

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/proveedores", $data);
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}
	

	public function detalleproveedor(){
		if($this->session->userdata('login') == true){
			$data['scripts'][]          = 'app/private/modules/f_proveedor';
			$data['editable'] 			= false;
			$data['id']					= null;	
	   
			if(!empty($this->input->get())){
		        
		        $post_id      	= $this->input->get('id');

				$datos_get = array(
					'id'	=> $post_id,
				);
		        $this->form_validation->set_data($datos_get)->set_rules('id', 'id', 'trim|integer|max_length[11]|greater_than_equal_to[1]|required'); 

		        if($this->form_validation->run()){
		        	$data['editable'] 	= true;
		        	$data['id']			= $datos_get['id'];
		        }

			} 

			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/forma_proveedores", $data );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}
	}

	public function reportes(){
		if($this->session->userdata('login') == true){
			$this->load->view( "public/componentes/header_f", array( 'rol' => $this->session->userdata('rol') == 1 ? 1 : 0) );
			$this->load->view( "public/private/reportes" );
			$this->load->view( "public/componentes/footer_f");
		}else{
			redirect('/', 'refresh');
		}		
	}
}
?>
