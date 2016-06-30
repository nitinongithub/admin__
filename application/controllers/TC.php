<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tc extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('My_model_tc', 'mtc');
        if (! $this->session->userdata('ussr_')) {
            redirect(__BACKTOSITE__);
        }
    }

    function index($limit=-1, $year__='x'){

        if($year__ == 'x'){ $year__=date('Y'); }
    	
        $data['user___'] = $this->session->userdata('ussr_');
        $data['tcData'] = $this->mtc->getTC_data($limit, $year__);
        $data['thisYear'] = $year__;
        $data['limit_'] = $limit;
        $data['folder_'] = 'tc';
        $data['page__'] = 'feedtc';
        $data['page_head'] = 'Upload &amp; Manage TC';
        $data['view1'] = 'viewatc_';

        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }
    function uploadTC(){
        $res_ = $this->mtc->uploadTC();
        $this->session->set_flashdata('feed_msg_', $res_['msg_']);

        redirect('tc');
    }
    
    function viewTC(){
        $limit__ = $this->input->post('cmbLimit');
        $year__ = $this->input->post('cmbYear');

        redirect('tc/index/'.$limit__.'/'.$year__);
    }
    
    function edit_tc($id__, $year__, $limit__){
        
        $data['user___'] = $this->session->userdata('ussr_');
        $data['tcEditData'] = $this->mtc->get_specific_TC_data($id__);
        $data['tcData'] = $this->mtc->getTC_data(-1, $year__);
        $data['thisYear'] = $year__;
        $data['limit_'] = $limit__;
        $data['folder_'] = 'tc';
        $data['page__'] = 'edit_tc';
        $data['page_head'] = 'Update TC';
        $data['view1'] = 'viewatc_';

        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }
    function updateTC($id_, $suubid_, $year__, $limit__){
        $res_ = $this->mtc->update_TC($id_, $suubid_);
        $this->session->set_flashdata('feed_msg_', $res_['msg_']);

        redirect('tc/edit_tc/' . $id_ . '/'. $year__.'/'.$limit__);
    }
    function del_tc($id__){
        $res_ = $this->mtc->delete_tc($id__);
        if($res_ == TRUE){
            $this->session->set_flashdata('feed_msg_', 'TC deleted successfully.');
        } else {
            $this->session->set_flashdata('feed_msg_', 'Something goes wrong. Try again !!');
        }

        redirect('tc');
    }
}