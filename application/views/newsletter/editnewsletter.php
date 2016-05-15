<div class="col-lg-12">
    <div class="panel panel-default"<?php echo $style_; ?>>
        <div class="panel-heading" style="background: #ff9000; color: #ffffff">
            Update Newsletters here...
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo form_open_multipart('newsletter/update_newsletter/'.$newsletter_edit->NID, array('name' => 'frmNewsEvents', 'id' => 'frmNewsEvents', 'role' => 'form')); ?>
                    <div class="form-group">
                        <label>Title</label>
                        <?php
                        $data = array(
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Title of Newsletter',
                            'class' => 'required form-control',
                            'name' => 'txtTitle',
                            'id' => 'txtTitle',
                            'value' => $newsletter_edit->TITLE_,
                            'style' => 'color: #ff9000'
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>For the Year</label>
                        <?php
                        $data = array(
                            'required' => 'required',
                            'class' => 'required form-control',
                            'name' => 'cmbYear',
                            'id' => 'cmbYear',
                            'style' => 'color: #ff9000'
                        );
                        $options = array();
                                $options[''] = 'Select Year';
                                for ($yr_ = date('Y'); $yr_ >= 2010; $yr_--) {
                                    $options[$yr_] = $yr_;
                                }
                        echo form_dropdown($data, $options, $newsletter_edit->YEAR_);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Volume</label>
                        <?php
                        $data = array(
                            'required' => 'required',
                            'class' => 'required form-control',
                            'name' => 'cmbVolume',
                            'id' => 'cmbVolume',
                            'style' => 'color: #ff9000'
                        );
                        $options = array();
                                $options[''] = 'Select Volume';
                                for ($vol_ = 1; $vol_ <= 12; $vol_++) {
                                    $options[$vol_] = 'Volume ' . $vol_;
                                }
                        echo form_dropdown($data, $options, $newsletter_edit->VOLUME_);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Upload Front Cover as thumbnail <span style="font-size: 11px; color: #808080; font-weight: normal; font-style: italic">Only <b>[ .jpg| .gif| .png ]</b> are allowed</span></label>
                        <?php
                        $data = array(
                            'type' => 'file',
                            'autocomplete' => 'off',
                            'class' => 'required form-control',
                            'name' => 'txtInputFileFront',
                            'id' => 'txtInputFileFront',
                            'style' => 'color: #ff9000'
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Upload Newsletter <span style="font-size: 11px; color: #808080; font-weight: normal; font-style: italic">Only <b>[ .doc| .docx| .pdf| .jpg| .png ]</b> are allowed</span></label>
                        <?php
                        $data = array(
                            'type' => 'file',
                            'autocomplete' => 'off',
                            'class' => 'required form-control',
                            'name' => 'txtInputFile',
                            'id' => 'txtInputFile',
                            'style' => 'color: #ff9000'
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <button type="submit" class="btn btn-danger"> Update </button>
                    <button type="reset" class="btn btn-flickr"> Reset </button>
                    <?php echo form_close(); ?>
                    <div style="color: #ff0000; font-weight: bold; font-style: italic; padding: 5px"><?php echo $this->session->flashdata('feed_msg_'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>