<?php 
class GetLocation extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

function getCountry()
{
   $this->db->select('*');
   $this->db->from('countries');
   $this->db->order_by('name', 'asc');
   $query=$this->db->get();
   return $query;
}

function getData($loadType,$loadId)
{
//echo "<script>alert('in model');</script>";
   if($loadType=="state"){
    $fieldList='id,name';
    $table='states';
	$fieldName='country_id';
    $orderByField='name';
	
	$this->db->select($fieldList);
    $this->db->from($table);
  //  $this->db->where($fieldName, $loadId);
    
    
    $this->db->order_by($orderByField, 'asc');
   $query=$this->db->get();
   //echo $this->db->last_query();
   return $query;
     }
   else if($loadType=="dealer")
   {
	 $array = array('city_id' => $loadId, 'role_id' => '2', 'is_active' => '1');  
	 $fieldList='first_name as name,last_name as lname,id';
     $table='user_master';
	
    $orderByField='first_name';
	
	$this->db->select($fieldList);
    $this->db->from($table);
    $this->db->where($array);
    
    $this->db->order_by($orderByField, 'asc');
   $query=$this->db->get();
   //echo $this->db->last_query();
   return $query;
   }
   else if($loadType=="user")
   {
	   
	   $this->db->select('player_id');
       $this->db->from('dealer_player');
       $this->db->where('dealer_id',$loadId);
       $query1=$this->db->get();
       
       if(!empty($query1)){
		   foreach($query1->result() as $result){
			     $ids[] = $result->player_id;
			}
		   //$ids = implode(',',$ids);
		   
		  
			 $fieldList='first_name as name,last_name as lname,id';
			 $table='user_master';
			
			 $orderByField='first_name';
			
			 $this->db->select($fieldList);
			 $this->db->from($table);
			 $this->db->where_in('id',$ids);
			 $this->db->where('is_active',1);
				   
		     $this->db->order_by($orderByField, 'asc');
   $query=$this->db->get();
   //echo $this->db->last_query();
   return $query;
		   }		   
   }
   else{
    $fieldList='id,name';
    $table='cities';
	$fieldName='state_id';
    $orderByField='name';
	
	$this->db->select($fieldList);
    $this->db->from($table);
    $this->db->where($fieldName, $loadId);
    
    $this->db->order_by($orderByField, 'asc');
   $query=$this->db->get();
   //echo $this->db->last_query();
   return $query;
    
   }
   
   
 }
 
 function getCountries()
{
   $query = $this->db->get('countries');
   return $query->result();
}
 function getStates($id)
{
   $this->db->where(array('country_id' => $id));
   $query = $this->db->get('states');
   return $query->result();
}
 function getCities($id)
{
   $this->db->where(array('state_id' => $id));
   $query = $this->db->get('cities');
   return $query->result();
}
 
}
?>
