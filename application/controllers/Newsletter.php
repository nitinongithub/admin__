<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('My_model_newsletter', 'mmnwl');
    }

    function newsletters() {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['newsletter_'] = $this->mmnwl->get_active_newsletter();
        $data['newsletter_d'] = $this->mmnwl->get_deactive_newsletter();
        $data['folder_'] = 'newsletter';
        $data['page__'] = 'feednewsletter';
        $data['page_head'] = 'Upload &amp; Manage Newsletters';
        $data['view1'] = 'viewnewsletter_active';
        $data['view2'] = 'viewnewsletter_deactive';

        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }

    function upload_newsletter() {
        $res_ = $this->mmnwl->upload_newsletter();
        $this->session->set_flashdata('_msg_', $res_['msg_']);
        redirect('newsletter/newsletters');
    }

    function active_deactive_newsletter($id_, $status_) {
        $res_ = $this->mmnwl->active_deactive_newsletter($id_, $status_);
        if ($res_ == TRUE) {
            if ($status_ == 1) {
                $this->session->set_flashdata('error_msg_', 'News Activated Successfully');
            } else {
                $this->session->set_flashdata('error_msg_', 'News Deactivated Successfully');
            }
        } else {
            $this->session->set_flashdata('error_msg_', 'Something went wrong. Please try again !!');
        }
        redirect('newsletter/newsletters');
    }

    function edit_newsletter($id__) {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['newsletter_edit'] = $this->mmnwl->get_newsletter_for_edit($id__);
        $data['newsletter_'] = $this->mmnwl->get_active_newsletter();
        $data['newsletter_d'] = $this->mmnwl->get_deactive_newsletter();
        $data['edit_page_heading'] = 'Update Newsletter';
        $data['folder_'] = 'newsletter';
        $data['page__'] = 'feednewsletter';
        $data['page_head'] = 'Upload &amp; Manage Newsletters';
        $data['edit_page'] = "newsletter/editnewsletter";

        $data['view1'] = 'newsletter/viewnewsletter_active';
        $data['view2'] = 'newsletter/viewnewsletter_deactive';
        $this->load->view('templates/header');
        $this->load->view('edit', $data);
        $this->load->view('templates/footer');
    }

    function update_newsletter($id__) {
        $res_ = $this->mmnwl->updateNewsletter_($id__);
        echo $this->session->set_flashdata('error_msg_', $res_['msg_']);
        redirect('newsletter/edit_newsletter/' . $id__);
    }

    function delete_newsletter($id_) {
        $res_ = $this->mmnwl->delete_newsletter($id_);
        if ($res_ == TRUE) {
            $this->session->set_flashdata('error_msg_', 'Newsletter deleted Successfully');
        } else {
            $this->session->set_flashdata('error_msg_', 'Something went wrong. Please try again !!');
        }
        redirect('newsletter/newsletters');
    }
}



