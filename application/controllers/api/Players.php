<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	require APPPATH . '/libraries/REST_Controller.php';
	
		

	class Players extends REST_Controller
	{
		function __construct()
		{
		    // Construct the parent class
		    parent::__construct();

		    // Configure limits on our controller methods
		    // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		    $this->methods['player_get']['limit'] = 500; // 500 requests per hour per user/key
		    $this->methods['player_post']['limit'] = 100; // 100 requests per hour per user/key
		    $this->methods['player_delete']['limit'] = 50; // 50 requests per hour per user/key
		    $this->load->database(); // load database
		    $this->load->model('Admin_model'); // load model
		    $this->load->model('bets_model'); // load model
		    $this->load->library('ion_auth');
		}	

		public function player_get($id = false)
		{
				// Users from a data store e.g. database
			        /*$players = [
			            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
			            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
			            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
			        ];*/

			        $players = $this->Admin_model->get_players();

			       

			        // If the id parameter doesn't exist return all the users

			        if ($id == false)
			        {
			            // Check if the users data store contains users (in case the database result returns NULL)
			            if ($players)
			            {
			                // Set the response and exit
			                $this->response($players, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			            }
			            else
			            {
			                // Set the response and exit
			                $this->response([
			                    'status' => FALSE,
			                    'message' => 'No Player were found'
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

			        $player = NULL;
                    
			        if (!empty($players))
			        {
			            foreach ($players as $key => $value)
			            {
			                if ( $value->id  == $id)
			                {
			                    
			                    $player = $value;
			                }
			            }
			        }

			        if (!empty($player))
			        {
			            $this->set_response($player, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			        }
			        else
			        {
			            $this->set_response([
			                'status' => FALSE,
			                'message' => 'Players could not be found'
			            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			        }
		}

		public function player_delete($id)
     {
       // $id = (int) $this->get('id');
      
        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $this->Admin_model->delete_player($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the player'
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code
    }
    function addPlayer_post()
      {
	  
	    
	   $ar = array('role_id'=>'3','city_id'=>$_POST['city_id']);
	   $ret = $this->db
       ->where($ar)
       ->count_all_results('user_master');
	  $paddedNum = sprintf("%05d", $ret+1);
	  
	   $query = $this->db->query("select * from user_master where id='".$_POST['dealer_id']."'");
       $row = $query->row_array(); 

	   $user_code = $row['user_code']."".$paddedNum;
	   
	   $data = array("first_name" => $_POST['fname'],
					"last_name"   => $_POST['lname'],
					"country_id"  => $_POST['country_id'],
					"state_id"    => $_POST['state_id'],
				    "user_code"   => $user_code,
					"city_id"     => $_POST['city_id'],
					"email_id"    => $_POST['email'],
					"password"    =>    $_POST['password'],
					"role_id"     => '3',
					"address_1"   => $_POST['address1'],
					"contact_no"  => $_POST['contact_no'],
					"alternate_no"=> $_POST['alternate_no'],
					"address_2"   => $_POST['address2'],
					"pincode"     => $_POST['pincode'],
					"activation_date" => date("Y-m-d"),
					"created_time" => date('Y-m-d h:s:a'),
	  );
	  if($this->db->insert('user_master',$data))
	  {	                
		    $data1 = array("dealer_id" => $_POST['dealer_id'],
					 "player_id" => $this->db->insert_id(),
					 "created_time" => date("Y-m-d h:s:a"));
	        $insert1 = $this->db->insert('dealer_player',$data1); 
			$this->response([
				'status' => TRUE,
				'message' => 'Player Added Successfully'
			], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
			            
        }else{   
			$this->response([
				'status' => FALSE,
				'message' => 'No Player were added'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	  
     }

		
    
    function updatePlayer_post()
      {
	  
	   $data = array("first_name" => $_POST['fname'],
					"last_name"   => $_POST['lname'],
					"country_id"  => $_POST['country_id'],
					"state_id"    => $_POST['state_id'],
					//"user_code"   => $user_code,
					"city_id"     => $_POST['city_id'],
					"email_id"    => $_POST['email'],
					"password"    =>    $_POST['password'],
					"role_id"     => '3',
					"address_1"   => $_POST['address1'],
					"contact_no"  => $_POST['contact_no'],
					"alternate_no"=> $_POST['alternate_no'],
					"address_2"   => $_POST['address2'],
					"pincode"     => $_POST['pincode'],
					"activation_date" => date("Y-m-d"),
					"updated_time" => date('Y-m-d h:s:a'),
	  );
	  $this->db->where('id', $_POST['update_id']);
	  if($this->db->update('user_master', $data))
	  {	                
			$this->response([
				'status' => TRUE,
				'message' => 'Player Updated Successfully'
			], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
			            
        }else{   
			$this->response([
				'status' => FALSE,
				'message' => 'No Player were updated'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	  
     }

	function login_post()
	{
		
		if($this->ion_auth->login($this->input->post('identity'), $this->input->post('password')))
		{	
			if($this->ion_auth->in_group('admin') OR $this->ion_auth->in_group('dealer') )
			{
				$this->response([
					'status' => FALSE,
					'message' => 'You must be a player to login into App.'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code			
			}                
			$user_id = $this->ion_auth->get_user_id();

			$player = $this->userInfo($user_id);

			$gamePlayedLottery = $this->Admin_model->getGamePlayedLottery($user_id);

			date_default_timezone_set("Asia/Calcutta");
			$this->response([
				'status' => TRUE,
				'message' => 'Login Successfully',
				'data' => array('player_id'=>$user_id,'default_amount'=>$player->deposited_amount,'present_amount'=>$player->present_amount,'date'=>date('Y-m-d H:i:s'),'lottery_game_played'=>$gamePlayedLottery)
			], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
			            
		}else{   
			$this->response([
				'status' => FALSE,
				'message' => 'Login Failed'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	function userInfo($id)
	{
		$players = $this->Admin_model->get_players();
		if (!empty($players))
        {
            foreach ($players as $key => $value)
            {
                if ( $value->id  == $id)
                {
                    
                    $player = $value;
                }
            }
        }

        if (!empty($player))
        {
        	return $player;
        }
	}

	function playerHistory_get()
	{
		if($_GET['player_id'])
		{
			$data = array();
			$from = date('Y-m-d').' 00:00:00';
			$to = date('Y-m-d').' 23:59:59';
			$data = $this->Admin_model->getPlayerHistory($_GET['player_id'],$from,$to);
			if(!empty($data))
			{
				$this->response([
				'status' => TRUE,
				'data' => $data
				], REST_Controller::HTTP_OK);
			}
			else{   
				$this->response([
					'status' => FALSE,
					'message' => 'No Data Found!!!'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			}
		}
		else{   
			$this->response([
				'status' => FALSE,
				'message' => 'Player Id required!!!'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

		
                     function accountsPlayerByDate_get()
                        {
                                    if(isset($_GET['player_id'])  && isset($_GET['date']))
		{
			$player_id = $_GET['player_id'];
                                                      $date = $_GET['date'];
                                                      $result['data_weekly'] = $this->bets_model->getAccountsPlayerByDate($player_id,$date);
			if(!empty($result))
			{
				$this->response([
				'status' => TRUE,
				'data' => $result
				], REST_Controller::HTTP_OK);
			}
			else{   
				$this->response([
					'status' => FALSE,
					'message' => 'No Data Found!!!'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			}
		}
		else{   
			$this->response([
				'status' => FALSE,
				'message' => 'Player Id and Date required!!!'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
                                    

                        
                        }

             function accountsPlayerByDrawTime_get()
            {

                         if(isset($_GET['player_id'])  && isset($_GET['date']) && isset($_GET['draw_time']))
		{
			$player_id = $_GET['player_id'];
	          $date = $_GET['date'];
	          $draw_time = $_GET['draw_time'];
	          $result['data_weekly'] = $this->bets_model->getAccountsPlayerByDrawTime($player_id,$date,$draw_time);
			if(!empty($result))
			{
				$this->response([
				'status' => TRUE,
				'data' => $result
				], REST_Controller::HTTP_OK);
			}
			else{   
				$this->response([
					'status' => FALSE,
					'message' => 'No Data Found!!!'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			}
		}
		else{   
			$this->response([
				'status' => FALSE,
				'message' => 'Player Id and Date required!!!'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
                                    
                        

                        

                       

            }

       function accountsPlayerByTransactionId_get()
      {
        
                if(isset($_GET['transaction_id']))
		{
			$transaction_id = $_GET['transaction_id'];
			$date = $_GET['date'];
            $draw_time = $_GET['draw_time'];
          	$result['data_weekly'] = $this->bets_model->getAccountsPlayerByTransactionId($transaction_id,$date,$draw_time);
			if(!empty($result))
			{
				$this->response([
				'status' => TRUE,
				'data' => $result
				], REST_Controller::HTTP_OK);
			}
			else{   
				$this->response([
					'status' => FALSE,
					'message' => 'No Data Found!!!'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			}
		}
		else{   
			$this->response([
				'status' => FALSE,
				'message' => 'Player Id and Date required!!!'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}           
                
               
                
                
        
        }
        
    
    
   
    
    
	}
?>	