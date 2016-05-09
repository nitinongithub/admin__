<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends my_admin {

    function __construct() {
        parent::__construct();
        //if (!$this->session->userdata('ussr_')) {
            //redirect(__BACKTOSITE__);
        //}

        if (!$this->session->userdata('ussr_')) {
            $this->session->set_userdata('ussr_', 'Admin');
        }
    }

    function index() {
        $data['user___'] = $this->session->userdata('ussr_');

        $this->load->view('templates/header');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}
