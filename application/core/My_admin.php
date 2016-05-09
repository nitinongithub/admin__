<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        //if (!$this->session->userdata('ussr_')) {
            //redirect(__BACKTOSITE__);
        //}
    }

    /*
    function index() {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['news_'] = $this->mm->get_all_news();
        $data['news_d'] = $this->mm->get_all_news_deactive();

        $this->load->view('templates/header');
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }
    */

    function log__out() {
        $this->session->unset_userdata('ussr_');
        $this->session->unset_userdata('stss_');

        redirect(__BACKTOSITE__);
    }

}
