<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends my_admin {

    function __construct() {
        parent::__construct();
    }

    function newsletters() {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['newsletter_'] = $this->mm->get_active_newsletter();
        $data['newsletter_d'] = $this->mm->get_deactive_newsletter();
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
        $res_ = $this->mm->upload_newsletter();
        $this->session->set_flashdata('_msg_', $res_['msg_']);
        redirect('admin_/newsletters');
    }

    function active_deactive_newsletter($id_, $status_) {
        $res_ = $this->mm->active_deactive_newsletter($id_, $status_);
        if ($res_ == TRUE) {
            if ($status_ == 1) {
                $this->session->set_flashdata('error_msg_', 'News Activated Successfully');
            } else {
                $this->session->set_flashdata('error_msg_', 'News Deactivated Successfully');
            }
        } else {
            $this->session->set_flashdata('error_msg_', 'Something went wrong. Please try again !!');
        }
        redirect('admin_/newsletters');
    }

    function edit_newsletter($id__) {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['newsletter_edit'] = $this->mm->get_newsletter_for_edit($id__);
        $data['newsletter_'] = $this->mm->get_active_newsletter();
        $data['newsletter_d'] = $this->mm->get_deactive_newsletter();
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
        $res_ = $this->mm->updateNewsletter_($id__);
        echo $this->session->set_flashdata('error_msg_', $res_['msg_']);
        redirect('admin_/edit_newsletter/' . $id__);
    }

    function delete_newsletter($id_) {
        $res_ = $this->mm->delete_newsletter($id_);
        if ($res_ == TRUE) {
            $this->session->set_flashdata('error_msg_', 'Newsletter deleted Successfully');
        } else {
            $this->session->set_flashdata('error_msg_', 'Something went wrong. Please try again !!');
        }
        redirect('admin_/newsletters');
    }
}



