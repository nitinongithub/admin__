<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function login() {

        $this->db->where('USERNAME_', $this->input->post('txtUsr'));
        $this->db->where('PASSWORD_', $this->input->post('txtPwd'));
        $query = $this->db->get('login');

        if ($query->num_rows() != 0) {
            $res = $query->row();
            $data = array('bool_' => TRUE, 'sts_' => $res->USER_STATUS);
        } else {
            $data = array('bool_' => FALSE, 'sts_' => 'x');
        }

        return $data;
    }

    function change_Password(){
        $old_pwd = $this->input->post('txtOldPwd');
        $confirm_pwd = $this->input->post('txtConfirmPwd');

        $this->db->where('USERNAME_', $this->session->userdata('ussr_'));
        $this->db->where('PASSWORD_', $old_pwd);
        $query = $this->db->get('login');

        if($query->num_rows() != 0){
            $data = array(
                'PASSWORD_' => $confirm_pwd
            );
            $this->db->where('USERNAME_', $this->session->userdata('ussr_'));
            $query = $this->db->update('login', $data);

            if($query == TRUE){
                $bool_ = array('res_'=>TRUE, 'msg_'=>'Password changed successfully. Please login again to proceed !!');
            } else {
                $bool_ = array('res_'=>FALSE, 'msg_'=>'Some thing goes wrong. Please try again !!');
            }
        } else {
            $bool_ = array('res_'=>FALSE, 'msg_'=>'Some thing goes wrong. Please try again !!');
        }

        return $bool_;
    }
}