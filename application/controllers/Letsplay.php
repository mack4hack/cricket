<?php
$link = @mysql_connect('localhost','game_play','game_play') OR die('Sorry could not connect to @mysql server');
@mysql_select_db('game_play') OR die('Sorry could not connect to database...');

class Letsplay extends CI_Controller {
	
	public function getCurrentDateTime($flag)
 {
	// echo 'getcurrent1';
   date_default_timezone_set("Asia/Kolkata");
    $created_time = date('Y-m-d H:i:s');
	$dateconvert=@split(" ",$created_time);
    $converted_date=date("d-m-Y", strtotime($dateconvert[0]));
	$converted_time=$dateconvert[1];
	
	if($flag==1)
	return $created_time;
	else if($flag==2)
	return $dateconvert[0];//"Y-m-d"
	else if($flag==3)
	return $converted_date;//"d-m-Y"
	else if($flag==4)
	return $dateconvert[1];//"time
 }
 
 
	
	public function login()
	{
		  $json = file_get_contents('php://input');
		  //$json="[{'password':';1002','email':'atul@gmail.com'}]";
		  $json_a=json_decode($json,true);
		  
					$email="";
					$password="";
		 if($json=="")
		 {
			 echo "0";
		 }else
		 {			 
		  foreach ($json_a as $key => $jsons) {  
		    foreach($jsons as $key => $value) {
				if($key=="email")
					$email=trim($value);
				
				if($key=="password")
					$password=trim($value);
		  }
		  }
		  
		  $active_user=mysql_query("select first_name,last_name from user_master where user_code='$email' and password='$password' and is_active='1' and role_id='3'");
		  if(mysql_num_rows($active_user)>0)
		  {
			  $blocked_users=mysql_query("select * from user_master where user_code='$email' and password='$password' and is_blocked='1'");
			  if(mysql_num_rows($blocked_users)>0)
				  echo "2";
			  else
			  {
				    while($row=mysql_fetch_assoc($active_user))
					$output[]=$row;
					print(json_encode($output));
			  }
		  }  else
			  echo "0";
		 }
	}
}
?>