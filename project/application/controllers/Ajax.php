<?php 


	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * All AJAX functions should go in here
 *
 * CSRF protection has been disabled for this controller in the config file
 
 */
 
	class Ajax extends CI_Controller {


		/**
		 * Constructor
		 */
		function __construct()
		{
			parent::__construct();

			$this->load->model('Ajax_model');
	        $this->load->helper(array('form', 'url'));
		}
	
	
		/**
		 * Change session language - user selected
		 */

		//check to duplicate email
		public function search_email()  
		{  

            //post data
            $email = $_POST['email'];
			$where = array('email'=>$email);

			//get data
			$get_lists = $this->Ajax_model->get_where("users",$where,'count'); 

           
            //check data
			if($get_lists >= '0') {
				$output = array('status'=>'success','count'=>$get_lists);  
			}
			else{
				$output = array('status'=>'error'); 

			}

            //return data
			$data['result'] = $output;
			echo json_encode($data);

			exit;
			
		 }

}
