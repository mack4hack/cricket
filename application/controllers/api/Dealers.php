<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	require APPPATH . '/libraries/REST_Controller.php';
	
		

	class Dealers extends REST_Controller
	{
		function __construct()
		{
		    // Construct the parent class
		    parent::__construct();

		    // Configure limits on our controller methods
		    // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		    $this->methods['dealer_get']['limit'] = 500; // 500 requests per hour per user/key
		    $this->methods['dealer_post']['limit'] = 100; // 100 requests per hour per user/key
		    $this->methods['dealer_delete']['limit'] = 50; // 50 requests per hour per user/key
		    $this->load->database(); // load database
		    $this->load->model('Admin_model'); // load model
		}	

		public function dealer_get($id)
		{
				// Users from a data store e.g. database
			        /*$players = [
			            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
			            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
			            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
			        ];*/

			        $dealers = $this->Admin_model->get_dealers();

			       // $id = $this->get('id');

			        // If the id parameter doesn't exist return all the users

			        if ($id === NULL)
			        {
			            // Check if the users data store contains users (in case the database result returns NULL)
			            if ($dealers)
			            {
			                // Set the response and exit
			                $this->response($dealers, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			            }
			            else
			            {
			                // Set the response and exit
			                $this->response([
			                    'status' => FALSE,
			                    'message' => 'No Dealer were found'
			                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			            }
			        }

			        // Find and return a single record for a particular user.

			        $id = (int) $id;

			        // Validate the id.
			        if ($id <= 0)
			        {
			            // Invalid id, set the response and exit.
			            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
			        }

			        // Get the user from the array, using the id as key for retreival.
			        // Usually a model is to be used for this.

			        $dealer = NULL;
                    
			        if (!empty($dealers))
			        {
			            foreach ($dealers as $key => $value)
			            {
			                if ( $value->id  == $id)
			                {
			                    
			                    $dealer = $value;
			                }
			            }
			        }

			        if (!empty($dealer))
			        {
			            $this->set_response($dealer, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			        }
			        else
			        {
			            $this->set_response([
			                'status' => FALSE,
			                'message' => 'Dealers could not be found'
			            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			        }
		}

		public function dealer_delete($id)
       {
       // $id = (int) $this->get('id');
      
        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $this->Admin_model->delete_dealer($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the dealer'
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code
    }
    
       public function areawisedealer_get()
		{
				 $country_id = (int) $this->get('country');   
				 $state_id = (int) $this->get('state');   
				 $city_id = (int) $this->get('city');
				
				
				
				 $dealers = $this->Admin_model->getAreaWiseDealers($country_id,$state_id,$city_id);
		          if ($dealers)
			            {
			                // Set the response and exit
			                $this->response($dealers, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			            }
			            else
			            {
			                // Set the response and exit
			                $this->response([
			                    'status' => FALSE,
			                    'message' => 'No Dealer were found'
			                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			            }
		
		
		}
		
		
		
   function addDealer_post()
      {
	   
	   $this->db->select('name');
	   $this->db->from('cities');
	   $this->db->where(array('id' => $_POST['city_id']));
	   $query = $this->db->get();
	   $city_name  = $query->row()->name;
	   $dealer_city =substr(strtoupper($city_name), 0, 3);
	  
	   $ar = array('role_id'=>'2','city_id'=>$_POST['city_id']);
	   $ret = $this->db
       ->where($ar)
       ->count_all_results('user_master');
	 
	   $paddedNum = sprintf("%03d", $ret+1);
	 
	   $user_code = $dealer_city."".$paddedNum;
	   $data = array("first_name" => $_POST['fname'],
					"last_name"   => $_POST['lname'],
					"country_id"  => $_POST['country_id'],
					"state_id"    => $_POST['state_id'],
					"user_code"   => $user_code,
					"city_id"     => $_POST['city_id'],
					"email_id"    => $_POST['email'],
					"password"    =>    $_POST['password'],
					"role_id"     => '2',
					"address_1"   => $_POST['address1'],
					"contact_no"  => $_POST['contact_no'],
					"alternate_no"=> $_POST['alternate_no'],
					"address_2"   => $_POST['address2'],
					"pincode"     => $_POST['pincode'],
					"activation_date" => date("Y-m-d"),
					"created_time" => date('Y-m-d H:i:s'),
	  );
	  if($this->db->insert('user_master',$data))
	  {	                
			$this->response([
				'status' => TRUE,
				'message' => 'Dealer Added Successfully'
			], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
			            
        }else{   
			$this->response([
				'status' => FALSE,
				'message' => 'No Dealer were added'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	  
     }

		
    
    function updateDealer_post()
      {
	  
	   $data = array("first_name" => $_POST['fname'],
					"last_name"   => $_POST['lname'],
					"country_id"  => $_POST['country_id'],
					"state_id"    => $_POST['state_id'],
					//"user_code"   => $user_code,
					"city_id"     => $_POST['city_id'],
					"email_id"    => $_POST['email'],
					"password"    =>    $_POST['password'],
					"role_id"     => '2',
					"address_1"   => $_POST['address1'],
					"contact_no"  => $_POST['contact_no'],
					"alternate_no"=> $_POST['alternate_no'],
					"address_2"   => $_POST['address2'],
					"pincode"     => $_POST['pincode'],
					"activation_date" => date("Y-m-d"),
					"updated_time" => date('Y-m-d H:i:s'),
	  );
	  $this->db->where('id', $_POST['update_id']);
	  if($this->db->update('user_master', $data))
	  {	                
			$this->response([
				'status' => TRUE,
				'message' => 'Dealer Updated Successfully'
			], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
			            
        }else{   
			$this->response([
				'status' => FALSE,
				'message' => 'No Dealer were updated'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	  
     }

		
   
    
    
	}
?>	
