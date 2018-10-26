<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model'); 

        // If user is not logged in -> redirect to user_login controller 
        if(!$this->_is_logged_in('user_id')) 
        {
            _redirect('user_login');
        }        
    }

    public function index() {

    }

    public function home()
    {
        // Send flashdata of alert messages and Show the alert message.    
        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');
        $data['get_data'] = $this->global_model->select_all('datatabledata');
        
        $this->load->view('user/common/header');
        $this->load->view('user/common/navigation',$data);
        $this->load->view('user/home', $data);
        $this->load->view('user/common/footer');
    }

    public function add_row()
    {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');

        $tableData = $this->global_model->add('datatabledata',$data);

        echo json_encode($tableData);        
    }

    public function get_data(){
        $get_data = $this->global_model->select_all('datatabledata');
        echo json_encode($get_data);          
    }

    public function logout() {
    $this->_unset_userdata('user_id');
    $this->_unset_cookie('user_email');
    $this->_unset_cookie('user_password');

    _redirect('user_login');
    }



    public function email()
    {
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => '',
        'smtp_port' =>  587,
        'smtp_user' => '',    //email id
        'smtp_pass' => '',            // password
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
        );  
        $this->load->library('email', $config);  

            $from_email = '';
            $this->email->set_newline("\r\n");
            $this->email->from($from_email, 'CRM'); 
            $this->email->to('');
            $this->email->subject('Subject Demo'); 
            $this->email->message('Demo Message'); 
            $this->email->set_mailtype('html');
            $this->email->send();
    
    }




}
