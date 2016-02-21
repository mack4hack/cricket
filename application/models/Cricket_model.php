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
