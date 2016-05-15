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
}