<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GoogleApis extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model'); 
     
    }

    public function index() {
		$this->load->view('gmap');
    }

	public function gmap(){
	}




}
