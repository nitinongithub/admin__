<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function login() {

        $this->db->where('USERNAME_', $this->input->post('txtUsr'));
        $this->db->where('PASSWORD_', $this->input->post('txtPwd'));
        $this->db->where('BLOCK', 0); // This condition says un-blocked user is only authorized to use the software
        $query = $this->db->get('login');

        if ($query->num_rows() != 0) {
            $res = $query->row();
            $data = array('bool_' => TRUE, 'sts_' => $res->USER_STATUS);
        } else {
            $data = array('bool_' => FALSE, 'sts_' => 'x');
        }

        return $data;
    }

    function changepwd(){
        if($this->session->userdata('pwd_count') <= 3){
            $old_pwd = $this->input->post('old_pwd');
            $new_pwd = $this->input->post('new_pwd');

            $this->db->where('USERNAME_', $this->session->userdata('ussr_'));
            $this->db->where('PASSWORD_', $old_pwd);
            $query = $this->db->get('login');

            if($query->num_rows() != 0){
                $data = array(
                    'PASSWORD_' => $new_pwd
                );
                $this->db->where('USERNAME_', $this->session->userdata('ussr_'));
                $this->db->where('PASSWORD_', $old_pwd);
                $query = $this->db->update('login', $data);

                $bool_ = array('res_'=>TRUE, 'msg_' => 'good');
                $this->session->unset_userdata('pwd_count');
            } else {
                $bool_ = array('res_'=>FALSE, 'msg_' => 'Your old credentials are not matching. Please try again!!!');
            }
        } else {
            $bool_ = array('res_'=>FALSE, 'msg_' => 'All three chances over.');
        }

        return $bool_;
    }
}