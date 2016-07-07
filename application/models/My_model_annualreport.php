<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model_annualreport extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function feedReport_() {
        $data = array(
            'PATH' => 'x',
            'YEAR' => $this->input->post('txtReportYear'),
            'STATUS_' => '1',
        );
        $query = $this->db->insert('annual_report', $data);

        if ($query == TRUE) {
            $id__ = $this->db->insert_id();
            $config = array(
                'upload_path' => './_assets_/annualReport',
                'allowed_types' => 'doc|docx|pdf',
                'file_name' => $id__
            );
            $file_element_name = 'txtInputproductImage';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload($file_element_name)) {
                $path_ji = $this->upload->data();
                $path_ = $path_ji['file_name'];
            } else {
                $path_ = 'x';
            }

            if ($path_ != 'x') {
                $data = array(
                    'PATH' => $path_
                );
                $this->db->where('ID', $id__);
                $query = $this->db->update('annual_report', $data);

                if ($query == TRUE) {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Annual Report Submitted Successfully with File !!');
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'Annual Report Submitted but something went wrong in updating file. Please try again !!');
                }
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Data submitted succesfully but something went wrong in uploading file. Please try again !!');
            }
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Something went wrong. Please try again !!');
        }
        return $bool_;
    }

    function updateReport_() {
        $id_ = $this->input->post('txtID_edit');
        $data = array(
            'YEAR' => $this->input->post('txtReportYear_edit'),
        );

        $this->db->where('ID', $id_);
        $query = $this->db->update('annual_report', $data);

        if ($query == TRUE) {
            $id__ = $id_;
            //----------------------------------Logo
            if (!isset($_FILES['txtInputproductImage_EDIT']) || $_FILES['txtInputproductImage_EDIT']['error'] == UPLOAD_ERR_NO_FILE) {
                //---------------yet to code
            } else {
                //----------------------------------Delete Previous Logo
                $this->db->where('ID', $id__);
                $query = $this->db->get('annual_report');

                if ($query->num_rows() != 0) {
                    $item_ = $query->row();

                    if ($item_->PATH != 'x') {
                        $file__ = $item_->PATH;
                    } else {
                        $file__ = 'x';
                    }
                }
                if ($file__ != 'x') {
                    echo $full_path_ = FCPATH . '_assets_/annualReport/' . $file__;
                    @unlink($full_path_);
                }

                //-----------------------------Add New Logo
                $config = array(
                    'upload_path' => './_assets_/annualReport',
                    'allowed_types' => 'doc|docx|pdf',
                    'file_name' => $id__
                );
                $file_element_name = 'txtInputproductImage_EDIT';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload($file_element_name)) {
                    $path_ji = $this->upload->data();
                    $path_ = $path_ji['file_name'];
                } else {
                    $path_ = 'x';
                }

                if ($path_ != 'x') {
                    $data = array(
                        'PATH' => $path_
                    );
                    $this->db->where('ID', $id__);
                    $query = $this->db->update('annual_report', $data);
                }
            }
            $bool_ = array('res_' => TRUE, 'msg_' => 'Annual Report Successfully Updated !!');
        } else {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Something went wrong. Please try again !!');
        }
        return $bool_;
    }

    function get_all_reports() {
        $this->db->order_by('ID', 'asc');
        $query = $this->db->get('annual_report');
        return $query->result();
    }

    function delete_Report_($id_) {
        
        //----------------------------------Delete Previous Logo
        $this->db->where('ID', $id_);
        $query = $this->db->get('annual_report');

        if ($query->num_rows() != 0) {
            $item_ = $query->row();

            if ($item_->PATH != 'x') {
                $file__ = $item_->PATH;
            } else {
                $file__ = 'x';
            }
        }
        if ($file__ != 'x') {
            echo $full_path_ = FCPATH . '_assets_/annualReport/' . $file__;
            @unlink($full_path_);
        }

        $this->db->where('ID', $id_);
        $query = $this->db->delete('annual_report');        
    } 
    
    function active_inactive_($id_,$status) {
        $data = array(
            'STATUS_'=>$status,
        );
        $this->db->where('ID', $id_);
        $query = $this->db->update('annual_report', $data);        
    }   
}
