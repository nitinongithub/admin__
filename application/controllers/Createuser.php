<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Createuser extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('My_model_create_user', 'cu');
        if (! $this->session->userdata('ussr_')) {
            redirect(__BACKTOSITE__);
        }
    }

    function index(){
    	$data['user___'] = $this->session->userdata('ussr_');
        $data['users_'] = $this->cu->get_all_users();
        
        $data['folder_'] = 'createuser';
        $data['page__'] = 'index';
        $data['page_head'] = 'Create &amp; Manage New User';
        
        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }

    function blockme($username, $block){

    }

    function edituser($username){

    }

    function deleteuser($username){
    	
    }
}