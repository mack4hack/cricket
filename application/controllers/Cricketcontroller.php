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
        $result = curl_exec($curl);
        $TokenArray = json_decode($result);
        //$TokenAccessValue = $TokenArray->auth->access_token;
        $TokenAccess = (isset($TokenArray->auth->access_token))?$TokenArray->auth->access_token:"";
        curl_close($curl);
        echo "shrikant".$TokenAccess;
        //echo $form_url."Ckecking Tocken Access:<pre>";
        print_r($TokenArray); exit;
        return $TokenAccess;
    }

    ///rest/v2/match/{MATCH_KEY}/balls/{OVER_KEY}/
    // Live Match Data From  
    function CronLiveMatchDataAutomated() {
        $TokenAccess = $this->GetApiAuthentication();
        if($TokenAccess != "")
        {
            $UniqueKeyOfMatchArray = $this->Cricketmodel_model->GetLiveMatchKeyAPIToday();

            if (count($UniqueKeyOfMatchArray) > 0) {

                foreach ($UniqueKeyOfMatchArray as $key => $v) {
                    $UniqueKeyOfMatch = $v->unique;
                    $MatchUniqueId = $v->id;
                    //$MatchUniqueId = 41;
                    //$UniqueKeyOfMatch = "asiacup_2016_g4";
                    //http://www.litzscore.com/rest/v2/
                    $CommonAuthUrl = "https://rest.cricketapi.com/rest/v2/";
                    $url = $CommonAuthUrl."match/" . $UniqueKeyOfMatch . "/?access_token=" . $TokenAccess;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $output = curl_exec($ch);
                    $LiveMatchArray = json_decode($output);

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
                            foreach ($summary->overs_summary as $key => $PerOver) {

                                $CheckedMatchSummaryOver = $this->Cricketmodel_model->getCheckUniqueMatchOverSummaryPresent($MatchUniqueId, $BattingKeyId, $PerOver->over);

                                if ($CheckedMatchSummaryOver == 0) {
                                    $ScoreExplode = explode("in", $PerOver->score);
                                    $RunsWicket = explode("/", $ScoreExplode[0]);
                                    $WicketKeyImp = "";

                                    if (count($PerOver->wickets) > 0) {
                                        $WicketKeyImp = implode(",", $PerOver->wickets);
                                    }

                                    $ArrayOfOverSummaryList = array(
                                        "score" => $PerOver->score,
                                        "match_id" => $MatchUniqueId,
                                        "Innings_code" => $BattingKeyId,
                                        "over" => $PerOver->over,
                                        "current_run_rate" => $PerOver->current_run_rate,
                                        "total_run" => $RunsWicket[0],
                                        "over_run" => $PerOver->runs,
                                        "wicket" => $RunsWicket[1],
                                        "wicket_key" => $WicketKeyImp,
                                        "summary_count" => $key + 1
                                    );

                                    $this->Cricketmodel_model->MatchOverSummaryInsert($ArrayOfOverSummaryList);
                                }
                            } // end of over summary

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

                            ///$this->CronLiveMatchBallByBallDataAutomated($UniqueKeyOfMatch, $MatchUniqueId, $BattingKeyId);
                        }
                    }


                    $this->CronCricketMatchPayoutAutomated($UniqueKeyOfMatch, $MatchUniqueId); // get calculate chip and payout
                    // "<pre>";
                    //print_r($LiveMatchArray->data->card);
                    exit;
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
    // Live Match Data From  
    function CronLiveMatchBallByBallDataAutomated($UniqueKeyOfMatch, $MatchUniqueId, $BattingKeyId) {
        $TokenAccess = $this->GetApiAuthentication();
        $BattingKeyUpdatedId = $BattingKeyId . "_1";
        //$BattingKeyUpdatedId = "b_1_1";
        //$UniqueKeyOfMatch = "asiacup_2016_g1";

        $url = "http://www.litzscore.com/rest/v2/match/" . $UniqueKeyOfMatch . "/balls/" . $BattingKeyUpdatedId . "/?access_token=" . $TokenAccess;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        $BallByBallArray = json_decode($output);

        if (count((array) $BallByBallArray) > 6) {
            $FirstBallMatchKey = $BallByBallArray->data->over->balls[0];
            $FirstBallCheck = $BallByBallArray->data->balls->$FirstBallMatchKey;
            //echo "In Ball By ball<pre>";
            //print_r($FirstBallCheck);//ball_by_ball
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
    }

// end of cron live data access ball by ball
    // one day call to this function 
    function CronDataAutomated() {

        $TokenAccess = $this->GetApiAuthentication();
        
        if($TokenAccess != "")
        {
            $CommonAuthUrl = "https://rest.cricketapi.com/rest/v2/";
            // get match data of next month when 5 days are remaning to end month  // need to work on this
            $url = $CommonAuthUrl."schedule/?access_token=" . $TokenAccess;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            $asd = json_decode($output);
            $matches = $asd->data->months[0]->days;
            $ArrayOfMatchList = array();
            //echo "<pre>";
            //print_r($matches); //exit;
            foreach ($matches as $value) {
                $MatchData = array_filter($value->matches);

                if (!empty($MatchData)) {

                    foreach ($MatchData as $v) {
                        //echo $i++.$v->name." ".$v->status." ".$v->key."<br>";t20//one-day
                        if ($v->format == "t20" || $v->format == "one-day") {
                            $CheckedMatchKey = $this->Cricketmodel_model->getCheckUniqueMatchIdPresent($v->key);

                            if ($CheckedMatchKey == 0) { // 0 will insert int odatabase as new match from server
                                $ArrayOfMatchList[] = array("name" => $v->name, "status" => $v->status
                                    , "unique" => $v->key, "format" => $v->format, "venue" => $v->venue
                                    , "start_date" => $v->start_date->iso, "team_a" => $v->teams->a->name, "team_b" => $v->teams->b->name
                                    , "winner_team" => $v->winner_team, "match_load" => 0
                                );
                            }
                        }
                    }
                }
            } // end of foreach

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
    
    
}
