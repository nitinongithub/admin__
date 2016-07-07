<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('My_model', 'mm');
        if (! $this->session->userdata('_ADMIN_')) {
            //redirect(__BACKTOSITE__);
            $this->session->set_userdata('_ADMIN_', 'ok');
        }
    }

    function index() {
        $data['No-USER'] = $this->session->userdata('_ADMIN_');

        $this->load->view('templates/header');
        $this->load->view('login', $data);
        $this->load->view('templates/footer');
    }

    function sign_in_() {

        $res_ = $this->mm->login();

        if ($res_['bool_'] == TRUE) {
            $this->session->set_userdata('ussr_', $this->input->post('txtUsr'));
            $this->session->set_userdata('stss_', $res_['sts_']);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('feed_msg_', 'X: Wrong credentials found. Please try again!! ');
            redirect('login');
        }
    }

    function log__out() {
        $this->session->unset_userdata('ussr_');
        $this->session->unset_userdata('stss_');

        redirect(__BACKTOSITE__);
    }

}
