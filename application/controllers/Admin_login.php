<?php  
class Admin_login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');

        // if admin is logged in, redirect him to admin/home method
		if($this->_is_logged_in('admin_id'))
		{
			_redirect('admin/home');
		}

        if($this->_read_cookie('crm_admin_email')&&$this->_read_cookie('crm_admin_password'))
        {
           $admin_email = $this->_read_cookie('crm_admin_email');
           $admin_password = $this->_read_cookie('crm_admin_password');

           if($user_data = $this->global_model->select_single('admin_user', ['admin_email'=>$admin_email,'admin_password'=>$admin_password]))
           {
                $this->session->set_userdata('admin_id', $user_data['admin_id']);
                return redirect('admin/home');
           }
        }

	}

	public function paths()
	{
        //  check full file path, just call the function.
        echo FCPATH;
		echo APPPATH;
	}
	public function index()
	{
    	$this->load->view('admin/common/header');
    	$this->load->view('admin/login');
    	$this->load->view('admin/common/footer');
	}

    public function login_submit() 
    {
        
        $this->form_validation->set_rules('admin_email','Admin Email','required|trim');
        $this->form_validation->set_rules('admin_password','Admin Password','required|trim');
        if($this->form_validation->run())
        {
            $admin_email  = $this->input->post('admin_email');
            $admin_password  = $this->input->post('admin_password');
            $remember_me =  $this->input->post('remember_me');

            if($remember_me == "on")
            {
                $cookie_admin_email = array(
                    'name'   => 'crm_admin_email',
                    'value'  =>  $admin_email,
                    'expire' => '604800',
                    );
                $this->input->set_cookie($cookie_admin_email);
                
                $cookie_admin_password = array(
                    'name'   => 'crm_admin_password',
                    'value'  =>  $admin_password,
                    'expire' => '604800',
                    );
                $this->input->set_cookie($cookie_admin_password);
            }

            if($user_data = $this->global_model->select_single('admin_user', ['admin_email'=>$admin_email,'admin_password'=>$admin_password]))
            {   
                $this->_set_userdata('admin_id', $user_data['admin_id']);
                _redirect("admin/home");
            }
            else
                {   
                    $this->session->set_flashdata('login_fail',"Login failed, Please try again!");
                    _redirect_pre();
                }


        }

    }

}
?>
