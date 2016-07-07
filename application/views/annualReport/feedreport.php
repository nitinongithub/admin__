<div class="col-sm-6">
    <div class="panel panel-default" style="height:auto;overflow: auto">
        <div class="panel-heading">
            Feed New Annual Report here...
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo form_open_multipart('annualReport/feedReport', array('name' => 'frmNewsEvents', 'id' => 'frmNewsEvents', 'role' => 'form')); ?>
                    <div class="form-group">
                        <label>Annual Report Year (YYYY)</label>
                        <?php
                        $data = array(
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Annual Report Year (YYYY) eg 2016',
                            'class' => 'required form-control',
                            'name' => 'txtReportYear',
                            'id' => 'txtReportYear',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>  
                    <div class="form-group">
                        <label>Choose Report (doc, docx, pdf)</label>
                        <?php
                        $data = array(
                            'type' => 'file',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'class' => 'required form-control',
                            'name' => 'txtInputproductImage',
                            'id' => 'txtInputproductImage',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                    <button type="reset" class="btn btn-flickr"> Reset </button>
                    <?php echo form_close(); ?>
                    <div style="color: #ff0000; font-weight: bold; font-style: italic; padding: 5px"><?php echo $this->session->flashdata('feed_msg_'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-5" id="editCat" style="display:none; position:absolute;">
    <div class="panel panel-default" style="height:350px;overflow: auto">
        <div class="panel-heading" style="background:#E13300; color:#ffffff">
            <b>Edit Annual Report here...</b>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo form_open_multipart('annualReport/updateReport', array('name' => 'frmServices', 'id' => 'frmServices', 'role' => 'form')); ?>
                    <div class="form-group">
                        <label>Annual Report Year (YYYY)</label>
                        <?php
                        $data = array(
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Annual Report Year (YYYY) eg 2016',
                            'class' => 'required form-control',
                            'name' => 'txtReportYear_edit',
                            'id' => 'txtReportYear_edit',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>  
                    <div class="form-group">
                        <label>Choose Report (doc, docx, pdf)</label>
                        <a href='mylist' target='_blank'><span id='Plist'>hello</span></a>
                        <?php
                        $data = array(
                            'type' => 'file',
                            'autocomplete' => 'off',
                            'class' => 'required form-control',
                            'name' => 'txtInputproductImage_EDIT',
                            'id' => 'txtInputproductImage_EDIT',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>                    
                    <div class="form-group">
                        <?php
                        $data = array(
                            'type' => 'hidden',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'class' => 'required form-control',
                            'name' => 'txtID_edit',
                            'id' => 'txtID_edit',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary col-sm-12"> UPDATE </button>
                    <?php echo form_close(); ?>
                    <div style="color: #ff0000; font-weight: bold; font-style: italic; padding: 5px"><?php echo $this->session->flashdata('edit_msg_'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="panel panel-default" style="height:auto;overflow:auto">
        <div class="panel-heading">
            <b>Existing Annual Reports</b>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-hover tableSection">
                        <tbody>
                            <?php
                            $attrib_ = array(
                                'class' => 'form-horizontal',
                                'name' => 'frmStaticHead_Del',
                                'id' => 'frmStaticHead_Del',
                            );
                            ?>
                            <?php echo form_open('', $attrib_); ?>
                            <?php if (count($existing) != 0) { ?>
                                <?php foreach ($existing as $item_) { ?>
                                    <tr>
                                        <td>
                                            <?PHP if ($item_->STATUS_ != 1) { ?>
                                                <a href="<?php echo site_url('annualReport/active_inactive/' . $item_->ID . '/1'); ?>"><img src="<?php echo base_url('_assets_/images/inactive.png'); ?>"></a>
                                            <?PHP } else { ?>
                                                <a href="<?php echo site_url('annualReport/active_inactive/' . $item_->ID . '/0'); ?>"><img src="<?php echo base_url('_assets_/images/active.png'); ?>"></a>
                                            <?PHP } ?>
                                        </td>
                                        <td style="width:50%"><a href="<?PHP echo base_url('_assets_/annualReport/'.$item_->PATH);?>" target="_blank"><?php echo strtoupper($item_->YEAR); ?></a></td>                                        
                                        <td align="right">
                                            <a href="#" class="btn btn-primary" id="changeHead_<?php echo $item_->ID; ?>" onclick="change_Report('<?php echo $item_->ID; ?>', '<?php echo $item_->YEAR; ?>','<?php echo $item_->PATH; ?>');"><i class='fa fa-pencil-square-o'></i></a>  
                                            <a href="<?php echo site_url('annualReport/delete_Report/' . $item_->ID); ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <th>No data found...</th>
                                </tr>
                            <?php } ?>
                            <?php
                            $data = array(
                                'type' => 'hidden',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'class' => 'required form-control',
                                'name' => 'txtFeeStaticHeadID_del',
                                'id' => 'txtFeeStaticHeadID_del',
                                'value' => ''
                            );
                            echo form_input($data);
                            ?>
                        <div style="padding: 5px"><?php echo $this->session->flashdata('msg_delete_'); ?></div>
                        <?php echo form_close(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>