<?php
class Controlador extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$data['scripts'][]          = 'app/private/modules/acceso';

		$this->load->view( "public/componentes/public_header_f" );
		$this->load->view( "public/login", $data );
		$this->load->view( "public/componentes/footer_f");
	}

	public function restablecer(){
		$this->load->view( "public/componentes/public_header_f" );
		$this->load->view( "public/restablecer" );
		$this->load->view( "public/componentes/footer_f");
	}

	public function puntosVenta(){
		
		$data['scripts'][]          = 'app/private/modules/puntosVenta';

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/puntosVenta", $data );
		$this->load->view( "public/componentes/footer_f");

	}

	public function detalleptventa(){

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

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/forma_puntosventa", $data );
		$this->load->view( "public/componentes/footer_f");

	}	

	public function insumos(){

		$data['scripts'][]          = 'app/private/modules/insumos';


		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/insumos", $data );
		$this->load->view( "public/componentes/footer_f");
	}

	public function detalleinsumo(){

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

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/forma_insumos", $data );
		$this->load->view( "public/componentes/footer_f");

	}	
	
	public function mermainsumo(){

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
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/forma_merma_insumo", $data );
		$this->load->view( "public/componentes/footer_f");

	}


	public function historialmermainsumo(){

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
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/historico_merma_insumo", $data );
		$this->load->view( "public/componentes/footer_f");

	}	

	public function comprainsumo(){

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
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/forma_compra_insumo", $data );
		$this->load->view( "public/componentes/footer_f");

	}	

	public function historialcomprainsumo(){

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
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/historico_compra_insumo", $data );
		$this->load->view( "public/componentes/footer_f");

	}

	public function recetas(){
		$data['scripts'][]          = 'app/private/modules/recetas';
		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/recetas", $data );
		$this->load->view( "public/componentes/footer_f");

	}

	public function detallereceta(){
		$this->load->model('Acceso_model');
		//mandamos el ID de usuario
		$res = $this->Acceso_model->getPuntosVenta(1);
		$punto_ventaS = $this->input->get('punto_venta');
		$data['scripts'][] = 'app/private/modules/detalle_recetas';
		foreach ($res as $punto_venta) {
			if($punto_venta->idPuntoVenta == $punto_ventaS) {
				//cargar el modelo para hacer el if de si esos puntos de venta le corresponden
				$this->load->view( "public/componentes/header_f" );
				$this->load->view( "public/private/forma_receta", $data );
				$this->load->view( "public/componentes/footer_f");
			}else{
				$data['scripts'][]          = 'app/private/modules/recetas';
				$this->load->view( "public/componentes/header_f" );
				$this->load->view( "public/private/recetas", $data );
				$this->load->view( "public/componentes/footer_f");
			}
		}

	}

	public function productos(){
		$data['scripts'][]          = 'app/private/modules/productos';

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/productos", $data );
		$this->load->view( "public/componentes/footer_f");

	}

	public function detalleproducto(){

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
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/forma_productos", $data );
		$this->load->view( "public/componentes/footer_f");

	}

	public function mermaproducto(){

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
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/forma_merma_productos", $data );
		$this->load->view( "public/componentes/footer_f");

	}


	public function historialmermaproducto(){

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
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/historico_merma_productos", $data );
		$this->load->view( "public/componentes/footer_f");

	}	

	public function compraproducto(){

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
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/forma_compra_productos", $data );
		$this->load->view( "public/componentes/footer_f");

	}	

	public function usuarios(){
		$data['scripts'][]          = 'app/private/modules/usuarios';

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/usuarios", $data );
		$this->load->view( "public/componentes/footer_f");

	}

	public function detalleusuario(){

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
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/forma_usuarios", $data );
		$this->load->view( "public/componentes/footer_f");

	}

	public function historialsesiones(){

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

	        	$data['res']					= $this->Usuario_model->getSesionesById($post_id);	
	        }

		} 
	

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/historico_sesion", $data );
		$this->load->view( "public/componentes/footer_f");

	}	

	public function proveedores(){

		$data['scripts'][]          = 'app/private/modules/proveedores';

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/proveedores", $data);
		$this->load->view( "public/componentes/footer_f");

	}
	

	public function detalleproveedor(){

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

		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/forma_proveedores", $data );
		$this->load->view( "public/componentes/footer_f");

	}

	public function reportes(){
		$this->load->view( "public/componentes/header_f" );
		$this->load->view( "public/private/reportes" );
		$this->load->view( "public/componentes/footer_f");
	}
}
?>
