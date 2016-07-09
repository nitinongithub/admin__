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
        $data['page_head'] = 'Create &amp; Manage Users';
        
        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }
    
    function create_user(){
        $result = $this->cu->create_user();
        $this->session->set_flashdata('feed_msg_', $result['msg_']);
        redirect('createuser');
    }

    function active_inactive($username, $block){
        $result = $this->cu->active_inactive($username, $block);
        $this->session->set_flashdata('feed_msg_', $result['msg_']);
        redirect('createuser');
    }

    function deleteuser($username){
    	$result = $this->cu->delete_user($username);
        $this->session->set_flashdata('msg_delete_', $result['msg_']);
        redirect('createuser');
    }
}