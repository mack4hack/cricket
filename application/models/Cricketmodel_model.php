<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//location: application/models/auth_model.php

class Cricketmodel_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // checked match unique is available or not
    function getCheckUniqueMatchIdPresent($UniqueKey) {

        $this->db->select('unique');
        $this->db->where('unique', $UniqueKey);
        $query = $this->db->get("match_list");

        $status = 0;

        if ($query) {
            if ($query->num_rows() > 0) {
                $status = 1;
            } else {
                $status = 0;
            }
        }

        return $status;
    }

    // checked match unique summary is available or not
    function getCheckUniqueMatchOverSummaryPresent($MatchUniqueId, $BattingKeyId, $OverCount) {

        $this->db->select('over');
        $this->db->where('match_id', $MatchUniqueId);
        $this->db->where('Innings_code', $BattingKeyId);
        $this->db->where('over', $OverCount);
        $query = $this->db->get("match_summary");

        $status = 0;

        if ($query) {
            if ($query->num_rows() > 0) {
                $status = 1;
            } else {
                $status = 0;
            }
        }

        return $status;
    }

    // checked match player unique summary is available or not
    function getCheckUniqueMatchPlyerPresent($MatchUniqueId, $BattingKeyId, $PlayerKey) {

        $this->db->select('player_key');
        $this->db->where('match_id', $MatchUniqueId);
        $this->db->where('Innings_code', $BattingKeyId);
        $this->db->where('player_key', $PlayerKey);
        $query = $this->db->get("team_player");

        $status = 0;

        if ($query) {
            if ($query->num_rows() > 0) {
                $status = 1;
            } else {
                $status = 0;
            }
        }

        return $status;
    }

    // checked match player unique summary is available or not
    function getCheckUniqueMatchWicketPresent($MatchUniqueId, $BattingKeyId, $PlayerKey) {

        $this->db->select('wicket_out_total_run');
        $this->db->where('match_id', $MatchUniqueId);
        $this->db->where('Innings_code', $BattingKeyId);
        $this->db->where('wicket_out_total_run', $PlayerKey);
        $query = $this->db->get("team_fall_wicket");

        $status = 0;

        if ($query) {
            if ($query->num_rows() > 0) {
                $status = 1;
            } else {
                $status = 0;
            }
        }

        return $status;
    }

    // checked match ball by ball summary is available or not
    function getCheckUniqueMatchBallByBallPresent($UniqueKeyOfMatch, $MatchUniqueId, $BattingKeyId) {

        $this->db->select('match_id');
        $this->db->where('match_id', $MatchUniqueId);
        $this->db->where('Innings_code', $BattingKeyId);
        //$this->db->where('wicket_out_total_run', $PlayerKey);
        $query = $this->db->get("ball_by_ball");

        $status = 0;

        if ($query) {
            if ($query->num_rows() > 0) {
                $status = 1;
            } else {
                $status = 0;
            }
        }

        return $status;
    }

    // update player data into our database
    function UpdatePlayerAllData($PlayerDetailArrayData, $MatchUniqueId, $BattingKeyId, $PlayerKey) {
        $this->db->where('match_id', $MatchUniqueId);
        $this->db->where('Innings_code', $BattingKeyId);
        $this->db->where('player_key', $PlayerKey);
        $this->db->update("team_player", $PlayerDetailArrayData);
    }

    // get match Player Key To     
    function GetSelectPlayerAllKeyData($MatchUniqueId, $BattingKeyId) {
        $this->db->select('player_key');
        $this->db->where('match_id', $MatchUniqueId);
        $this->db->where('Innings_code', $BattingKeyId);
        //$this->db->where('player_key', $PlayerKey);
        $query = $this->db->get("team_player");
        $players = $query->result();

        return $query->result();
    }

    // insert all match from litzscore
    function MatchListInsert($data) {

        foreach ($data as $insert_data) {
            $this->db->insert('match_list', $insert_data);
        }
        return true;
    }

    // insert all match over summary from litzscore
    function MatchOverSummaryInsert($data) {

        // foreach($data as $insert_data){
        $this->db->insert('match_summary', $data);
        //echo $this->db->last_query();die;
        // }

        return true;
    }

    // insert all match Player summary from litzscore
    function MatchPlayerSummaryInsert($data) {

        // foreach($data as $insert_data){
        $this->db->insert('team_player', $data);
        //echo $this->db->last_query();die;
        // }

        return true;
    }

    // insert all match Player summary from litzscore
    function MatchWicketSummaryInsert($data) {

        // foreach($data as $insert_data){
        $this->db->insert('team_fall_wicket', $data);
        //echo $this->db->last_query();die;
        // }

        return true;
    }

    // insert  match first ball data from litzscore
    function MatchFirstBallSummaryInsert($data) {

        // foreach($data as $insert_data){
        $this->db->insert('ball_by_ball', $data);
        //echo $this->db->last_query();die;
        // }

        return true;
    }

    // get match list for not inserted       
    function GetMatchNotLoaded() {
        $this->db->select('*');
        $this->db->from('match_list');
        $this->db->where('match_load', 0);
        $this->db->order_by('id', "ASC");
        $this->db->limit(10);
        $query = $this->db->get();
        $players = $query->result();

        return $query->result();
    }

    // get match key for current date played       
    function GetLiveMatchKeyAPIToday() {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('match_list');
        $this->db->where('STR_TO_DATE( start_date, "%Y-%m-%d" )
        BETWEEN STR_TO_DATE( "' . $today . '", "%Y-%m-%d" )
        AND STR_TO_DATE( "' . $today . '", "%Y-%m-%d" )', NULL, FALSE);
        $query = $this->db->get();

        return $query->result();
    }

    // get config_cric_odds data for        
    function GetConfigOddMasterData() {
        $this->db->select('*');
        $this->db->from('config_cric_odds');
        $query = $this->db->get();
        $players = $query->result();

        return $query->result();
    }

    // get shedule match data will be insert
    function MatchBetSheduleDataInsert($data) {

        //foreach($data as $insert_data){
        $this->db->insert('cric_matchbet_schedule', $data);
        // }
        return true;
    }

    // checked match unique is available or not in  cric_matchbet_schedule
    function getCheckUniqueMatchIdPresentInOddsscheduleTable($MatchId) {

        $this->db->select('match_id');
        $this->db->where('match_id', $MatchId);
        $query = $this->db->get("cric_matchbet_schedule");

        $status = 0;

        if ($query) {
            if ($query->num_rows() > 0) {
                $status = 1;
            } else {
                $status = 0;
            }
        }

        return $status;
    }

    // update match load to 1 after insertion of master data to schedule data
    function SetMatchLoadUpdate($MatchId) {
        $data = array("match_load" => 1);
        $this->db->where('id', $MatchId);
        $this->db->update("match_list", $data);
    }

    // update match load to 1 after insertion of master data to schedule data
    function UpdateLiveMatchData($ArrayOfMatchUpdateList, $UniqueKeyOfMatch) {
        //$data = array("match_load" => 1);
        $this->db->where('unique', $UniqueKeyOfMatch);
        $this->db->update("match_list", $ArrayOfMatchUpdateList);
    }

    // get match list for backend       
    function getMatchList() {
        $this->db->select('*');
        $this->db->from('match_list');
        $this->db->where('status != ', 'completed');
        $query = $this->db->get();

        return $query->result();
    }

    // get match list for backend Toss Data       
    function GetTossGameDetails($MatchId) {
        $this->db->select('*');
        $this->db->from('match_list');
        $this->db->where('id', $MatchId);
        $query = $this->db->get();

        return $query->result();
    }

    // get match pericular data for backend First ball Data       
    function GetFirstBallGameDetails($MatchId) {
        // 3 Fist ball team A , 4 first ball team b
        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND (cms.m_id = 3 OR cms.m_id = 4)');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend First over Data       
    function GetFirstOverGameDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND (cms.m_id = 5 OR cms.m_id = 6)');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend First ten over Sesson Data       
    function GetFirstTenOverSessionGameDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND (cms.m_id = 7 OR cms.m_id = 8)');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend First Wicket Data       
    function GetFirstWicketGameDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND (cms.m_id = 9 OR cms.m_id = 10)');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend First thirthies run Data       
    function GetFirstThirtiesRunGameDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND (cms.m_id = 15 OR cms.m_id = 16)');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend First fifty run Data       
    function GetFirstFiftyRunGameDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND (cms.m_id = 17 OR cms.m_id = 18)');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend First 100 run Data       
    function GetFirstHundredRunGameDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND (cms.m_id = 19 OR cms.m_id = 20)');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend Run rate Data       
    function GetFirstRunRateGameDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND (cms.m_id = 21 OR cms.m_id = 22)');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend - first wicket fall at run Data       
    function GetFirstWicketFallAtRunsGameDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND (cms.m_id = 13 OR cms.m_id = 14)');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend Win LossData       
    function GetWinLossGameDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND cms.m_id = 1');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend Win LossData       
    function GetHighestOpeningPartnerShipDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND cms.m_id = 11');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // get match pericular data for backend RaceToFifty      
    function GetRaceToFiftyDetails($MatchId) {

        $this->db->select('*');
        $this->db->from('cric_matchbet_schedule cms');
        $this->db->join('config_cric_odds cco', 'cms.odd_id=cco.odd_id');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
        $this->db->where('cms.match_id =' . $MatchId . ' AND cms.m_id = 12');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    // Update Mater Odds Value
    function SetUpdateMasterOddsData($MasterOddId, $data, $ScheduleUpdateArray) {
        //$data = array("match_load" => 1);
        $this->db->where('odd_id', $MasterOddId);
        $this->db->update("config_cric_odds", $data);

        $this->db->where('odd_id', $MasterOddId);
        $this->db->update("cric_matchbet_schedule", $ScheduleUpdateArray);
    }

    // Update Mater Odds Value
    function SetUpdateScheduleOddsData($ScheduleId, $data) {
        //$data = array("match_load" => 1);
        $this->db->where('id', $ScheduleId);
        $this->db->update("cric_matchbet_schedule", $data);
        //echo $this->db->last_query();die;
    }

    // get match format
    function getMatchFormatData($MatchIdReturn) {

        $this->db->select('format');
        $this->db->where('id', $MatchIdReturn);
        $query = $this->db->get("match_list")->row();

        return $query->format;
    }

    /*  swapnil data // start//   */

    // get match pericular data for backend Win LossData       
    function GetGameDetailsTotalBet($MatchId, $odd_id) {

        $this->db->select('sum(chips) as total_bet');
        $this->db->from('cric_user_bet');
        //$this->db->join('match_list ml','cms.match_id=ml.id');
        $this->db->where('match_id =' . $MatchId . ' AND odd_id =' . $odd_id . '');
        //$this->db->where('');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    function update_bet_and_payout($table, $where = array(), $data) {
        $this->db->update($table, $data, $where);
        //echo $this->db->last_query();//die;
        return $this->db->affected_rows();
    }

    /*  swapnil data // End//   */
    
    
    // insert all match Player summary from litzscore
    function MatchErrorInsert($data) {

        // foreach($data as $insert_data){
        $this->db->insert('catch_error', $data);
        //echo $this->db->last_query();die;
        // }

        return true;
    }
    
    
    // get match batsman data to backend      
    function GetAllBatsmanDataDetails($MatchId) {
        
        $this->db->select('*');
        $this->db->from('team_player tp');
        $this->db->join('match_list mt', 'tp.match_id=mt.id');
        $this->db->where('tp.match_id ='. $MatchId);
        $this->db->where('tp.Innings_code', "a_1");
        $this->db->where('tp.player_name !=',"null");
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        
        return $query->result_array();
    }
    
    
    
    
    
    
    
}
