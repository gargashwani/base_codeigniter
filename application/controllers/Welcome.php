<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model'); 
	
    $this->load->library('table');

	$this->load->library('pagination');

	$this->load->helper('form');

	$this->load->helper('url');

	$this->load->database(); //load library database      
    }


public function get_jotform_data()
{

//Get form field values and decode - nothing to change here
$fieldvalues = $_REQUEST['rawRequest'];
$obj = json_decode($fieldvalues, true);

print_r($obj);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "###",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "Cache-Control: no-cache",
	    "Postman-Token: aa579936-b4af-4166-b4e6-cdf609a82d31"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}
}


function backup()
{
   $table_name = "users";
   // $backup_file  = base_url('assets/users.sql');
   $backup_file  = sys_get_temp_dir().'/users.sql';
   $sql = $this->db->query("SELECT * INTO OUTFILE $backup_file FROM $table_name");
   
   if(! $retval ) {
      die('Could not take data backup: ' . mysql_error());
   }
   
   echo "Backedup  data successfully\n";
}

function index($offset = 0){
 $this->load->library('table');
 $this->load->library('pagination');
 $this->load->helper('form');
 $this->load->helper('url');
 $this->load->database(); //load library database

// Config setup
$num_rows=$this->db->count_all("users");
 $config['base_url'] = base_url().'index.php/welcome/index';
 $config['total_rows'] = $num_rows;
 $config['per_page'] = 5;
 $config['num_links'] = $num_rows;
 $config['use_page_numbers'] = TRUE;
 $this->pagination->initialize($config);

$records = $this->db->get('users', $config['per_page'],$offset);// take record of the table
$data['records'] = $records->result_array();
// $header = array('Id', 'Name','Email','Mobile','Address'); // create table header
// $this->table->set_heading($header);// apply a heading with a header that was created
$this->load->view('welcome_message',$data); // load content view with data taken from the users table
 }

}
