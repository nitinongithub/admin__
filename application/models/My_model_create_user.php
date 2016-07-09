<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model_create_user extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function create_user(){

    }
    function get_all_users($status = 'x'){
    	//$this->db->where('USER_STATUS!=', 'adm');
    	if($status != 'x') $this->db->where('BLOCK', $status);
    	$query = $this->db->get('login');
    	return $query->result();
    }
}