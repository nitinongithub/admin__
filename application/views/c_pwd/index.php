<div class="col-sm-12">
	<p style="padding: 12px"></p>
</div>
<div class="col-lg-4"></div>
<div class="col-lg-4">
    <div class="panel panel-default"<?php //echo $style_; ?> id="fullform">
        <div class="panel-heading" style="overflow: hidden">
        	<div style="float: left">
	            <b><?php echo $this->session->userdata('ussr_') ;?></b> needs to change the password...
	        </div>
	        <div style="float: right">
	        	<a href="<?php echo site_url('newsevents');?>">
		        	<span class="glyphicon glyphicon-remove-circle" style="font-size: 20px; color: #900000"></span>
		        </a>
	        </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo form_open('#', array('name' => 'frm_cpwd', 'id' => 'frm_cpwd', 'role' => 'form')); ?>
                    <div class="form-group" style="color: #ff0000">
                        <label>Old Password<sup>*</sup></label>
                        <?php
                        $data = array(
                            'type' => 'password',
                            'maxlength' => '28',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Old Password',
                            'class' => 'required form-control',
                            'name' => 'old_pwd',
                            'id' => 'old_pwd',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group" style="color: #009000">
                        <label>New Password<sup>*</sup></label>
                        <?php
                        $data = array(
                            'type' => 'password',
                            'maxlength' => '28',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'New Password',
                            'class' => 'required form-control',
                            'name' => 'new_pwd',
                            'id' => 'new_pwd',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group" style="color: #009000">
                        <label>Confirm new Password<sup>*</sup></label>
                        <?php
                        $data = array(
                            'type' => 'password',
                            'maxlength' => '28',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'New Re-Password',
                            'class' => 'required form-control',
                            'name' => 'new_re-pwd',
                            'id' => 'new_re-pwd',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group" style="text-align: right">
                        <button type="button" class="btn btn-danger" id="changepwdbutt"> Change Password </button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
	            <div class="col-sm-12">
	                <div style="color: #ff0000; font-weight: bold; font-style: italic; padding: 5px" id="msg_"><?php echo $this->session->flashdata('feed_msg_'); ?></div>
	            </div>
        	</div>
	    </div>
	</div>
</div>
<div class="col-lg-4"></div>