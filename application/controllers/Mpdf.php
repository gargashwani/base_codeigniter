<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mpdf extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model'); 

        // If user is not logged in -> redirect to user_login controller 
        // if(!$this->_is_logged_in('user_id')) 
        // {
        //     _redirect('user_login');
		// }        
	}
	
    public function index()
    {
		// echo base_url('/assets/images/01.jpg');
		// exit();
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('html_to_pdf',[],true);
		$mpdf->WriteHTML($html);
		$mpdf->showImageErrors = true;
		$mpdf->Image(base_url('/assets/images/01.jpg'), 0, 0, 210, 297, 'jpg', '', true, false);
		$mpdf->Image(base_url('/assets/images/02.png'), 0, 50, 50, 50, 'jpg', '#', true, false);
		$mpdf->SetAlpha(0.5);
		$mpdf->Image(base_url('/assets/images/02.png'), 100, 50, 50, 50, 'jpg', 'https://google.com', true, false);
		$mpdf->SetAlpha(1);
		$mpdf->Image(base_url('/assets/images/icon_01.png'), 50, 10, 10, 10, 'jpg', '', true, false);
		$mpdf->Image(base_url('/assets/images/icon_02.png'), 70, 10, 10, 10, 'jpg', '', true, false);
		$mpdf->Image(base_url('/assets/images/icon_03.png'), 90, 10, 10, 10, 'jpg', '', true, false);
		$mpdf->Image(base_url('/assets/images/icon_04.png'), 110, 10, 10, 10, 'jpg', '', true, false);
		$mpdf->Image(base_url('/assets/images/icon_05.png'), 130, 10, 10, 10, 'jpg', '', true, false);
		// $mpdf->Image(base_url('/assets/images/logo.png'), 150, 10, 10, 10, 'png', '', true, false);
		// use php 5.5 for png images
        $mpdf->Output(); // opens in browser
        // $mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
    }

}
