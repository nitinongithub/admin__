<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model_tc extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function uploadTC() {
        $tcno_ = $this->input->post('txtTCno');
        $rollno_ = $this->input->post('txtRollNo');
        $fname_ = $this->input->post('txtFName');
        $mname_ = $this->input->post('txtMName');
        $lname_ = $this->input->post('txtLName');
        $adm_date = $this->input->post('txtAdmissionDate');
        $adm_class = $this->input->post('txtAdmissionClass');
        $leave_date = $this->input->post('txtLeavingDate');
        $leave_class = $this->input->post('txtLeavingClass');

        $this->db->where('TC_NO', $tcno_);
        $this->db->or_where('ROLLNO', $tcno_);
        $query = $this->db->get('transfer_certificate');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'For this <b style="color:#0000ff">Roll no/ TC No</b> was Already uploaded');
        } else {
            $data = array(
                'TC_NO' => $tcno_,
                'ROLLNO' => $rollno_,
                'FNAME' => $fname_,
                'MNAME' => $mname_,
                'LNAME' => $lname_,
                'ADMISSION_DATE' => $adm_date,
                'ADMISSION_CLASS' => $adm_class,
                'LEAVING_DATE' => $leave_date,
                'LEAVING_CLASS'	=> $leave_class,
                'USERNAME_' => $this->session->userdata('ussr_')
            );
            $query_ = $this->db->insert('transfer_certificate', $data);

            if ($query_ == TRUE) {
                $id__ = $this->db->insert_id();
                $path_ = $this->upload_tc_file($id__);
                if ($path_ != 'x') {
                    $data = array(
                    	'TCID'	=> $id__,
                    	'TC_NO'	=> $tcno_,
                        'ATTACH_PATH' => $path_,
                        'DATE_'	=> date('Y-m-d H:i:s'),
                        'STATUS_'	=> 1,
                        'USERNAME_'	=> $this->session->userdata('ussr_')
                    );
                    $query = $this->db->insert('tc_paths', $data);

                    if ($query == TRUE) {
                        $bool_ = array('res_' => TRUE, 'msg_' => 'TC Uploaded Successfully !!');
                    } else {
                        $bool_ = array('res_' => FALSE, 'msg_' => 'TC record Updated succesfully but something went wrong in uploading TC file. Please update the TC copy immediately !!');
                    }
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'TC record Updated succesfully but without TC file. Please update the TC copy immediately!!');
                }
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Something goes wrong. Please try again !!');
            }
        }
        return $bool_;
    }

    function upload_tc_file($id__) {
        $config1 = array(
            'upload_path' => './_assets_/tc',
            'allowed_types' => 'jpg|png|bmp|gif',
            'overwrite' => TRUE,
            'file_name' => $id__
        );
        $file_element_name = 'txtInputFileTC';
        $this->load->library('upload', $config1);
        $this->upload->initialize($config1);

        if ($this->upload->do_upload($file_element_name)) {
            $path_ji = $this->upload->data();
            $path_ = $path_ji['file_name'];
        } else {
            $path_ = 'x';
        }

        return $path_;
    }

    function getTC_data($limit__, $year__){
        $this->db->select('a.*, b.ATTACH_PATH, b.STATUS_');
        $this->db->from('transfer_certificate a');
        $this->db->join('tc_paths b', 'a.TCID = b.TCID');
        $this->db->where('YEAR(b.DATE_)', $year__);
        $query = $this->db->get();

        echo $this->db->last_query();
        die();
    }
}