<?php
require_once APPPATH.'controllers/Base.php';
class Gestiones extends Base {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Inicio_model');
     }
	
	function index(){
		//Arreglo para traer todo los tipos de llamada que existen
		$data['tipo_llamada'] = $this->Inicio_model->get_tipo(null);
		//Arreglo para traer todos los origenes de llamada que existen
		$data['origen_llamada'] = $this->Inicio_model->get_origen(null);

		$data['gestion'] = $this->Inicio_model->get_gestion(null);


		$this->load->view('dashboard/header');
		$this->load->view('dashboard/menus');
        $this->load->view('Gestiones/index_gestiones',$data);
	}

		//Obtiene el origen segun el codigo que se mande
		function get_datos(){
			$code = $this->input->post('code');

			$data = $this->Inicio_model->get_gestion($code);

			echo json_encode($data);
		}



	function guardar_gestion(){
		//Capturamos los valores que vinen por POST del Jquery
		$tipo = $this->input->post('tipo');
		$origen = $this->input->post('origen');
		$nombre = $this->input->post('nombre');
		$telefono = $this->input->post('telefono');
		$gestion = $this->input->post('gestion');

		$data = '';
    	$bandera = true;

    	//Validamos que los campos no vayan vacios y de ir vacios mostramos un mensajes de error
		if($nombre == null){
			$data .= 'Debe de ingresar un nombre de gestion<br>';
    		$bandera = false;
		}

		if($telefono == null){
			$data .= 'Debe de ingresar un numero de telefono de gestion<br>';
    		$bandera = false;
		}

		if($gestion == null){
			$data .= 'Debe de ingresar una fecha de gestion<br>';
    		$bandera = false;
		}

		

		if($bandera){
			$data = array(
    			'tipo_llamada_id' 		=> $tipo,
    			'origen_llamada_id' 	=> $origen,
    			'nombre' 				=> $nombre,
    			'telefono' 				=> $telefono,
    			'gestion' 				=> $gestion,
    			'estado' 				=> 1,
    		);
    		$this->Inicio_model->save_gestion($data);
			echo json_encode(null);
		}else{
			echo json_encode($data);
		}

	}


	//Funcion para editar el origen segun id
  function editar_gestion()
  {
    //Recibo los parametros que vienen por post del modal editar
    $code = $this->input->post('code');
    $tipo = $this->input->post('tipo_edit');
	$origen = $this->input->post('origen_edit');
	$nombre = $this->input->post('nombre_edit');
	$telefono = $this->input->post('telefono_edit');
	$gestion = $this->input->post('gestion_edit');

    $data = '';
    $bandera = true;

    //Validamos que los campos no vayan vacios y de ir vacios mostramos un mensajes de error
		if($nombre == null){
			$data .= 'Debe de ingresar un nombre de gestion<br>';
    		$bandera = false;
		}

		if($telefono == null){
			$data .= 'Debe de ingresar un numero de telefono de gestion<br>';
    		$bandera = false;
		}

		if($gestion == null){
			$data .= 'Debe de ingresar una fecha de gestion<br>';
    		$bandera = false;
		}

    if ($bandera) {
      $data = array(
    			'tipo_llamada_id' 		=> $tipo,
    			'origen_llamada_id' 	=> $origen,
    			'nombre' 				=> $nombre,
    			'telefono' 				=> $telefono,
    			'gestion' 				=> $gestion,
    		);

      $this->Inicio_model->update_gestion($code, $data);
      echo json_encode(null);
    } else {
      echo json_encode($data);
    }
  }


  	//Funcion para eliminar la gestion segun el codigo que se mande
   function eliminar_gestion()
  {
    $code = $this->input->post('code');

    $data = array(
      'estado'   => 0
    );

    $this->Inicio_model->delete_gestion($code, $data);

    echo json_encode(null);
  }


   
}