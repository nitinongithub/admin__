<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model_bday extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function students_bday_today() {
        $dt_ = date('d');
        $mnth_ = date('m');
        $this->db->where('MONTH(DOB)', $mnth_);
        $this->db->where('DAY(DOB)',$dt_);
        $this->db->where('STATUS', 1);
        $this->db->order_by('NAME_');
        $query = $this->db->get('bday_data');

        return $query->result();
    }

    
    function students_bday_this_week($diff_) {
        $datetime = new DateTime(date('Y/m/d'));
        $datetime->modify('+'.$diff_.' day');
        $next7thdaydate= $datetime->format('Y-m-d');
        $str_dt = explode('-',$next7thdaydate);

        $dt_ = $str_dt[2];
        $mnth_ = $str_dt[1];
        $yr_ = $str_dt[0];
        $dateupto = $yr_.'/'.$mnth_.'/'.$dt_;

        $this->db->where('DATE_FORMAT(CONCAT('.date('Y').', "/",MONTH(DOB),"/",DAY(DOB)),"%Y/%m/%d") >=', date('Y/m/d'));
        $this->db->where('DATE_FORMAT(CONCAT('.date('Y').', "/",MONTH(DOB),"/",DAY(DOB)),"%Y/%m/%d") <=', $dateupto);
        $this->db->where('STATUS', 1);
        $this->db->order_by('NAME_');
        $query = $this->db->get('bday_data');
        
        return $query->result();
    }
    

    

    function get_all_bdays() {
        $this->db->where('STATUS', 1);
        $this->db->order_by('BID', 'desc');
        $query = $this->db->get('bday_data');

        return $query->result();
    }

    function get_all_bdays_deactivated() {
        $this->db->where('STATUS', 0);
        $this->db->order_by('BID', 'desc');
        $query = $this->db->get('bday_data');

        return $query->result();
    }

    function getbdayData($bid__) {
        $this->db->where('BID', $bid__);
        $query = $this->db->get('bday_data');

        return $query->row();
    }

    function feedBday_() {
        $data = array(
            'NAME_' => $this->input->post('txtStudName'),
            'DOB' => $this->input->post('txtDOB_'),
            'PHOTO_' => 'x',
            'DOA' => date('Y-m-d H:i:s'),
            'STATUS' => 1,
            'USERNAME_' => $this->session->userdata('ussr_')
        );
        $query = $this->db->insert('bday_data', $data);

        if ($query == TRUE) {
            $id__ = $this->db->insert_id();
            $config = array(
                'upload_path' => './_assets_/stud_photo',
                'allowed_types' => 'jpg|png',
                'file_name' => $id__
            );
            $file_element_name = 'txtInputFile';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload($file_element_name)) {
                $path_ji = $this->upload->data();
                $path_ = $path_ji['file_name'];
            } else {
                $path_ = 'x';
            }

            if ($path_ != 'x') {
                $data = array(
                    'PHOTO_' => $path_
                );
                $this->db->where('BID', $id__);
                $query = $this->db->update('bday_data', $data);

                if ($query == TRUE) {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Birthday Record Submitted Successfully with photo !!');
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'Data submitted succesfully but something went wrong in updating photo. Please try again !!');
                }
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Data submitted succesfully but something went wrong in uploading photo. Please try again !!');
            }
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Something went wrong. Please try again !!');
        }
        return $bool_;
    }

    function update_bday($bid__) {
        $data = array(
            'NAME_' => $this->input->post('txtStudName'),
            'DOB' => $this->input->post('txtDOB_'),
            'DOA' => date('Y-m-d H:i:s'),
            'USERNAME_' => $this->session->userdata('ussr_')
        );
        $this->db->where('BID', $bid__);
        $query = $this->db->update('bday_data', $data);
        $id__ = $bid__;

        if ($query == TRUE) {
            $config = array(
                'upload_path' => './_assets_/stud_photo',
                'allowed_types' => 'jpg|png',
                'overwrite' => TRUE,
                'file_name' => $id__
            );
            $file_element_name = 'txtInputFile';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload($file_element_name)) {
                $path_ji = $this->upload->data();
                $path_ = $path_ji['file_name'];
            } else {
                $path_ = 'x';
            }

            if ($path_ != 'x') {
                $data = array(
                    'PHOTO_' => $path_
                );
                $this->db->where('BID', $id__);
                $query = $this->db->update('bday_data', $data);

                if ($query == TRUE) {
                    $bool_ = array('res_' => TRUE, 'msg_' => 'Birthday Record Updated Successfully with photo !!');
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'Data Updated succesfully but something went wrong in updating photo. Please try again !!');
                }
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Data Updated succesfully but without photo. Please try again (if needed) !!');
            }
        } else {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Something went wrong. Please try again !!');
        }
        return $bool_;
    }

    function delete_bday($bid__) {
        $this->db->where('BID', $bid__);
        $query = $this->db->get('bday_data');

        if ($query->num_rows() != 0) {
            $item_ = $query->row();

            if ($item_->PHOTO_ != 'x') {
                $file__ = $item_->PHOTO_;
            } else {
                $file__ = 'x';
            }
        }
        $this->db->where('BID', $bid__);
        $bool_ = $this->db->delete('bday_data');
        if ($bool_ == TRUE) {
            if ($file__ != 'x') {
                $full_path_ = FCPATH . '_assets_/stud_photo/' . $file__;
                @unlink($full_path_);
            }
        }
        return $bool_;
    }
}
