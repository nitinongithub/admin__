<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model_gallery extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_categories() {
        $this->db->order_by('CATEG_ID', 'desc');
        $query = $this->db->get('gallery_category');
        return $query->result();
    }

    function feedCategory_() {
        $data = array(
            'CATEGORY' => $this->input->post('txtCategory'),
            'DESC' => $this->input->post('txtDesc'),
            'STATUS' =>1,
        );
        $query = $this->db->insert('gallery_category', $data);
        $id__ = $this->db->insert_id();

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Category Feeded Successfully');
        } else {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Something went wrong. Please try again !!');
        }
        return $bool_;
    }

    function editCategory_() {
        $id_ = $this->input->post('txtID_edit');
        $data = array(
            'CATEGORY' => $this->input->post('txtCategory_edit'),
            'DESC' => $this->input->post('txtDesc_edit'),
        );
        $this->db->where('CATEG_ID', $id_);
        $query = $this->db->update('gallery_category', $data);

        if ($query == TRUE) {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Category Updated Successfully');
        } else {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Something went wrong. Please try again !!');
        }
        return $bool_;
    }
    
    function active_inactive_($id_,$status) {
        $data = array(
            'STATUS'=>$status,
        );
        $this->db->where('CATEG_ID', $id_);
        $query = $this->db->update('gallery_category', $data);        
    }    

    function deletecateg($id_){
        $this->db->where('CATEG_ID', $id_);
        $query = $this->db->delete('gallery_category');

        if($query == TRUE){
            $bool_ = array('res_'=>TRUE, 'msg_'=> 'Category Deleted successfully.');
        } else {
            $bool_ = array('res_'=>TRUE, 'msg_'=> 'Something goes wrong. Please try again !!');
        }

        return $bool_;
    }
    
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
                    'STATUS'    => 1,
                    'USERNAME_' => $this->session->userdata('ussr_')
                );
                $this->db->insert('gallery', $data);
            }
            //echo'<h4 style="color:green">Image uploaded Succesfully</h4>';
        }
    }

    function fillGallery($id_){
        $data_ = '';
        $uploadpath = base_url() . '_assets_/gallery/';

        $this->db->where('CATEG_ID', $id_);
        $rs = $this->db->get('gallery');

        if ($rs->num_rows() != 0) {
            foreach ($rs->result() as $row) {
                $src = $uploadpath . $row->PHOTO_;
                $alt = $row->PHOTO_;
                $lid = $row->GL_ID . 'g';
                $data_ = $data_ .  "<li class='thumbnail' id='$lid'>
                            <span id='$row->GL_ID' class='btn btn-info btn-block btn-delete'><i class='glyphicon glyphicon-remove'></i>&nbsp;&nbsp;&nbsp;Delete</span>
                            <img src='$src' alt='$alt' style='max-height:100px;'>";
                if ($row->STATUS != 0) {
                    $data_ = $data_ . "<span id='$row->GL_ID' class='btn btn-success btn-block btn-active'>&nbsp;&nbsp;&nbsp;ACTIVE</span>";
                } else {
                    $data_ = $data_ .  "<span id='$row->GL_ID' class='btn btn-danger btn-block btn-inactive'>&nbsp;&nbsp;&nbsp;INACTIVE</span>";
                }
            }
        } else {
            $data_ = "<li class='thumbnail' style='color:red'>
                           No Images have been added to this gallery</li>";
        }
        return $data_;
    }

    function deleteimg() {
        $this->db->where('GL_ID', $this->input->post('id'));
        $query = $this->db->get('gallery');
        if($query->num_rows() != 0){
            $row = $query->row();
            $bool_ = array('res_'=>TRUE, 'photo__' => $row->PHOTO_);

            $this->db->where('GL_ID', $this->input->post('id'));
            $this->db->delete('gallery');
        } else {
            $bool_ = array('res_'=>FALSE, 'photo__' => 'X');
        }
        return $bool_;
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