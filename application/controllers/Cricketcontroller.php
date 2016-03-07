<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cricketcontroller extends CI_Controller {
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
    function cricket() {
        $Data['MatchList'] = $this->Cricketmodel_model->getMatchList();
        $this->load->view('admin/cricket', $Data);
    }
    // get tocken access from this GetApiAuthentication function	
    function GetApiAuthentication() {
        $CommonAuthUrl = "https://rest.cricketapi.com/rest/v2/";
        //$form_url = "http://www.litzscore.com/rest/v2/auth/";
        //$form_url = "https://rest.cricketapi.com/rest/v2/auth/";
        $form_url = $CommonAuthUrl."auth/";
       
        $data_to_post = array(
            "access_key" => "c5fcdde18fe2dae84a78d3e90035a372",
            "secret_key" => "8976c672ad179cb4ca212ae7a1a175dc",
            "app_id" => "145340019452649",
            "device_id" => "abr344mkd99"
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $form_url);
        curl_setopt($curl, CURLOPT_POST, sizeof($data_to_post));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_to_post);
        //curl_setopt($ch,CURLOPT_ENCODING , "gzip");
        $result = curl_exec($curl);
        $TokenArray = json_decode($result);
        //$TokenAccessValue = $TokenArray->auth->access_token;
        $TokenAccess = (isset($TokenArray->auth->access_token))?$TokenArray->auth->access_token:"";
        curl_close($curl);
        
        return $TokenAccess;
    }
    
    // Live Match Data From  
    function CronLiveMatchDataAutomated() {
        
        //if($CheckMatchStartWithTwoHoursBefore)
        //{  // need to work
            
        //}
        
        $TokenAccess = $this->GetApiAuthentication();
        if($TokenAccess != "")
        {
            $UniqueKeyOfMatchArray = $this->Cricketmodel_model->GetLiveMatchKeyAPIToday();
            
            
            
            echo "<pre>";
            print_r($this->Cricketmodel_model->GetLiveMatchKeyAPIToday());
            
            
            if (count($UniqueKeyOfMatchArray) > 0) {
                foreach ($UniqueKeyOfMatchArray as $key => $v) {
                    $UniqueKeyOfMatch = $v->unique;
                    $MatchUniqueId = $v->id;
                    //$MatchUniqueId = 50;
                    //$UniqueKeyOfMatch = "asiacup_2016_final";
                    //$CommonAuthUrl = "http://www.litzscore.com/rest/v2/";
                    $CommonAuthUrl = "https://rest.cricketapi.com/rest/v2/";
                    $url = $CommonAuthUrl."match/" . $UniqueKeyOfMatch . "/?access_token=" . $TokenAccess;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch,CURLOPT_ENCODING , "gzip");
                    $output = curl_exec($ch);
                    $LiveMatchArray = json_decode($output);
                    //echo "ss<pre>";
                    //echo $LiveMatchArray->data->card->now->batting_team;
                    //print_r($LiveMatchArray->data); exit;
                    //exit;
                    if (count((array) $LiveMatchArray->data->card->toss) > 0) {
                        if ($LiveMatchArray->data->card->toss->won != "") {
                            $RunRate = (isset($LiveMatchArray->data->card->now->req->runs_rate)) ? $LiveMatchArray->data->card->now->req->runs_rate : "0";
                            $ArrayOfMatchUpdateList = array(
                                "toss_win" => $LiveMatchArray->data->card->toss->won,
                                "decision" => $LiveMatchArray->data->card->toss->decision,
                                "runs_str" => $LiveMatchArray->data->card->now->runs_str,
                                "batting_team" => $LiveMatchArray->data->card->now->batting_team,
                                "bowling_team" => $LiveMatchArray->data->card->now->bowling_team,
                                "winner_team" => $LiveMatchArray->data->card->winner_team,
                                "runs_rate" => $RunRate,
                                "status" => "started"
                            );
                            $ArrayMatchListNotLoaded = $this->Cricketmodel_model->UpdateLiveMatchData($ArrayOfMatchUpdateList, $UniqueKeyOfMatch);
                        }
                        if ($LiveMatchArray->data->card->winner_team != "") {
                            $StatusArray = array("status" => "completed");
                            ;
                            $this->Cricketmodel_model->UpdateLiveMatchData($StatusArray, $UniqueKeyOfMatch);
                        }
                    } //end of toss if 
                    //echo "<pre>";
                    if (count((array) $LiveMatchArray->data->card->innings) > 0) {
                        foreach ($LiveMatchArray->data->card->innings as $key => $summary) {
                            $BattingKeyId = $summary->key;
                            
                                
                            foreach ($summary->batting_order as $key => $PlayerKey) {
                                $CheckedMatchPlayer = $this->Cricketmodel_model->getCheckUniqueMatchPlyerPresent($MatchUniqueId, $BattingKeyId, $PlayerKey);
                                if ($CheckedMatchPlayer == 0) {
                                    $ArrayOfPlayerSummaryList = array(
                                        "match_id" => $MatchUniqueId,
                                        "Innings_code" => $BattingKeyId,
                                        "player_key" => $PlayerKey
                                    );
                                    $this->Cricketmodel_model->MatchPlayerSummaryInsert($ArrayOfPlayerSummaryList);
                                } else {
                                    //$LiveMatchArray->data->card->players->a_rahane
                                    $PlayerArrayLists = $this->Cricketmodel_model->GetSelectPlayerAllKeyData($MatchUniqueId, $BattingKeyId);
                                    foreach ($PlayerArrayLists as $key => $AllPlayerKey) {
                                        $PlayerKey = $AllPlayerKey->player_key;
                                        $PlayerDetails = $LiveMatchArray->data->card->players->$PlayerKey;
                                        //print_r($PlayerDetails->fullname);
                                        if (count($PlayerDetails->match->innings) > 0) {
                                            foreach ($PlayerDetails->match->innings as $key => $PlayerBatttingArray) {
                                                if (count((array) $PlayerBatttingArray->batting) > 0) {
                                                    $PlayerPlayedBallCount = $PlayerBatttingArray->batting->balls;
                                                    $PlayerRunsCount = $PlayerBatttingArray->batting->runs;
                                                    $PlayerStrikeRate = $PlayerBatttingArray->batting->strike_rate;
                                                    $PlayerDismissed = (isset($PlayerBatttingArray->batting->dismissed)) ? $PlayerBatttingArray->batting->dismissed : "0";
                                                    $PlayerTeamRun = "";
                                                    $PlayerTeamOver = "";
                                                    $PlayerTeamBall = "";
                                                    $PlayerTeamWicketIndex = "";
                                                    $PlayerTeamWicketType = "";
                                                    if ($PlayerDismissed == 1) {
                                                        $PlayerTeamRun = $PlayerBatttingArray->batting->dismissed_at->team_runs;
                                                        $PlayerTeamOver = $PlayerBatttingArray->batting->dismissed_at->over;
                                                        $PlayerTeamBall = $PlayerBatttingArray->batting->dismissed_at->ball;
                                                        $PlayerTeamWicketIndex = $PlayerBatttingArray->batting->dismissed_at->wicket_index;
                                                        $PlayerTeamWicketType = $PlayerBatttingArray->batting->ball_of_dismissed->wicket_type;
                                                    }
                                                    $PlayerDetailArrayData = array(
                                                        "player_name" => $PlayerDetails->fullname,
                                                        "player_runs" => $PlayerRunsCount,
                                                        "player_balls" => $PlayerPlayedBallCount,
                                                        "player_strike_rate" => $PlayerStrikeRate,
                                                        "player_dismissed" => $PlayerDismissed,
                                                        "team_runs" => $PlayerTeamRun,
                                                        "team_over" => $PlayerTeamOver,
                                                        "team_over_ball" => $PlayerTeamBall,
                                                        "player_wicket_index" => $PlayerTeamWicketIndex,
                                                        "wicket_type" => $PlayerTeamWicketType,
                                                        "player_count" => $key + 1
                                                    );
                                                    //$BattingKeyId//$MatchUniqueId
                                                    $this->Cricketmodel_model->UpdatePlayerAllData($PlayerDetailArrayData, $MatchUniqueId, $BattingKeyId, $PlayerKey);
                                                } // checked batting array blank or not
                                            } // player detail data foreach
                                        } // checked inning data available or not
                                    }
                                } // end of player data else
                                //$LiveMatchArray->data->card->players;
                            }  // batting order foreach
                            foreach ($summary->fall_of_wickets as $key => $FallWicket) {
                                $WicketDownPlayerName = explode("at", $FallWicket);
                                preg_match_all('!\d+\.*\d*!', $FallWicket, $dataWicketArray);
                                //echo $WicketDownPlayerName[0]." ".$dataWicketArray[0][0]."<br>";
                                //$Wicket
                                $CheckedMatchWicket = $this->Cricketmodel_model->getCheckUniqueMatchWicketPresent($MatchUniqueId, $BattingKeyId, $dataWicketArray[0][0]);
                                if ($CheckedMatchWicket == 0) {
                                    $ArrayOfWicketSummaryList = array(
                                        "match_id" => $MatchUniqueId,
                                        "Innings_code" => $BattingKeyId,
                                        "wicket_player_name" => $WicketDownPlayerName[0],
                                        "wicket_out_total_run" => $dataWicketArray[0][0],
                                        "wicket_out_total_over" => $dataWicketArray[0][1],
                                        "wicket_summary" => $FallWicket,
                                        "wicket_count" => $key + 1
                                    );
                                    $this->Cricketmodel_model->MatchWicketSummaryInsert($ArrayOfWicketSummaryList);
                                }
                                // print_r($dataWicketArray);
                            } // end of fall wicket foreach
                            
                            
                            foreach ($LiveMatchArray->data->card->now->recent_overs as $key => $valueOfRecentOver) {
                                
                                
                                if($valueOfRecentOver[0] == 1 && $LiveMatchArray->data->card->now->batting_team."_1" == $BattingKeyId)
                                {
                                    $OverBallKeyValue = $valueOfRecentOver[1][0]; // get over key
                                    $FirstBallCheck = $LiveMatchArray->data->card->balls->$OverBallKeyValue;
                                    $CheckedMatchBallByBall = $this->Cricketmodel_model->getCheckUniqueMatchBallByBallPresent($UniqueKeyOfMatch, $MatchUniqueId, $BattingKeyId);
                                    if ($CheckedMatchBallByBall == 0) {
                                        $BallByBallArrayValues = array(
                                            "ball_comment" => $FirstBallCheck->comment,
                                            "ball_batting_team" => $FirstBallCheck->batting_team,
                                            "ball_over_str" => $FirstBallCheck->over_str,
                                            "ball_dotball" => $FirstBallCheck->batsman->dotball,
                                            "ball_runs" => $FirstBallCheck->runs,
                                            "ball_wicket" => $FirstBallCheck->wicket,
                                            "ball_type" => $FirstBallCheck->ball_type,
                                            "ball_wicket_type" => $FirstBallCheck->wicket_type,
                                            "unique_key" => $UniqueKeyOfMatch,
                                            "Innings_code" => $BattingKeyId,
                                            "match_id" => $MatchUniqueId
                                        );
                                        $this->Cricketmodel_model->MatchFirstBallSummaryInsert($BallByBallArrayValues);
                                        
                                        
                                    }
                                    
                                }
                                
                                
                            } // end of recent over logic
                            
                            $this->CronGameClosedAutomated($MatchUniqueId , $BattingKeyId); // game closed
                            
                        }
                    }
                    $this->CronCricketMatchOverSummaryAutomated($UniqueKeyOfMatch, $MatchUniqueId); // get over summary api
                    $this->CronCricketMatchPayoutAutomated($UniqueKeyOfMatch, $MatchUniqueId); // get calculate chip and payout
                    $this->CronCricketMatchResultBetAutomated($MatchUniqueId); // get sync litz and user
                    //
                    // "<pre>";
                    //print_r($LiveMatchArray->data->card);
                    //exit;
                } // end of foreach of match key
            } // end if of match key
        } // end of if (if tocken access not available)
        else
        {
            $ArrayErrorList = array(
                
                        "desc" => "Access Tocken not working ",
                        "function" => "CronLiveMatchDataAutomated()"
             );
            
            $this->Cricketmodel_model->MatchErrorInsert($ArrayErrorList);
        }
        
    }
