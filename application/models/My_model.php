<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function login() {
        $data = array(
            'USERNAME_' => $this->input->post('txtUsr'),
            'PASSWORD_' => $this->input->post('txtPwd')
        );
        $this->db->where($data);
        $query = $this->db->get('login');
        if ($query->num_rows() != 0) {
            $res = $query->row();
            $data = array('bool_' => TRUE, 'sts_' => $res->USER_STATUS);
        } else {
            $data = array('bool_' => FALSE, 'sts_' => 'x');
        }

        return $data;
    }

    function students_bday_today() {
        $dt_ = date('d');
        $mnth_ = date('m');
        $this->db->where('MONTH(DOB)', $mnth_);
        $this->db->where('DAY(DOB)', $dt_);
        $this->db->where('STATUS', 1);
        $this->db->order_by('NAME_');
        $query = $this->db->get('bday_data');

        return $query->result();
    }

    function feedNews_() {
        $data = array(
            'SUBJECT' => $this->input->post('txtSubject'),
            'NEWS' => $this->input->post('txtNews'),
            'PATH_ATTACH' => 'x',
            'FONTJI' => 'Arial',
            'DATE_' => date('d/m/Y'),
            'TIME_' => date("h:i:sa"),
            'STATUS' => 1,
            'USERNAME' => $this->session->userdata('ussr_')
        );
        $query = $this->db->insert('newsevents', $data);
        $id__ = $this->db->insert_id();

        $config = array(
            'upload_path' => './_assets_/newsdetail',
            'overwrite' => TRUE,
            'allowed_types' => 'doc|docx|pdf|jpg|png',
            'file_name' => $id__
        );

        $file_element_name = 'txtInputFile';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_element_name)) {
            $path_ji = $this->upload->data();

            $path_ = $path_ji['file_name'];

            $data = array(
                'PATH_ATTACH' => $path_
            );
            $this->db->where('ID', $id__);
            $query = $this->db->update('newsevents', $data);
        } else {
            $path_ = 'x';
        }

        if ($query == TRUE) {
            if ($path_ != 'x') {
                $bool_ = array('res_' => TRUE, 'msg_' => 'News Feeded Successfully with uploaded file.');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'News Feeded Successfully without any uploaded file.');
            }
        } else {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Something went wrong. Please try again !!');
        }
        return $bool_;
    }

    function get_news_events_for_edit($id__) {
        $this->db->where('ID', $id__);
        $query = $this->db->get('newsevents');

        return $query->row();
    }

    function updateNews_($id__) {
        $this->db->where('ID', $id__);
        $data = array(
            'SUBJECT' => $this->input->post('txtSubject'),
            'NEWS' => $this->input->post('txtNews'),
            'FONTJI' => 'Arial',
            'DATE_' => date('d/m/Y'),
            'TIME_' => date("h:i:sa"),
            'USERNAME' => $this->session->userdata('ussr_')
        );
        $query = $this->db->update('newsevents', $data);

        $config = array(
            'upload_path' => './_assets_/newsdetail',
            'overwrite' => TRUE,
            'allowed_types' => 'doc|docx|pdf|jpg|png',
            'file_name' => $id__
        );
        $file_element_name = 'txtInputFile';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_element_name)) {
            $path_ji = $this->upload->data();
            $path_ = $path_ji['file_name'];

            $data = array(
                'PATH_ATTACH' => $path_
            );
            $this->db->where('ID', $id__);
            $query = $this->db->update('newsevents', $data);
        } else {
            $path_ = 'x';
        }

        if ($query == TRUE) {
            if ($path_ != 'x') {
                $bool_ = array('res_' => TRUE, 'msg_' => 'News Updated Successfully with uploaded file.');
            } else {
                $bool_ = array('res_' => TRUE, 'msg_' => 'News Updated Successfully without any uploaded file.');
            }
        } else {
            $bool_ = array('res_' => TRUE, 'msg_' => 'Something went wrong. Please try again !!');
        }
        return $bool_;
    }

    function get_latest_news($limit_) {
        $this->db->where('STATUS', 1);
        $this->db->order_by('ID', 'desc');
        $query = $this->db->get('newsevents', 0, $limit_);
        return $query->result();
    }

    function get_all_news() {
        $this->db->where('STATUS', 1);
        $this->db->order_by('ID', 'desc');
        $query = $this->db->get('newsevents');
        return $query->result();
    }

    function get_all_news_deactive() {
        $this->db->where('STATUS', 0);
        $this->db->order_by('ID', 'desc');
        $query = $this->db->get('newsevents');
        return $query->result();
    }

    function active_deactive_news($id_, $status_) {
        $this->db->where('ID', $id_);
        $data = array(
            'STATUS' => $status_
        );
        $query = $this->db->update('newsevents', $data);
        return $query;
    }

    function active_deactive_bday($bid__, $status_) {
        $this->db->where('BID', $bid__);
        $data = array(
            'STATUS' => $status_
        );
        $query = $this->db->update('bday_data', $data);
        return $query;
    }

    function delete_news_events($id_) {
        $this->db->where('ID', $id_);
        $query = $this->db->get('newsevents');

        if ($query->num_rows() != 0) {
            $item_ = $query->row();

            if ($item_->PATH_ATTACH != 'x') {
                $file__ = $item_->PATH_ATTACH;
            } else {
                $file__ = 'x';
            }
        }
        $this->db->where('ID', $id_);
        $bool_ = $this->db->delete('newsevents');
        if ($bool_ == TRUE) {
            if ($file__ != 'x') {
                $full_path_ = FCPATH . '_assets_/newsdetail/' . $file__;
                @unlink($full_path_);
            }
        }
        return $bool_;
    }

    function delete_attach_news($id__) {
        $this->db->where('ID', $id__);
        $query__ = $this->db->get('newsevents');
        if ($query__->num_rows() != 0) {
            $item_ = $query__->row();

            if ($item_->PATH_ATTACH != 'x') {
                $file__ = $item_->PATH_ATTACH;
            } else {
                $file__ = 'x';
            }
        }
        $data = array(
            'PATH_ATTACH' => 'x'
        );
        $this->db->where('ID', $id__);
        $query = $this->db->update('newsevents', $data);
        if ($query == TRUE) {
            if ($file__ != 'x') {
                $full_path_ = FCPATH . '_assets_/newsdetail/' . $file__;
                @unlink($full_path_);
            }
        }
        return $query;
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

    //--------------------------------GALLERY
    function get_all_categories() {
        $this->db->order_by('CATEG_ID', 'desc');
        $query = $this->db->get('gallery_category');
        return $query->result();
    }

    function feedCategory_() {
        $data = array(
            'CATEGORY' => $this->input->post('txtCategory'),
            'DESC' => $this->input->post('txtDesc'),
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
    
}
