<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	require APPPATH . '/libraries/REST_Controller.php';
	
		

	class Locations extends REST_Controller
	{
		function __construct()
		{
		    // Construct the parent class
		    parent::__construct();

		    // Configure limits on our controller methods
		    // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		    // $this->methods['player_get']['limit'] = 500; // 500 requests per hour per user/key
		    //$this->methods['player_post']['limit'] = 100; // 100 requests per hour per user/key
		    //$this->methods['player_delete']['limit'] = 50; // 50 requests per hour per user/key
		    $this->load->database(); // load database
		    $this->load->model('GetLocation'); // load model
		}	

		public function country_get()
		{
				
			        $countries = $this->GetLocation->getCountries();
			     
			            if ($countries)
			            {
			                // Set the response and exit
			                $this->response($countries, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			            }
			            else
			            {
			                // Set the response and exit
			                $this->response([
			                    'status' => FALSE,
			                    'message' => 'No Countries were found'
			                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			            }
         }
         public function state_get($id)
		{
				
			        $states = $this->GetLocation->getStates($id);
			     
			            if ($states)
			            {
			                // Set the response and exit
			                $this->response($states, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			            }
			            else
			            {
			                // Set the response and exit
			                $this->response([
			                    'status' => FALSE,
			                    'message' => 'No states were found'
			                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			            }
         }
         public function city_get($id)
		{
				
			        $cities = $this->GetLocation->getCities($id);
			     
			            if ($cities)
			            {
			                // Set the response and exit
			                $this->response($cities, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			            }
			            else
			            {
			                // Set the response and exit
			                $this->response([
			                    'status' => FALSE,
			                    'message' => 'No cities were found'
			                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			            }
         }
}
?>	
