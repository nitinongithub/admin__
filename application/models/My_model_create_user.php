<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model_create_user extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function check_user($user_){

        $this->db->where('USERNAME_',$user_);
        $query = $this->db->get('login');

        if($query->num_rows() != 0){
            $bool_ = array('res_'=>FALSE, 'msg_' => 'Not available.');
        } else {
            $bool_ = array('res_'=>TRUE, 'msg_' => 'User available.');
        }
        return $bool_;
    }
    function create_user(){
        $user_ = $this->input->post('txtUsername');
        $pwd_ = $this->input->post('txtpwd');
        $blocked = $this->input->post('txtStatus');

        $data = array(
            'USERNAME_' => $user_,
            'PASSWORD_' => $pwd_,
            'USER_STATUS'   => 'usr',
            'BLOCK' => $blocked,
            'USER_' => $this->session->userdata('ussr_')
        );

        $bool_ = $this->check_user($user_);

        if($bool_['res_'] == TRUE){
            $query = $this->db->insert('login', $data);
            if($query == TRUE){
                $bool_ = array('res_'=>TRUE, 'msg_'=>'New User Created');
            } else {
                $bool_ = array('res_'=>FALSE, 'msg_'=>'Something goes wrong...!! Please try again.');
            }
        } else {
            $bool_ = array('res_'=>FALSE, 'msg_'=>'User already exists. Please try again.');
        }
        return $bool_;
    }
    function get_all_users($status = 'x'){
    	$this->db->where('USER_STATUS!=', 'adm');
    	if($status != 'x') $this->db->where('BLOCK', $status);
    	$query = $this->db->get('login');
    	return $query->result();
    }
    function active_inactive($user_, $block){
        $data = array(
            'BLOCK'=>$block,
        );
        $this->db->where('USERNAME_', $user_);
        $query = $this->db->update('login', $data);
    }
    function delete_user($user_){
        $this->db->where('USERNAME_', $user_);
        $query = $this->db->delete('login');

        if($query == TRUE){
            $bool_ = array('res_'=>TRUE, 'msg_'=>'User successfully deleted !!');
        } else {
            $bool_ = array('res_'=>FALSE, 'msg_'=>'Something goes wrong...!! Please try again.');
        }

        return $bool_;
    }
}