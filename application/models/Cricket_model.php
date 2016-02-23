<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//location: application/models/auth_model.php

class Cricket_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
    }
    
    function placebet($data) {
        return $this->db->insert('cric_user_bet', $data);
    }
    
    
    function getCricketMatchList() {
        date_default_timezone_set("Asia/Calcutta");
        $now = getdate();
        
        $this->db->select('*');
        $this->db->from('match_list');
        $this->db->order_by('date','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }



function getCheckUniqueMatchIdPresent($UniqueKey)
{
	$this->db->select('unique');
			$this->db->from('match_list');
			$this->db->where('unique',$UniqueKey);		
			//$query = $this->db->get();
			$query=$this->db->get()->row();
			//$query->unique;
			//echo($this->db->last_query());
// exit;
			//$players = $query->result(); 
       return $query;
}
function getCheckUniqueMatchIdPresentInMatchDetails($UniqueKey)
{
	$this->db->select('unique');
			$this->db->from('match_details');
			$this->db->where('unique',$UniqueKey);		
			//$query = $this->db->get();
			$query=$this->db->get()->row();
			//$query->unique;
			//echo($this->db->last_query());
// exit;
			//$players = $query->result(); 
       return $query;
}

function MatchListInsert($data)
	{
            
                               foreach($data as $insert_data){
                         	 $this->db->insert('match_list',$insert_data);
                               }
                               return  true;
	}	
function MatchDetailsInsert($data)
	{
            
                              // foreach($data as $insert_data){
                         	 $this->db->insert('match_details',$data);
                              // }
                               return  true;
	}	
	
function getMatchList()
{
	$this->db->select('*');
			$this->db->from('match_list');
			$this->db->where('status != ','completed');
			//$this->db->limit(15);
			$query=$this->db->get();
			
			//echo($this->db->last_query());

			$players = $query->result(); 
       return $query->result();
}

function getMatchDetails($data)
{
	$this->db->select('*');
			$this->db->from('match_details');
			$this->db->where('unique', $data);
			//$this->db->limit(15);
			$query=$this->db->get();
			
			//echo($this->db->last_query());

			$players = $query->result(); 
       return $query->result();
}



// get master match game
function getMaterDataValueOfFirstBall($UniqueGameName)
{
	$this->db->select('m_id');
			$this->db->from('config_cricgame_master');
			$this->db->where('game_name',$UniqueGameName);		
			//$query = $this->db->get();
			$query=$this->db->get()->row();
			 
       return $query->m_id;
}


// get cofig odds data from master
function getMaterConfigOdd($data)
{
	$this->db->select('*');
			$this->db->from('config_cric_odds');
			$this->db->where('m_id', $data);
			
			$query=$this->db->get();
			$players = $query->result(); 
       return $query->result();
}

// get shedule match data will be insert
function MatchBetSheduleDataInsert($data)
	{
            
                               foreach($data as $insert_data){
                         	 $this->db->insert('cric_matchbet_schedule',$insert_data);
                               }
                               return  true;
	}	


function getCricketMatchDetails(){
	$today = date('Y-m-d');
	$next_date = date("Y-m-d", strtotime("+3 days"));
	$this->db->select('*');
        $this->db->from('match_list');
	$this->db->where('STR_TO_DATE( start_date, "%Y-%m-%d" )
BETWEEN STR_TO_DATE( "'.$today.'", "%Y-%m-%d" )
AND STR_TO_DATE( "'.$next_date.'", "%Y-%m-%d" )', NULL, FALSE );

        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
	}

function getCricketMatchOdds(){
	$today = date('Y-m-d');
	$next_date = date("Y-m-d", strtotime("+3 days"));
	$this->db->select('*,cgm.game_name');
    $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
	$this->db->join('match_list ml','ml.id=cms.match_id');
	$this->db->join('config_cricgame_master cgm','cms.m_id=cgm.m_id');
	$this->db->where('STR_TO_DATE( ml.start_date, "%Y-%m-%d" )
BETWEEN STR_TO_DATE( "'.$today.'", "%Y-%m-%d" )
AND STR_TO_DATE( "'.$next_date.'", "%Y-%m-%d" )', NULL, FALSE );
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
	}
	
	function addUserCricketMatchBet($data){
		$this->db->insert('cric_user_bet', $data);
		return $this->db->insert_id();
	}
	
	
	function cancelCricBet($player_id) {
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
            $debit_dealer = array('id' => $dealer_id, 'bet_amount' => $bet_amount_dealer);
            $credit = array('id' => $player_id, 'bet_amount' => $bet_amount);
            
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
            $this->db->delete('cric_user_bet', array('transaction_id' => $transaction_id));
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

function checkBettingClosed($match_id,$m_id){
	$this->db->select('match_id,game_close');
    $this->db->from('cric_matchbet_schedule');
	$this->db->where('match_id',$match_id);
	$this->db->where('m_id',$m_id);	
	$this->db->where('game_close','1');
	
    $query = $this->db->get();
	return $query->result_array();
}

function getGameType($m_id){
	$this->db->select('game_type');
    $this->db->from('config_cricgame_master');
	$this->db->where('m_id',$m_id);	
    $query = $this->db->get();
	return $query->result_array();
}

function getCricketMatchOddsByMatchId($match_id,$m_id){
	
	$this->db->select('*');
    $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
	$this->db->join('match_list ml','ml.id=cms.match_id');
	$this->db->where('match_id',$match_id);
	$this->db->where('m_id',$m_id);
    $query = $this->db->get();
	//echo $this->db->last_query();die;
    return $query->result_array();
}

    
}
