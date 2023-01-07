<?php
require_once APPPATH.'controllers/Base.php';
class Inicio extends Base {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Inicio_model');
     }
	
	function index(){

		$this->load->view('dashboard/header');
		$this->load->view('dashboard/menus');
        $this->load->view('Inicio/index');
	}

   
}