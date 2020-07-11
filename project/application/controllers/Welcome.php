<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
    {

        parent::__construct();
        
		$this->load->model('Welcome_model');
	    $this->load->helper(array('form', 'url'));
	    $this->load->library('session');
    }


	public function index()
	{

        //check to redirt to next page
		$redirectthankyou = false; 

		//get special offer
		$where = array('status'=>'1');
	    $get_lists = $this->Welcome_model->get_where("special_offers",$where);

        // check for post data
        if(isset($_POST) && !empty($_POST)){

            // check for submit
			if($_POST['getregisterd']=='Submit'){

                // get post data && insert && store in seesion data
				if(true){
                    $this->session->unset_userdata('usersdata');
                    $usersdata    = array();
					$firstname    = $_POST['registration']['primaryGuest']['firstName'];
					$lastname     = $_POST['registration']['primaryGuest']['lastName'];
					$email        = $_POST['registration']['primaryGuest']['email'];
					$zipcode      = $_POST['registration']['primaryGuest']['zipCode'];
					$noOfGuests   = $_POST['registration']['noOfGuests'];
					$step         = $_POST['registration']['step'];
					$token        = $_POST['registration']['_token'];
					$specialoffer = (isset($_POST['specialoffer']))?implode(",",$_POST['specialoffer']):'';
					$date         = date("Y-m-d H:i");
					$barcode      = $this->barcode_generate();
                    
                   
                    // insert user
				    $data = array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'zipcode'=>$zipcode,'guestcount'=>$noOfGuests,'barcode'=>$barcode,'specialoffer'=>$specialoffer,'status'=>'1','createddate'=>$date);

				    //insert and get inserted id
				    $insertedid = $this->Welcome_model->insert("users",$data);
                    
                    // array of user data
				    array_push($usersdata,array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'barcode'=>$barcode,'insertedid'=>$insertedid));

				}
				
				
                //get friends detail
				if(isset($_POST['registration']['guests'])){
              
                    //all post guest
					$guests = $_POST['registration']['guests'];

					foreach($guests as $guest){

                        //post guest data
						$firstname    = $guest['firstName'];
					    $lastname     = $guest['lastName'];
					    $email        = $guest['email'];
					    $barcode      = $this->barcode_generate();

					   //insert
					    $data = array('userid'=>$insertedid,'firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'barcode'=>$barcode,'status'=>'1','createddate'=>$date);
				        $insert = $this->Welcome_model->insert("freinds",$data);

                        // put vallues in an array
				        array_push($usersdata,array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'barcode'=>$barcode));

					}   
				}
				else{

					//set variable true
					$insert = true;
				}
					
			    //maill  redirect and make seesion of userdata
                if($insert){

                	// create session of sata
                	$this->session->set_userdata('usersdata', $usersdata);

                	//maill to all(user and freinds)
                	$mailall  = $this->compose_signupmail('all');
                    $redirectthankyou = 'true';

					if($redirectthankyou){
					
					   // redirect
					   redirect('thank-you');
				    }
			    }
				
			}

		    
        }

        // data view
		$content_data = array(
	         'get_lists'    => $get_lists
		);

        //view page
		$this->load->view('welcome', $content_data);

	}

	public function thank_you()
	{

        // check session data
		if($this->session->has_userdata('usersdata')){

            //check user session data
            $usersdata = $this->session->userdata('usersdata');

            if(isset($usersdata[0]['insertedid'])){
                
                //user id
            	$id    = $usersdata[0]['insertedid'];

            }
            else{
                
                // redirect
            	redirect('');

            }  
        }
        else{
           
               // redirect
        	   redirect('');
        }


        if(isset($_POST) && !empty($_POST)){

            //on submit
			if($_POST['getregisterd'] == 'Submit'){
                
				if(isset($_POST['registration']['guests'])){

					$usersdata = array();

                    // check session user data
					if($this->session->userdata('usersdata')){

                        //get userdata array from sesssion
						$usersdata = $this->session->userdata('usersdata');

					}
                    
                    //post data
					$guests    = $_POST['registration']['guests'];
                    $id        = $_POST['id'];
                    $date      = date("Y-m-d H:i");

					foreach($guests as $guest){

                        //post data
                        $user         = array();
						$firstname    = $guest['firstName'];
					    $lastname     = $guest['lastName'];
					    $email        = $guest['email'];
					    $rnd          = rand(1000,9999);
					    $barcode      = $this->barcode_generate($rnd);
                     
                        //make array of guest
                        $user = array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'barcode'=>$barcode);
					    array_push($usersdata,$user);

                      //send mail to user
					    if(true){

							    //view data
			                  	$content_data = array(
							         'userguest'   => $user,
							         'freinds'    => array()
								);
			 
			                    //get message template
						    	$message = $this->load->view('htmlmail',$content_data,true); 
						    	//send mail
			                    $this->send_mail($user['email'],$message);

	                    }


					    
					    //insert data
					    $data = array('userid'=>$id,'firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'barcode'=>$barcode,'status'=>'1','createddate'=>$date);
				        $insert = $this->Welcome_model->insert("freinds",$data);

					}
                    
                    //set seesion userdata array
					 $this->session->set_userdata('usersdata', $usersdata);  

					 //maill to main user
					 $temp = '';
					 $mailall  = $this->compose_signupmail($temp);

					 //redirect
					  redirect('thank-you'); 
				}
			}
		}

        //view data
		$content_data = array(
	            'usersdata' => $usersdata,
	            'id'        => $id
		);

        //view page
		$this->load->view('thank_you', $content_data);
	}

	public function barcode_generate(){

        //get random numbers to use
		$time = time();
		$rnd  = rand(1000,9999);
		
		//get barcode library
		$this->load->library('zend');
	    $this->zend->load('Zend/Barcode');

	    //create barcode
	    $test = Zend_Barcode::draw('ean8', 'image', array('text' =>$rnd), array());

	    $brcodeimg = 'img/barcode/barcode'.$time.'.jpg';

	    // save barcode image
	    imagejpeg($test, $brcodeimg, 100);

	    return $brcodeimg;
	}

   public function compose_signupmail($action){
			            
   	    if($this->session->has_userdata('usersdata')){

   	    	//get session userdata array
            $usersdata = $this->session->userdata('usersdata');
                     
            // data  $array 
            $userguest = array();
            $freinds  = array();
            foreach($usersdata as $key=>$user){
                  if($key == 0){

                  	   //get user data
                       $userguest = $user;
                  }
                  else{

                  	    if($action == 'all'){
		                  	//view data
		                  	$content_data = array(
						         'userguest'   => $user,
						         'freinds'    => array()
							);
		 
		                    //get message template
					    	$message = $this->load->view('htmlmail',$content_data,true); 
					    	//send mail
		                    $this->send_mail($user['email'],$message);

					    }
                  	array_push($freinds,$user);
                }
            }

        }
        else{
        	return false;
        }

        //view data
        $content_data = array(
	         'userguest'    => $userguest,
	         'freinds'    => $freinds
		);

        //get message template
    	$message = $this->load->view('htmlmail',$content_data,true); 

    	//send mail
        $this->send_mail($userguest['email'],$message);
        return true;
   }



   public function send_mail($to,$msg){ 
			            
            //include livbraray
            require_once(APPPATH.'libraries/sendemail/sendgrid-php.php');
            
            //set url and secreat key
            $url = 'https://api.sendgrid.com/';
            $apiKey = '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';


            //send mail
			$sendgrid = new SendGrid($apiKey);
			$email = new  \SendGrid\Mail\Mail();
			$email->setFrom("amitprasad0135@gmail.com", "dasdak");
			$email->setSubject("Welcome to redskins group");
			$email->addTo($to, "Example User");
			//$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
			$email->addContent("text/html",$msg);

            //get response
			try {
			    $response = $sendgrid->send($email);
			    print $response->statusCode() . "\n";
			    print_r($response->headers());
			    print $response->body() . "\n";
			} catch (Exception $e) {
			    echo 'Caught exception: '. $e->getMessage() ."\n";
			}		
   }

}
