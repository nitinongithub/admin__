<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bday extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('My_model_bday', 'mmb');
        if (! $this->session->userdata('ussr_')) {
            redirect(__BACKTOSITE__);
        }
    }
    function bDay() {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['bday_'] = $this->mmb->get_all_bdays();
        //$data['today_'] = $this->mmb->students_bday_today();
        $data['today_'] = $this->mmb->students_bday_this_week(7);
        $data['deactivebday_'] = $this->mmb->get_all_bdays_deactivated();
        $data['folder_'] = 'bday';
        $data['page__'] = 'feedbday';
        $data['page_head'] = 'Feed Birthday';
        $data['view1'] = 'viewbday_active';
        $data['view2'] = 'viewbday_deactive';
        $data['view3'] = 'viewbday_deactivated';
        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }

    function feedBday() {
        $res_ = $this->mmb->feedBday_();
        $this->session->set_flashdata('_msg_', $res_['msg_']);
        redirect('bday/bDay');
    }

    function active_deactive_bday($bid__, $status_) {
        $res_ = $this->mmb->active_deactive_bday($bid__, $status_);
        $this->session->set_flashdata('feed_msg_', $res_['msg_']);

        redirect('bday/bDay/' . $bid__);
    }

    function edit_bday($bid__) {
        $data['record_'] = $this->mmb->getbdayData($bid__);

        $data['user___'] = $this->session->userdata('ussr_');
        $data['bday_'] = $this->mmb->get_all_bdays();
        $data['today_'] = $this->mmb->students_bday_this_week(7);
        $data['deactivebday_'] = $this->mmb->get_all_bdays_deactivated();
        $data['folder_'] = 'bday';
        $data['page_head'] = 'Update Birthday';
        $data['view1'] = 'viewbday_active';
        $data['view2'] = 'viewbday_deactive';
        $data['view3'] = 'viewbday_deactivated';
        $this->load->view('templates/header');
        $this->load->view('editbday', $data);
        $this->load->view('templates/footer');
    }

    function updateBday($bid__) {
        $res_ = $this->mmb->update_bday($bid__);
        $this->session->set_flashdata('feed_msg_', $res_['msg_']);

        redirect('bday/edit_bday/' . $bid__);
    }

    function delete_bday($bid__) {
        $res_ = $this->mmb->delete_bday($bid__);
        if ($res_ == TRUE) {
            $this->session->set_flashdata('feed_msg_', 'Data deleted Successfully !!');
        } else {
            $this->session->set_flashdata('feed_msg_', 'Server Error!! Data not deleted. PLease try again !!');
        }

        redirect('bday/bDay');
    }
}
