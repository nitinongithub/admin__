<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Newsevents extends my_admin {

    function __construct() {
        parent::__construct();
        //if (!$this->session->userdata('ussr_')) {
            //redirect(__BACKTOSITE__);
        //}
    }

    function index() {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['news_'] = $this->mm->get_all_news();
        $data['news_d'] = $this->mm->get_all_news_deactive();

        $this->load->view('templates/header');
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }

    function edit_news_events($id__) {
        $data['record_'] = $this->mm->get_news_events_for_edit($id__);

        $data['user___'] = $this->session->userdata('ussr_');
        $data['news_'] = $this->mm->get_all_news();
        $data['news_d'] = $this->mm->get_all_news_deactive();
        $data['edit_page_heading'] = 'Update News &amp; Events';
        $data['edit_page'] = "newsevents/editnews";
        $data['view1'] = "newsevents/viewnews_active";
        $data['view2'] = "newsevents/viewnews_deactive";

        $this->load->view('templates/header');
        $this->load->view('edit', $data);
        $this->load->view('templates/footer');
    }

    function updateNews($id__) {
        $res_ = $this->mm->updateNews_($id__);
        $this->session->set_flashdata('feed_msg_', $res_['msg_']);
        redirect('newsevents/edit_news_events/' . $id__);
    }

    function active_deactive_news($id_, $status_) {
        $res_ = $this->mm->active_deactive_news($id_, $status_);
        if ($res_ == TRUE) {
            if ($status_ == 1) {
                $this->session->set_flashdata('error_msg_', 'News Activated Successfully');
            } else {
                $this->session->set_flashdata('error_msg_', 'News Deactivated Successfully');
            }
        } else {
            $this->session->set_flashdata('error_msg_', 'Something went wrong. Please try again !!');
        }
        redirect('newsevents');
    }

    function feedNews() {
        $res_ = $this->mm->feedNews_();
        $this->session->set_flashdata('feed_msg_', $res_['msg_']);
        redirect('newsevents');
    }

    function delete_news_events($id_) {
        $res_ = $this->mm->delete_news_events($id_);
        if ($res_ == TRUE) {
            $this->session->set_flashdata('error_msg_', 'News Deleted Successfully');
        } else {
            $this->session->set_flashdata('error_msg_', 'Something went wrong. Please try again !!');
        }
        redirect('newsevents');
    }

    function delete_attachment($id__) {
        $res_ = $this->mm->delete_attach_news($id__);

        if ($res_ == TRUE) {
            $this->session->set_flashdata('error_msg_', 'News Attachment Deleted Successfully');
        } else {
            $this->session->set_flashdata('error_msg_', 'Something went wrong. Please try again !!');
        }
        redirect('newsevents');
    }
}