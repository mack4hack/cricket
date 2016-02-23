<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//location: application/models/auth_model.php

class Cricketmodel_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
    }
    
    
    // checked match unique is available or not
    function getCheckUniqueMatchIdPresent($UniqueKey)
    {
        
        $this->db->select('unique');
        $this->db->where('unique', $UniqueKey);
        $query = $this->db->get("match_list"); 
        
        $status = 0;
        
        if($query)
        {
            if($query->num_rows()>0)
            {
                  $status = 1;

            }
            else
            {
                 $status = 0;
            }    
        }
        
        return $status; 
        
    }
    
    // insert all match from litzscore
    function MatchListInsert($data)
    {

       foreach($data as $insert_data){
         $this->db->insert('match_list',$insert_data);
       }
       return  true;
    }
    
     // get match list for not inserted       
    function GetMatchNotLoaded()
    {
        $this->db->select('*');
        $this->db->from('match_list');
        $this->db->where('match_load', 0);
        $this->db->order_by('id', "ASC");
        $this->db->limit(10);
        $query=$this->db->get();
        $players = $query->result(); 
        
       return $query->result();
    }
        
        
    // get config_cric_odds data for        
    function GetConfigOddMasterData()
    {
        $this->db->select('*');
        $this->db->from('config_cric_odds');
        $query=$this->db->get();
        $players = $query->result(); 
        
       return $query->result();
    }    
    
    // get shedule match data will be insert
    function MatchBetSheduleDataInsert($data)
    {

       //foreach($data as $insert_data){
         $this->db->insert('cric_matchbet_schedule',$data);
      // }
       return  true;
    }
    
    // checked match unique is available or not in  cric_matchbet_schedule
    function getCheckUniqueMatchIdPresentInOddsscheduleTable($MatchId)
    {
        
        $this->db->select('match_id');
        $this->db->where('match_id', $MatchId);
        $query = $this->db->get("cric_matchbet_schedule"); 
        
        $status = 0;
        
        if($query)
        {
            if($query->num_rows()>0)
            {
                  $status = 1;

            }
            else
            {
                 $status = 0;
            }    
        }
        
        return $status; 
        
    }
    
    // update match load to 1 after insertion of master data to schedule data
    function SetMatchLoadUpdate($MatchId)
    {
        $data = array("match_load" => 1);
        $this->db->where('id', $MatchId);
	$this->db->update("match_list", $data);
         
    }
    
     // get match list for backend       
    function getMatchList()
    {
        $this->db->select('*');
        $this->db->from('match_list');
        $this->db->where('status != ','completed');
        $query=$this->db->get();
        
        return $query->result();
    }
    
     // get match list for backend Toss Data       
    function GetTossGameDetails($MatchId)
    {
        $this->db->select('*');
        $this->db->from('match_list');
        $this->db->where('id', $MatchId);
        $query=$this->db->get();
        
        return $query->result();
    }

    // get match pericular data for backend First ball Data       
    function GetFirstBallGameDetails($MatchId)
    {   
        // 3 Fist ball team A , 4 first ball team b
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
	$this->db->where('cms.match_id ='.$MatchId.' AND (cms.m_id = 3 OR cms.m_id = 4)');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend First over Data       
    function GetFirstOverGameDetails($MatchId)
    {   
       
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
	$this->db->where('cms.match_id ='.$MatchId.' AND (cms.m_id = 5 OR cms.m_id = 6)');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend First ten over Sesson Data       
    function GetFirstTenOverSessionGameDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
	$this->db->where('cms.match_id ='.$MatchId.' AND (cms.m_id = 7 OR cms.m_id = 8)');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend First Wicket Data       
    function GetFirstWicketGameDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
	$this->db->where('cms.match_id ='.$MatchId.' AND (cms.m_id = 9 OR cms.m_id = 10)');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend First thirthies run Data       
    function GetFirstThirtiesRunGameDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
	$this->db->where('cms.match_id ='.$MatchId.' AND (cms.m_id = 15 OR cms.m_id = 16)');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend First fifty run Data       
    function GetFirstFiftyRunGameDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
	$this->db->where('cms.match_id ='.$MatchId.' AND (cms.m_id = 17 OR cms.m_id = 18)');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend First 100 run Data       
    function GetFirstHundredRunGameDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
	$this->db->where('cms.match_id ='.$MatchId.' AND (cms.m_id = 19 OR cms.m_id = 20)');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend Run rate Data       
    function GetFirstRunRateGameDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
	$this->db->where('cms.match_id ='.$MatchId.' AND (cms.m_id = 21 OR cms.m_id = 22)');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend - first wicket fall at run Data       
    function GetFirstWicketFallAtRunsGameDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
	$this->db->where('cms.match_id ='.$MatchId.' AND (cms.m_id = 13 OR cms.m_id = 14)');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    
    // get match pericular data for backend Win LossData       
    function GetWinLossGameDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
	$this->db->where('cms.match_id ='.$MatchId.' AND cms.m_id = 1');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend Win LossData       
    function GetHighestOpeningPartnerShipDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
	$this->db->where('cms.match_id ='.$MatchId.' AND cms.m_id = 11');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }
    
    // get match pericular data for backend RaceToFifty      
    function GetRaceToFiftyDetails($MatchId)
    {   
        
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
	$this->db->join('config_cric_odds cco','cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
	$this->db->where('cms.match_id ='.$MatchId.' AND cms.m_id = 12');
        //$this->db->where('');
        $query = $this->db->get();
	//echo $this->db->last_query();die;
        return $query->result_array();
        
        
    }

        
        
        
    
}
