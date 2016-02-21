<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//location: application/models/auth_model.php

class Auth_model extends CI_Model {

     

     

    public function user_login($name, $password){

		$this->load->library('session');

        $password = $password;

        $this->db->where('user_code',$name);

        $this->db->where('password',$password);

		//$this->db->where('role_id','1');

		//$this->db->where('email_verified','1');

		//$this->db->where('is_active','1');

        $query = $this->db->get('user_master');

        if($query->num_rows()==1){

            foreach ($query->result() as $row){

                $data = array(

                            'email'=> $row->username,

                            'logged_in'=>TRUE

							 );

            }

			$this->session->set_userdata('logged_in',$data);

            return TRUE;

        }

        else{

            return FALSE;

      }    

    }

     

    

     

}