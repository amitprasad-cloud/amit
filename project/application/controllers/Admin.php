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
        //check sessiondata
        if($this->session->has_userdata('admindata')){
            
            //redirect to admin page
        	redirect('admin/dashboard');

        }

        
        if(isset($_POST) && !empty($_POST)){


            //onsubmit
		    if($_POST['submit'] == 'Login'){
	           
	            //post values
	            $status    = false;
				$username  = $_POST['username'];
				$password  = $_POST['password'];

                //check detail
			    $where     = array('username' => $username, 'password' => $password);
			    $admindata = $this->Admin_model->get_where('admin',$where,'array');
	            
                //check existance
	            if(count($admindata) == '1'){

	            	    $temp_arr = array('firstname'=>$admindata['0']['firstname'] , 'lastname' => $admindata['0']['lastname'], [email] => $admindata['0']['email']);
                         
                         ///make sesssion
	                     $this->session->set_userdata('admindata', $temp_arr);

	                     //redirect
				         redirect('admin/dashboard');
	            }	
		    }
	    } 

       //admin login page
		$this->load->view('admin/login');

	}

	public function dashboard()
	{
        
        //check admin session
        if($this->session->has_userdata('admindata') == false){

        	//redirect to login page
        	redirect('admin');
        }

        //admin data
		$admindata = $this->session->userdata('admindata');

		//user data
		$where     = array();
		$usercount = $this->Admin_model->get_where("users",$where,'count');


		$content_data = array(
	            'admindata' => $admindata,
	            'usercount' => $usercount
		);


        //view pages
		$this->load->view('admin/include/header', $content_data);
		$this->load->view('admin/dashboard', $content_data);
		$this->load->view('admin/include/footer', $content_data);
	}

	public function users()
	{
		//check admin session
		if($this->session->has_userdata('admindata') == false){

			//redirect o login page
        	redirect('admin');
        }
      
        //admin data
		$admindata = $this->session->userdata('admindata');

		//user data
		$where     = array();
		$users     = $this->Admin_model->get_where('users',$where,'array');

        
        //view data
		$content_data = array(
	            'admindata' => $admindata,
	            'users'     => $users
		);


        //view pages
		$this->load->view('admin/include/header', $content_data);
		$this->load->view('admin/users', $content_data);
		$this->load->view('admin/include/footer', $content_data);
	}

	public function user_detail()
	{

		//check admin session
		if($this->session->has_userdata('admindata') == false){

			//redirect o login page
        	redirect('admin');
        }

        //check user by userid
        if($this->uri->segment(2) > '0'){
        	$userid = $this->uri->segment(3);
        }
        else{
            redirect('admin/users');
        }


        //admin data
        $admindata = $this->session->userdata('admindata');

        //admin.user.friends data
        $where     = array('id'=>$userid);
		$users     = $this->Admin_model->get_where('users',$where,'array');
        
        //afriends data
        $where     = array('userid'=>$userid);
		$friends   = $this->Admin_model->get_where('freinds',$where,'array');
   
        //specialcode data
		$where     = array();
		$specialoffers   = $this->Admin_model->get_where('special_offers',$where,'array');

        $userspecialofferid = array();
        $special_code = array();


        if($users[0]['specialoffer'] !=''){

          $userspecialofferid = explode(',',$users[0]['specialoffer']);

        }
        
        //array of specialofffer
		foreach($userspecialofferid as $userspecialid){

			foreach($specialoffers as $specialoffer){
                
                //check selected special offer
				if($userspecialid == $specialoffer['id']){
					array_push($special_code,$specialoffer['code']);
				}
			}

		}

        //get user special code
		$users[0]['special_code'] = $special_code;

        
        //view data
        $content_data = array(
	            'admindata' => $admindata,
	            'users'     => $users,
	            'friends'   => $friends
		);

        //view pages
        $this->load->view('admin/include/header', $content_data);
		$this->load->view('admin/user_detail', $content_data);
		$this->load->view('admin/include/footer', $content_data);
	}

	public function logout()
	{
        //unset sesson
        $this->session->unset_userdata('admindata');
		redirect('admin');
	}
}
