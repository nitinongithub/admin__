<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TC extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('My_model_tc', 'mtc');
    }

    function index(){
    	$data['user___'] = $this->session->userdata('ussr_');
        //$data['tc_'] = $this->mtc->get_active_activities();
        //$data['tc_d'] = $this->mtc->get_deactive_activities();
        $data['folder_'] = 'tc';
        $data['page__'] = 'feedtc';
        $data['page_head'] = 'Upload &amp; Manage TC';
        $data['view1'] = 'viewatc_';

        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }
    function feedTC(){
        //yet to code
    }
}