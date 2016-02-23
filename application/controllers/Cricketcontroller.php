<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cricketcontroller extends CI_Controller
{
    public function __construct() {
    parent::__construct();

    //header('Access-Control-Allow-Origin: *');
    //header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    $this->load->database();
    $this->load->model('Auth_model');
    $this->load->model('Getlocation');
    $this->load->model('Admin_model');
    //$this->load->model('Cricket_model');
    $this->load->model('Cricketmodel_model');
    $this->load->model('Bets_model');
    $this->load->library('ion_auth');
    
}
    // call to cricket page of view
    function cricket()
    {
        $Data['MatchList'] = $this->Cricketmodel_model->getMatchList();
        $this->load->view('admin/cricket',$Data);
    }
    // get tocken access from this GetApiAuthentication function	
    function GetApiAuthentication()
    {	 

        $form_url="http://www.litzscore.com/rest/v2/auth/";
        $data_to_post = array(
        "access_key" => "c5fcdde18fe2dae84a78d3e90035a372",
        "secret_key" => "8976c672ad179cb4ca212ae7a1a175dc",			
        "app_id" => "145340019452649",
        "device_id" => "abr344mkd99"			
        );
	
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_URL, $form_url);
        curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));
        curl_setopt($curl,CURLOPT_POSTFIELDS, $data_to_post);
        $result = curl_exec($curl);
        $TokenArray =  json_decode($result);
        $TokenAccess = $TokenArray->auth->access_token;
        curl_close($curl);
        return $TokenAccess;
        
    }
	

    // one day call to this function 
    function CronDataAutomated()
    {
    
        $TokenAccess = $this->GetApiAuthentication();
        // get match data of next month when 5 days are remaning to end month  // need to work on this
        $url="http://www.litzscore.com/rest/v2/schedule/?access_token=".$TokenAccess;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        $asd =  json_decode($output);
        $matches = $asd->data->months[0]->days;
        $ArrayOfMatchList = array();
        //echo "<pre>";
        //print_r($matches); //exit;
        foreach($matches as $value)
        {	
            $MatchData = array_filter($value->matches);
            
            if(!empty($MatchData))
            {

                    foreach($MatchData as $v)
                    {
                            //echo $i++.$v->name." ".$v->status." ".$v->key."<br>";t20//one-day
                        if($v->format=="t20" || $v->format=="one-day")
                        {
                            $CheckedMatchKey = $this->Cricketmodel_model->getCheckUniqueMatchIdPresent($v->key);
                            
                            if($CheckedMatchKey == 0) // 0 will insert int odatabase as new match from server
                            {
                                    $ArrayOfMatchList[] = array("name" => $v->name, "status" => $v->status
                                    ,"unique" => $v->key,"format" => $v->format,"venue" => $v->venue
                                    ,"start_date" => $v->start_date->iso,"team_a" => $v->teams->a->name,"team_b" => $v->teams->b->name
                                    ,"winner_team" => $v->winner_team , "match_load" => 0
                                    );
                                    
                            }
                        }
                    }
            }

        } // end of foreach

        $this->Cricketmodel_model->MatchListInsert($ArrayOfMatchList);
        $ArrayMatchListNotLoaded = $this->Cricketmodel_model->GetMatchNotLoaded();
        
        if(count($ArrayMatchListNotLoaded) > 0)
        {
            
            foreach ($ArrayMatchListNotLoaded as $key => $value)
            {
                // Check if match id already exist then not insert data
                $CheckedMatchKeyInOddScheduleValue = $this->Cricketmodel_model->getCheckUniqueMatchIdPresentInOddsscheduleTable($value->id);

                if($CheckedMatchKeyInOddScheduleValue == 0) // 0 will insert int odatabase as new match from server
                {
                    $GetConfigOddDataArray = $this->Cricketmodel_model->GetConfigOddMasterData();                
                    foreach ($GetConfigOddDataArray as $key => $v) 
                    {
                        $ScheduleArrayDataValue =  array("match_id" => $value->id,"odd_id" => $v->odd_id, "odds" => $v->odds, "m_id" => $v->m_id);
                        $this->Cricketmodel_model->MatchBetSheduleDataInsert($ScheduleArrayDataValue);
                    }
                }    

                // update match list table match_load column
                $this->Cricketmodel_model->SetMatchLoadUpdate($value->id);

            } // end of match loaded count loop
            
        } // end of match loaded count if
       
	//echo "Done All";
		
    } // end of function
    
    function GetAllMatchList()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        //$MatchUniqueKey = $data['key'];
        $AllMAtchLists = $this->Cricketmodel_model->getMatchList();
        
        echo json_encode($AllMAtchLists);
    }
    
    // specific match toss data to backend
    function GetTossGameData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllRowMatchTossArrayData = $this->Cricketmodel_model->GetTossGameDetails($MatchId);
        
        echo json_encode($AllRowMatchTossArrayData);
    
    
    }
    
    // specific match to first ball details
    function GetFirstBallData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchFirstzBallArrayData = $this->Cricketmodel_model->GetFirstBallGameDetails($MatchId);
        
        echo json_encode($AllMatchFirstzBallArrayData);
    
    
    }
    
    // specific match to first over details
    function GetFirstOverData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchFirstOverArrayData = $this->Cricketmodel_model->GetFirstOverGameDetails($MatchId);
        
        echo json_encode($AllMatchFirstOverArrayData);
    
    
    }
    
    // specific match to first ten over details
    function GetFirstTenOverSessionData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchFirstTenOverDataArrayData = $this->Cricketmodel_model->GetFirstTenOverSessionGameDetails($MatchId);
        
        echo json_encode($AllMatchFirstTenOverDataArrayData);
    
    
    }
    
    // specific match to first wicket details
    function GetFirstWicketData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchFirstWicketDataArrayData = $this->Cricketmodel_model->GetFirstWicketGameDetails($MatchId);
        
        echo json_encode($AllMatchFirstWicketDataArrayData);
    
    
    }
    
    
    // specific match to first 30 run details
    function GetFirstThirtiesRunData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchFirstThirtiesRunArrayData = $this->Cricketmodel_model->GetFirstThirtiesRunGameDetails($MatchId);
        
        echo json_encode($AllMatchFirstThirtiesRunArrayData);
    
    
    }
    
    // specific match to first 50 run details
    function GetFirstFiftyRunData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchFirstFiftyRunArrayData = $this->Cricketmodel_model->GetFirstFiftyRunGameDetails($MatchId);
        
        echo json_encode($AllMatchFirstFiftyRunArrayData);
    
    
    }
    
    // specific match to first 100 run details
    function GetFirstHundredRunData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchFirstHundredRunArrayData = $this->Cricketmodel_model->GetFirstHundredRunGameDetails($MatchId);
        
        echo json_encode($AllMatchFirstHundredRunArrayData);
    
    
    }
    
    // specific match to first run rate details
    function GetFirstRunRateData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchFirstRunRateArrayData = $this->Cricketmodel_model->GetFirstRunRateGameDetails($MatchId);
        
        echo json_encode($AllMatchFirstRunRateArrayData);
    
    
    }
    
    // specific match to Win Loss details
    function GetWinLossData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchWinLossArrayData = $this->Cricketmodel_model->GetWinLossGameDetails($MatchId);
        
        echo json_encode($AllMatchWinLossArrayData);
    
    
    }
    
    
    // specific match to Highest Opening PartnerShip details
    function GetHighestOpeningPartnerShipData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchHighestOpeningPartnerShipArrayData = $this->Cricketmodel_model->GetHighestOpeningPartnerShipDetails($MatchId);
        
        echo json_encode($AllMatchHighestOpeningPartnerShipArrayData);
    
    
    }
    
    
    
    // specific match to Race To 50 details
    function GetRaceToFiftyData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchRaceToFiftyArrayData = $this->Cricketmodel_model->GetRaceToFiftyDetails($MatchId);
        
        echo json_encode($AllMatchRaceToFiftyArrayData);
    
    
    }
    
    
    // specific match to first wicket fall at run Data  details
    function GetWicketFallAtRunsGameData()
    {
        $data = array(
        'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];

        $AllMatchWicketFallAtRunsArrayData = $this->Cricketmodel_model->GetFirstWicketFallAtRunsGameDetails($MatchId);
        
        echo json_encode($AllMatchWicketFallAtRunsArrayData);
    
    
    }
    
    
    
    

   
	
}