// end of function
    
    function CronGameClosedAutomated($MatchUniqueId , $BattingKeyId)
    {
        //$MatchUniqueId = 41;
        //$BattingKeyId = "a_1";
        $GetOverDataForGameClosedList = $this->Cricketmodel_model->getMatchOverSummaryPresent($MatchUniqueId , $BattingKeyId);
        
        if(count($GetOverDataForGameClosedList) > 0)
        {
            foreach ($GetOverDataForGameClosedList as $key => $value) {
                
                //echo $value->over."<br>";
                if($value->over == 7)
                { 
                    $MId = ($BattingKeyId == 'a_1')?array(7):array(8);
                   
                    $TestResult = $this->Cricketmodel_model->GetUpdateClosedScheduleGame($MatchUniqueId , $MId);
        
                    //print_r($TestResult); exit;
                }
                
            }
            
        }
        
    }  // end of game closed function
    
    
    //over summary data automation
    
    function CronCricketMatchOverSummaryAutomated($UniqueKeyOfMatch, $MatchUniqueId)
    {
        
        //$UniqueKeyOfMatch, $MatchUniqueId
        //$UniqueKeyOfMatch = "asiacup_2016_final";
        //$MatchUniqueId = 50;
        $TokenAccess = $this->GetApiAuthentication();

        if($TokenAccess != "")
        {
            $CommonAuthUrl = "https://rest.cricketapi.com/rest/v2/";            
            $url = $CommonAuthUrl."match/".$UniqueKeyOfMatch."/overs_summary/?access_token=" . $TokenAccess;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_ENCODING , "gzip");
            $output = curl_exec($ch);
            $OverSummaryArray = json_decode($output);
            curl_close($ch);
            
            $ArrayOfMatchList = array();
           
            //print_r($OverSummaryArray->data->innings);
            if(count( $OverSummaryArray->data->innings ) > 0 )
            {
                foreach ($OverSummaryArray->data->innings as $key => $summary) {

                    $BattingKeyId = $summary->key;

                   foreach ($summary->overs_summary as $key => $PerOver) {
                    //match
                        //print_r($PerOver->over);
                        //$PerOver->match->score
                        //$PerOver->match->current_run_rate//runs

                        $CheckedMatchSummaryOver = $this->Cricketmodel_model->getCheckUniqueMatchOverSummaryPresent($MatchUniqueId, $BattingKeyId, $PerOver->over);

                        if($CheckedMatchSummaryOver == 0) {

                                    $ScoreExplode = explode("in", $PerOver->match->score);
                                    $RunsWicket = explode("/", $ScoreExplode[0]);
                                    $WicketKeyImp = "";

    //                                if (count($PerOver->wickets) > 0) {
    //                                    $WicketKeyImp = implode(",", $PerOver->wickets);
    //                                }

                                    $ArrayOfOverSummaryList = array(
                                        "score" => $PerOver->match->score,
                                        "match_id" => $MatchUniqueId,
                                        "Innings_code" => $BattingKeyId,
                                        "over" => $PerOver->over,
                                        "current_run_rate" => $PerOver->match->current_run_rate,
                                        "total_run" => $RunsWicket[0],  
                                        "over_run" => $PerOver->runs,
                                        "wicket" => $RunsWicket[1],
                                        "wicket_key" => $WicketKeyImp,
                                        "summary_count" => $key + 1
                                    );

                                    $this->Cricketmodel_model->MatchOverSummaryInsert($ArrayOfOverSummaryList);
                        }
                    } // end of over summary


                }

            }
        }
           
    }
    
    
    // one day call to this function 
    function CronDataAutomated() {
        $TokenAccess = $this->GetApiAuthentication();
        if($TokenAccess != "")
        {
            $CommonAuthUrl = "https://rest.cricketapi.com/rest/v2/";            
            $url = $CommonAuthUrl."schedule/?access_token=" . $TokenAccess;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_ENCODING , "gzip");
            $output = curl_exec($ch);
            $asd = json_decode($output);
            curl_close($ch);
            $matches = $asd->data->months[0]->days;
            $ArrayOfMatchList = array();
            
            //echo "In Auto<pre>";
            //print_r($asd);
            //echo "asd";
            
            //print_r($matches);
            //exit;
            foreach ($matches as $value) {
                $MatchData = array_filter($value->matches);
                if (!empty($MatchData)) {
                    foreach ($MatchData as $v) {
                        //echo $i++.$v->name." ".$v->status." ".$v->key."<br>";t20//one-day
                        if ($v->format == "t20" || $v->format == "one-day") {
                            $CheckedMatchKey = $this->Cricketmodel_model->getCheckUniqueMatchIdPresent($v->key);
                            if ($CheckedMatchKey == 0) { // 0 will insert into database as new match from server
                                $ArrayOfMatchList[] = array("name" => $v->name, "status" => $v->status
                                    , "unique" => $v->key, "format" => $v->format, "venue" => $v->venue
                                    , "start_date" => $v->start_date->iso, "team_a" => $v->teams->a->name
                                    , "team_b" => $v->teams->b->name
                                    , "winner_team" => $v->winner_team, "match_load" => 0
                                );
                            }
                            else
                            {
                                $ArrayOfMatchUpdateLits = array(
                                    
                                                            "name" => $v->name
                                                            , "venue" => $v->venue
                                                            , "start_date" => $v->start_date->iso
                                                            , "team_a" => $v->teams->a->name
                                                            , "team_b" => $v->teams->b->name
                                   
                                                            );
                                
                                $this->Cricketmodel_model->MatchUpdateIfChanges($ArrayOfMatchUpdateLits , $v->key);
                                
                                
                                
                            }    
                        }
                    }
                }
            } // end of foreach
            //exit;
            $this->Cricketmodel_model->MatchListInsert($ArrayOfMatchList);
            $ArrayMatchListNotLoaded = $this->Cricketmodel_model->GetMatchNotLoaded();
            if (count($ArrayMatchListNotLoaded) > 0) {
                foreach ($ArrayMatchListNotLoaded as $key => $value) {
                    // Check if match id already exist then not insert data
                    $CheckedMatchKeyInOddScheduleValue = $this->Cricketmodel_model->getCheckUniqueMatchIdPresentInOddsscheduleTable($value->id);
                    if ($CheckedMatchKeyInOddScheduleValue == 0) { // 0 will insert int odatabase as new match from server
                        $GetConfigOddDataArray = $this->Cricketmodel_model->GetConfigOddMasterData();
                        foreach ($GetConfigOddDataArray as $key => $v) {
                            $ScheduleArrayDataValue = array("match_id" => $value->id, "odd_id" => $v->odd_id, "odds" => $v->odds_master, "m_id" => $v->m_id);
                            $this->Cricketmodel_model->MatchBetSheduleDataInsert($ScheduleArrayDataValue);
                        }
                    }
                    // update match list table match_load column
                    $this->Cricketmodel_model->SetMatchLoadUpdate($value->id);
                } // end of match loaded count loop
            } // end of match loaded count if
            //echo "Done All";
        }
        else
        {
            $ArrayErrorList = array(
                
                        "desc" => "Access Tocken not working CronDataAutomated function ",
                        "function" => "CronDataAutomated()"
             );
            
            $this->Cricketmodel_model->MatchErrorInsert($ArrayErrorList);
        }
        
        
    }
