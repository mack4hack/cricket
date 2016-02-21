<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Bets extends REST_Controller
{
    function __construct() {
        
        // Construct the parent class
        parent::__construct();
        
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->load->database();
         // load database
        $this->load->model('Bets_model');
         // load model
        $this->load->library('ion_auth');
        $this->load->model('Admin_model');
    }
    
    public function index_get() {
        echo "you are in Bets controller";
    }
    
    public function PlaceBetFirst_post() {
      
         
           if( date("H:i:s") < "23:45:00"){
        
        
            $this->db->select('max(game_id) as game_id');
            $this->db->from('game_lottery');
            $query1 = $this->db->get()->row();
            $last =   $query1->game_id;
              
            $this->db->select('user_code');
            $this->db->from('user_master');
            $this->db->where('id', $this->post('player_id'));
            $query1 = $this->db->get()->row();
            //$transaction_id =   $query1->user_code."L".$last;
            $transaction_id =   "L".$last;
            
        
         $success = false;
         $total_amount = 0;
         foreach ($this->post('data') as $jodi_data) {
             $total_amount  = $total_amount + $jodi_data['bet_amount'];
         }
            $this->db->select('present_amount');
            $this->db->from('user_master');
            $this->db->where('id', $this->post('player_id'));
            $query1 = $this->db->get()->row();
            $current_amount =   $query1->present_amount;
            
       if($total_amount <= $current_amount){
        foreach ($this->post('data') as $jodi_data) {
            
            $payout = ($jodi_data['bet_amount'] * 8.5);
            
            $commission = $jodi_data['bet_amount'] * 0.05;

            $data = array('game_type' => 1, 'player_id' => $this->post('player_id'), 'digit' => $jodi_data['digit'], 'bet_amount' => $jodi_data['bet_amount'], 'payout' => $payout, 'timeslot' => date('Y-m-d H:i:s'),'transaction_id' =>$transaction_id,'commission' =>$commission   );
            
            $history = array('game_type' => 1, 'player_id' => $this->post('player_id'), 'bet_amount' => $jodi_data['bet_amount'], 'first_digit' => $jodi_data['digit'], 'second_digit' => null, 'jodi_digit' => null, 'payout' => $payout, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id   )  ;
            
            //calclulate commison and dealer id
            $this->db->select('dealer_id');
            $this->db->from('dealer_player');
            $this->db->where('player_id', $this->post('player_id'));
            $query1 = $this->db->get()->row();
            $dealer_id = $query1->dealer_id;
            
            $bet_amount_dealer = $jodi_data['bet_amount'] * 0.05;
            
            $debit = array('id' => $this->post('player_id'), 'bet_amount' => $jodi_data['bet_amount'],);
            
            $credit_dealer = array('id' => $dealer_id, 'bet_amount' => $bet_amount_dealer,);
            $credit = array('id' => 1, 'bet_amount' => $jodi_data['bet_amount'] - $bet_amount_dealer,);
            
            $admin_history = array('game_type' => 1, 'player_id' => $this->post('player_id'), 'bet_amount' => $jodi_data['bet_amount'], 'commission' => $bet_amount_dealer, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id   )   ;
            
            $dealer_history = array('game_type' => 1, 'player_id' => $this->post('player_id'), 'dealer_id' => $this->getDealerId($this->post('player_id')), 'bet_amount' => $jodi_data['bet_amount'], 'commission' => $bet_amount_dealer, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id   );
            
            if ($this->Bets_model->placebet($data)) {
                $this->Bets_model->addplayerhistory($history);
                
                $this->Bets_model->debit($debit);
                
                if (!$this->ion_auth->in_group('demo', $this->post('player_id'))) {
                    $this->Bets_model->addAdminHistory($admin_history);
                    
                    $this->Bets_model->addDealerHistory($dealer_history);
                    
                    $this->Bets_model->credit($credit);
                    
                    $this->Bets_model->credit_dealer($credit_dealer);
                } 
                else {
                    
                    $dealer_history = array('game_type' => 1, 'player_id' => $this->post('player_id'), 'dealer_id' => $this->getDealerId($this->post('player_id')), 'bet_amount' => $jodi_data['bet_amount'], 'commission' => '', 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId()  ,'transaction_id' =>$transaction_id  );
                    
                    $this->Bets_model->addDealerHistory($dealer_history);
                    
                    $credit = array('id' => $dealer_id, 'bet_amount' => $jodi_data['bet_amount'],);
                    $this->Bets_model->credit($credit);
                }
                
                $success = true;
            } 
            else {
                $success = false;
            }
        }
       
          if ($success) {
            $this->response(['status' => TRUE, 'message' => 'Bets Placed Successfully'], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'Bets Cannot Be Placed!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        } 
        
       }else {
            $this->response(['status' => FALSE, 'message' => 'insufficient amount!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
      
        }else {
            $this->response(['status' => FALSE, 'message' => 'Bets closed,will resume after 12'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
       
    }
    public function PlaceBetSecond_post() {
            if( date("H:i:s") < "23:45:00"){
         $this->db->select('max(game_id) as game_id');
            $this->db->from('game_lottery');
            $query1 = $this->db->get()->row();
            $last =   $query1->game_id;
              
            $this->db->select('user_code');
            $this->db->from('user_master');
            $this->db->where('id', $this->post('player_id'));
            $query1 = $this->db->get()->row();
         //   $transaction_id =   $query1->user_code."L".$last;
              $transaction_id =   "L".$last;
        $success = false;
        $total_amount = 0;
         foreach ($this->post('data') as $jodi_data) {
             $total_amount  = $total_amount + $jodi_data['bet_amount'];
         }
            $this->db->select('present_amount');
            $this->db->from('user_master');
            $this->db->where('id', $this->post('player_id'));
            $query1 = $this->db->get()->row();
            $current_amount =   $query1->present_amount;
            
       if($total_amount <= $current_amount){
        foreach ($this->post('data') as $jodi_data) {
            
            $payout = ($jodi_data['bet_amount'] * 8.5);

            $commission = $jodi_data['bet_amount'] * 0.05;
            
            $data = array('game_type' => 2, 'player_id' => $this->post('player_id'), 'digit' => $jodi_data['digit'], 'bet_amount' => $jodi_data['bet_amount'], 'payout' => $payout, 'timeslot' => date('Y-m-d H:i:s') ,'transaction_id' =>$transaction_id,'commission' =>$commission   );
            
            $history = array('game_type' => 2, 'player_id' => $this->post('player_id'), 'bet_amount' => $jodi_data['bet_amount'], 'first_digit' => null, 'second_digit' => $jodi_data['digit'], 'jodi_digit' => null, 'payout' => $payout, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
            
            //calclulate commison and dealer id
            $this->db->select('dealer_id');
            $this->db->from('dealer_player');
            $this->db->where('player_id', $this->post('player_id'));
            $query1 = $this->db->get()->row();
            $dealer_id = $query1->dealer_id;
            
            $bet_amount_dealer = $jodi_data['bet_amount'] * 0.05;
            
            $debit = array('id' => $this->post('player_id'), 'bet_amount' => $jodi_data['bet_amount'],);
            
            $credit_dealer = array('id' => $dealer_id, 'bet_amount' => $bet_amount_dealer,);
            $credit = array('id' => 1, 'bet_amount' => $jodi_data['bet_amount'] - $bet_amount_dealer,);
            
            $admin_history = array('game_type' => 2, 'player_id' => $this->post('player_id'), 'bet_amount' => $jodi_data['bet_amount'], 'commission' => $bet_amount_dealer, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
            
            $dealer_history = array('game_type' => 2, 'player_id' => $this->post('player_id'), 'dealer_id' => $this->getDealerId($this->post('player_id')), 'bet_amount' => $jodi_data['bet_amount'], 'commission' => $bet_amount_dealer, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
            
            if ($this->Bets_model->placebet($data)) {
                $this->Bets_model->addplayerhistory($history);
                $this->Bets_model->debit($debit);
                if (!$this->ion_auth->in_group('demo', $this->post('player_id'))) {
                    $this->Bets_model->addAdminHistory($admin_history);
                    
                    $this->Bets_model->addDealerHistory($dealer_history);
                    
                    $this->Bets_model->credit($credit);
                    
                    $this->Bets_model->credit_dealer($credit_dealer);
                } 
                else {
                    
                    $dealer_history = array('game_type' => 2, 'player_id' => $this->post('player_id'), 'dealer_id' => $this->getDealerId($this->post('player_id')), 'bet_amount' => $jodi_data['bet_amount'], 'commission' => '', 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
                    
                    $this->Bets_model->addDealerHistory($dealer_history);
                    
                    $credit = array('id' => $dealer_id, 'bet_amount' => $jodi_data['bet_amount'],);
                    $this->Bets_model->credit($credit);
                }
                
                $success = true;
            } 
            else {
                $success = false;
            }
        }
        if ($success) {
            $this->response(['status' => TRUE, 'message' => 'Bets Placed Successfully'], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'Bets Cannot Be Placed!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
         }
       }else{
            $this->response(['status' => FALSE, 'message' => 'insufficient amount!'], REST_Controller::HTTP_NOT_FOUND);
       }
       }else {
            $this->response(['status' => FALSE, 'message' => 'Bets closed, will resume after 12'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
       
    }
    public function PlaceBetJodi_post() {
            if( date("H:i:s") < "23:45:00"){
        
         $this->db->select('max(game_id) as game_id');
            $this->db->from('game_lottery');
            $query1 = $this->db->get()->row();
            $last =   $query1->game_id;
              
            $this->db->select('user_code');
            $this->db->from('user_master');
            $this->db->where('id', $this->post('player_id'));
            $query1 = $this->db->get()->row();
           // $transaction_id =   $query1->user_code."L".$last;
              $transaction_id =   "L".$last;
        //print_r($this->post('player_id'));die;
         $success = false;
        $total_amount = 0;
         foreach ($this->post('data') as $jodi_data) {
             $total_amount  = $total_amount + $jodi_data['bet_amount'];
         }
            $this->db->select('present_amount');
            $this->db->from('user_master');
            $this->db->where('id', $this->post('player_id'));
            $query1 = $this->db->get()->row();
            $current_amount =   $query1->present_amount;
            
       if($total_amount <= $current_amount){
        foreach ($this->post('data') as $jodi_data) {
            
            $payout = ($jodi_data['bet_amount'] * 85);

            $commission = $jodi_data['bet_amount'] * 0.05;
            
            $data = array('game_type' => 3, 'player_id' => $this->post('player_id'), 'digit' => $jodi_data['digit'], 'bet_amount' => $jodi_data['bet_amount'], 'payout' => $payout, 'timeslot' => date('Y-m-d H:i:s') ,'transaction_id' =>$transaction_id,'commission' =>$commission  );
            
            $history = array('game_type' => 3, 'player_id' => $this->post('player_id'), 'bet_amount' => $jodi_data['bet_amount'], 'first_digit' => null, 'second_digit' => null, 'jodi_digit' => $jodi_data['digit'], 'payout' => $payout, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
            
            //calclulate commison and dealer id
            $this->db->select('dealer_id');
            $this->db->from('dealer_player');
            $this->db->where('player_id', $this->post('player_id'));
            $query1 = $this->db->get()->row();
            $dealer_id = $query1->dealer_id;
            
            $bet_amount_dealer = $jodi_data['bet_amount'] * 0.05;
            
            $debit = array('id' => $this->post('player_id'), 'bet_amount' => $jodi_data['bet_amount'],);
            
            $credit_dealer = array('id' => $dealer_id, 'bet_amount' => $bet_amount_dealer,);
            $credit = array('id' => 1, 'bet_amount' => $jodi_data['bet_amount'] - $bet_amount_dealer,);
            
            $admin_history = array('game_type' => 3, 'player_id' => $this->post('player_id'), 'commission' => $bet_amount_dealer, 'bet_amount' => $jodi_data['bet_amount'], 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
            
            $dealer_history = array('game_type' => 3, 'player_id' => $this->post('player_id'), 'dealer_id' => $this->getDealerId($this->post('player_id')), 'bet_amount' => $jodi_data['bet_amount'], 'commission' => $bet_amount_dealer, 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
            
            if ($this->Bets_model->placebet($data)) {
                $this->Bets_model->addplayerhistory($history);
                $this->Bets_model->debit($debit);
                if (!$this->ion_auth->in_group('demo', $this->post('player_id'))) {
                    $this->Bets_model->addAdminHistory($admin_history);
                    
                    $this->Bets_model->addDealerHistory($dealer_history);
                    
                    $this->Bets_model->credit($credit);
                    
                    $this->Bets_model->credit_dealer($credit_dealer);
                } 
                else {
                    
                    $dealer_history = array('game_type' => 3, 'player_id' => $this->post('player_id'), 'dealer_id' => $this->getDealerId($this->post('player_id')), 'bet_amount' => $jodi_data['bet_amount'], 'commission' => '', 'timeslot' => date('Y-m-d H:i:s'), 'timeslot_id' => $this->Admin_model->getTimeslotId() ,'transaction_id' =>$transaction_id  );
                    
                    $this->Bets_model->addDealerHistory($dealer_history);
                    
                    $credit = array('id' => $dealer_id, 'bet_amount' => $jodi_data['bet_amount'],);
                    $this->Bets_model->credit($credit);
                }
                
                $success = true;
            } 
            else {
                $success = false;
            }
        }
        if ($success) {
            $this->response(['status' => TRUE, 'message' => 'Bets Placed Successfully'], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'Bets Cannot Be Placed!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
        }
      }else{
            $this->response(['status' => FALSE, 'message' => 'insufficient amount!'], REST_Controller::HTTP_NOT_FOUND);
       }
       }else {
            $this->response(['status' => FALSE, 'message' => 'Bets closed,will resume after 12'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
       
    }
    public function LuckyNumber_get() {
        
        $result   = $this->Bets_model->getLuckyNumber();
        
        if (!empty($result)) {
            
            $this->response(['status' => TRUE, 'lucky_number' => $result['lucky_number'],'draw_time' =>$result['draw_time']
            ], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'No lucky number found!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
    }
    public function CancelBet_post() {
        $player_id = $this->post('player_id');
        //$digit = $this->post('digit');
        //$game_type = $this->post('game_type');
        
        if ($this->Bets_model->cancelbet($player_id)) {
            
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
    
    public function LuckyNumberChart_get() {
        
        $result = array();
        if (isset($_GET['month'])) {
            $result['lucky_numbers'] = $this->Bets_model->getLuckyNumberAccToMnth($_GET['month']);
        } 
        else {
            
            $this->response(['status' => FALSE, 'message' => 'please send a proper month in 0000-00 (year-month) format!'], REST_Controller::HTTP_NOT_FOUND);
        }
        if (!empty($result)) {
            
            $this->response(['status' => TRUE, 'data' => $result['lucky_numbers']
            ], REST_Controller::HTTP_OK);
             // NOT_FOUND (404) being the HTTP response code
            
            
        } 
        else {
            $this->response(['status' => FALSE, 'message' => 'No lucky numbers found!'], REST_Controller::HTTP_NOT_FOUND);
             // NOT_FOUND (404) being the HTTP response code
            
        }
    }
    
    public function getServerTimings_get() {
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        
        $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        $result['current'] = date("Y-m-d H:i:s a");
        $start = strtotime('+15 minutes', strtotime($rounded));
        $result['start'] = date("h:i a", strtotime($rounded));
        $result['end'] = date("h:i a", $start);
      $result_lucky_number = $this->Bets_model->getLuckyNumber();
        if(isset($result_lucky_number['lucky_number'])){
        $result['lucky_number'] = $result_lucky_number['lucky_number'];}else{
            $result['lucky_number']= '';
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

    public function cricketBet_post(){

    	//game_type = 4 ; // toss game
    	$payout = ($this->post('bet_amount') * 8.5);
    	$data = array('game_type' => $this->post('game_type'), 'player_id' => $this->post('player_id'), 'team' =>  $this->post('team'), 'bet_amount' => $this->post('bet_amount'), 'payout' => $payout, 'timeslot' => date('Y-m-d H:i:s'));
    }
}
?>	
