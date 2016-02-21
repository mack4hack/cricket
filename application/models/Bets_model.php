<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//location: application/models/auth_model.php

class Bets_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
    }
    
    function placebet($data) {
        return $this->db->insert('game_lottery', $data);
    }
    
    function getfirstdigitchart() {
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        $now['minutes'] = $now['minutes'] - 1;
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        $max_time = date('Y-m-d H:i:s');
        
        //echo $max_time;die;
        $this->db->select('sum(bet_amount ) as bet_amount ,digit,sum(payout ) as payout');
        $this->db->from('game_lottery');
        $this->db->where('game_type', 1);
        $this->db->where("timeslot >= '" . $rounded . "' and timeslot < '" . $max_time . "' ");
        $this->db->group_by('digit');
        $query = $this->db->get();
        return $query;
    }
    function getfirstdigitchartAccToTime($start, $end) {
        $this->db->select('sum(bet_amount ) as bet_amount ,digit,sum(payout ) as payout');
        $this->db->from('game_lottery');
        $this->db->where('game_type', 1);
        $this->db->where("timeslot >= '" . $start . "' and timeslot < '" . $end . "' ");
        $this->db->group_by('digit');
        $query = $this->db->get();
        return $query;
    }
    function getseconddigitchart() {
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        $now['minutes'] = $now['minutes'] - 1;
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        $max_time = date('Y-m-d H:i:s');
        
        $this->db->select('sum(bet_amount ) as bet_amount ,digit,sum(payout ) as payout');
        $this->db->from('game_lottery');
        $this->db->where('game_type', 2);
        $this->db->where("timeslot >= '" . $rounded . "' and timeslot < '" . $max_time . "' ");
        $this->db->group_by('digit');
        $query = $this->db->get();
        return $query;
    }
    function getSeconddigitchartAccToTime($start, $end) {
        $this->db->select('sum(bet_amount ) as bet_amount ,digit,sum(payout ) as payout');
        $this->db->from('game_lottery');
        $this->db->where('game_type', 2);
        $this->db->where("timeslot >= '" . $start . "' and timeslot < '" . $end . "' ");
        $this->db->group_by('digit');
        $query = $this->db->get();
        return $query;
    }
    function getjodichart() {
        
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        $now['minutes'] = $now['minutes'] - 1;
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        $max_time = date('Y-m-d H:i:s');
        
        $this->db->select('sum(bet_amount ) as bet_amount ,digit,sum(payout ) as payout');
        $this->db->from('game_lottery');
        $this->db->where('game_type', 3);
        $this->db->where("timeslot >= '" . $rounded . "' and timeslot < '" . $max_time . "' ");
        $this->db->group_by('digit');
        $query = $this->db->get();
        
        return $query;
    }
    function getjodichartAccToTime($start, $end) {
        $this->db->select('sum(bet_amount ) as bet_amount ,digit,sum(payout ) as payout');
        $this->db->from('game_lottery');
        $this->db->where('game_type', 3);
        $this->db->where("timeslot >= '" . $start . "' and timeslot < '" . $end . "' ");
        $this->db->group_by('digit');
        $query = $this->db->get();
        return $query;
    }
    function getTotalPayoutAndBets() {
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        $now['minutes'] = $now['minutes'] - 1;
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        $max_time = date('Y-m-d H:i:s');
        
        $this->db->select('sum(bet_amount ) as bet_amount,sum(payout ) as payout');
        $this->db->from('game_lottery');
        $this->db->where("timeslot >= '" . $rounded . "' and timeslot < '" . $max_time . "' ");
        
        //$this->db->where('game_type',3);
        //$this->db->group_by('digit');
        $query = $this->db->get()->row();
        return $query;
    }
    function getTotalPayoutAndBetsAccToTime($start, $end, $lucky_number) {
        $first = floor($lucky_number / 10);
        $second = $lucky_number % 10;
        
        $this->db->select('sum(bet_amount ) as bet_amount,sum(payout ) as payout');
        $this->db->from('player_history');
        $this->db->where("timeslot >= '" . $start . "' and timeslot < '" . $end . "' ");
        $where = '(first_digit="' . $first . '" or second_digit="' . $second . '" or jodi_digit="' . $lucky_number . '")';
        $this->db->where($where);
        $this->db->where('result',1);
        
        //  $this->db->where('where',$whr);
        //$this->db->group_by('digit');
        $query = $this->db->get()->row();
        return $query;
    }
    function getTotalBetsAccToTime($start, $end, $lucky_number) {
        $first = floor($lucky_number / 10);
        $second = $lucky_number % 10;
        
        $this->db->select('sum(bet_amount ) as bet_amount');
        $this->db->from('game_lottery');
        $this->db->where("timeslot >= '" . $start . "' and timeslot < '" . $end . "' ");
        //$where = '(digit="' . $first . '" or digit="' . $second . '"  or digit="' . $lucky_number . '")';
        //$this->db->where($where);
        
        //  $this->db->where('where',$whr);
        //$this->db->group_by('digit');
        $query = $this->db->get()->row();
        return $query;
    }
    
    function addplayerhistory($data) {
             
             date_default_timezone_set("Asia/Calcutta");
             $now = getdate();
             $now['minutes'] = $now['minutes'] - 1;
             $minutes = $now['minutes'] - $now['minutes'] % 15;
             $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
             $time = strtotime($rounded);
             $time = $time + (15 * 60);
             $date = date("Y-m-d H:i:s", $time);
             
             $this->db->set('is_canceled', 0, FALSE);
             $this->db->where('player_id',$data['player_id']);
             $this->db->where("timeslot >= '" . $rounded . "' and timeslot <= '" . $date . "' ");
             $this->db->update('player_history');        
             
             $this->db->insert('player_history', $data);
    }
    
    function debit($data) {
        $this->db->set('present_amount', 'present_amount-' . $data['bet_amount'], FALSE);
        $this->db->where('id', $data['id']);
        $this->db->update('user_master');
    }
    function debit_dealer($data) {
        $this->db->set('present_amount', 'present_amount-' . $data['bet_amount'], FALSE);
        $this->db->where('id', $data['id']);
        $this->db->update('user_master');
    }
    
    function credit($data) {
        $this->db->set('present_amount', 'present_amount+' . $data['bet_amount'], FALSE);
        $this->db->where('id', $data['id']);
        $this->db->update('user_master');
    }
    
    function credit_dealer($data) {
        $this->db->set('present_amount', 'present_amount+' . $data['bet_amount'], FALSE);
        $this->db->where('id', $data['id']);
        $this->db->update('user_master');
    }
    
    function getLuckyNumber() {
        
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        
        //$now['minutes'] = $now['minutes'] - 1;
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        $time = strtotime($rounded);
        $time = $time + (15 * 60);
        $date = date("Y-m-d H:i:s", $time);
        
        //echo $rounded;die;
        $this->db->select('lucky_number');
        $this->db->from('lucky_numbers');
        $this->db->where('timeslot <= ', $date);
        $this->db->where('timeslot >= ', $rounded);
        $draw_time = $now['hours'].":".$minutes;
        //$this->db->where("timeslot >= '".$date."' and timeslot < '".$rounded."' ");
        $query = $this->db->get()->row();
        $data = array();
        $data['draw_time'] = $draw_time;
        //echo $this->db->last_query();die;
        if (!empty($query)) {
            if ($query->lucky_number <= 9) {
                $query->lucky_number = "0" . $query->lucky_number;
            }
           $data['lucky_number'] = $query->lucky_number;
           return $data;
        } 
        else {
            return "";
        }
    }
    function getLuckyNumberAccToTime($start, $end) {
        
        $this->db->select('lucky_number');
        $this->db->from('lucky_numbers');
        $this->db->where("timeslot like '" . $end . "%' ");
        $query = $this->db->get()->row();
        
        //echo $this->db->last_query(); die;
        
        if (!empty($query)) {
            if ($query->lucky_number <= 9) {
                $query->lucky_number = "0" . $query->lucky_number;
            }
            return $query->lucky_number;
        } 
        else {
            return "";
        }
    }
    
    function cancelbet($player_id) {
        $this->load->library('ion_auth');
        
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        $now['minutes'] = $now['minutes'] - 1;
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        
        $time = strtotime($rounded);
        $time = $time + (15 * 60);
        $date = date("Y-m-d H:i:s", $time);
        
        $this->db->select('*');
        $this->db->from('player_history');
        $this->db->where('player_id', $player_id);
        $this->db->where('is_canceled', 1);
        $this->db->where("timeslot >= '" . $rounded . "' and timeslot <= '" . $date . "' ");
        $canceled = $this->db->get()->row();
        if(empty($canceled)){         
        
        
        $this->db->select('sum(bet_amount) as bet_amount,id,transaction_id');
        $this->db->from('player_history');
        $this->db->where('player_id', $player_id);
        
        $this->db->where("timeslot >= '" . $rounded . "' and timeslot <= '" . $date . "' ");
        $this->db->order_by('id', 'desc');
        $this->db->group_by('transaction_id');
        
        
        $query = $this->db->get()->row();
        $transaction_id = $query->transaction_id;
        //echo "<pre>";print_r($query->transaction_id);die;
        
        if (!empty($query)) {
            $bet_amount = $query->bet_amount;
            
            //calclulate commison and dealer id
            $this->db->select('dealer_id');
            $this->db->from('dealer_player');
            $this->db->where('player_id', $player_id);
            $query1 = $this->db->get()->row();
            $dealer_id = $query1->dealer_id;
            
            $bet_amount_dealer = $bet_amount * 0.05;
            
            $debit = array('id' => 1, 'bet_amount' => $bet_amount - $bet_amount_dealer,);
            $debit_dealer = array('id' => $dealer_id, 'bet_amount' => $bet_amount_dealer,);;
            $credit = array('id' => $player_id, 'bet_amount' => $bet_amount,);
            
            $this->credit($credit);
            
            if (!$this->ion_auth->in_group('demo', $player_id)) {
                $this->debit($debit);
                $this->debit_dealer($debit_dealer);
                 //debit dealers commision
                
                //delete admin history and dealer history
//                $this->db->select('id');
//                $this->db->from('admin_history');
//                $this->db->where('player_id', $player_id);
//                $this->db->order_by('id', 'desc');
//                $this->db->limit(1);
//                $query2 = $this->db->get()->row();
//                $delete_id = $query2->id;
                $this->db->delete('admin_history', array('transaction_id' => $transaction_id));
            } 
            else {
                
                $debit_dealer = array('id' => $dealer_id, 'bet_amount' => $bet_amount,);
                $this->debit_dealer($debit_dealer);
                 //debit dealers commision
                
            }
            
            $this->db->delete('player_history', array('transaction_id' => $transaction_id));
            $this->db->delete('dealer_history', array('transaction_id' => $transaction_id));
            $this->db->delete('game_lottery', array('transaction_id' => $transaction_id));
            //set is_canceled 1  so that user cannot cancel bet
             $this->db->set('is_canceled', 1, FALSE);
             $this->db->where('player_id',$player_id);
             $this->db->where("timeslot >= '" . $rounded . "' and timeslot <= '" . $date . "' ");
             $this->db->update('player_history');        
            return true;
        } 
        else {
            return false;
        }
        
        }else {
            return false;
        }
    }
    
    function addAdminHistory($data) {
        $this->db->select('total');
        $this->db->from('admin_history');
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get()->row();
        $old_total = $query->total;
        $new_total = ($old_total + $data['bet_amount']) - $data['commission'];
        $data['total'] = $new_total;
        
        $this->db->insert('admin_history', $data);
    }
    
    function getDealerId($player_id) {
        $this->db->select('dealer_id');
        $this->db->where('player_id', $player_id);
        $query = $this->db->get('dealer_player')->row();
        return $query->dealer_id;
    }
    
    function addDealerHistory($data) {
        $this->db->select('total');
        $this->db->from('dealer_history');
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get()->row();
        $old_total = $query->total;
        $new_total = $old_total + $data['commission'];
        $data['total'] = $new_total;
        
        $this->db->insert('dealer_history', $data);
    }
    
    function getLuckyNumberAccToMonth() {
        
        
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        $now['minutes'] = $now['minutes'] - 1;
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        if($minutes<=9){
            $minutes = "0".$minutes;
        }
       // $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        $max_time = date('Y-m-d H:i:s');
        
        $current_month = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'];
        //$start_date = date('Y-m-d H:m:s');
        //$pre_date = date($current_month,strtotime("60 days"));
        $pre_date = date('Y-m-d', strtotime('-60 days', strtotime($current_month)));
        //echo $pre_date;die;
        $this->db->select('lucky_number,timeslot,timeslot_id');
        $this->db->from('lucky_numbers');
        //$this->db->where("timeslot like '" . $month . "%'");
        $this->db->where("timeslot >=", $pre_date );
        $this->db->where("timeslot <=", $max_time );
        $query = $this->db->get();
        
        //echo $this->db->last_query(); die;
        
        $data = $query->result();
        
        //print_r($data); die;
        $numbers = array();
        foreach ($data as $d) {
            
            //$d->timeslot; die;
            $date = explode(' ', $d->timeslot) [0];
            //$datearr = explode('-', $date);
            //$day = end($datearr);
            $numbers[] = array('lucky_number' => $d->lucky_number, 'date' => $date, 'timeslot_id' => $d->timeslot_id,);
        }
        
        if (!empty($query)) {
            return $numbers;
        } 
        else {
            return "";
        }
    }
    function getLuckyNumberAccToMnth() {
        
        
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        $now['minutes'] = $now['minutes'] - 1;
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        if($minutes<=9){
            $minutes = "0".$minutes;
        }
       // $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        $max_time = date('Y-m-d H:i:s');
        
        $current_month = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'];
        //$start_date = date('Y-m-d H:m:s');
        //$pre_date = date($current_month,strtotime("60 days"));
        $pre_date = date('Y-m-d', strtotime('-60 days', strtotime($current_month)));
        //echo $pre_date;die;
        $this->db->select('lucky_number,timeslot,timeslot_id');
        $this->db->from('lucky_numbers');
        //$this->db->where("timeslot like '" . $month . "%'");
        $this->db->where("timeslot >=", $pre_date );
        $this->db->where("timeslot <=", $max_time );
        $query = $this->db->get();
        
        //echo $this->db->last_query(); die;
        
        $data = $query->result();
        
        //print_r($data); die;
        $numbers = array();
        foreach ($data as $d) {
            
            //$d->timeslot; die;
            $date = explode(' ', $d->timeslot) [0];
            //$datearr = explode('-', $date);
            //$day = end($datearr);
            if($d->lucky_number < 10){
                $d->lucky_number = '0'.$d->lucky_number;
            }
            $numbers[] = array('lucky_number' => $d->lucky_number, 'date' => $date, 'timeslot_id' => $d->timeslot_id,);
        }
        
        if (!empty($query)) {
            return $numbers;
        } 
        else {
            return "";
        }
    }
    
    function getLuckyNumberByTimeSlot($time) {
        
        $this->db->select('lucky_number,timeslot');
        $this->db->from('lucky_numbers');
        $this->db->where("timeslot like '%" . $time . "%'");
        $query = $this->db->get();
        
        /*echo $this->db->last_query();
         echo '<br/>';*/
        
        // $data = $query->result();
        
        if (!empty($query)) {
            return $query->result();
        } 
        else {
            return "";
        }
    }
    
    public function getNumberOfBets($game_type) {
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        $now['minutes'] = $now['minutes'] - 1;
        $minutes = $now['minutes'] - $now['minutes'] % 15;
        $rounded = $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . " " . $now['hours'] . ":" . $minutes . ":00";
        $max_time = date('Y-m-d H:i:s');
        
        //echo $max_time;die;
        $this->db->select('*');
        $this->db->from('game_lottery');
        $this->db->where('game_type', $game_type);
        $this->db->where("timeslot >= '" . $rounded . "' and timeslot < '" . $max_time . "' ");
        
        //$this->db->group_by('digit');
        $query = $this->db->get();
        return $query;
    }
    
    public function getNumberOfBetsByTime($from, $to, $game_type) {
        
        $this->db->select('*');
        $this->db->from('game_lottery');
        $this->db->where('game_type', $game_type);
        $this->db->where("timeslot >= '" . $from . "' and timeslot < '" . $to . "' ");
        
        //$this->db->group_by('digit');
        $query = $this->db->get();
        return $query;
    }
    function getActualJodiPayoutAccToTime($start, $end, $lucky_number) {
        $first = floor($lucky_number / 10);
        $second = $lucky_number % 10;
        
        $this->db->select('sum(payout) as payout');
        $this->db->from('game_lottery');
        $this->db->where("timeslot >= '" . $start . "' and timeslot < '" . $end . "' ");
        $this->db->where('digit', $lucky_number);
        $this->db->where('game_type', '3');
        $query = $this->db->get()->row();
        return $query->payout;
    }
    function getActualFirstPayoutAccToTime($start, $end, $lucky_number) {
        $first = floor($lucky_number / 10);
        $second = $lucky_number % 10;
        
        $this->db->select('sum(payout) as payout');
        $this->db->from('game_lottery');
        $this->db->where("timeslot >= '" . $start . "' and timeslot < '" . $end . "' ");
        $this->db->where('digit', $first);
        $this->db->where('game_type', '1');
        $query = $this->db->get()->row();
        return $query->payout;
    }
    function getActualsecondPayoutAccToTime($start, $end, $lucky_number) {
        $first = floor($lucky_number / 10);
        $second = $lucky_number % 10;
        
        $this->db->select('sum(payout) as payout');
        $this->db->from('game_lottery');
        $this->db->where("timeslot >= '" . $start . "' and timeslot < '" . $end . "' ");
        $this->db->where('digit', $second);
        $this->db->where('game_type', '2');
        $query = $this->db->get()->row();
        return $query->payout;
    }
    
    function getAccountsPlayerByDate($player_id,$day)
	{
			
		$data = array();
		
		$this->db->select('user_code');
     	$this->db->from('user_master');
	    $this->db->where('id',$player_id);
	    $query=$this->db->get()->row();;
	    $user_code =  $query->user_code;

	   	$timeslot_id = 1; 
	   	for ($i = 0 * 60; $i < 24 * 60; $i+= 15) {
            $hr = floor($i / 60);
            if ($hr <= 9) $hr = '0' . $hr;
            
            $min = ($i / 60 - floor($i / 60)) * 60;
            if ($min <= 9) $min = '0' . $min;
            
            $start = $hr . ":" . $min;
            
            $newTime = date("h:i a", strtotime($start . " +15 minutes"));
            
            //$time_slots[] = $start." To ".$newTime;
            //if(strtotime($newTime) < strtotime(date('h:i a')))
            	$timeslots[] = array('timeslot_id' => $timeslot_id, 'timeslot' => $newTime,);
            $timeslot_id++;
        }

        //echo "<pre>";
	    //	print_r($timeslots); die;

        $total_bet = 0 ;
		$total_wins = 0;
		$total_balance = 0;
		$total_commission = 0;


		if(!empty($timeslots))
		{	$i=1;
			foreach ($timeslots as $timeslot)
			{
				//print_r($timeslot); die;
				$this->db->select('sum(bet_amount) as chips');
				$this->db->from('player_history');
				$this->db->where('timeslot_id',$timeslot['timeslot_id']);
				$this->db->where('player_id',$player_id);
				$this->db->like('timeslot',$day);
				//$this->db->like('timeslot',$timeslot->timeslot);
				$query=$this->db->get()->row();
				//echo $this->db->last_query(); die;
				$chips = $query->chips;

				$this->db->select('sum(payout) as win');
				$this->db->from('player_history');
				$this->db->where('result','1');
				$this->db->where('timeslot_id',$timeslot['timeslot_id']);
				$this->db->where('player_id',$player_id);
				$this->db->like('timeslot',$day);
				$query=$this->db->get()->row();
				$win = $query->win;

				
			   	$balance =  $win - $chips;
			   	$total_bet = $total_bet + $chips ;
				$total_wins = $total_wins + $win;
				$total_balance = $total_balance + $balance;

			   	$data[]= array(
			   			'sr_no' => $i,
			   			'user_code' => $user_code,
			   			'bet_amount'=>$chips,
			   			'payout'=>$win,
			   			'balance'=>$balance,
			   			'total_bet'=>$total_bet,
			   			'total_wins'=>$total_wins,
			   			'total_balance'=>$total_balance,
			   			'draw_time'=>$timeslot['timeslot'],
			   			'timeslot_id'=>$timeslot['timeslot_id'],
			   		);
			   	$i++;
			}
		}	

		//echo "<pre>";
		//print_r($data);
	   //	die;
	  	return $data;
	}

	function getAccountsPlayerByDrawTime($player_id,$day,$timeslot_id)
	{
			
		$data = array();
        
        $this->db->select('id,transaction_id');
        $this->db->from('player_history');
        $where = 'player_id = "'.$player_id.'" AND timeslot LIKE "%'.$day.'%" AND timeslot_id="'.$timeslot_id.'"';
        $this->db->where($where);
        $this->db->group_by('transaction_id');
        $query=$this->db->get();
        //echo($this->db->last_query());  die;
        $records =  $query->result();

        //echo "<pre>";
        //  print_r($timeslots); die;

        $this->db->select('user_code');
        $this->db->from('user_master');
        $this->db->where('id',$player_id);
        $query=$this->db->get()->row();;
        $user_code =  $query->user_code;

        $total_bet = 0 ;
        $total_wins = 0;
        $total_balance = 0;
        $total_commission = 0;


        if(!empty($records))
        {   $i=1;
            foreach ($records as $record)
            {
                //print_r($timeslot); die;
                $this->db->select('sum(bet_amount) as chips');
                $this->db->from('player_history');
                // $this->db->where('id',$record->id);
                $this->db->where('player_id',$player_id);
                $this->db->where('transaction_id',$record->transaction_id);
                $this->db->like('timeslot',$day);
                $this->db->group_by('transaction_id');
                //$this->db->like('timeslot',$timeslot->timeslot);
                $query=$this->db->get()->row();
                // echo $this->db->last_query(); die;
                $chips = $query->chips;

                $this->db->select('sum(payout) as win');
                $this->db->from('player_history');
                $this->db->where('result','1');
                // $this->db->where('id',$record->id);
                $this->db->where('player_id',$player_id);
                $this->db->where('transaction_id',$record->transaction_id);
                $this->db->like('timeslot',$day);
                $query=$this->db->get()->row();
                //echo $this->db->last_query(); die;
                $win = $query->win;

                
                $balance = $chips - $win;
                $total_bet = $total_bet + $chips ;
                $total_wins = $total_wins + $win;
                $total_balance = $total_balance + $balance;

                $data[]= array(
                        'sr_no' => $i,
                        'user_code' => $user_code,
                        'bet_amount'=>$chips,
                        'payout'=>$win,
                        'transaction_id'=>$record->transaction_id,
                        'total_bet'=>number_format($total_bet,2),
                        'total_wins'=>number_format($total_wins,2),
                        //'total_balance'=>$total_balance,
                        //'draw_time'=>$timeslot['timeslot'],
                    );
                $i++;
            }
        }   

        //echo "<pre>";
        //print_r($data);
       //   die;
        return $data;
	}

	function getAccountsPlayerByTransactionId($transaction_id,$date,$draw_time)
	{
			
		$data = array();
        
        $this->db->select('id,transaction_id');
        $this->db->from('player_history');
        //$where = 'player_id = "'.$player_id.'" AND timeslot LIKE "%'.$day.'%" AND timeslot_id="'.$timeslot_id.'"';
        $this->db->where('transaction_id',$transaction_id);
        //$this->db->group_by('transaction_id');
        $query=$this->db->get();
        //echo($this->db->last_query());  die;
        $transactions =  $query->result();

        //echo "<pre>";
        //print_r($transactions); die;


        $total_bet = 0 ;
        $total_wins = 0;
        $total_balance = 0;
        $total_commission = 0;


		foreach ($transactions as $transaction) {
            $this->db->select('bet_amount as chips');
            $this->db->from('player_history');
            $this->db->where('id',$transaction->id);
            $query=$this->db->get()->row();
            // echo $this->db->last_query(); die;
            $chips = '';
            if($query)
                $chips = $query->chips;

            $this->db->select('payout as win');
            $this->db->from('player_history');
            $this->db->where('result','1');
            $this->db->where('id',$transaction->id);
            // $this->db->where('transaction_id',$record->transaction_id);
            // $this->db->like('timeslot',$day);
            $win = 0;
            $query=$this->db->get()->row();
            // echo $this->db->last_query(); die;
            if($query)
                $win = number_format($query->win,2);


            $this->db->select('sum(bet_amount) as total_bet');
            $this->db->from('player_history');
            $this->db->where('transaction_id',$transaction->transaction_id);
            $query=$this->db->get()->row();
            // echo $this->db->last_query(); die;
            $total_bet = '';
            if($query)
                $total_bet = number_format($query->total_bet,2);

            $this->db->select('sum(payout) as total_wins');
            $this->db->from('player_history');
            $this->db->where('result','1');
            $this->db->where('transaction_id',$transaction->transaction_id);
            $query=$this->db->get()->row();
            //echo $this->db->last_query(); die;
            $total_wins ='';
            if($query)
                $total_wins = number_format($query->total_wins,2);


            $this->db->select('first_digit,second_digit,jodi_digit');
            $this->db->from('player_history');
            $this->db->where('id',$transaction->id);
            $query=$this->db->get()->row();
            // echo $this->db->last_query(); die;
            $first_digit = $query->first_digit;
            $second_digit = $query->second_digit;
            $jodi_digit = $query->jodi_digit;

            $this->db->select('lucky_number,timeslot');
            $this->db->from('lucky_numbers');
            $this->db->where('timeslot_id',$draw_time+1);
            $this->db->like('timeslot',$date);
            $query=$this->db->get()->row();
            // echo $this->db->last_query(); die;
            $lucky_number ='';
            $timeslot='';
            $drawtime ='';
            if($query){
                $lucky_number = $query->lucky_number;
                if($lucky_number < 10){
                    $lucky_number = "0".$lucky_number;
                }
                $timeslot = $query->timeslot;
                $drawtime = date('h:i a', strtotime(explode(" ", $timeslot)[1]));
            }

            $this->db->select('timeslot');
            $this->db->from('player_history');
            $this->db->where('transaction_id',$transaction->transaction_id);
            $query=$this->db->get()->row();
            //echo $this->db->last_query(); die;
            if($query)
                $trans_time = date('h:i:s a',strtotime($query->timeslot));

            if(isset($jodi_digit)){
                if($jodi_digit<10){
                    $jodi_digit = "0".$jodi_digit;
                }
            }

            $data[$transaction->transaction_id][] = array('id'=>$transaction->id,
                            'first_digit'=>(isset($first_digit)) ? $first_digit : 999,
                            'second_digit'=>(isset($second_digit)) ? $second_digit : 999,
                            'jodi_digit'=>(isset($jodi_digit)) ? $jodi_digit : 999,
                            'win'=>$win,
                            'total_bet'=>$total_bet,
                            'total_wins'=>$total_wins,
                            'chips'=>$chips,
                            'lucky_number'=>$lucky_number,
                            'drawtime'=>$drawtime,
                            'trans_time'=>$trans_time,

                            );


        }
        
        // echo "<pre>"; print_r($data);    die;
        return $data;
	}
    
}
