<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AnnualReport extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('My_model_annualreport', 'mmar');
    }

    function index() {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['existing'] = $this->mmar->get_all_reports();
        
        $data['folder_'] = 'annualReport';
        $data['page__'] = 'feedreport';
        $data['page_head'] = 'Feed Annual Report';
        
        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }


    function updateReport() {
        $res_ = $this->mmar->updateReport_();
        $this->session->set_flashdata('feed_msg_', $res_['msg_']);
        redirect('annualReport');
    }
    
    function feedReport() {
        $res_ = $this->mmar->feedReport_();
        $this->session->set_flashdata('feed_msg_', $res_['msg_']);
        redirect('annualReport');
    }

    function delete_Report($id_) {
        $res_ = $this->mmar->delete_Report_($id_);
        if ($res_ == TRUE) {
            $this->session->set_flashdata('error_msg_', 'Annual Report Deleted Successfully');
        } else {
            $this->session->set_flashdata('error_msg_', 'Something went wrong. Please try again !!');
        }
        redirect('annualReport');
    }  
    function active_inactive($id_, $status) {
        $res_ = $this->mmar->active_inactive_($id_, $status);
        redirect('annualReport');
    }
}