<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class getLocation extends CI_Controller {
public function __construct() {
		parent::__construct();
		$this->load->database();
	}	
public function index()
{
   $this->load->model('GetLocation');
   $result['list']=$this->model->getCountry();
   $this->load->view('top');
   $this->load->view('index',$result);
   $this->load->view('footer');
}

 public function loadData()
 {
   $loadType=$_POST['loadType'];
   $loadId=$_POST['loadId'];
   $this->load->model('model');
   $result=$this->model->getData($loadType,$loadId);
   $HTML="";
   
   if($result->num_rows() > 0){
     foreach($result->result() as $list){
       $HTML.="<option value='".$list->id."'>".$list->name."</option>";
     }
   }
   echo $HTML;
 }
}
 ?>
