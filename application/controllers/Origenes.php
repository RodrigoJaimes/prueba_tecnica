<?php
require_once APPPATH.'controllers/Base.php';
class Origenes extends Base {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Inicio_model');
     }
	
	function index(){
		$data['origen_llamada'] = $this->Inicio_model->get_origen(null);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/menus');
        $this->load->view('Origenes_llamada/index_origenes_llamada',$data);
	}

	//Obtiene el origen segun el codigo que se mande
	function get_datos(){
		$code = $this->input->post('code');

		$data = $this->Inicio_model->get_origen($code);

		echo json_encode($data);
	}



	function guardar_origen(){
		//Capturamos los valores que vinen por POST del JQUERY
		$origen = $this->input->post('origen');

		$data = '';
    	$bandera = true;

    	//Validamos que los campos no vayan vacios y de ir vacios mostramos un mensajes de error
		if($origen == null){
			$data .= 'Debe de ingresar un nombre de origen';
    		$bandera = false;
		}


		if($bandera){
			$data = array(
    			'origen_llamada' 		=> $origen,
    			'fecha_ingreso' 		=> date('Y-m-d'),
    			'estado' 				=> 1,

       		);
    		$this->Inicio_model->save_origen($data);
			echo json_encode(null);
		}else{
			echo json_encode($data);
		}

	}


	//Funcion para editar el origen segun id
  function editar_origen()
  {
    //Recibo los parametros que vienen por post del modal editar
    $code = $this->input->post('id_edit');
    $origen = $this->input->post('origen_edit');

    $data = '';
    $bandera = true;

    if ($origen == null) {
      $data .= 'Debe de ingresar un nombre de origen<br>';
      $bandera = false;
    }

    if ($bandera) {
      $data = array(
        'origen_llamada'     => $origen,
      );

      $this->Inicio_model->update_origen($code, $data);
      echo json_encode(null);
    } else {
      echo json_encode($data);
    }
  }

  	//Funcion para eliminar el origen segun el codigo que se mande
   function eliminar_origen()
  {
    $code = $this->input->post('code');

    $data = array(
      'estado'   => 0
    );

    $this->Inicio_model->delete_origen($code, $data);

    echo json_encode(null);
  }

   
}