<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model');
        $this->load->library('excel'); // loading excel third party libraries

        if(!$this->_is_logged_in('admin_id'))
        {
            _redirect('admin_login');
        }
    }

    public function index()
    {

    }


    public function home() {
        $data['lists'] = $this->global_model->select_all('lists'); 

        $data['total_lists'] = $this->global_model->count_rows('lists'); 
        $data['total_subscribers'] = $this->global_model->count_rows('subscribers');
        $data['total_active_subscribers'] =$this->global_model->count_rows('subscribers',['subscriber_status' =>'Active']);


        $data['msg']= $this->session->flashdata('msg');
        $data['alert_class']= $this->session->flashdata('alert_class');
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/navigation',$data);
        $this->load->view('admin/home', $data);
        $this->load->view('admin/common/footer');
    }

    public function lists()
    {

        $data['total_lists'] = $this->global_model->count_rows('lists'); 
        $data['total_subscribers'] = $this->global_model->count_rows('subscribers');
        $data['total_active_subscribers'] =$this->global_model->count_rows('subscribers',['subscriber_status' =>'Active']);

        $data['lists'] = $this->global_model->select_all('lists');   
        $data['msg']= $this->session->flashdata('msg');
        $data['alert_class']= $this->session->flashdata('alert_class');
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/navigation',$data);
        $this->load->view('admin/lists', $data);
        $this->load->view('admin/common/footer');        
    }    

    public function new_list()
    {

        $data = $this->input->post();
        if(!$list_name = $this->global_model->select_single('lists',$data))
        {
            if ($user_data = $this->global_model->add('lists',$data)) 
            {
                $this->_msg('msg', 'New List added successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();
            }                 
        }
        else 
        {
            $this->_msg('msg', 'This list name is already added');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();
        }                     
    }

    public function edit_list()
    {
        $data['total_lists'] = $this->global_model->count_rows('lists'); 
        $data['total_subscribers'] = $this->global_model->count_rows('subscribers');
        $data['total_active_subscribers'] =$this->global_model->count_rows('subscribers',['subscriber_status' =>'Active']);

        $id =  $this->uri->segment('3');
        $data['lists'] = $this->global_model->select_single('lists',[ 'list_id' => $id]);
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/navigation',$data);
        $this->load->view('admin/list_edit', $data);
        $this->load->view('admin/common/footer');
    }

    public function update_list()
    {
        $data['list_name'] = $this->input->post('list_name');
        $data['list_id'] = $this->input->post('list_id');
        $table = 'lists';
        $list_update = $this->global_model->update($table, ['list_id'=>$data['list_id']], ['list_name'=>$data['list_name']]);
        if($list_update)
        {   
            $this->_msg('msg', 'List updation successful!');
            $this->_class('alert_class', 'alert-success');
            _redirect('admin/lists');

        }
        else
        {
            $this->_msg('msg', 'List updation failed!');
            $this->_class('alert_class', 'alert-warning');
            _redirect('admin/lists');            
        }
    }

    public function list_delete() {
        $data['list_id'] = $this->input->get('list_id');
        if ($user_data = $this->global_model->delete('lists', $data)) {

            $this->_msg('msg', 'List deleted successfully.');
            $this->_class('alert_class', 'alert-success');
            _redirect_pre();

        } else {
            $this->_msg('alert', 'Please try later');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();
        }
    }  



public function change_password()
{
    $data['admin_user'] = $this->global_model
    ->select_single('admin_user',['admin_id'=>$this->session->userdata['admin_id']]);
        // echo "<pre>";            
        // print_r($data);          
        // echo "</pre>";   

        $data['total_lists'] = $this->global_model->count_rows('lists'); 
        $data['total_subscribers'] = $this->global_model->count_rows('subscribers');
        $data['total_active_subscribers'] =$this->global_model->count_rows('subscribers',['subscriber_status' =>'Active']);

    $this->load->view('admin/common/header');
    $this->load->view('admin/common/navigation',$data);
    $this->load->view('admin/profile', $data);
    $this->load->view('admin/common/footer'); 
} 

public function update_profile()
{   
        // echo "<pre>";
        // print_r($this->input->post());
        // echo "</pre>";
    $table = 'admin_user';
    $where = ['admin_id'=>$this->session->userdata('admin_id')];
    if($this->input->post('admin_username')){
        $data['admin_username'] = $this->input->post('admin_username');
        $this->global_model->update($table, $where, ['admin_username'=>$this->input->post('admin_username')]);
        $this->session->set_flashdata('msg','Username Updated!');
        $this->session->set_flashdata('alert','alert-success');
        _redirect_pre();
    }
    elseif($this->input->post('admin_email')){
        $data['admin_email'] = $this->input->post('admin_email');
        $this->global_model->update($table, $where, ['admin_email'=>$this->input->post('admin_email')]);
        $this->session->set_flashdata('msg','Email Updated!');
        $this->session->set_flashdata('alert','alert-success');
        _redirect_pre();
    }
        // To change password, all three fields are required
    if($this->input->post('admin_old_password')&&
        $this->input->post('admin_new_password')&&
        $this->input->post('admin_confirm_password'))
    {
       if(!($this->input->post('admin_new_password') == $this->input->post('admin_confirm_password')))
       {
        $this->session->set_flashdata('msg','New Password does not match with Confirm password.');
        $this->session->set_flashdata('alert','alert-danger');

        _redirect_pre();
    }
    elseif(!$this->global_model
        ->select_single($table, 
            ['admin_id'=>$this->session->userdata('admin_id'),'admin_password'=>$this->input->post('admin_old_password')]))
    {
        $this->session->set_flashdata('msg','You entered wrong old password.');
        $this->session->set_flashdata('alert','alert-danger');

        _redirect_pre();            
    }
    else
    {
        if($this->global_model->update($table, $where, ['admin_password'=>$this->input->post('admin_new_password')]))
        {
            $this->session->set_flashdata('msg','Password updated <successfully class=""></successfully>');
            $this->session->set_flashdata('alert','alert-success');

            _redirect_pre();                 
        }
    }
}
else
{
    $this->session->set_flashdata('msg','All three fields are required to change the password.');
    $this->session->set_flashdata('alert','alert-danger');

    _redirect_pre();            
}
}


public function logout() {
    $this->_unset_userdata('admin_id');
    $this->_unset_cookie('crm_admin_email');
    $this->_unset_cookie('crm_admin_password');

    _redirect('admin_login');
}

}
