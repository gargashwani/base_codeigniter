<?php  
class user_login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');

        // if user is logged in, redirect him to user/home method
		if($this->_is_logged_in('user_id'))
		{
			_redirect('user/home');
		}

        // If cookies are set and email-password is matched, then login the user and redirect to user/home
        if($this->_read_cookie('user_email')&&$this->_read_cookie('user_password'))
        {
           $user_email = $this->_read_cookie('user_email');
           $user_password = $this->_read_cookie('user_password');

           if($user_data = $this->global_model->select_single('user', ['user_email'=>$user_email,'user_password'=>$user_password]))
           {
                $this->session->set_userdata('user_id', $user_data['user_id']);
                return redirect('user/home');
           }
        }

	}

    // This function call from AJAX
    public function user_data_submit() {
        $data = array(
            'username' => $this->input->post('name'),
            'pwd'=>$this->input->post('pwd')
        );

    //Either you can print value or you can send value to database
        echo json_encode($data);
    }
 
    public function index()
	{
        $data['msg']= $this->session->flashdata('msg');
        $data['alert_class']= $this->session->flashdata('alert_class');
    	$this->load->view('user/common/header');
    	$this->load->view('user/login',$data);
    	$this->load->view('user/common/footer');
	}

    public function check_email()
    {
        $data['user_email'] = $this->input->post('user_email');
        $data['user_password'] = $this->input->post('user_password');

        $check_email = $this->global_model->select_single('users',['user_email'=>$data['user_email']]);

        if(!$check_email)
        {
            $data['check_email'] = 'This email is not registered in our database, Please try another.';
        }
        else
        {
            $data['check_email'] = '';
        }
        echo json_encode($data);
    }

    public function login_submit() 
    {
        $data['user_email'] = $this->input->post('user_email');
        $data['user_password'] = $this->input->post('user_password');

        if($this->form_validation->run('user_login')==TRUE)
        {
            $user_email  = $this->input->post('user_email');
            $user_password  = $this->input->post('user_password');
            $remember_me =  $this->input->post('remember_me');

            if($remember_me == "on")
            {
                $cookie_user_email = array(
                    'name'   => 'user_email',
                    'value'  =>  $user_email,
                    'expire' => '604800',
                    );
                $this->input->set_cookie($cookie_user_email);
                
                $cookie_user_password = array(
                    'name'   => 'user_password',
                    'value'  =>  $user_password,
                    'expire' => '604800',
                    );
                $this->input->set_cookie($cookie_user_password);
            }

            if($user_data = $this->global_model->select_single('users', ['user_email'=>$user_email,'user_password'=>$user_password]))
            {   
                $this->_set_userdata('user_id', $user_data['user_id']);
                _redirect("user/home");
            }
            else
                {   
                $this->_msg('msg', '<i class="fa fa-frown-o" aria-hidden="true"></i> Email and password mismatched, Please enter right email & password ');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
                }


        }
        else
        {
            $this->load->view('user/common/header');
            $this->load->view('user/login');
            $this->load->view('user/common/footer');
        }

    }

}
?>