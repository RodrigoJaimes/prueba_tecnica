<?php
require_once APPPATH.'controllers/Base.php';
class productos extends Base {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Inicio_model');
     }
	
	function index(){
		$data['productos'] = $this->Inicio_model->get_all_productos(null);

		$data['sucursal'] = $this->Inicio_model->get_all_sucursal();
		$data['marca'] = $this->Inicio_model->get_all_marca();
		$data['categoria'] = $this->Inicio_model->get_all_categoria();
		$data['proveedor'] = $this->Inicio_model->get_all_proveedor();

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/menus');
        $this->load->view('Inicio/index',$data);
	}


	function guardar_producto(){
		//Capturamos los valores que vinen por POST del Jquery
		$nombre = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$precio = $this->input->post('precio');
		$stock = $this->input->post('stock');
		$sucursal = $this->input->post('sucursal');
		$marca = $this->input->post('marca');
		$categoria = $this->input->post('categoria');
		$proveedor = $this->input->post('proveedor');
		//$archivo1 =	$this->upload->do_upload('archivo1');

		$data = '';
    	$bandera = true;

    	//Validamos que los campos no vayan vacios y de ir vacios mostramos un mensajes de error
		if($nombre == null){
			$data .= 'Debe de ingresar un nombre de producto<br>';
    		$bandera = false;
		}

		if($descripcion == null){
			$data .= 'Debe de ingresar una descripcion de producto<br>';
    		$bandera = false;
		}

		if($precio == null){
			$data .= 'Debe de ingresar un precio de producto<br>';
    		$bandera = false;
		}

		if($stock == null){
			$data .= 'Debe de ingresar una cantidad de stock<br>';
    		$bandera = false;
		}

		/*if($archivo1 == null){
			$data .= 'Debe de subir una imagen <br>';
    		$bandera = false;
		}*/

		if($bandera){
			$data = array(
    			'nombre' 		=> $nombre,
    			'descripcion' 	=> $descripcion,
    			'precio' 		=> $precio,
    			'stock' 		=> $stock,
    			'id_sucursal' 	=> $sucursal,
    			'id_marca'   	=> $marca,
    			'id_categoria' 	=> $categoria,
    			'id_proveedor' 	=> $proveedor,
    			'fecha_ingreso' => date("Y-m-d H:i:s"),
    			'estado' 		=> 1,
    		);
    		$this->Inicio_model->save_producto($data);
			echo json_encode(null);
		}else{
			echo json_encode($data);
		}

	}

	function llenar_productos(){

		//echo "entre baby";

		$codigo = $this->input->post('codigo');

		echo $codigo;

		//$data = $this->Inicio_model->get_all_productos($code);

		//echo "<pre>";
		//print_r($data);


		//echo json_encode($data);
	}

   
}