// end of function
    function GetAllMatchList() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        //$MatchUniqueKey = $data['key'];
        $AllMAtchLists = $this->Cricketmodel_model->getMatchList();
        echo json_encode($AllMAtchLists);
    }
    // specific match toss data to backend
    function GetTossGameData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllRowMatchTossArrayData = $this->Cricketmodel_model->GetTossGameDetails($MatchId);
        echo json_encode($AllRowMatchTossArrayData);
    }
    // specific match to first ball details
    function GetFirstBallData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchFirstzBallArrayData = $this->Cricketmodel_model->GetFirstBallGameDetails($MatchId);
        echo json_encode($AllMatchFirstzBallArrayData);
    }
    // specific match to first over details
    function GetFirstOverData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchFirstOverArrayData = $this->Cricketmodel_model->GetFirstOverGameDetails($MatchId);
        echo json_encode($AllMatchFirstOverArrayData);
    }
    // specific match to first ten over details
    function GetFirstTenOverSessionData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchFirstTenOverDataArrayData = $this->Cricketmodel_model->GetFirstTenOverSessionGameDetails($MatchId);
        echo json_encode($AllMatchFirstTenOverDataArrayData);
    }
    // specific match to first wicket details
    function GetFirstWicketData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchFirstWicketDataArrayData = $this->Cricketmodel_model->GetFirstWicketGameDetails($MatchId);
        echo json_encode($AllMatchFirstWicketDataArrayData);
    }
    // specific match to first 30 run details
    function GetFirstThirtiesRunData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchFirstThirtiesRunArrayData = $this->Cricketmodel_model->GetFirstThirtiesRunGameDetails($MatchId);
        echo json_encode($AllMatchFirstThirtiesRunArrayData);
    }
    // specific match to first 50 run details
    function GetFirstFiftyRunData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchFirstFiftyRunArrayData = $this->Cricketmodel_model->GetFirstFiftyRunGameDetails($MatchId);
        echo json_encode($AllMatchFirstFiftyRunArrayData);
    }
    // specific match to first 100 run details
    function GetFirstHundredRunData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchFirstHundredRunArrayData = $this->Cricketmodel_model->GetFirstHundredRunGameDetails($MatchId);
        echo json_encode($AllMatchFirstHundredRunArrayData);
    }
    // specific match to first run rate details
    function GetFirstRunRateData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchFirstRunRateArrayData = $this->Cricketmodel_model->GetFirstRunRateGameDetails($MatchId);
        echo json_encode($AllMatchFirstRunRateArrayData);
    }
    // specific match to Win Loss details
    function GetWinLossData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchWinLossArrayData = $this->Cricketmodel_model->GetWinLossGameDetails($MatchId);
        echo json_encode($AllMatchWinLossArrayData);
    }
    // specific match to Highest Opening PartnerShip details
    function GetHighestOpeningPartnerShipData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchHighestOpeningPartnerShipArrayData = $this->Cricketmodel_model->GetHighestOpeningPartnerShipDetails($MatchId);
        echo json_encode($AllMatchHighestOpeningPartnerShipArrayData);
    }
    // specific match to Race To 50 details
    function GetRaceToFiftyData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchRaceToFiftyArrayData = $this->Cricketmodel_model->GetRaceToFiftyDetails($MatchId);
        echo json_encode($AllMatchRaceToFiftyArrayData);
    }
    // specific match to first wicket fall at run Data  details
    function GetWicketFallAtRunsGameData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $AllMatchWicketFallAtRunsArrayData = $this->Cricketmodel_model->GetFirstWicketFallAtRunsGameDetails($MatchId);
        echo json_encode($AllMatchWicketFallAtRunsArrayData);
    }
    // Odds Change from backend
    function SetChangeOddsCommonData() {
        // print_R( $_POST['OddsKey']);
        //exit;
        $MatchIdReturn = '';
        foreach ($_POST['OddsKey'] as $key => $value) {
            $GameTypeFlag = $value['GameTypeFlag'];
            $OddsValue = $value['OddsValue'];
            $OddsId = $value['OddsId'];
            $OddsIdArray = explode("_", $OddsId);
            $MatchId = $OddsIdArray[1];
            $MasterOddId = $OddsIdArray[2];
            $ScheduleId = $OddsIdArray[3];
            $MatchIdReturn = $MatchId;
            $MasterUpdateArray = array(
                "odds_master" => $OddsValue
            );
            $ScheduleUpdateArray = array(
                "odds" => $OddsValue
            );
            //echo $OddsIdArray[0]." ".$OddsIdArray[1]."<br>";
            if ($GameTypeFlag == 1) {
                $this->Cricketmodel_model->SetUpdateMasterOddsData($MasterOddId, $MasterUpdateArray, $ScheduleUpdateArray);
            }
            $this->Cricketmodel_model->SetUpdateScheduleOddsData($ScheduleId, $ScheduleUpdateArray);
        }
        // select mmatch format
        $MatchFormat = $this->Cricketmodel_model->getMatchFormatData($MatchIdReturn);
        $MatchArray = array(
            "MatchId" => $MatchIdReturn,
            "MatchFormat" => $MatchFormat
        );
        echo json_encode($MatchArray);
    }
    /*  swapnil data // start//   */
    function GetWinLossPayout($MatchId) {
        $AllMatchWinLossArrayData = $this->Cricketmodel_model->GetWinLossGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        $i = 1;
        foreach ($AllMatchWinLossArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchWinLossArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    function GetFirstBallPayout($MatchId) {
        $AllMatchFirstzBallArrayData = $this->Cricketmodel_model->GetFirstBallGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchFirstzBallArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchFirstzBallArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    // specific match to first over details
    function GetFirstOverPayout($MatchId) {
        $AllMatchFirstOverArrayData = $this->Cricketmodel_model->GetFirstOverGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchFirstOverArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchFirstOverArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    function GetFirstTenOverSessionPayout($MatchId) {
        $AllMatchFirstTenOverDataArrayData = $this->Cricketmodel_model->GetFirstTenOverSessionGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchFirstTenOverDataArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchFirstTenOverDataArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    function GetFirstWicketPayout($MatchId) {
        $AllMatchFirstWicketDataArrayData = $this->Cricketmodel_model->GetFirstWicketGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchFirstWicketDataArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchFirstWicketDataArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    function GetFirstThirtiesRunPayout($MatchId) {
        $AllMatchFirstThirtiesRunArrayData = $this->Cricketmodel_model->GetFirstThirtiesRunGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchFirstThirtiesRunArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchFirstThirtiesRunArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    function GetFirstHundredRunPayout($MatchId) {
        $AllMatchFirstHundredRunArrayData = $this->Cricketmodel_model->GetFirstHundredRunGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchFirstHundredRunArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchFirstHundredRunArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    function GetFirstFiftyRunPayout($MatchId) {
        $AllMatchFirstFiftyRunArrayData = $this->Cricketmodel_model->GetFirstFiftyRunGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchFirstFiftyRunArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchFirstFiftyRunArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    function GetFirstRunRatePayout($MatchId) {
        $AllMatchFirstRunRateArrayData = $this->Cricketmodel_model->GetFirstRunRateGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchFirstRunRateArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchFirstRunRateArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    function GetHighestOpeningPartnerShipPayout($MatchId) {
        $AllMatchHighestOpeningPartnerShipArrayData = $this->Cricketmodel_model->GetHighestOpeningPartnerShipDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchHighestOpeningPartnerShipArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchHighestOpeningPartnerShipArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    // specific match to Race To 50 details
    function GetRaceToFiftyPayout($MatchId) {
        $AllMatchRaceToFiftyArrayData = $this->Cricketmodel_model->GetRaceToFiftyDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchRaceToFiftyArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchRaceToFiftyArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    // specific match to first wicket fall at run Data  details
    function GetWicketFallAtRunsGamePayout($MatchId) {
        $AllMatchWicketFallAtRunsArrayData = $this->Cricketmodel_model->GetFirstWicketFallAtRunsGameDetails($MatchId);
        $TotalBet = 0;
        $totalPayout = 0;
        foreach ($AllMatchWicketFallAtRunsArrayData as $row):
            $TotalBet = 0;
            $totalPayout = 0;
            $TotalBet = $this->Cricketmodel_model->GetGameDetailsTotalBet($MatchId, $row['odd_id']);
            $totalPayout = $TotalBet[0]['total_bet'] * $AllMatchWicketFallAtRunsArrayData[0]['odds'];
            if ($TotalBet[0]['total_bet'] > 0) {
                $where = array('match_id' => $MatchId, 'odd_id' => $row['odd_id']);
                $data_update = array("total_chips" => $TotalBet[0]['total_bet'], "payout" => $totalPayout);
                $this->Cricketmodel_model->update_bet_and_payout('cric_matchbet_schedule', $where, $data_update);
            }
        endforeach;
    }
    /* all paypout functions are set to one cron */
    // Live Match Data From  
    function CronCricketMatchPayoutAutomated($MatchKey, $MatchId) {
        //$MatchId = 41;
        $this->GetFirstTenOverSessionPayout($MatchId);
        $this->GetFirstOverPayout($MatchId);
        $this->GetFirstBallPayout($MatchId);
        $this->GetWinLossPayout($MatchId);
        $this->GetFirstWicketPayout($MatchId);
        $this->GetFirstThirtiesRunPayout($MatchId);
        $this->GetFirstHundredRunPayout($MatchId);
        $this->GetFirstFiftyRunPayout($MatchId);
        $this->GetFirstRunRatePayout($MatchId);
        $this->GetHighestOpeningPartnerShipPayout($MatchId);
        $this->GetRaceToFiftyPayout($MatchId);
        $this->GetWicketFallAtRunsGamePayout($MatchId);
    }
    /*  swapnil data // End//   */
    
    
    // Match details batsman data to backend
    function GetAllBatsmanData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $allBatsmanDataArray = $this->Cricketmodel_model->GetAllBatsmanDataDetails($MatchId);
        echo json_encode($allBatsmanDataArray);
    }
    
    // Match details batsman out at run data to backend
    function GetAllBatsmanOutAtRunData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $allBatsmanOutAtRunDataArray = $this->Cricketmodel_model->GetAllBatsmanOutAtRunDataDetails($MatchId);
        echo json_encode($allBatsmanOutAtRunDataArray);
    }
    
    // Match details batsman out at run team b data to backend
    function GetAllBatsmanOutAtRunOFTeamBData() {
        $data = array(
            'key' => $this->input->post('key'),
        );
        $MatchId = $data['key'];
        $allBatsmanOutAtRunDataArray = $this->Cricketmodel_model->GetAllBatsmanOutAtRunOFTeamBDataDetails($MatchId);
        echo json_encode($allBatsmanOutAtRunDataArray);
    }
    
    
    
    
    
	function GetWinLossResultBet($MatchId){
        $AllMatchWinLossArrayData = $this->Cricketmodel_model->GetWinLossGameMatchResult($MatchId);
		
		if(!empty($AllMatchWinLossArrayData)){	
			foreach($AllMatchWinLossArrayData as $row):	
				$AllMatchWinLossSchduledData = $this->Cricketmodel_model->GetWinLossGameDetails($MatchId);
				
				if(!empty($AllMatchWinLossSchduledData)){
					foreach($AllMatchWinLossSchduledData as $sch):
					
						if($row['winner_team'] == 'a' && $sch['odd_id'] == '1'){
							$where = array('match_id' => $MatchId, "m_id" => '1', "odd_id" => '1',"game_close" => '1');
							$data = array('result_bet' => 'win');
							$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
						}
						elseif($row['winner_team'] != 'a' && $sch['odd_id'] == '2'){
							$where = array('match_id' => $MatchId, "m_id" => '1', "odd_id" => '1',"game_close" => '1');
							$data = array('result_bet' => 'loss');
							$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
						}
						if($row['winner_team'] == 'b' && $sch['odd_id'] == '2'){
							$where = array('match_id' => $MatchId, "m_id" => '1', "odd_id" => '2',"game_close" => '1');
							$data = array('result_bet' => 'win');
							$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
						}
						elseif($row['winner_team'] != 'b' && $sch['odd_id'] == '2'){
							$where = array('match_id' => $MatchId, "m_id" => '1', "odd_id" => '2',"game_close" => '1');
							$data = array('result_bet' => 'loss');
							$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
						}
					endforeach;
				}
			endforeach;
		}
	}
	
	function GetTossWinLossResultBet($MatchId){
        $AllMatchTossWinLossArrayData = $this->Cricketmodel_model->GetTossWinLossGameMatchResult($MatchId);
		
		if(!empty($AllMatchTossWinLossArrayData)){	
			foreach($AllMatchTossWinLossArrayData as $row):	
				$AllMatchTossWinLossSchduledData = $this->Cricketmodel_model->GetTossWinLossGameDetails($MatchId);
				//print_r($AllMatchTossWinLossSchduledData);
				if(!empty($AllMatchTossWinLossSchduledData)){
					foreach($AllMatchTossWinLossSchduledData as $sch):
					//	echo $sch['odd_id'];
						if($row['toss_win'] == 'a' && $sch['odd_id'] == '3'){
							$where = array('match_id' => $MatchId, "m_id" => '2', "odd_id" => '3',"game_close" => '1');
							$data = array('result_bet' => 'win');
							$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
						}
						elseif($row['toss_win'] != 'a' && $sch['odd_id'] == '3'){
							$where = array('match_id' => $MatchId, "m_id" => '2', "odd_id" => '3',"game_close" => '1');
							$data = array('result_bet' => 'loss');
							$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
						}
						if($row['toss_win'] == 'b' && $sch['odd_id'] == '4'){
							$where = array('match_id' => $MatchId, "m_id" => '2', "odd_id" => '4',"game_close" => '1');
							$data = array('result_bet' => 'win');
							$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
						}
						elseif($row['toss_win'] != 'b' && $sch['odd_id'] == '4'){
							$where = array('match_id' => $MatchId, "m_id" => '2', "odd_id" => '4',"game_close" => '1');
							$data = array('result_bet' => 'loss');
							$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
						}
					endforeach;
				}
			endforeach;
		}
	}
	
	
	function GetFirstOverResultBet($MatchId){
        $AllMatchFirstOverArrayData = $this->Cricketmodel_model->GetFirstOverGameMatchResult($MatchId,"a_1");
				if(!empty($AllMatchFirstOverArrayData)){	
					foreach($AllMatchFirstOverArrayData as $row):	
					    $AllMatchFirstOverSchduledData = $this->Cricketmodel_model->GetFirstOverGameTeam1Details($MatchId);
						
						if(!empty($AllMatchFirstOverSchduledData)){
							foreach($AllMatchFirstOverSchduledData as $sch):	
							//echo $row['team_runs'];
							//echo $sch['perticular_val'];
							
							$explode = explode(',',$sch['perticular_val']);		
							$range = range($explode[0],$explode[1]);
							//print_r($range);
							if(true  == in_array($row['total_run'], $range)){	
							
								$where = array('match_id' => $MatchId, "m_id" => '5', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
								$where = array('match_id' => $MatchId, "m_id" => '5', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
		
		$AllMatchFirstOverTeam2ArrayData = $this->Cricketmodel_model->GetFirstOverGameMatchResult($MatchId,"b_1");
				if(!empty($AllMatchFirstOverTeam2ArrayData)){	
					foreach($AllMatchFirstOverTeam2ArrayData as $row):	
					    $AllMatchFirstOverTeam2SchduledData = $this->Cricketmodel_model->GetFirstOverGameTeam2Details($MatchId);
						
						if(!empty($AllMatchFirstOverTeam2SchduledData)){
							foreach($AllMatchFirstOverTeam2SchduledData as $sch):	
							//echo $row['team_runs'];
							//echo "<br/>";
						//	echo $sch['perticular_val'];
							$explode = explode(',',$sch['perticular_val']);		
							
							$range = range($explode[0],$explode[1]);
//							echo $row['team_runs'];
							if(true  == in_array($row['total_run'], $range)){	
	
							//echo "Win";
								$where = array('match_id' => $MatchId, "m_id" => '6', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
							//echo "Loss";							
								$where = array('match_id' => $MatchId, "m_id" => '6', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
		
		
	}
	
	function GetFirstTenOverSessionResultBet($MatchId){
		$AllMatchFirstOverArrayData = $this->Cricketmodel_model->GetFirstTenOverGameMatchResult($MatchId,"a_1");
				if(!empty($AllMatchFirstOverArrayData)){	
					foreach($AllMatchFirstOverArrayData as $row):	
					    $AllMatchFirstOverSchduledData = $this->Cricketmodel_model->GetFirstTenOverGameTeam1Details($MatchId);
						
						if(!empty($AllMatchFirstOverSchduledData)){
							foreach($AllMatchFirstOverSchduledData as $sch):	
							//echo $row['team_runs'];
							//echo $sch['perticular_val'];
							
							$explode = explode(',',$sch['perticular_val']);		
							$range = range($explode[0],$explode[1]);
							//print_r($range);
							if(true  == in_array($row['total_run'], $range)){	
							
								$where = array('match_id' => $MatchId, "m_id" => '7', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
								$where = array('match_id' => $MatchId, "m_id" => '7', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
		
		$AllMatchFirstOverTeam2ArrayData = $this->Cricketmodel_model->GetFirstTenOverGameMatchResult($MatchId,"b_1");
				if(!empty($AllMatchFirstOverTeam2ArrayData)){	
					foreach($AllMatchFirstOverTeam2ArrayData as $row):	
					    $AllMatchFirstOverTeam2SchduledData = $this->Cricketmodel_model->GetFirstTenOverGameTeam2Details($MatchId);
						
						if(!empty($AllMatchFirstOverTeam2SchduledData)){
							foreach($AllMatchFirstOverTeam2SchduledData as $sch):	
							//echo $row['team_runs'];
							//echo "<br/>";
						//	echo $sch['perticular_val'];
							$explode = explode(',',$sch['perticular_val']);		
							
							$range = range($explode[0],$explode[1]);
//							echo $row['team_runs'];
							if(true  == in_array($row['total_run'], $range)){	
	
							//echo "Win";
								$where = array('match_id' => $MatchId, "m_id" => '8', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
							//echo "Loss";							
								$where = array('match_id' => $MatchId, "m_id" => '8', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
		
	}
	
	
	function GetFirstWicketResultBet($MatchId){
		$FirstWicketTeam1ArrayData = $this->Cricketmodel_model->GetFirstWicketGameMatchResult($MatchId,"a_1");
				if(!empty($FirstWicketTeam1ArrayData)){	
					foreach($FirstWicketTeam1ArrayData as $row):	
					    $FirstWicketOverSchduledData = $this->Cricketmodel_model->GetFirstWicketTeam1Details($MatchId);
						
						if(!empty($FirstWicketOverSchduledData)){
							foreach($FirstWicketOverSchduledData as $sch):	
							//echo $row['team_runs'];
							//echo $sch['perticular_val'];
							
							if($row['wicket_type'] == $sch['perticular_val']){
								$where = array('match_id' => $MatchId, "m_id" => '9', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
								$where = array('match_id' => $MatchId, "m_id" => '9', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
		
		$FirstWicketTeam2ArrayData = $this->Cricketmodel_model->GetFirstWicketGameMatchResult($MatchId,"b_1");
				if(!empty($FirstWicketTeam2ArrayData)){	
					foreach($FirstWicketTeam2ArrayData as $row):	
					    $FirstWicketTeam2SchduledData = $this->Cricketmodel_model->GetFirstWicketTeam2Details($MatchId);
						
						if(!empty($FirstWicketTeam2SchduledData)){
							foreach($FirstWicketTeam2SchduledData as $sch):	
							//echo $row['team_runs'];
							//echo "<br/>";
						//	echo $sch['perticular_val'];
//							echo $row['team_runs'];
							if($row['wicket_type'] == $sch['perticular_val']){	
	
							//echo "Win";
								$where = array('match_id' => $MatchId, "m_id" => '10', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
							//echo "Loss";							
								$where = array('match_id' => $MatchId, "m_id" => '10', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
		
	}
	
	function GetFirstThirtiesRunResultBet($MatchId){
		$FirstThirtiesTeam1ArrayData = $this->Cricketmodel_model->GetToMake30MatchResult($MatchId,"a_1");
				if(!empty($FirstThirtiesTeam1ArrayData)){	
					foreach($FirstThirtiesTeam1ArrayData as $row):	
					    $FirstWicketOverSchduledData = $this->Cricketmodel_model->GetToMake30Team1Details($MatchId);
						
						if(!empty($FirstWicketOverSchduledData)){
							foreach($FirstWicketOverSchduledData as $sch):	
							//echo $row['team_runs'];
							//echo $sch['perticular_val'];
							
							if(count($row['player_runs']) == $sch['perticular_val']){
								$where = array('match_id' => $MatchId, "m_id" => '15', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
								$where = array('match_id' => $MatchId, "m_id" => '15', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
				else{
								$where = array('match_id' => $MatchId, "m_id" => '16', "odd_id" => 187, "game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
				}
		
		$FirstThirtiesTeam2ArrayData = $this->Cricketmodel_model->GetToMake30MatchResult($MatchId,"b_1");
				if(!empty($FirstThirtiesTeam2ArrayData)){	
					foreach($FirstThirtiesTeam2ArrayData as $row):	
					    $FirstWicketTeam2SchduledData = $this->Cricketmodel_model->GetToMake30Team2Details($MatchId);
						
						if(!empty($FirstWicketTeam2SchduledData)){
							foreach($FirstWicketTeam2SchduledData as $sch):	
							if(count($row['player_runs']) == $sch['perticular_val']){
	
							//echo "Win";
								$where = array('match_id' => $MatchId, "m_id" => '16', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
							//echo "Loss";							
								$where = array('match_id' => $MatchId, "m_id" => '16', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						else{
								
						
						}
						
					endforeach;
				}
				else{
								$where = array('match_id' => $MatchId, "m_id" => '16', "odd_id" => 237,"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
				}
	}
	
	function GetFirstFiftyRunResultBet($MatchId){
		$FirstThirtiesTeam1ArrayData = $this->Cricketmodel_model->GetToMake50MatchResult($MatchId,"a_1");
				if(!empty($FirstThirtiesTeam1ArrayData)){	
					foreach($FirstThirtiesTeam1ArrayData as $row):	
					    $FirstWicketOverSchduledData = $this->Cricketmodel_model->GetToMake50Team1Details($MatchId);
						
						if(!empty($FirstWicketOverSchduledData)){
							foreach($FirstWicketOverSchduledData as $sch):	
							//echo $row['team_runs'];
							//echo $sch['perticular_val'];
							
							if(count($row['player_runs']) == $sch['perticular_val']){
								$where = array('match_id' => $MatchId, "m_id" => '17', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
								$where = array('match_id' => $MatchId, "m_id" => '17', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
				else{
								$where = array('match_id' => $MatchId, "m_id" => '17', "odd_id" => 237, "game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
				}
		
		$FirstThirtiesTeam2ArrayData = $this->Cricketmodel_model->GetToMake50MatchResult($MatchId,"b_1");
				if(!empty($FirstThirtiesTeam2ArrayData)){	
					foreach($FirstThirtiesTeam2ArrayData as $row):	
					    $FirstWicketTeam2SchduledData = $this->Cricketmodel_model->GetToMake50Team2Details($MatchId);
						
						if(!empty($FirstWicketTeam2SchduledData)){
							foreach($FirstWicketTeam2SchduledData as $sch):	
							if(count($row['player_runs']) == $sch['perticular_val']){
	
							//echo "Win";
								$where = array('match_id' => $MatchId, "m_id" => '18', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
							//echo "Loss";							
								$where = array('match_id' => $MatchId, "m_id" => '18', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						else{
								
						
						}
						
					endforeach;
				}
				else{
								$where = array('match_id' => $MatchId, "m_id" => '18', "odd_id" => 238, "game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
				}
	}
	function GetFirstHundredRunResultBet($MatchId){
			$FirstHundredTeam1ArrayData = $this->Cricketmodel_model->GetInnRunRateMatchResult($MatchId,"a_1");
				if(!empty($FirstHundredTeam1ArrayData)){	
					foreach($FirstHundredTeam1ArrayData as $row):	
					    $FirstWicketOverSchduledData = $this->Cricketmodel_model->GetInnRunRateTeam1Details($MatchId);
						
						if(!empty($FirstWicketOverSchduledData)){
							foreach($FirstWicketOverSchduledData as $sch):	
							//echo $row['team_runs'];
							//echo $sch['perticular_val'];
							
							if(count($row['current_run_rate']) == $sch['perticular_val']){
								$where = array('match_id' => $MatchId, "m_id" => '21', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
								$where = array('match_id' => $MatchId, "m_id" => '21', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
				else{
								$where = array('match_id' => $MatchId, "m_id" => '21', "odd_id" => 239, "game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
				}
		
		$FirstInnRateTeam2ArrayData = $this->Cricketmodel_model->GetInnRunRateMatchResult($MatchId,"b_1");
				if(!empty($FirstInnRateTeam2ArrayData)){	
					foreach($FirstInnRateTeam2ArrayData as $row):	
					    $FirstWicketTeam2SchduledData = $this->Cricketmodel_model->GetInnRunRateTeam2Details($MatchId);
						
						if(!empty($FirstWicketTeam2SchduledData)){
							foreach($FirstWicketTeam2SchduledData as $sch):	
							if(count($row['player_runs']) == $sch['perticular_val']){
	
							//echo "Win";
								$where = array('match_id' => $MatchId, "m_id" => '22', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
							//echo "Loss";							
								$where = array('match_id' => $MatchId, "m_id" => '22', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						else{
								
						
						}
						
					endforeach;
				}
				else{
								$where = array('match_id' => $MatchId, "m_id" => '22', "odd_id" => 240, "game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
				}
		
	}
	function GetFirstRunRateResultBet($MatchId){
			$FirstHundredTeam1ArrayData = $this->Cricketmodel_model->GetInnRunRateMatchResult($MatchId,"a_1");
				if(!empty($FirstHundredTeam1ArrayData)){	
					foreach($FirstHundredTeam1ArrayData as $row):	
					    $FirstWicketOverSchduledData = $this->Cricketmodel_model->GetInnRunRateTeam1Details($MatchId);
						
						if(!empty($FirstWicketOverSchduledData)){
							foreach($FirstWicketOverSchduledData as $sch):	
							//echo $row['team_runs'];
							//echo $sch['perticular_val'];
							
							//echo $sch['perticular_val'];
							$explode = explode(',',$sch['perticular_val']);		
							$range = range($explode[0],$explode[1]);
							//print_r($range);
							//die;
							if(true  == in_array($row['current_run_rate'], $range)){
								$where = array('match_id' => $MatchId, "m_id" => '21', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
								$where = array('match_id' => $MatchId, "m_id" => '21', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
				else{
								$where = array('match_id' => $MatchId, "m_id" => '21', "odd_id" => 239, "game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
				}
		
		$FirstHundredTeam2ArrayData = $this->Cricketmodel_model->GetInnRunRateMatchResult($MatchId,"b_1");
				if(!empty($FirstHundredTeam2ArrayData)){	
					foreach($FirstHundredTeam2ArrayData as $row):	
					    $FirstWicketTeam2SchduledData = $this->Cricketmodel_model->GetInnRunRateTeam2Details($MatchId);
						
						if(!empty($FirstWicketTeam2SchduledData)){
							foreach($FirstWicketTeam2SchduledData as $sch):	
							$explode = explode(',',$sch['perticular_val']);		
							$range = range($explode[0],$explode[1]);
							//print_r($range);
							if(true  == in_array($row['current_run_rate'], $range)){	
	
							//echo "Win";
								$where = array('match_id' => $MatchId, "m_id" => '22', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
							//echo "Loss";							
								$where = array('match_id' => $MatchId, "m_id" => '22', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						else{
								
						
						}
						
					endforeach;
				}
				else{
								$where = array('match_id' => $MatchId, "m_id" => '22', "odd_id" => 240, "game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
				}
		
	}
	
	
	
	function GetHighestOpeningPartnerShipResultBet($MatchId){
		
		$FirstWicketTeam2ArrayData = $this->Cricketmodel_model->GetHIghestOpeningMatchResult($MatchId,"a_1");
				if(!empty($FirstWicketTeam2ArrayData)){	
					foreach($FirstWicketTeam2ArrayData as $row):	
					    $FirstWicketTeam2SchduledData = $this->Cricketmodel_model->GetFirstWicketTeam2Details($MatchId);
						
						if(!empty($FirstWicketTeam2SchduledData)){
							foreach($FirstWicketTeam2SchduledData as $sch):	
							//echo $row['team_runs'];
							//echo "<br/>";
						//	echo $sch['perticular_val'];
//							echo $row['team_runs'];
							if($row['wicket_type'] == $sch['perticular_val']){	
	
							//echo "Win";
								$where = array('match_id' => $MatchId, "m_id" => '10', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
							//echo "Loss";							
								$where = array('match_id' => $MatchId, "m_id" => '10', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
			
	}
	
	
	function GetFirstBallResultBet($MatchId) {
			$FirstHundredTeam1ArrayData = $this->Cricketmodel_model->GetFirstBallGameMatchResult($MatchId,"a_1");
				if(!empty($FirstHundredTeam1ArrayData)){	
					foreach($FirstHundredTeam1ArrayData as $row):	
					    $FirstWicketOverSchduledData = $this->Cricketmodel_model->GetFirstBallTeam1Details($MatchId);
						
						if(!empty($FirstWicketOverSchduledData)){
							foreach($FirstWicketOverSchduledData as $sch):	
							//echo $row['team_runs'];
							//echo $sch['perticular_val'];
							
							if($row['ball_type'] == $sch['perticular_val'] || $row['ball_runs'] == $sch['perticular_val'] || $row['ball_wicket'] == $sch['perticular_val'] ){
								$where = array('match_id' => $MatchId, "m_id" => '3', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
								$where = array('match_id' => $MatchId, "m_id" => '3', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						
					endforeach;
				}
				else{
				}
		
		$FirstInnRateTeam2ArrayData = $this->Cricketmodel_model->GetFirstBallGameMatchResult($MatchId,"b_1");
				if(!empty($FirstInnRateTeam2ArrayData)){	
					foreach($FirstInnRateTeam2ArrayData as $row):	
					    $FirstWicketTeam2SchduledData = $this->Cricketmodel_model->GetFirstBallTeam2Details($MatchId);
						
						if(!empty($FirstWicketTeam2SchduledData)){
							foreach($FirstWicketTeam2SchduledData as $sch):	
							if($row['ball_type'] == $sch['perticular_val'] || $row['ball_runs'] == $sch['perticular_val'] || $row['ball_wicket'] == $sch['perticular_val'] ){
	
							//echo "Win";
								$where = array('match_id' => $MatchId, "m_id" => '4', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'win');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							else{
							//echo "Loss";							
								$where = array('match_id' => $MatchId, "m_id" => '4', "odd_id" => $sch['odd_id'],"game_close" => '0');
								$data = array('result_bet' => 'loss');
								$this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
							}
							endforeach;
						}
						else{
								
						
						}
						
					endforeach;
				}
				else{
								
				}
	}
	
	function CronCricketMatchResultBetAutomated($MatchId) {
        //$MatchId = 41;
	$this->GetTossWinLossResultBet($MatchId);
        $this->GetFirstTenOverSessionResultBet($MatchId);
        $this->GetFirstOverResultBet($MatchId);
        $this->GetFirstBallResultBet($MatchId);
        $this->GetWinLossResultBet($MatchId);
        $this->GetFirstWicketResultBet($MatchId);
        $this->GetFirstThirtiesRunResultBet($MatchId);
        $this->GetFirstHundredRunResultBet($MatchId);
        $this->GetFirstFiftyRunResultBet($MatchId);
        $this->GetFirstRunRateResultBet($MatchId);
        $this->GetHighestOpeningPartnerShipResultBet($MatchId);
        //$this->GetRaceToFiftyResultBet($MatchId);
        $this->GetWicketFallAtRunsGameResultBet($MatchId);
    }
	
    
    
    // Match details batsman out at run team b data to backend
   
    function GetWinLoasAjaxExecute() {
        $data = array(
            'match_id' => $this->input->post('match_id'),
            'm_id' => $this->input->post('m_id'),
            'odd_id' => $this->input->post('odd_id')
        );
        $MatchId = $data['match_id'];
        $MId = $data['m_id'];
        $OddId = $data['odd_id'];
        $GameClosed = false;
                $scheduled_res = $this->Cricketmodel_model->GetMatchScheduledDetails($MatchId,$MId);
                
                  /*get payout of winner and add to their account*/
                if(!empty($scheduled_res)){
                        foreach($scheduled_res as $res):
                        
                            
                        if($res['result_bet'] == 'win'){
                                $users_bet = $this->Cricketmodel_model->GetUserBetDetails($MatchId,$OddId);
                                if(!empty($users_bet)){
                                        $present_amount=0;
                                        foreach($users_bet as $bet):
                                                $this->db->select('present_amount');
                                                $this->db->from('user_master');
                                                $this->db->where('id', $bet['user_id']);
                                                $query1 = $this->db->get()->row();
                                                $current_amount =   $query1->present_amount;
                                                $present_amount = $current_amount + $bet['payout'];
                                                $data_user = array("payout" => $present_amount);
                                                $this->Cricketmodel_model->SetUpdateMasterUserData($bet['user_id'],
$data_user);
                                                $data_user = array( "execute_flag" => '1');
                                                $this->Cricketmodel_model->SetUpdateScheduledData($MatchId,$OddId, $data_user);
                                        endforeach;
                                }
                        }
                        elseif($res['result_bet'] == 'loss'){
                                $users_bet = $this->Cricketmodel_model->GetUserBetDetails($MatchId,$OddId);
                                if(!empty($users_bet)){
                                        $present_amount=0;
                                        foreach($users_bet as $bet):
                                                $this->db->select('present_amount');
                                                $this->db->from('user_master');
                                                $this->db->where('id', $bet['user_id']);
                                                $query1 = $this->db->get()->row();
                                                $current_amount =   $query1->present_amount;
                                                $present_amount = $current_amount - $bet['payout'];
                                                $data_user = array("user_id" => $u_id, "match_id" =>
$match_id,"odd_id" => $odd_id, "payout" => $present_amount);
                                                $this->Cricketmodel_model->SetUpdateMasterUserData($bet['user_id'],
$data_user);
                                                $data_user = array( "execute_flag" => '1');
                                                $this->Cricketmodel_model->SetUpdateScheduledData(MatchId,
$OddId, $data_user);
                                        endforeach;
                                }
                        }
                        endforeach;
                }
       
        $MatchFormat = $this->Cricketmodel_model->getMatchFormatData($MatchId);
							   
	$MatchArray = array(
            "MatchId" => $MatchId,
            "MatchFormat" => $MatchFormat
        );
        echo json_encode($MatchArray);
                
    }
    
    
    
    function GetWicketFallAtRunsGameResultBet($MatchId){
                                $AllMatchFirstOverArrayData =
$this->Cricketmodel_model->GetRunsWicketMatchResult($MatchId,"a_1");
                                if(!empty($AllMatchFirstOverArrayData)){
                                        foreach($AllMatchFirstOverArrayData as $row):
                                            $AllMatchFirstOverSchduledData =
$this->Cricketmodel_model->GetRunsWicketTeam1Details($MatchId);
                                                if(!empty($AllMatchFirstOverSchduledData)){
                                                        foreach($AllMatchFirstOverSchduledData as $sch):
                                                        //echo $row['team_runs'];
                                                        //echo $sch['perticular_val'];
                                                        $explode = explode(',',$sch['perticular_val']);
                                                        $range = range($explode[0],$explode[1]);
                                                        //print_r($range);
                                                        if(true  == in_array($row['total_run'], $range)){
                                                                $where = array('match_id' => $MatchId, "m_id" => '13',
"odd_id" => $sch['odd_id'],"game_close" => '1');
                                                                $data = array('result_bet' => 'win');
                                                                $this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
                                                        }
                                                        else{
                                                                $where = array('match_id' => $MatchId, "m_id" => '13',
"odd_id" => $sch['odd_id'],"game_close" => '1');
                                                                $data = array('result_bet' => 'loss');
                                                                $this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
                                                        }
                                                        endforeach;
                                                }
                                        endforeach;
                                }
                $AllMatchFirstOverTeam2ArrayData =
$this->Cricketmodel_model->GetRunsWicketMatchResult($MatchId,"b_1");
                                if(!empty($AllMatchFirstOverTeam2ArrayData)){
                                        foreach($AllMatchFirstOverTeam2ArrayData as $row):
                                            $AllMatchFirstOverTeam2SchduledData =
$this->Cricketmodel_model->GetRunsWicketTeam2Details($MatchId);
                                                if(!empty($AllMatchFirstOverTeam2SchduledData)){
                                                        foreach($AllMatchFirstOverTeam2SchduledData as $sch):
                                                        //echo $row['team_runs'];
                                                        //echo "<br/>";
                                                //      echo $sch['perticular_val'];
                                                        $explode = explode(',',$sch['perticular_val']);
                                                        $range = range($explode[0],$explode[1]);
//                                                      echo $row['team_runs'];
                                                        if(true  == in_array($row['total_run'], $range)){
                                                        //echo "Win";
                                                                $where = array('match_id' => $MatchId, "m_id" => '14',
"odd_id" => $sch['odd_id'],"game_close" => '1');
                                                                $data = array('result_bet' => 'win');
                                                                $this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
                                                        }
                                                        else{
                                                        //echo "Loss";
                                                                $where = array('match_id' => $MatchId, "m_id" => '14',
"odd_id" => $sch['odd_id'],"game_close" => '1');
                                                                $data = array('result_bet' => 'loss');
                                                                $this->Cricketmodel_model->UpdateScheduledMatchData($where,$data);
                                                        }
                                                        endforeach;
                                                }
                                        endforeach;
                                }
        }
                
                
                
    
    
    
    
}