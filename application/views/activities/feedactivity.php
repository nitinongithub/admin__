<div class="col-lg-12">
    <div class="panel panel-default"<?php //echo $style_; ?>>
        <div class="panel-heading">
            Feed Activity here...
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <?php echo form_open_multipart('activity/feedactivity', array('name' => 'frmActivities', 'id' => 'frmActivities', 'role' => 'form')); ?>
                    <div class="form-group">
                        <label>Title<sup>*</sup></label>
                        <?php
                        $data = array(
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Title of Activity',
                            'class' => 'required form-control',
                            'name' => 'txtTitle',
                            'id' => 'txtTitle',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Brief Description of the Activity<sup>*</sup></label>
                        <?php
                        $data = array(
                            'rows' => '5',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Brief Description of the Activity held...',
                            'class' => 'required form-control',
                            'name' => 'txtBriefDesc',
                            'id' => 'txtBriefDesc',
                            'value' => ''
                        );
                        echo form_textarea($data);
                        ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Date of Activity<sup>*</sup></label>
                        <?php
                        $data = array(
                            'type' => 'date',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Title of Activity',
                            'class' => 'required form-control',
                            'name' => 'txtDateofActivity',
                            'id' => 'txtDateofActivity',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Detailed description (if any) <span style="font-size: 11px; color: #808080; font-weight: normal; font-style: italic">Only <b>[ .jpg| .gif| .png| .pdf| .doc| .docx ]</b> are allowed</span></label>
                        <?php
                        $data = array(
                            'type' => 'file',
                            'autocomplete' => 'off',
                            'class' => 'required form-control',
                            'name' => 'txtInputFileDescription',
                            'id' => 'txtInputFileDescription',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Picture/ Photo of the activity<sup>*</sup> <span style="font-size: 11px; color: #808080; font-weight: normal; font-style: italic">Only <b>[ .jpg| .gif| .png| ]</b> are allowed</span></label>
                        <?php
                        $data = array(
                            'type' => 'file',
                            'required' => 'required',
                            'autocomplete' => 'off',
                            'class' => 'required form-control',
                            'name' => 'txtInputFilePicture',
                            'id' => 'txtInputFilePicture',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group" style="text-align: right">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                        <button type="reset" class="btn btn-flickr"> Reset </button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-sm-12">
                <div style="color: #ff0000; font-weight: bold; font-style: italic; padding: 5px"><?php echo $this->session->flashdata('feed_msg_'); ?></div>
            </div>
        </div>
    </div>
</div>