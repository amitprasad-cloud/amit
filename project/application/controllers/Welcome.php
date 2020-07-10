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
				    $insertedid = $this->Welcome_model->insert("users",$data);
                    
                    // array of user data
				    array_push($usersdata,array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'barcode'=>$barcode,'insertedid'=>$insertedid));

				}
				
				
                //get friends detail
				if(isset($_POST['registration']['guests'])){

					$guests = $_POST['registration']['guests'];

					foreach($guests as $guest){

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
					$insert = true;
				}
					
			    //maill  redirect and make seesion of userdata
                if($insert){

                	// create session of sata
                	$this->session->set_userdata('usersdata', $usersdata);

                	//maill to all(user and freinds)
                	$mailall  = $this->compose_signupmail();
                    $redirectthankyou = 'true';

					if($redirectthankyou){
								            // redirect
					   redirect('thank-you');
				    }
			    }
				
			}

		    
        }



		$content_data = array(
	         'get_lists'    => $get_lists
		);


		$this->load->view('welcome', $content_data);

	}

	public function thank_you()
	{


		if($this->session->has_userdata('usersdata')){

            $usersdata = $this->session->userdata('usersdata');

            if(isset($usersdata[0]['insertedid'])){

            	$id    = $usersdata[0]['insertedid'];

            }
            else{

            	redirect('');

            }  
        }
        else{

        	   redirect('');
        }


        if(isset($_POST) && !empty($_POST)){


			if($_POST['getregisterd'] == 'Submit'){
                
				if(isset($_POST['registration']['guests'])){

					$usersdata = array();

					if($this->session->userdata('usersdata')){

						$usersdata = $this->session->userdata('usersdata');

					}
                    
					$guests    = $_POST['registration']['guests'];
                    $id        = $_POST['id'];
                    $date      = date("Y-m-d H:i");

					foreach($guests as $guest){

						$firstname    = $guest['firstName'];
					    $lastname     = $guest['lastName'];
					    $email        = $guest['email'];
					    $rnd          = rand(1000,9999);
					    $barcode      = $this->barcode_generate($rnd);


					    array_push($usersdata,array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'barcode'=>$barcode));

					    $data = array('userid'=>$id,'firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'barcode'=>$barcode,'status'=>'1','createddate'=>$date);
				        $insert = $this->Welcome_model->insert("freinds",$data);

					}

					 $this->session->set_userdata('usersdata', $usersdata);  
					  redirect('thank-you'); 
				}
			}
		}

		$content_data = array(
	            'usersdata' => $usersdata,
	            'id'        => $id
		);

		$this->load->view('thank_you', $content_data);
	}

	public function barcode_generate(){

		$time = time();
		$rnd          = rand(1000,9999);
		
		$this->load->library('zend');
	    $this->zend->load('Zend/Barcode');
	    $test = Zend_Barcode::draw('ean8', 'image', array('text' =>$rnd), array());

	    $brcodeimg = 'img/barcode/barcode'.$time.'.jpg';
	    imagejpeg($test, $brcodeimg, 100);

	    return $brcodeimg;
	}

   public function compose_signupmail(){

   	     $array = array();
	   // $array = array(array('userame'=>'swaptik godh','barcode'=>'img/barcode/barcode1594147815.jpg'));
	   // $array = array(array('userame'=>'swaptik godh','barcode'=>'img/barcode/barcode1594147815.jpg'),array('userame'=>'swaptik godh','barcode'=>'img/barcode/barcode1594147815.jpg'),array('userame'=>'swaptik godh','barcode'=>'img/barcode/barcode1594147815.jpg'),array('userame'=>'swaptik godh','barcode'=>'img/barcode/barcode1594147815.jpg'),array('userame'=>'swaptik godh','barcode'=>'img/barcode/barcode1594147815.jpg'));
       // $data = array();
echo '@2';
			            
   	    if($this->session->has_userdata('usersdata')){
            $usersdata = $this->session->userdata('usersdata');
           
                      
           // $usersdata = $array ;
            $userguest = array();
            $freinds  = array();
            foreach($usersdata as $key=>$user){
                  if($key == 0){
                       $userguest = $user;
                  }
                  else{
                  	 $content_data = array(
				         'userguest'   => $user,
				         'freinds'    => array()
					);

			    	$message = $this->load->view('htmlmail',$content_data,true); 
                    $this->send_mail($user['email'],$message);
                  	array_push($freinds,$user);
                }
            }

        }
        else{
        	return false;
        }

         print_r($userguest);

         print_r($freinds);

         
        $content_data = array(
	         'userguest'    => $userguest,
	         'freinds'    => $freinds
		);

    	$message = $this->load->view('htmlmail',$content_data,true); 
        $this->send_mail($userguest['email'],$message);
        return true;
   }



   public function send_mail($to,$msg){ 
			            

            require_once(APPPATH.'libraries/sendemail/sendgrid-php.php');
            
            $url = 'https://api.sendgrid.com/';
            $apiKey = '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';

			$sendgrid = new SendGrid($apiKey);
			$email = new  \SendGrid\Mail\Mail();

			$email = new \SendGrid\Mail\Mail(); 
			$email->setFrom("amitprasad0135@gmail.com", "dasdak");
			$email->setSubject("Welcome to redskins group");
			$email->addTo($to, "Example User");
			//$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
			$email->addContent("text/html",$msg);

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
