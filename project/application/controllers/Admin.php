<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()

    {

        parent::__construct();
        
		$this->load->model('Admin_model');
	    $this->load->helper(array('form', 'url'));
	    $this->load->library('session');
       

    }

	public function index()
	{
		//
	}

	public function login()
	{

        if($this->session->has_userdata('admindata')){

        	redirect('admin/dashboard');

        }

        if(isset($_POST) && !empty($_POST)){

		    if($_POST['submit'] == 'Login'){
	        
	            $status    = false;
				$username  = $_POST['username'];
				$password  = $_POST['password'];

			    $where     = array('username' => $username, 'password' => $password);
			    $admindata = $this->Admin_model->get_where('admin',$where,'array');
	            

	            if(count($admindata) == '1'){

	            	    $temp_arr = array('firstname'=>$admindata['0']['firstname'] , 'lastname' => $admindata['0']['lastname'], [email] => $admindata['0']['email']);

	                     $this->session->set_userdata('admindata', $temp_arr);
				         redirect('admin/dashboard');
	            }	
		    }
	    } 


		$this->load->view('admin/login');

	}

	public function dashboard()
	{
        
        if($this->session->has_userdata('admindata') == false){
        	redirect('admin');
        }

		$admindata = $this->session->userdata('admindata');
		$where     = array();
		$usercount = $this->Admin_model->get_where("users",$where,'count');


		$content_data = array(
	            'admindata' => $admindata,
	            'usercount' => $usercount
		);

		$this->load->view('admin/include/header', $content_data);
		$this->load->view('admin/dashboard', $content_data);
		$this->load->view('admin/include/footer', $content_data);
	}

	public function users()
	{
		if($this->session->has_userdata('admindata') == false){
        	redirect('admin');
        }

		$admindata = $this->session->userdata('admindata');
		$where     = array();
		$users     = $this->Admin_model->get_where('users',$where,'array');

		$content_data = array(
	            'admindata' => $admindata,
	            'users'     => $users
		);

		$this->load->view('admin/include/header', $content_data);
		$this->load->view('admin/users', $content_data);
		$this->load->view('admin/include/footer', $content_data);
	}

	public function user_detail()
	{
		if($this->session->has_userdata('admindata') == false){
        	redirect('admin');
        }

        if($this->uri->segment(2) > '0'){
        	$userid = $this->uri->segment(3);
        }
        else{
            redirect('admin/users');
        }

        
        $admindata = $this->session->userdata('admindata');
        $where     = array('id'=>$userid);
		$users     = $this->Admin_model->get_where('users',$where,'array');
        
        $where     = array('userid'=>$userid);
		$friends   = $this->Admin_model->get_where('freinds',$where,'array');

		$where     = array();
		$specialoffers   = $this->Admin_model->get_where('special_offers',$where,'array');

        $userspecialofferid = array();
        $special_code = array();


        if($users[0]['specialoffer'] !=''){

          $userspecialofferid = explode(',',$users[0]['specialoffer']);

        }
        
		foreach($userspecialofferid as $userspecialid){

			foreach($specialoffers as $specialoffer){

				if($userspecialid == $specialoffer['id']){
					array_push($special_code,$specialoffer['code']);
				}
			}

		}

		$users[0]['special_code'] = $special_code;
        

        $content_data = array(
	            'admindata' => $admindata,
	            'users'     => $users,
	            'friends'   => $friends
		);


        $this->load->view('admin/include/header', $content_data);
		$this->load->view('admin/user_detail', $content_data);
		$this->load->view('admin/include/footer', $content_data);
	}

	public function logout()
	{

        $this->session->unset_userdata('admindata');
		redirect('admin');
	}
}
