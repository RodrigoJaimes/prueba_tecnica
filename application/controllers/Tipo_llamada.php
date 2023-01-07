<?php
require_once APPPATH.'controllers/Base.php';
class Tipo_llamada extends Base {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Inicio_model');
     }
	
	function index(){
		$data['tipo_llamada'] = $this->Inicio_model->get_tipo(null);

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/menus');
    $this->load->view('Tipo_llamada/index_tipo_llamada',$data);
	}

	//Obtiene el origen segun el codigo que se mande
	function get_datos(){
		$code = $this->input->post('code');

		$data = $this->Inicio_model->get_tipo($code);

		echo json_encode($data);
	}



	function guardar_tipo(){
		//Capturamos los valores que vinen por POST del JQUERY
		$tipo = $this->input->post('tipo');

		$data = '';
    $bandera = true;

    //Validamos que los campos no vayan vacios y de ir vacios mostramos un mensajes de error
		if($tipo == null){
			$data .= 'Debe de ingresar un tipo de llamada';
    	$bandera = false;
		}


		if($bandera){
			$data = array(
    			'tipo_llamada' 		=> $tipo,
    			'fecha_ingreso' 	=> date('Y-m-d'),
    			'estado' 					=> 1,

       		);
    		$this->Inicio_model->save_tipo($data);
			echo json_encode(null);
		}else{
			echo json_encode($data);
		}

	}


	//Funcion para editar el origen segun id
  function editar_tipo()
  {
    //Recibo los parametros que vienen por post del modal editar
    $code = $this->input->post('id_edit');
    $tipo = $this->input->post('tipo_edit');

    $data = '';
    $bandera = true;

    if ($tipo == null) {
      $data .= 'Debe de ingresar un tipo de llamada<br>';
      $bandera = false;
    }

    if ($bandera) {
      $data = array(
        'tipo_llamada'     => $tipo,
      );

      $this->Inicio_model->update_tipo($code, $data);
      echo json_encode(null);
    } else {
      echo json_encode($data);
    }
  }

  	//Funcion para eliminar el origen segun el codigo que se mande
   function eliminar_tipo()
  {
    $code = $this->input->post('code');

    $data = array(
      'estado'   => 0
    );

    $this->Inicio_model->delete_tipo($code, $data);

    echo json_encode(null);
  }

   
}