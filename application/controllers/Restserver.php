<?php

defined('BASEPATH') OR exit('No direct script access allowed');
		
		use chriskacerguis\RestServer\RestController;
    require APPPATH . '/libraries/RestController.php';
    require APPPATH . '/libraries/Format.php';

	class Restserver extends RestController {


	public function __construct(){
		parent::__construct();

		$this->load->database();
		$this->load->model('Inicio_model');
	}
	
	public function obtener_datos_get()
	{
		$this->response($this->Inicio_model->get_gestion(null));
	}  
   
}