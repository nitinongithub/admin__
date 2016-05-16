<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('My_model_gallery', 'mmg');
    }
    function index() {
        $data['user___'] = $this->session->userdata('ussr_');
        $data['existing'] = $this->mmg->get_all_categories();
        $data['folder_'] = 'gallery';
        $data['page__'] = 'feedgallery';
        $data['page_head'] = 'Upload &amp; Manage Gallery';
        $data['view1'] = 'Updategallery';

        $this->load->view('templates/header');
        $this->load->view('inner', $data);
        $this->load->view('templates/footer');
    }

    function feedCategory() {
        $res_ = $this->mmg->feedCategory_();
        $this->session->set_flashdata('_msg_', $res_['msg_']);
        redirect('gallery');
    }

    function editCategory() {
        $res_ = $this->mmg->editCategory_();
        $this->session->set_flashdata('_msg_', $res_['msg_']);
        redirect('gallery');
    }

    function active_inactive($id_, $status) {
        $res_ = $this->mmg->active_inactive_($id_, $status);
        redirect('gallery');
    }

    function deleteCat($id_) {
        $res_ = $this->mmg->active_inactive_($id_, $status);
        redirect('gallery');
    }

    function getImages() {
        $data['existing'] = $this->mmg->getImagesByCat(trim($this->input->post('txtCategory')));
        echo json_encode($data['existing']);
    }

    function uploadGallery() {
        $data['existing'] = $this->mmg->uploadGallery_(trim($this->input->post('txtCategory')));
        echo json_encode($data['existing']);
        //redirect('admin_/gallery');
    }

    //---------------------------------------------------------------------------------------------

    function do_upload(){
        $this->mmg->do_upload();
        redirect('gallery');
    }

    function fillGallery($id_) {
        $data_to_ajax = $this->mmg->fillGallery($id_);
        echo $data_to_ajax;
    }

    function deleteimg() {
        $uploadpath = FCPATH . '_assets_/gallery/';
        $row = $this->mmg->deleteimg();

        $src = $uploadpath . $row['photo__'];
        @unlink($src);

        if($row['res_'] == TRUE){
            echo'<h4 style="color:green">This image deleted successfully</h4>';
        } else {
            echo'<h4 style="color:green">Some server error !! Please try again.</h4>';
        }
    }

    function activeImg() {
        $bool_ = $this->mmg->activeImg();

        if($bool_ == TRUE){
            echo'<h4 style="color:green">This image deleted successfully</h4>';    
        } else {
            echo'<h4 style="color:green">Some server error !! Please try again.</h4>';    
        }
    }

    function InactiveImg() {
        $bool_ = $this->mmg->InactiveImg();

        if($bool_ == TRUE){
            echo'<h4 style="color:green">This image deleted successfully</h4>';    
        } else {
            echo'<h4 style="color:green">Some server error !! Please try again.</h4>';    
        }
    }

}
