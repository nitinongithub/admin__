<?php $data['style_'] = ' style="height: 350px;"'; ?>
<div class="col-lg-6">
    <div class="panel panel-default"<?php echo $style_; ?>>
        <div class="panel-heading">
            Change Password...
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                	<?php echo form_open_multipart('dashboard/update_Pwd', array('name' => 'frmNewsEvents', 'id' => 'frmNewsEvents', 'role' => 'form')); ?>
                    <div class="form-group">
                        <label>Old Password</label>
                        <?php
                        $data = array(
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Old Password',
                            'class' => 'required form-control',
                            'name' => 'txtOldPwd',
                            'id' => 'txtOldPwd',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <label style="color: #0000AA">New Password</label>
                        <?php
                        $data = array(
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'New Password',
                            'class' => 'required form-control',
                            'name' => 'txtNewPwd',
                            'id' => 'txtNewPwd',
                            'value' => '',
                            'style'	=> 'color: #0000AA'
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <label style="color: #0000AA">Confirm Password</label>
                        <?php
                        $data = array(
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Confirm Password',
                            'class' => 'required form-control',
                            'name' => 'txtConfirmPwd',
                            'id' => 'txtConfirmPwd',
                            'value' => '',
                            'style'	=> 'color: #0000AA'
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <button type="submit" class="btn btn-danger">Change Password</button>
                </div>
            </div>
            <div style="color: #ff0000; font-weight: bold; font-style: italic; padding: 10px 0px 0px 0px"><?php echo $this->session->flashdata('feed_msg_'); ?></div>
        </div>
    </div>
</div>
<div class="col-sm-6"></div>