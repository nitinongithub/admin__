<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model_newsletter extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	function upload_newsletter() {
        $title_ = $this->input->post('txtTitle');
        $year_ = $this->input->post('cmbYear');
        $volume_ = $this->input->post('cmbVolume');

        $this->db->where('YEAR_', $year_);
        $this->db->where('VOLUME_', $volume_);
        $query = $this->db->get('newsletter');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Newsletter having Volume ' . $volume_ . ' for the year ' . $year_ . ' already exists. Please try another volume for ' . $year_ . '.');
        } else {
            $data = array(
                'TITLE_' => $title_,
                'VOLUME_' => $volume_,
                'COVER_' => 'x',
                'PATH_' => 'x',
                'DATE_' => date('Y-m-d H:i:s'),
                'YEAR_' => $year_,
                'USERNAME_' => $this->session->userdata('ussr_'),
                'STATUS_' => 1
            );
            $query_ = $this->db->insert('newsletter', $data);

            if ($query_ == TRUE) {
                $id__ = $this->db->insert_id();
                $path_ = $this->upload_newsletter_file($id__);
                if ($path_ != 'x') {
                    $data = array(
                        'PATH_' => $path_
                    );
                    $this->db->where('NID', $id__);
                    $query = $this->db->update('newsletter', $data);

                    if ($query == TRUE) {
                        $boolean_ = $this->upload_newletter_front_cover($id__);

                        if ($boolean_ == TRUE) {
                            $bool_ = array('res_' => TRUE, 'msg_' => 'Newsletter Uploaded Successfully !!');
                        } else {
                            $bool_ = array('res_' => TRUE, 'msg_' => 'Newsletter Uploaded Successfully without front cover !!');
                        }
                    } else {
                        $bool_ = array('res_' => FALSE, 'msg_' => 'Newsletter record Updated succesfully but something went wrong in uploading newsletter file. Please try again !!');
                    }
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'Newsletter record Updated succesfully but without newsletter file. Please try again (if needed) !!');
                }
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Something goes wrong. Please try again !!');
            }
        }
        return $bool_;
    }

    function upload_newsletter_file($id__) {
        $config1 = array(
            'upload_path' => './_assets_/newsletters',
            'allowed_types' => 'jpg|png|docx|doc|pdf',
            'overwrite' => TRUE,
            'file_name' => $id__
        );
        $file_element_name = 'txtInputFile';
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

    function upload_newletter_front_cover($id__) {
        $file_name_ = "front_" . $id__;

        $config2 = array(
            'upload_path' => './_assets_/newsletters/fronts',
            'allowed_types' => 'jpg|png|gif',
            'overwrite' => TRUE,
            'file_name' => "'" . $file_name_ . "'"
        );
        $this->upload->initialize($config2);

        $file_element_name = 'txtInputFileFront';
        $this->load->library('upload', $config2);

        if ($this->upload->do_upload($file_element_name)) {
            $path_ji_ = $this->upload->data();
            $path__ = $path_ji_['file_name'];
        } else {
            $path__ = 'x';
        }

        if ($path__ != 'x') {
            $data = array(
                'COVER_' => $path__
            );
            $this->db->where('NID', $id__);
            $query = $this->db->update('newsletter', $data);
            $bool_ = TRUE;
        } else {
            $bool_ = FALSE;
        }

        return $bool_;
    }

    function get_newsletter_for_edit($id__) {
        $this->db->where('NID', $id__);
        $query = $this->db->get('newsletter');

        return $query->row();
    }

    function get_active_newsletter() {
        $this->db->where('STATUS_', 1);
        $this->db->order_by('YEAR_', 'desc');
        $this->db->order_by('VOLUME_', 'desc');
        $query = $this->db->get('newsletter');

        return $query->result();
    }

    function get_deactive_newsletter() {
        $this->db->where('STATUS_', 0);
        $this->db->order_by('YEAR_', 'desc');
        $this->db->order_by('VOLUME_', 'desc');
        $query = $this->db->get('newsletter');

        return $query->result();
    }

    function active_deactive_newsletter($id_, $status_) {
        $this->db->where('NID', $id_);
        $data = array(
            'STATUS_' => $status_
        );
        $query = $this->db->update('newsletter', $data);
        return $query;
    }

    function updateNewsletter_($id__) {
        $title_ = $this->input->post('txtTitle');
        $year_ = $this->input->post('cmbYear');
        $volume_ = $this->input->post('cmbVolume');

        $this->db->where('YEAR_', $year_);
        $this->db->where('VOLUME_', $volume_);
        $query = $this->db->get('newsletter');

        if ($query->num_rows() != 0) {
            $bool_ = array('res_' => FALSE, 'msg_' => 'Newsletter having Volume ' . $volume_ . ' for the year ' . $year_ . ' already exists. Please try another volume for ' . $year_ . '.');
        } else {
            $data = array(
                'TITLE_' => $title_,
                'VOLUME_' => $volume_,
                'DATE_' => date('Y-m-d H:i:s'),
                'YEAR_' => $year_,
                'USERNAME_' => $this->session->userdata('ussr_'),
            );
            $this->db->where('NID', $id__);
            $query_ = $this->db->update('newsletter', $data);

            if ($query_ == TRUE) {
                $path_ = $this->upload_newsletter_file($id__);
                if ($path_ != 'x') {
                    $data = array(
                        'PATH_' => $path_
                    );
                    $this->db->where('NID', $id__);
                    $query = $this->db->update('newsletter', $data);

                    if ($query == TRUE) {
                        $boolean_ = $this->upload_newletter_front_cover($id__);

                        if ($boolean_ == TRUE) {
                            $bool_ = array('res_' => TRUE, 'msg_' => 'Newsletter Updated Successfully !!');
                        } else {
                            $bool_ = array('res_' => TRUE, 'msg_' => 'Newsletter Updated Successfully without front cover !!');
                        }
                    } else {
                        $bool_ = array('res_' => FALSE, 'msg_' => 'Newsletter record Updated succesfully but something went wrong in uploading newsletter file. Please try again !!');
                    }
                } else {
                    $bool_ = array('res_' => FALSE, 'msg_' => 'Newsletter record Updated succesfully but without newsletter file. Please try again (if needed) !!');
                }
            } else {
                $bool_ = array('res_' => FALSE, 'msg_' => 'Something goes wrong. Please try again !!');
            }
        }
        return $bool_;
    }

    function delete_newsletter($id_) {
        $this->db->where('NID', $id_);
        $query = $this->db->get('newsletter');

        if ($query->num_rows() != 0) {
            $item_ = $query->row();

            if ($item_->PATH_ != 'x') { // For Newsletter file
                $file__ = $item_->PATH_;
            } else {
                $file__ = 'x';
            }
            if ($item_->COVER_ != 'x') { // For Newsletter front cover
                $front_cover = $item_->COVER_;
            } else {
                $front_cover = 'x';
            }
        }
        $this->db->where('NID', $id_);
        $bool_ = $this->db->delete('newsletter');
        if ($bool_ == TRUE) {
            if ($file__ != 'x') { // For Newsletter file
                echo $full_path_ = FCPATH . '_assets_/newsletters/' . $file__;
                @unlink($full_path_);
            }
            if ($front_cover != 'x') { // For Newsletter front cover
                $full_path__ = FCPATH . '_assets_/newsletters/fronts/' . $front_cover;
                @unlink($full_path__);
            }
        }
        return $bool_;
    }
}