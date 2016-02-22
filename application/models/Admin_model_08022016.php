<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



//location: application/models/auth_model.php



class Admin_model extends CI_Model {
function get_dealers()
{
	$this->db->where('role_id','2');
   $query=$this->db->get('user_master');//employee is a table in the database
    

       return $query->result();
}
function getAreaWiseDealers($country_id,$state_id,$city_id)
{
	$this->db->where('role_id','2');
	if($country_id !=0){
	$this->db->where('country_id',$country_id);
	}
	if($state_id !=0){
	$this->db->where('state_id',$state_id);
	}
	if($city_id !=0){
	$this->db->where('city_id',$city_id);
	}
	
	$query=$this->db->get('user_master');//employee is a table in the database
    return $query->result();
}
function get_players()
{
	$this->db->where('role_id','3');
                  $query=$this->db->get('user_master');//employee is a table in the database
    

       return $query->result();
}


function getPlayersAccToDealer($dealer_id)
{
	//SELECT * FROM `dealer_player` as dp inner join user_master as um on dp.player_id = um.id where um.role_id  = 3 and dp.dealer_id = 32
                    $this->db->select('user_master.*');    
                    $this->db->from('user_master');
                    $this->db->join('dealer_player', 'user_master.id = dealer_player.player_id');
                    $this->db->where('user_master.role_id',3);
                    $this->db->where('is_blocked',0);
                    //$this->db->where('is_active',1);
                    $this->db->where('dealer_player.dealer_id',$dealer_id);
                    $query = $this->db->get();
    
                    return $query->result();
}

function delete_player($id)
{
	  $this->db->delete('user_master', array('id' => $id ,'role_id' => 3));  
	  return true;
}

function delete_dealer($id)
{
	  $this->db->delete('user_master', array('id' => $id ,'role_id' => 2));  
	  return true;
}

	function saveLuckyNumbers($data)
	{
            
                               foreach($data as $insert_data){
                         	 $this->db->insert('lucky_numbers',$insert_data);
                               }
                               return  true;
	}

