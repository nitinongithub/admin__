<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('My_model', 'mm');
        if (! $this->session->userdata('ussr_')) {
            redirect(__BACKTOSITE__);
        }
    }

    function index() {
        $data['user___'] = $this->session->userdata('ussr_');

        $this->load->view('templates/header');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    function log__out() {
        $this->session->unset_userdata('ussr_');
        $this->session->unset_userdata('stss_');
        //$this->session->unset_userdata('_ADMIN_');
        //redirect(__BACKTOSITE__);
        redirect('login');
    }

}
