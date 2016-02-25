<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Cricket extends REST_Controller
{
    function __construct() {
        
        // Construct the parent class
        parent::__construct();
        
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->load->database();
         // load database
        $this->load->model('Cricket_model');
		$this->load->model('Bets_model');
		
         // load model
        $this->load->library('ion_auth');
        $this->load->model('Admin_model');
    }
    
    public function getCricketMatchList_get() {
        $lists = $this->Cricket_model->getCricketMatchList();
		//print_r($lists);die;
   	    $result['Cricket_Match']  = $lists;
	
        
        if (!empty($result)) {
            
            $this->response(['status' => TRUE, 'data' => $result
            ], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'No data found!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
    }
	 
	function getCricketMatchDetails_get(){
		 $lists = $this->Cricket_model->getCricketMatchDetails();
		//print_r($lists);die;
		 if(!empty($lists)){
		 $i=1;
		 foreach($lists as $row):
				$result['Match_'.$i]  = $row;
				$i++;
		 endforeach;
        }
        if (!empty($result)) {
            
            $this->response(['status' => TRUE, 'data' => $result
            ], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'No data found!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
	} 

	function getCricketMatchDetailsWithOdds_get(){
                /*get odds from parameters*/
       
		 $list_match_odds = $this->Cricket_model->getCricketMatchOdds();
		 //print_r($list_match_odds);die;
		 if(!empty($list_match_odds)){
			
		 	$result['Match_Odds']  = $list_match_odds;	
		 
        	}
        if (!empty($result)) {
            
            $this->response(['status' => TRUE, 'data' => $result
            ], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'No data found!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
	} 
	
	 function placeCricketMatchBet_post(){
	 	$u_id = $this->post('player_id');
		$match_id = $this->post('match_id');
		$m_id = $this->post('m_id');
		$odd_id = $this->post('odd_id');
		$odds = $this->post('odds');
		$chips = $this->post('chips');
		$last_eight_digit = substr($u_id,3,10); 
		$transaction_id = "C".$match_id.$u_id.$m_id;
		$transaction_time =  date('H:i:s');
		/*get status of game wether betting is closed ot not*/
		$game_type_res = $this->Cricket_model->getGameType($m_id);
	
		$game_type = $game_type_res[0]['game_type'];
		//print_r($game_type);
		//die;
		$game_status = $this->Cricket_model->checkBettingClosed($match_id,$m_id);
		$success = false;
		if(count($game_status)<=0){
		    
			$total_amount = 0;
			if($chips>0){
				 $total_amount  = $total_amount + $chips;
			}
			
			$this->db->select('present_amount');
            $this->db->from('user_master');
            $this->db->where('id', $u_id);
            $query1 = $this->db->get()->row();
            $current_amount =   $query1->present_amount;
			
			if($total_amount <= $current_amount){
				$payout = $odds * $chips;
            
            	$commission = $chips * 0.05;
				
				$data = array("user_id"=>$u_id, "match_id" => $match_id,"odd_id" =>$odd_id, "chips"=>$odds, "chips" => $chips,"payout" => $payout,'transaction_id'=>$transaction_id,"transaction_time"=>$transaction_time,'commission' =>$commission);
            	            
           		$history = array('game_type' => $game_type, 'player_id' => $u_id, 'bet_amount' => $chips, 'payout' => $payout, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id);
			//calclulate commison and dealer id
				$this->db->select('dealer_id');
				$this->db->from('dealer_player');
				$this->db->where('player_id', $u_id);
				$query1 = $this->db->get()->row();
				$dealer_id = $query1->dealer_id;
				
				$bet_amount_dealer = $chips * 0.05;
				
				$debit = array('id' => $this->post('player_id'), 'bet_amount' => $chips);
				
				$credit_dealer = array('id' => $dealer_id, 'bet_amount' => $chips);
				$credit = array('id' => 1, 'bet_amount' => $chips - $bet_amount_dealer);
				
				$admin_history = array('game_type' => $game_type, 'player_id' => $u_id, 'commission' => $bet_amount_dealer, 'bet_amount' => $chips, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
				
				$dealer_history = array('game_type' => $game_type, 'player_id' => $u_id, 'dealer_id' => $this->getDealerId($u_id), 'bet_amount' => $chips, 'commission' => $bet_amount_dealer, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
				
				if ($this->Cricket_model->addUserCricketMatchBet($data)) {
					$this->Bets_model->addplayerhistory($history);
					$this->Bets_model->debit($debit);
						if (!$this->ion_auth->in_group('demo', $u_id)) {
							$this->Bets_model->addAdminHistory($admin_history);
							
							$this->Bets_model->addDealerHistory($dealer_history);
							
							$this->Bets_model->credit($credit);
							
							$this->Bets_model->credit_dealer($credit_dealer);
						} 
						else {
							
							$dealer_history = array('game_type' => $game_type, 'player_id' => $u_id, 'dealer_id' => $this->getDealerId($u_id), 'bet_amount' => $chips, 'commission' => '', 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
							
							$this->Bets_model->addDealerHistory($dealer_history);
							
							$credit = array('id' => $dealer_id, 'bet_amount' => $chips);
							$this->Bets_model->credit($credit);
						}
					
						$success = true;
				} 
				else {
					$success = false;
				}
				
				if ($success) {
				$this->response(['status' => TRUE, 'message' => 'Bet Placed Successfully'], REST_Controller::HTTP_OK);
				 // NOT_FOUND (404) being the HTTP response code            
				} 
				else {
					$this->response(['status' => FALSE, 'message' => 'Bets Cannot Be Placed!'], REST_Controller::HTTP_NOT_FOUND);
					 // NOT_FOUND (404) being the HTTP response code
					
				} 
			
			   }
			   else {
					$this->response(['status' => FALSE, 'message' => 'insufficient amount!'], REST_Controller::HTTP_NOT_FOUND);
					 // NOT_FOUND (404) being the HTTP response code
					
			   }
      
        }
		else {
            $this->response(['status' => FALSE, 'message' => 'Time Up !!! Bet closed'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
        }
       
    }
	 
	
	public function cancelCricketBet_post() {
        $player_id = $this->post('player_id');
        //$digit = $this->post('digit');
        //$game_type = $this->post('game_type');
        
        if ($this->Bets_model->cancelCricBet($player_id)) {
            
            $this->response(['status' => TRUE, 'message' => 'Bets Cancelled Successfully'], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'Bets Cannot Be Cancelled!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
    }
	 
	 
	 public function getDealerId($player_id) {
        return $this->Bets_model->getDealerId($player_id);
    }
	 
	 function getCricketMatchOddsWithMatchId_post(){
                /*get odds from parameters*/
 	 	$match_id = $this->post('match_id');
		$m_id = $this->post('m_id');
                
		$list_match_odds = $this->Cricket_model->getCricketMatchOddsByMatchId($match_id,$m_id);
		 //print_r($list_match_odds);die;
		if(!empty($list_match_odds)){
			
		 	$result['Match_Odds']  = $list_match_odds;	
		 
        }
        if (!empty($result)) {
            
            $this->response(['status' => TRUE, 'data' => $result
            ], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'No data found!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
	} 
	
	function getMatchLiveScore_get(){
		$match_id = $this->get('match_id');
		$live_score = $this->Cricket_model->getCricketMatchId($match_id);
		if(!empty($live_score)){
		 	$result['Live_Score']  = $live_score;	
        }
		if (!empty($result)) {
            
            $this->response(['status' => TRUE, 'data' => $result
            ], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'No data found!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
	}
	 
	 
}
?>