	function getLuckyPlayers($jodi)
	{
		if($jodi < 10 )
			$jodi = '0'.$jodi;
		$first = floor($jodi/10);
    	$second = $jodi%10;

    	date_default_timezone_set("Asia/Calcutta");
		$now = getdate();
		$now['minutes'] = $now['minutes'] - 1;
		$minutes = $now['minutes'] - $now['minutes']%15;

		 //Can add this to go to the nearest 15min interval (up or down)
		 // $rmin  = $now['minutes']%15;
		  //if ($rmin > 7){
		  //  $minutes = $now['minutes'] + (15-$rmin);
		 //  }else{
		 //     $minutes = $now['minutes'] - $rmin;
		 // }

        if($now['mday']<=9){
            $now['mday'] = "0".$now['mday'];
        }
        if($now['mon']<=9){
            $now['mon'] = "0".$now['mon'];
        }
        if($now['hours']<=9){
            $now['hours'] = "0".$now['hours'];
        }
        if($minutes<=9){
            $minutes = "0".$minutes;
        }

		$rounded = $now['year']."-".$now['mon']."-".$now['mday']." ".$now['hours'].":".$minutes.":00";
		//echo $rounded;
    	$max_time = date('Y-m-d H:i:s');
    	 $min_time = date('Y-m-d H:i:s',strtotime('-15 minutes',strtotime($max_time)));
    	/*select TRUNC_15_MINUTES(timeslot) AS period_starting, digit from game_lottery 
    	where timeslot >= $rounded and timeslot < date('Y-m-d H:i:s') 
    	group by TRUNC_15_MINUTES(timeslot), digit order by TRUNC_15_MINUTES(timeslot)*/
    	$query = $this->db->query("select player_id,payout from game_lottery 
    	where (timeslot >= '".$min_time."' and timeslot < '".$max_time."')  
    	and ( (digit=".$first." and game_type=1 ) or ( digit=".$second." and game_type=2 ) or ( digit=".$jodi." and game_type=3 ) )");

    	echo $this->db->last_query();

		//$where = '(digit='.$first.' or digit='.$second.' or digit='.$jodi.')';
   		//$this->db->where($where);
   		//$query=$this->db->get('game_lottery');//employee is a table in the database
	    
	    return $query->result();
	}

	function updatePlayerHistory($jodi)
	{

		$first = floor($jodi/10);
    	                  $second = $jodi%10;

		date_default_timezone_set("Asia/Calcutta");
		$now = getdate();
		$now['minutes'] = $now['minutes'] - 1;
		$minutes = $now['minutes'] - $now['minutes']%15;

		$rounded = $now['year']."-".$now['mon']."-".$now['mday']." ".$now['hours'].":".$minutes.":00";
                         	$max_time = date('Y-m-d H:i:s');
    	
        $min_time = date('Y-m-d H:i:s',strtotime('-15 minutes',strtotime($max_time)));             
		$this->db->set('result',1,FALSE);
		$where = "((timeslot >= '".$min_time."' and timeslot < '".$max_time."') and  (  first_digit='".$first."' or second_digit='".$second."' or jodi_digit='".$jodi."'))";
   		$this->db->where($where);
		$this->db->update('player_history');
		echo $this->db->last_query();		
	}

	function getAdminHistory($from = null , $to = null)
	{
		$this->db->select('timeslot,timeslot_id');
		$this->db->from('admin_history');
		$this->db->where('timeslot <',$from);
		$this->db->where('timeslot >=',$to);
		$this->db->group_by('timeslot_id');
		$query=$this->db->get();
		
		$timeslots = $query->result();
		$data = array();

		$this->db->select('total');
		$this->db->from('admin_history');
		$this->db->order_by("id", "desc"); 
		$this->db->limit(1);
	   	$query=$this->db->get()->row();
	   	$final_total = $query->total;


		if(!empty($timeslots))
		{	
			foreach ($timeslots as $timeslot)
			{
				$this->db->select('sum(bet_amount) as credited');
				$this->db->from('admin_history');
				$this->db->where('bet_amount >= 0');
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$this->db->like('timeslot',$timeslot->timeslot);
				$query=$this->db->get()->row();
				$credited = $query->credited;

				$this->db->select('sum(bet_amount) as debited');
				$this->db->from('admin_history');
				$this->db->where('bet_amount < 0');
				$this->db->like('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$query=$this->db->get()->row();
				$debited = $query->debited;

				$this->db->select('total');
				$this->db->from('admin_history');
				$this->db->like('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$this->db->order_by("id", "desc"); 
				$this->db->limit(1);
				//$this->db->group_by('timeslot');
			   	$query=$this->db->get()->row();
			   	$day_total = $query->total;

			    $this->db->select('sum(commission) as commission');
				$this->db->from('admin_history');
				$this->db->like('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
			   	$query=$this->db->get()->row();
			   	$commission = $query->commission;

			   	$timespan = $this->getTimeslotById($timeslot->timeslot_id);
			   	$draw_time = explode(' To ', $timespan);
			   	$data[]= array(
			   			'timeslot'=>$timeslot->timeslot,
			   			'credited'=>$credited,
			   			'debited'=>$debited,
			   			'commission'=>$commission,
			   			'day_total'=>$day_total,
			   			'final_total'=>$final_total,
			   			'draw_time'=>date('d-m-y',strtotime($timeslot->timeslot)).'  '.date('h:i a',strtotime($draw_time['1'])),
			   			'profit'=>$credited -($debited + $commission)
			   		);
			}
		}	

	  	return $data;
	}

	function getDealerHistory()
	{
		$this->db->select('timeslot');
		$this->db->from('dealer_history');
		$this->db->group_by('timeslot');
		$query=$this->db->get();	

		$timeslots = $query->result();
		$data = array();
		foreach ($timeslots as $timeslot)
		{
			$this->db->select('sum(bet_amount) as credited');
			$this->db->from('dealer_history');
			$this->db->where('bet_amount >= 0');
			$this->db->where('timeslot',$timeslot->timeslot);
			$query=$this->db->get()->row();
			$credited = $query->credited;

			$this->db->select('sum(bet_amount) as debited');
			$this->db->from('dealer_history');
			$this->db->where('bet_amount < 0');
			$this->db->where('timeslot',$timeslot->timeslot);
			$query=$this->db->get()->row();
			$debited = $query->debited;

			$this->db->select('total');
			$this->db->from('dealer_history');
			$this->db->where('timeslot',$timeslot->timeslot);
			$this->db->order_by("id", "desc"); 
			$this->db->limit(1);
			//$this->db->group_by('timeslot');
		   	$query=$this->db->get()->row();
		   	$day_total = $query->total;

		   	$this->db->select('sum(commission) as commission');
			$this->db->from('dealer_history');
			$this->db->group_by('timeslot');
		   	$query=$this->db->get()->row();
		   	$commission = $query->commission;

		   	$data[]= array(
		   			'timeslot'=>$timeslot->timeslot,
		   			'credited'=>$credited,
		   			'debited'=>$debited,
		   			'day_total'=>$day_total,
		   			'final_total'=>$day_total,
		   			'commission'=>$commission
		   		);
		}

	  	return $data;
	}
	function getDealerHistoryById($dealer_id,$from = null , $to = null)
	{
		$this->db->select('timeslot,timeslot_id');
		$this->db->from('dealer_history');
		$where = "dealer_id = $dealer_id and (timeslot BETWEEN '$to' AND '$from')";
		$this->db->where($where);
		//$this->db->and_like('timeslot',$to);
		//$this->db->or_like('timeslot',$from);
		$this->db->group_by('timeslot_id');
		$query=$this->db->get();	
		$timeslots = $query->result();
		$data = array();

		$this->db->select('total');
		$this->db->from('dealer_history');
		$this->db->order_by("id", "desc"); 
		$this->db->limit(1);
	   	$query=$this->db->get()->row();
	   	$final_total = $query->total;

	   	if(!empty($timeslots))
		{
			foreach ($timeslots as $timeslot)
			{
				$this->db->select('sum(bet_amount) as credited');
				$this->db->from('dealer_history');
				$this->db->where('bet_amount >= 0');
				$this->db->where('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$this->db->where('dealer_id',$dealer_id);
				$query=$this->db->get()->row();
				$credited = $query->credited;

				$this->db->select('sum(bet_amount) as debited');
				$this->db->from('dealer_history');
				$this->db->where('bet_amount < 0');
				$this->db->where('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$this->db->where('dealer_id',$dealer_id);
				$query=$this->db->get()->row();
				$debited = $query->debited;

				/*$this->db->select('total');
				$this->db->from('dealer_history');
				$this->db->where('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$this->db->where('dealer_id',$dealer_id);
				$this->db->order_by("id", "desc"); 
				$this->db->limit(1);
				// $this->db->group_by('timeslot');
			   	$query=$this->db->get()->row();
			   	echo($this->db->last_query());
			   	$day_total = 0;
			   	if($query)
			   		$day_total = $query->total;*/

			   	$this->db->select('sum(commission) as commission');
				$this->db->from('dealer_history');
				$this->db->where('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
			   	$query=$this->db->get()->row();
			   	$commission = $query->commission;

			   	$timespan = $this->getTimeslotById($timeslot->timeslot_id);
			   	$draw_time = explode(' To ', $timespan);	

			   	$data[]= array(
			   			'timeslot'=>$timeslot->timeslot,
			   			'credited'=>$credited,
			   			'debited'=>$debited,
			   			//'day_total'=>$day_total,
			   			'final_total'=>$final_total,
			   			'commission'=>$commission,
			   			'draw_time'=>date('d-m-y',strtotime($timeslot->timeslot)).'  '.date('h:i a',strtotime($draw_time['1'])),
			   			'profit'=>$credited -($debited + $commission),
			   			'week' => date('d-m-y',strtotime($to)).' To '.date('d-m-y',strtotime($from))
			   		);
			}
		}	

	  	return $data;
	}
        
         function getMonthlyProfit()
         {
             
                  date_default_timezone_set("Asia/Calcutta");
	$now = getdate();
	$rounded = $now['year']."-".$now['mon'];
                  $this->db->select(' max(total) - min(total ) as profit');
			$this->db->from('admin_history');
                                                      $this->db->like('timeslot',$rounded);
			$this->db->order_by('timeslot','desc');
			$query=$this->db->get()->row();
                                                      //echo $this->db->last_query();die;
                        
			$profit  = $query->profit;                                    
			
                                                      return $profit;
         }
         function getTotalUsers($role_id)
         {
             
                  
                  $this->db->select(' count( id ) as number');
			$this->db->from('user_master');
			$this->db->where('role_id',$role_id);
                                                      $query=$this->db->get()->row();
                                                      //echo $this->db->last_query();die;
                        
			$number  = $query->number;                                    
			
                                                      return $number;
         }


     	function getTimeslotId()
     	{
     		date_default_timezone_set("Asia/Calcutta");
		   	$now = getdate();
		    $minutes = $now['minutes'] - $now['minutes']%15;

		    $rounded = $now['hours'].":".$minutes;
		    $start = date('H:i', strtotime($rounded));
		      
		      
		    $endTime = date('H:i',strtotime("+15 minutes", strtotime($start)));
	        $time_slots = $start." To ".$endTime;

         	$this->db->select('timeslot_id');
	     	$this->db->from('timeslots');
	      	$this->db->where('timeslot',$time_slots);
	      	$query=$this->db->get()->row();
	      	return $timeslot_id = $query->timeslot_id;
     	}

     	function getTimeslotById($id)
     	{
         	                  
                                    $this->db->select('timeslot');
	     	$this->db->from('timeslots');
	      	$this->db->where('timeslot_id',$id);
	      	$query=$this->db->get()->row();
	      	return $query->timeslot;
     	}
        
             public function restore_amount($users){
                     
                     $result['failed_users'] = array();
                     $result['error'] = '';
                     $result['success'] = '';
                        foreach($users as $user){
                                     $this->db->select("present_amount,deposited_amount,sunday_amount");
                                     $this->db->from("user_master"); 
                                     $this->db->where("id",$user);
                                     $query = $this->db->get()->row();
                                    $present_amount = $query->present_amount;                 
                                    $deposited_amount = $query->deposited_amount;                 
                                    $sunday_amount = $query->sunday_amount;        
                                    //echo "<pre>";
                                      //                                  print_r($query) ;die;
                                    if( $sunday_amount != 0.00){
                                        
//                                             if($sunday_amount > $deposited_amount){
//                                                 
//                                                     $amount = $sunday_amount - $deposited_amount;
//                                                     $present_amount = $present_amount - $amount ;
//                                                     
//                                                      $data = array(
//					
//				"present_amount" => $present_amount,
//				"is_restored" => 1,
//				"restored_time" => date("Y-m-d H:i:s"),
//				"sunday_amount" => 0,
//					
//                                                        );
//                                                        $this->db->where('id', $user);
//                                                        $this->db->update('user_master', $data);
//                                                     
//                                             }else{
//                                                  $result['failed_users'][] = $user;
//                                             }
                                                 
                                        $amount = $present_amount - $sunday_amount;
                                        $amount1 = $amount + $deposited_amount;
                                      //echo $amount."--".$amount1;die;
                                        $data = array(
					
				"present_amount" => $amount1,
				"is_restored" => 1,
				"restored_time" => date("Y-m-d H:i:s"),
				"sunday_amount" => 0,
					
                                                        );
                                        
                                              //echo "<pre>";print_r($data);die;
                                                        $this->db->where('id', $user);
                                                        $this->db->update('user_master', $data);
                                                        $result['success'] = "Amount restored successfully";
                                        
                                        
                                    }else{
                                        
                                                   $result['failed_users'][] = $user;
                                                   $result['error'] = "Amount restored successfully";
                                    }
                         }
                         return $result;
             }
		
 	function getPlayerHistory($player_id,$from,$to)
    {
      	$this->db->select('*');
     	$this->db->from('player_history');
	    $this->db->where('player_id',$player_id);
	    $this->db->where("timeslot >= '".$from."' and timeslot < '".$to."' ");
	    $query=$this->db->get();
	    return $query->result();
    }
    function getGamePlayedLottery($player_id)
    {
      	$this->db->select('*');
     	$this->db->from('player_history');
	    $this->db->where('player_id',$player_id);
	    $query=$this->db->get();
	    return $query->num_rows();
    }
    function getPlayerHistoryById($player_id,$from = null , $to = null)
	{
		$this->db->select('timeslot,timeslot_id');
		$this->db->from('player_history');
		$this->db->where('player_id',$player_id);
		$this->db->like('timeslot',$to);
		$this->db->or_like('timeslot',$from);
		$this->db->group_by('timeslot_id');
		$query=$this->db->get();	
		$timeslots = $query->result();

		//echo $this->db->last_query();

		$data = array();

		$this->db->select('present_amount');
		$this->db->from('user_master');
		$this->db->where('id',$player_id);
		$this->db->order_by("id", "desc"); 
		$this->db->limit(1);
	   	$query=$this->db->get()->row();
	   	$final_total = $query->present_amount;

	   	if(!empty($timeslots))
		{
			foreach ($timeslots as $timeslot)
			{
				$this->db->select('sum(bet_amount) as credited');
				$this->db->from('player_history');
				$this->db->where('bet_amount >= 0');
				$this->db->where('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$this->db->where('player_id',$player_id);
				$query=$this->db->get()->row();
				$credited = $query->credited;

				$this->db->select('sum(bet_amount) as debited');
				$this->db->from('player_history');
				$this->db->where('bet_amount < 0');
				$this->db->where('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$this->db->where('player_id',$player_id);
				$query=$this->db->get()->row();
				$debited = $query->debited;

				/*$this->db->select('total');
				$this->db->from('player_history');
				$this->db->where('timeslot',$timeslot->timeslot);
				$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$this->db->where('player_id',$player_id);
				$this->db->order_by("id", "desc"); 
				$this->db->limit(1);
				//$this->db->group_by('timeslot');
			   	$query=$this->db->get()->row();
			   	$day_total = $query->total;*/
			   	$day_total =0 ;

			   	

			   	$timespan = $this->getTimeslotById($timeslot->timeslot_id);
			   	$draw_time = explode(' To ', $timespan);	

			   	$data[]= array(
			   			'timeslot'=>$timeslot->timeslot,
			   			'credited'=>$credited,
			   			'debited'=>$debited,
			   			'day_total'=>$day_total,
			   			'final_total'=>$final_total,
			   			'draw_time'=>date('d-m-y',strtotime($timeslot->timeslot)).'  '.date('h:i a',strtotime($draw_time['1'])),
			   			'profit'=>$credited -$debited
			   		);
			}
		}	

	  	return $data;
	}
	function getPlayerHistoryByDealer($dealer_id, $from, $to)
	{
		if(isset($dealer_id)){
			$this->db->select('player_id');
			$this->db->from('dealer_player');
			$this->db->where('dealer_id',$dealer_id);
			$query=$this->db->get();

			//echo($this->db->last_query());

			$players = $query->result(); 

			foreach ($players as $player) {
				$this->db->select('user_code');
				$this->db->from('user_master');
				$this->db->where('id',$player->player_id);
				$query=$this->db->get()->row();
				$user_code = $query->user_code; 

				$this->db->select('sum(bet_amount) as bet_amount');
				$this->db->from('player_history');
				$where = "player_id = $player->player_id and (timeslot BETWEEN '$to' AND '$from')";
				$this->db->where($where);
				$query=$this->db->get()->row();
				$bet_amount = $query->bet_amount;

			}
			//die;
		}	
	}

        
        
        public function restore_account(){
            
             $this->db->set('sunday_amount','present_amount',FALSE);
             $this->db->where('role_id',3);
             $this->db->update('user_master');
             //echo    $this->db->last_query();die;
        }

	function getDailyHistory($day)
	{
		if(isset($day)){
			$day = $day;
		}
		else{
			$day = date('Y-m-d');
		}

		$timeslot_id = 1; 
		for ($i = 0 * 60; $i < 24 * 60; $i+= 15) {
            $hr = floor($i / 60);
            if ($hr <= 9) $hr = '0' . $hr;
            
            $min = ($i / 60 - floor($i / 60)) * 60;
            if ($min <= 9) $min = '0' . $min;
            
            $start = date('Y-m-d') . " " . $hr . ":" . $min;
            $val_start = $hr . ":" . $min;
            $newTime = date("Y-m-d H:i", strtotime($start . " +15 minutes"));
            $val_end = date("H:i", strtotime($start . " +15 minutes"));
            $display = date("h:i a", strtotime($val_end));
            
            $timeslot_range = $day.' '.$val_start.' To '.$val_end;

            $timeslots[] = array('date'=>$day,'timeslot'=>$display,'timeslot_id'=>$timeslot_id,'timeslot_range'=>$timeslot_range);  #array('value' => $val_start . " To " . $val_end, 'display' => $display,);
            $timeslot_id++;
        }

		/*$this->db->select('timeslot,timeslot_id');
		$this->db->from('admin_history');
		$this->db->where('timeslot <',$from);
		$this->db->where('timeslot >=',$to);
		$this->db->group_by('timeslot_id');
		$query=$this->db->get();
		
		$timeslots = $query->result();*/
		$data = array();

		//echo "<pre>";
		//print_r($timeslots);

		$this->db->select('total');
		$this->db->from('admin_history');
		$this->db->order_by("id", "desc"); 
		$this->db->limit(1);
	   	$query=$this->db->get()->row();
		$final_total = 0;
	   	if($query){
		   	$final_total = $query->total;
	   	}



		if(!empty($timeslots))
		{	
			foreach ($timeslots as $timeslot)
			{
				$this->db->select('sum(bet_amount) as credited');
				$this->db->from('admin_history');
				$this->db->where('bet_amount >= 0');
				$this->db->where('timeslot_id',$timeslot['timeslot_id']);
				$this->db->like('timeslot',$timeslot['date']);
				$query=$this->db->get()->row();
				$credited = 0;

				//echo($this->db->last_query());

				if($query){
					$credited = $query->credited;

				}	

				$this->db->select('sum(payout) as debited');
				$this->db->from('player_history');
				$this->db->where('result','1');
				$this->db->like('timeslot',$timeslot['date']);
				$this->db->where('timeslot_id',$timeslot['timeslot_id']);
				$query=$this->db->get()->row();
				$debited =  $query->debited;

				$this->db->select('total');
				$this->db->from('admin_history');
				$this->db->like('timeslot',$timeslot['timeslot']);
				//$this->db->where('timeslot_id',$timeslot->timeslot_id);
				$this->db->order_by("id", "desc"); 
				$this->db->limit(1);
				//$this->db->group_by('timeslot');
			   	$query=$this->db->get()->row();
			   	$day_total = 0;
			   	if($query)
			   	{
				   	$day_total = $query->total;
			   	}

			    $this->db->select('sum(commission) as commission');
				$this->db->from('admin_history');
				$this->db->like('timeslot',$timeslot['date']);
				$this->db->where('timeslot_id',$timeslot['timeslot_id']);
			   	$query=$this->db->get()->row();
			   	$commission = $query->commission;

			   	//echo($this->db->last_query());

			   	//$timespan = $this->getTimeslotById($timeslot->timeslot_id);
			   	//$draw_time = explode(' To ', $timespan);
			   	$profit = $credited -($debited + $commission); 
			   	$draw_time = '';
			   	$data[]= array(
			   			'timeslot'=>$timeslot['timeslot'],
			   			'credited'=>$credited,
			   			'debited'=>$debited,
			   			'commission'=>$commission,
			   			'day_total'=>$day_total,
			   			'final_total'=>$final_total,
			   			'draw_time'=>  $timeslot['timeslot'], // date('d-m-y',strtotime($timeslot['timeslot'])).'  '.date('h:i a',strtotime($draw_time['1'])),
			   			'profit'=> $profit,
			   			'day'=>$day,
			   			'timeslot_range'=>$timeslot['timeslot_range'],
			   		);
			}
		}	

	  	return $data;
	}

	function getAccounts($from,$to)
	{
		$this->db->select('user_code,id');
     	$this->db->from('user_master');
	    $this->db->where('role_id','2');
	    $query=$this->db->get();
	     // echo($this->db->last_query());  die;
	    $dealers =  $query->result();

	    $i=1;
	    $total_bet = 0 ;
		$total_wins = 0;
		$total_balance = 0;
		$total_commission = 0;

	    foreach ($dealers as $dealer) {
	    	
	    	$this->db->select('sum(bet_amount) as bet_amount');
			$this->db->from('dealer_history');
			$this->db->where('bet_amount >= 0');
			$where = 'dealer_id = "'.$dealer->id.'" AND (timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
			$this->db->where($where);
			$query=$this->db->get()->row();
			$bet_amount = 0;
			  //echo($this->db->last_query());  die;
			if($query){
				$bet_amount = $query->bet_amount;
			}

			$this->db->select('sum(commission) as commission');
			$this->db->from('dealer_history');
			$this->db->where('bet_amount >= 0');
			$where = 'dealer_id = "'.$dealer->id.'" AND (timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
			$this->db->where($where);
			$query=$this->db->get()->row();
			$commission = 0;
			//echo($this->db->last_query()); 
			if($query){
				$commission = $query->commission;
			}

			

			$this->db->select('sum(total) as total');
			$this->db->from('dealer_history');
			$this->db->where('bet_amount >= 0');
			$where = '(timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
			$this->db->where($where);
			$query=$this->db->get()->row();
			$total = 0;
			// echo($this->db->last_query()); die;
			if($query){
				$total = $query->total;
			}	

			$too = $to.' 00:00:00'; 
	    	$fromm = $from.' 23:59:59'; 

			$this->db->select('sum(payout) as payout');
			$this->db->from('player_history');
			$this->db->join('dealer_player', 'dealer_player.player_id = player_history.player_id');
			$this->db->where('result','1');
			$where = 'dealer_player.dealer_id = "'.$dealer->id.'" AND (timeslot BETWEEN "'.$too.'" AND  "'.$fromm.'")';
			$this->db->where($where);
			$query=$this->db->get()->row();
			$payout = 0;
			//echo($this->db->last_query());
			if($query){
				$payout = $query->payout;
			}


			$balance = $bet_amount - $payout - $commission;
			$total_bet = $total_bet+$bet_amount;
			$total_wins = $total_wins+$payout;
			$total_balance = $total_balance+$balance;
			$total_commission = $total_commission + $commission;

			$data[]= array(
			   			'sr_no' => $i,
			   			'user_code'=>$dealer->user_code,
			   			'dealer_id'=>$dealer->id,
			   			'bet_amount'=>$bet_amount,
			   			'payout'=>$payout,
			   			'commission'=>$commission,
			   			'total'=>$total,
			   			'week' => date('d-m-Y',strtotime($to)) .' To '.date('d-m-Y',strtotime($from)),
			   			'month' => date('M-Y'),
			   			'balance'=>number_format($balance,2),
			   			'total_bet'=>number_format($total_bet,2),
			   			'total_wins'=>number_format($total_wins,2),
			   			'total_balance'=>number_format($total_balance,2),
			   			'total_commission'=>number_format($total_commission,2)
			   			//'draw_time'=>  $timeslot['timeslot'], // date('d-m-y',strtotime($timeslot['timeslot'])).'  '.date('h:i a',strtotime($draw_time['1'])),
			   			//'balance'=>$credited -($debited + $commission)
			   		);
			$i++;
	    }

	    //print_r($data);
	    //die;

	    return $data;
	}
	function getAccountsDealer($from,$to , $dealer_id)
	{
		//if(isset($_GET['dealer_id'])){
			$this->db->select('user_code,user_master.id');
	     	$this->db->from('user_master');
		    $this->db->where('role_id','3');
		    $this->db->where('dealer_id',$dealer_id);
		    $this->db->join('dealer_player', 'dealer_player.player_id = user_master.id');
		    $query=$this->db->get();
		     // echo($this->db->last_query());  die;
		    $players =  $query->result();

		    $i=1;

		    $total_bet = 0 ;
			$total_wins = 0;
			$total_balance = 0;
			$total_commission = 0;

			$data = array();
			$week = date('d-m-Y',strtotime($to)) .' To '.date('d-m-Y',strtotime($from));
		    foreach ($players as $player) {
		    	
		    	$to = $to.' 00:00:00'; 
		    	$from = $from.' 23:59:59'; 

		    	$this->db->select('sum(bet_amount) as bet_amount');
				$this->db->from('dealer_history');
				$this->db->where('bet_amount >= 0');
				$where = 'player_id = "'.$player->id.'" AND (timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
				$this->db->where($where);
				$query=$this->db->get()->row();
				$bet_amount = 0;
				 // echo($this->db->last_query());  die;
				if($query){
					$bet_amount = $query->bet_amount;
				}

				$this->db->select('sum(commission) as commission');
				$this->db->from('dealer_history');
				$this->db->where('bet_amount >= 0');
				$where = 'player_id = "'.$player->id.'" AND (timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
				$this->db->where($where);
				$query=$this->db->get()->row();
				$commission = 0;
				//echo($this->db->last_query()); 
				if($query){
					$commission = $query->commission;
				}

				$this->db->select('sum(payout) as payout');
				$this->db->from('player_history');
				$this->db->where('result','1');
				$where = 'player_id = "'.$player->id.'" AND (timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
				$this->db->where($where);
				$query=$this->db->get()->row();
				$payout = 0;
				// echo($this->db->last_query()); die;
				if($query){
					$payout = $query->payout;
				}	

				$balance = $bet_amount - $payout - $commission;
				$total_bet = $total_bet+$bet_amount;
				$total_wins = $total_wins+$payout;
				$total_balance = $total_balance+$balance;
				$total_commission = $total_commission + $commission;

				$data[]= array(
				   			'sr_no' => $i,
				   			'user_code'=>$player->user_code,
				   			'player_id'=>$player->id,
				   			'bet_amount'=>$bet_amount,
				   			'payout'=>$payout,
				   			'commission'=>$commission,
				   			'total_bet'=>number_format($total_bet,2),
				   			'total_wins'=>number_format($total_wins,2),
				   			'total_balance'=>number_format($total_balance,2),
				   			'total_commission'=>number_format($total_commission,2),
				   			//'total'=>$total,
				   			'week' => $week,
				   			'month' => date('M-Y'),
				   			'balance'=>number_format($balance,2),
				   			//'draw_time'=>  $timeslot['timeslot'], // date('d-m-y',strtotime($timeslot['timeslot'])).'  '.date('h:i a',strtotime($draw_time['1'])),
				   			//'balance'=>$credited -($debited + $commission)
				   		);
				$i++;
		    }
		//}
	   // print_r($data);
	   // die;

	    return $data;
	}

	function getAccountsPlayer($player_id)
	{
			$player_id = $_GET['player_id'];
			//if(isset($_GET['dealer_id'])){
			$this->db->select('user_code');
	     	$this->db->from('user_master');
		    $this->db->where('id',$player_id);
		    $query=$this->db->get()->row();;
		    $user_code =  $query->user_code;

		    $i=1;

		    if(date('Y-m-d') == date('Y-m-d',strtotime('sunday')))
		    {	
				$mon = date( 'Y-m-d', strtotime( 'monday previous week' ) );
				$tue = date( 'Y-m-d', strtotime( 'tuesday previous week' ) );
				$wed = date( 'Y-m-d', strtotime( 'wednesday previous week' ) );
				$thr = date( 'Y-m-d', strtotime( 'thursday previous week' ) );
				$fri = date( 'Y-m-d', strtotime( 'friday previous week' ) );
	            $sat = date( 'Y-m-d', strtotime( 'saturday previous week' ) );
	            $sun = date( 'Y-m-d', strtotime( 'sunday previous week' ) );
	        }
	        else{

	        	$mon = date( 'Y-m-d', strtotime( 'monday this week' ) );
				$tue = date( 'Y-m-d', strtotime( 'tuesday this week' ) );
				$wed = date( 'Y-m-d', strtotime( 'wednesday this week' ) );
				$thr = date( 'Y-m-d', strtotime( 'thursday this week' ) );
				$fri = date( 'Y-m-d', strtotime( 'friday this week' ) );
	            $sat = date( 'Y-m-d', strtotime( 'saturday this week' ) );
	            $sun = date( 'Y-m-d', strtotime( 'sunday this week' ) );
	        }

			$week_days = array($mon,$tue,$wed,
								$thr,$fri,$sat,$sun,);

				/*echo "<pre>";
				print_r($week_days); die;*/
			$total_bet = 0 ;
			$total_wins = 0;
			$total_balance = 0;
			$total_commission = 0;

		    foreach ($week_days as $day) {
		    	

		    	///$day = $to.' 00:00:00'; 
		    	//$from = $from.' 23:59:59'; 

		    	$this->db->select('sum(bet_amount) as bet_amount');
				$this->db->from('player_history');
				// $this->db->where('bet_amount >= 0');
				//$where = 'player_id = "'.$player->player_id.'" AND (timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
				$where = 'player_id = "'.$player_id.'" AND timeslot LIKE "%'.$day.'%"';
				$this->db->where($where);
				$query=$this->db->get()->row();
				$bet_amount = 0;
				 // echo($this->db->last_query());  die;
				if($query){
					$bet_amount = $query->bet_amount;
				}

				$this->db->select('sum(payout) as payout');
				$this->db->from('player_history');
				$this->db->where('result','1');
				$where = 'player_id = "'.$player_id.'" AND timeslot LIKE "%'.$day.'%"';
				$this->db->where($where);
				$query=$this->db->get()->row();
				$payout = 0;
				// echo($this->db->last_query()); die;
				if($query){
					$payout = $query->payout;
				}

				/*$this->db->select('sum(payout) as payout');
				$this->db->from('player_history');
				$this->db->where('result','1');
				$where = 'player_id = "'.$player->id.'" AND (timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
				$this->db->where($where);
				$query=$this->db->get()->row();
				$payout = 0;
				// echo($this->db->last_query()); die;
				if($query){
					$payout = $query->payout;
				}*/	

				$commission = $bet_amount*.05;
				$balance = $bet_amount - $payout - $commission;

				$total_bet = $total_bet+$bet_amount;
				$total_wins = $total_wins+$payout;
				$total_balance = $total_balance+$balance;
				$total_commission = $total_commission + $commission;
				$data[]= array(
				   			'sr_no' => $i,
				   			'user_code' => $user_code,
				   			'date'=>$day,
				   			'bet_amount'=>$bet_amount,
				   			'payout'=>$payout,
				   			'commission'=>number_format($commission,2),
				   			'total_bet'=>number_format($total_bet,2),
				   			'total_wins'=>number_format($total_wins,2),
				   			'total_balance'=>number_format($total_balance,2),
				   			'total_commission'=>number_format($total_commission,2),
				   			//'week' => date('d-m-Y',strtotime($to)) .' To '.date('d-m-Y',strtotime($from)),
				   			//'month' => date('M-Y'),
				   			'balance'=>number_format($balance,2),
				   			//'draw_time'=>  $timeslot['timeslot'], // date('d-m-y',strtotime($timeslot['timeslot'])).'  '.date('h:i a',strtotime($draw_time['1'])),
				   			//'balance'=>$credited -($debited + $commission)
				   		);
				$i++;
		    }
		//}
	   /* print_r($data);
	   die;*/

	    return $data;
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

				
			   	$balance = $chips - $win;
			   	$total_bet = $total_bet + $chips ;
				$total_wins = $total_wins + $win;
				$total_balance = $total_balance + $balance;

				if($chips){
				   	$data[]= array(
				   			'sr_no' => $i,
				   			'user_code' => $user_code,
				   			'bet_amount'=>$chips,
				   			'payout'=>$win,
				   			'balance'=>number_format($balance,2),
				   			'total_bet'=>number_format($total_bet,2),
				   			'total_wins'=>number_format($total_wins,2),
				   			'total_balance'=>number_format($total_balance,2),
				   			'draw_time'=>$timeslot['timeslot'],
				   			'timeslot_id'=>$timeslot['timeslot_id'],
				   		);
				   	$i++;
				}   	
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
	    //	print_r($timeslots); die;

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
		{	$i=1;
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
	   //	die;
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


		/*if(!empty($records))
		{	$i=1;
			foreach ($records as $record)
			{
				//print_r($timeslot); die;
				$this->db->select('bet_amount as chips');
				$this->db->from('player_history');
				// $this->db->where('timeslot_id',$record->timeslot_id);
				//$this->db->where('id',$record->id);
				$this->db->where('transaction_id',$record->transaction_id);
				//$this->db->like('timeslot',$day);
				//$this->db->like('timeslot',$timeslot->timeslot);
				$query=$this->db->get()->row();
				// echo $this->db->last_query(); die;
				$chips = $query->chips;

				$this->db->select('payout as win');
				$this->db->from('player_history');
				$this->db->where('result','1');
				//$this->db->where('timeslot_id',$record->timeslot_id);
				//$this->db->where('player_id',$player_id);
				//$this->db->where('id',$record->id);
				$this->db->where('transaction_id',$record->transaction_id);
				// $this->db->like('timeslot',$day);
				$query=$this->db->get()->row();
				//echo $this->db->last_query(); die;
				$win = $query->win;

				$this->db->select('first_digit');
				$this->db->from('player_history');
				$this->db->where('transaction_id',$record->transaction_id);
				$this->db->where('game_type','1');
				$query=$this->db->get()->row();
				$first_digit ='';
				if($query)
					$first_digit = $query->first_digit;

				$this->db->select('bet_amount');
				$this->db->from('player_history');
				$this->db->where('game_type','1');
				$this->db->where('transaction_id',$record->transaction_id);
				$query=$this->db->get()->row();
				$bet_amount_first ='';
				if($query)
					$bet_amount_first = $query->bet_amount;

				$this->db->select('payout');
				$this->db->from('player_history');
				$this->db->where('game_type','1');
				$this->db->where('transaction_id',$record->transaction_id);
				$this->db->where('result','1');
				$query=$this->db->get()->row();
				$win_amount_first = '';
				if($query)
					$win_amount_first = $query->payout;

				$this->db->select('second_digit');
				$this->db->from('player_history');
				$this->db->where('game_type','2');
				$this->db->where('transaction_id',$record->transaction_id);
				$query=$this->db->get()->row();
				$second_digit = '';
				if($query)
					$second_digit = $query->second_digit;

				$this->db->select('bet_amount');
				$this->db->from('player_history');
				$this->db->where('game_type','2');
				$this->db->where('transaction_id',$record->transaction_id);
				$query=$this->db->get()->row();
				$bet_amount_second ='';
				if($query)
					$bet_amount_second = $query->bet_amount;
	    		// echo($this->db->last_query());  //die;


				$this->db->select('payout');
				$this->db->from('player_history');
				$this->db->where('game_type','2');
				$this->db->where('transaction_id',$record->transaction_id);
				$this->db->where('result','1');
				$query=$this->db->get()->row();
				$win_amount_second ='';
				if($query)
					$win_amount_second = $query->payout;


			   	$balance = $chips - $win;
			   	$total_bet = $total_bet + $chips ;
				$total_wins = $total_wins + $win;
				$total_balance = $total_balance + $balance;

			   	$data[]= array(
			   			'sr_no' => $i,
			   			'bet_amount'=>$chips,
			   			'payout'=>$win,
			   			'transaction_id'=>$record->transaction_id,
			   			'total_bet'=>$total_bet,
			   			'total_wins'=>$total_wins,
			   			'first_digit'=>$first_digit,
			   			'bet_amount_first' =>$bet_amount_first,
			   			'win_amount_first' =>$win_amount_first,
			   			'second_digit'=>$second_digit,
			   			'bet_amount_second' =>$bet_amount_second,
			   			'win_amount_second' =>$win_amount_second,
			   			//'total_balance'=>$total_balance,
			   			//'draw_time'=>$timeslot['timeslot'],
			   		);
			   	$i++;
			}
		}*/	

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
				$drawtime = date('h:i: a', strtotime(explode(" ", $timeslot)[1]));
			}

			$this->db->select('timeslot');
			$this->db->from('player_history');
			$this->db->where('transaction_id',$transaction->transaction_id);
			$query=$this->db->get()->row();
			//echo $this->db->last_query(); die;
			if($query)
				$trans_time = date('d-m-Y h:i:s a',strtotime($query->timeslot));

			

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
		
		// echo "<pre>"; print_r($data);  	die;
	  	return $data;
	}

	function getAccountsPlayerByWeek($player_id,$to, $from)
	{
		// $player_id = $_GET['player_id'];
			//if(isset($_GET['dealer_id'])){
			$this->db->select('user_code');
	     	$this->db->from('user_master');
		    $this->db->where('id',$player_id);
		    $query=$this->db->get()->row();;
		    $user_code =  $query->user_code;

		    $i=1;

			$mon = $from; 
			$tue = date( 'Y-m-d', strtotime( '+ 1 day', strtotime($mon) ) );
			$wed = date( 'Y-m-d', strtotime( '+ 1 day', strtotime($tue )) );
			$thr = date( 'Y-m-d', strtotime( '+ 1 day', strtotime($wed ) ));
			$fri = date( 'Y-m-d', strtotime( '+ 1 day', strtotime($thr ) ));
            $sat = date( 'Y-m-d', strtotime( '+ 1 day', strtotime($fri ) ));
            $sun = $to;

			$week_days = array($mon,$tue,$wed,
								$thr,$fri,$sat,$sun,);

				// echo "<pre>";
				// print_r($week_days); die;
			$total_bet = 0 ;
			$total_wins = 0;
			$total_balance = 0;
			$total_commission = 0;

		    foreach ($week_days as $day) {
		    	

		    	///$day = $to.' 00:00:00'; 
		    	//$from = $from.' 23:59:59'; 

		    	$this->db->select('sum(bet_amount) as bet_amount');
				$this->db->from('player_history');
				// $this->db->where('bet_amount >= 0');
				//$where = 'player_id = "'.$player->player_id.'" AND (timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
				$where = 'player_id = "'.$player_id.'" AND timeslot LIKE "%'.$day.'%"';
				$this->db->where($where);
				$query=$this->db->get()->row();
				$bet_amount = 0;
				 // echo($this->db->last_query());  die;
				if($query){
					$bet_amount = $query->bet_amount;
				}

				$this->db->select('sum(payout) as payout');
				$this->db->from('player_history');
				$this->db->where('result','1');
				$where = 'player_id = "'.$player_id.'" AND timeslot LIKE "%'.$day.'%"';
				$this->db->where($where);
				$query=$this->db->get()->row();
				$payout = 0;
				// echo($this->db->last_query()); die;
				if($query){
					$payout = $query->payout;
				}

				/*$this->db->select('sum(payout) as payout');
				$this->db->from('player_history');
				$this->db->where('result','1');
				$where = 'player_id = "'.$player->id.'" AND (timeslot BETWEEN "'.$to.'" AND  "'.$from.'")';
				$this->db->where($where);
				$query=$this->db->get()->row();
				$payout = 0;
				// echo($this->db->last_query()); die;
				if($query){
					$payout = $query->payout;
				}*/	

				$commission = $bet_amount*.05;
				$balance = $bet_amount - $payout - $commission;

				$total_bet = $total_bet+$bet_amount;
				$total_wins = $total_wins+$payout;
				$total_balance = $total_balance+$balance;
				$total_commission = $total_commission + $commission;

				if($bet_amount){
					$data[]= array(
					   			'sr_no' => $i,
					   			'user_code' => $user_code,
					   			'date'=>date('d-m-Y',strtotime($day)),
					   			'bet_amount'=>$bet_amount,
					   			'payout'=>$payout,
					   			'commission'=>number_format($commission,2),
					   			'total_bet'=>number_format($total_bet,2),
					   			'total_wins'=>number_format($total_wins,2),
					   			'total_balance'=>number_format($total_balance,2),
					   			'total_commission'=>number_format($total_commission,2),
					   			//'week' => date('d-m-Y',strtotime($to)) .' To '.date('d-m-Y',strtotime($from)),
					   			//'month' => date('M-Y'),
					   			'balance'=>number_format($balance,2),
					   			//'draw_time'=>  $timeslot['timeslot'], // date('d-m-y',strtotime($timeslot['timeslot'])).'  '.date('h:i a',strtotime($draw_time['1'])),
					   			//'balance'=>$credited -($debited + $commission)
					   		);
					$i++;
				}	
		    }
		//}
	   /* print_r($data);
	   die;*/

	    return $data;
	}

	function getAccountsPlayerWeeklyByDrawTime($player_id,$day,$timeslot_id)
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
	    //	print_r($timeslots); die;

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
		{	$i=1;
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
	   //	die;
	  	return $data;
	}

	function getAccountsPlayerWeeklyByTransactionId($transaction_id,$date,$draw_time)
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
				$timeslot = $query->timeslot;
				$drawtime = date('h:i: a', strtotime(explode(" ", $timeslot)[1]));
			}

			$this->db->select('timeslot');
			$this->db->from('player_history');
			$this->db->where('transaction_id',$transaction->transaction_id);
			$query=$this->db->get()->row();
			//echo $this->db->last_query(); die;
			if($query)
				$trans_time = date('d-m-Y h:i:s a',strtotime($query->timeslot));

			

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
		
		// echo "<pre>"; print_r($data);  	die;
	  	return $data;
	}
}
