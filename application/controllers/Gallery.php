<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends my_admin {

    function index() {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['existing'] = $this->mm->get_all_categories();
        $data['folder_'] = 'gallery';
        $data['page__'] = 'feedgallery';
        $data['page_head'] = 'Upload &amp; Manage Gallery';
        $data['view1'] = 'Updategallery';

        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }

    function feedCategory() {
        $res_ = $this->mm->feedCategory_();
        $this->session->set_flashdata('_msg_', $res_['msg_']);
        redirect('gallery');
    }

    function editCategory() {
        $res_ = $this->mm->editCategory_();
        $this->session->set_flashdata('_msg_', $res_['msg_']);
        redirect('gallery');
    }

    function active_inactive($id_, $status) {
        $res_ = $this->mm->active_inactive_($id_, $status);
        redirect('gallery');
    }

    function deleteCat($id_) {
        $res_ = $this->mm->active_inactive_($id_, $status);
        redirect('gallery');
    }

    function getImages() {
        $data['existing'] = $this->mm->getImagesByCat(trim($this->input->post('txtCategory')));
        echo json_encode($data['existing']);
    }

    function uploadGallery() {
        $data['existing'] = $this->mm->uploadGallery_(trim($this->input->post('txtCategory')));
        echo json_encode($data['existing']);
        //redirect('admin_/gallery');
    }

    //---------------------------------------------------------------------------------------------
    public function do_upload() {
        $config['upload_path'] = './_assets_/gallery';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '204800';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            foreach ($error as $item => $value) {
                echo'<ol class="alert alert-danger"><li>' . $value . '</ol></li>';
            }
            exit;
        } else {
            $upload_data = array('upload_data' => $this->upload->data());
            foreach ($upload_data as $key => $value) {

                $id_ = $this->input->post('txtCategory');

                $image = $value['file_name'];
                $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value['file_name']);

                $data = array(
                    'PHOTO_' => $image,
                    'TITLE_' => 'x',
                    'WIDTH_' => 'x',
                    'HEIGHT_' => 'x',
                    'CATEG_ID' => $id_,
                    'USERNAME_' => $this->session->userdata('ussr_')
                );
                $this->db->insert('gallery', $data);
            }
            echo'<h4 style="color:green">Image uploaded Succesfully</h4>';
            redirect('gallery');
        }
    }

    function fillGallery($id_) {
        $uploadpath = base_url() . '_assets_/gallery/';

        $this->db->where('CATEG_ID', $id_);

        $rs = $this->db->get('gallery');
        if ($rs->num_rows() != 0) {
            foreach ($rs->result() as $row) {
                $src = $uploadpath . $row->PHOTO_;
                $alt = $row->PHOTO_;
                $lid = $row->GL_ID . 'g';
                echo "<li class='thumbnail' id='$lid'>
                            <span id='$row->GL_ID' class='btn btn-info btn-block btn-delete'><i class='glyphicon glyphicon-remove'></i>&nbsp;&nbsp;&nbsp;Delete</span>
                            <img src='$src' alt='$alt' style='max-height:100px;'>";
                if ($row->STATUS != 0) {
                    echo "<span id='$row->GL_ID' class='btn btn-success btn-block btn-active'>&nbsp;&nbsp;&nbsp;ACTIVE</span>";
                } else {
                    echo "<span id='$row->GL_ID' class='btn btn-danger btn-block btn-inactive'>&nbsp;&nbsp;&nbsp;INACTIVE</span>";
                }
            }
        } else {
            echo "<li class='thumbnail' style='color:red'>
                           No Images have been added to this gallery</li>";
        }
    }

    function deleteimg() {
        $uploadpath = FCPATH . '_assets_/gallery/';

        $this->db->where('GL_ID', $this->input->post('id'));
        $query = $this->db->get('gallery');
        foreach ($query->result() as $row) {
            $src = $uploadpath . $row->PHOTO_;
            @unlink($src);
        }

        $this->db->where('GL_ID', $this->input->post('id'));
        $this->db->delete('gallery');

        echo'<h4 style="color:green">This image deleted successfully</h4>';
    }

    function activeImg() {
        $data = array(
            'STATUS' => 0,
        );
        $this->db->where('GL_ID', $this->input->post('id'));
        $query = $this->db->update('gallery', $data);

        echo'<h4 style="color:green">This image deleted successfully</h4>';
    }

    function InactiveImg() {
        $data = array(
            'STATUS' => 1,
        );
        $this->db->where('GL_ID', $this->input->post('id'));
        $query = $this->db->update('gallery', $data);

        echo'<h4 style="color:green">This image deleted successfully</h4>';
    }

}
