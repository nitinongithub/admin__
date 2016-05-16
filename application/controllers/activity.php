<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('My_model_activities', 'mma');
    }

    function index(){
    	$data['user___'] = $this->session->userdata('ussr_');
        $data['activity_'] = $this->mma->get_active_activities();
        $data['activity_d'] = $this->mma->get_deactive_activities();
        $data['folder_'] = 'activities';
        $data['page__'] = 'feedactivity';
        $data['page_head'] = 'Upload &amp; Manage Activity';
        $data['view1'] = 'viewactivities_active';
        $data['view2'] = 'viewactivities_deactive';

        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }
    function feedactivity(){
    	$res_ = $this->mma->feedactivity();

        $this->session->set_flashdata('feed_msg_', $res_['msg_']);
        redirect('activity');
    }
    function active_deactive_activity($id_, $st_){
        $res_ = $this->mma->active_deactive_activity($id_, $st_);
        if($st_ == 0){
            $this->session->set_flashdata('feed_msg_', 'Successfully de-activated.');
        } else {
            $this->session->set_flashdata('feed_msg_', 'Successfully activated.');
        }
        redirect('activity');   
    }
    function editactivity($id_){
        $data['user___'] = $this->session->userdata('ussr_');
        $data['activity_'] = $this->mma->get_active_activities();
        $data['activity_d'] = $this->mma->get_deactive_activities();
        $data['edit_activity_'] = $this->mma->get_activity_detail($id_);

        $data['folder_'] = 'activities';
        $data['page__'] = 'editactivity';
        $data['page_head'] = 'Update Activity';
        $data['view1'] = 'viewactivities_active';
        $data['view2'] = 'viewactivities_deactive';

        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');

    }
    function updateactivity($id_){
        $res_ = $this->mma->updateactivity($id_);

        $this->session->set_flashdata('feed_msg_', $res_['msg_']);
        redirect('activity/editactivity/'.$id_);
    }
    function deleteactivity($id_){
        $query = $this->mma->deleteactivity($id_);
        redirect('activity');
    }
}