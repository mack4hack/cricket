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
		$this->load->model('Cricket_model');
        $this->load->model('Bets_model');
        $this->load->library('ion_auth');
    }
	
		
	
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
//print_r($result);
//echo "<br>";
$TokenAccess = $TokenArray->auth->access_token;

curl_close($curl);
return $TokenAccess;

		
	}
	
function GetMatchFirstBallData()
{

	$data = array(
		'MatchId' => $this->input->post('MatchId'),
		'IningFristBallTeam' => $this->input->post('IningFristBallTeam')
		
	);
    $MatchId = $data['MatchId'];
	$IningFristBallTeam = $data['IningFristBallTeam'];
//echo $MatchId." ".$IningFristBallTeam;

$DataMasterGameTypeValue = $this->Cricket_model->getMaterDataValueOfFirstBall($IningFristBallTeam);
$DataArrayForMatchOddLists = $this->Cricket_model->getMaterConfigOdd($DataMasterGameTypeValue);

$ArrayOfMatchOddsList = array();
foreach($DataArrayForMatchOddLists as $v)
	{
		//echo $v->perticulars." ".$v->odds." ".$v->odd_id."<br>";
		
		
		//$CheckedMatchScheduleDataValue = $this->Cricket_model->getCheckUniqueMatchIdPresent($v->key);
					//print_r($CheckedMatchKey); exit;
				//	if($CheckedMatchKey == "")
				//	{
						$ArrayOfMatchOddsList[] = array("match_id" => $MatchId, "odd_id" => $v->odd_id ,"odds" => $v->odds);
						//$ArrayOfMatchList[] = array("name" => $v->name, "status" => $v->status,"unique" => $v->key);
			//		}
		
		
	} // end of loop


//print_r($ArrayOfMatchOddsList);
//echo $DataArray;
$this->Cricket_model->MatchBetSheduleDataInsert($ArrayOfMatchOddsList);
exit;
//
   //     $Data['MatchList'] = $this->Cricket_model->getMatchList();
		  

}	
	
	
	
	function GetUniqueMatchKey()
	{
	
	//echo "shrikant"; exit;  /rest/v2/match/iplt20_2013_g30/?access_token=ACCESSTOKEN
	$data = array(
		'key' => $this->input->post('key'),
	);
    $MatchUniqueKey = $data['key'];


$TokenAccess = $this->GetApiAuthentication();
  
$url="http://www.litzscore.com/rest/v2/match/".$MatchUniqueKey."/?access_token=".$TokenAccess;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch,CURLOPT_HEADER, false); 
 $output=curl_exec($ch);
 //echo "<pre>";
//print_r($output);
$MatchStat =  json_decode($output);

$DataArray = $MatchStat->data->card->name;
$Team = explode("vs", $DataArray);
//echo $Team[0]." ".$Team[1];
$TossWinner = $MatchStat->data->card->first_batting;
$status = $MatchStat->data->card->status;
$ArrayOfMatchDetails  = array("unique" => $MatchUniqueKey, "team_a" => $Team[0],"team_b" => $Team[1],"toss_win" => $TossWinner,"status" => $status);
$CheckedMatchKey = $this->Cricket_model->getCheckUniqueMatchIdPresentInMatchDetails($MatchUniqueKey);
if($CheckedMatchKey == ""){

$this->Cricket_model->MatchDetailsInsert($ArrayOfMatchDetails);

}

$DataDetail['MatchDetails'] = $this->Cricket_model->getMatchDetails($MatchUniqueKey);
echo json_encode($DataDetail['MatchDetails']);
//print_r($MatchStat->data->card); exit; //first_batting
//$matches = $MatchStat->data->months[0]->days;

//$ArrayOfMatchList = array();
/*
foreach($matches as $value)
{
	
$MatchData = array_filter($value->matches);

if (!empty($MatchData)) {
	
	foreach($MatchData as $v)
	{
		//echo $i++.$v->name." ".$v->status." ".$v->key."<br>";
		$CheckedMatchKey = $this->Cricket_model->getCheckUniqueMatchIdPresent($v->key);
		//print_r($CheckedMatchKey); exit;
		if($CheckedMatchKey == ""){
			$ArrayOfMatchList[] = array("name" => $v->name, "status" => $v->status,"unique" => $v->key);
		}
	}
}

} // end of foreach
*/
	
	}
   
    
  public function cricket() {
		 
$TokenAccess = $this->GetApiAuthentication();
  
$url="http://www.litzscore.com/rest/v2/schedule/?access_token=".$TokenAccess;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch,CURLOPT_HEADER, false); 
 $output=curl_exec($ch);
 //echo "<pre>";
//print_r($output);
$asd =  json_decode($output);
//print_r($asd);
$matches = $asd->data->months[0]->days;

$ArrayOfMatchList = array();

foreach($matches as $value)
{
	
$MatchData = array_filter($value->matches);
//echo "<pre>";
//print_r($MatchData);
if (!empty($MatchData)) {
	
	foreach($MatchData as $v)
	{
		//echo $i++.$v->name." ".$v->status." ".$v->key."<br>";t20//one-day
		if($v->format=="t20" || $v->format=="one-day")
		{
					$CheckedMatchKey = $this->Cricket_model->getCheckUniqueMatchIdPresent($v->key);
					//print_r($CheckedMatchKey); exit;
					if($CheckedMatchKey == "")
					{
						$ArrayOfMatchList[] = array("name" => $v->name, "status" => $v->status
						,"unique" => $v->key,"format" => $v->format,"venue" => $v->venue
						,"start_date" => $v->start_date->iso,"team_a" => $v->teams->a->name,"team_b" => $v->teams->b->name
						,"winner_team" => $v->winner_team 
						);
						//$ArrayOfMatchList[] = array("name" => $v->name, "status" => $v->status,"unique" => $v->key);
					}
		}
	}
}

} // end of foreach

//exit();

		$this->Cricket_model->MatchListInsert($ArrayOfMatchList);
        $Data['MatchList'] = $this->Cricket_model->getMatchList();
		
		//print_r($Data['MatchList']); exit;
        $this->load->view('admin/cricket', $Data);
		
     }

   
	
	
	
	
	
	
	
	
	
	
	
}
