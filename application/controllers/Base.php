<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller{ 

	var $permisos;
	var $seccion_actual;
	var $data;
	var $id_log;
	var $APP;//Configuración

	function __construct(){
		parent::__construct();
		$this->load->database();//para usar la bdd
		$this->load->helper('form');
		$this->load->library('encryption');//libreria para el uso de encriptacion
		$this->load->helper('url');
		$this->load->library('form_validation'); //libreria de validacion
   		$this->load->library('session');//para sesiones
		$this->load->model('Inicio_model');//modelo de empleados

	}

	
}