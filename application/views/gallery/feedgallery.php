<div class="col-lg-6" id="newCat">
    <div class="panel panel-default" style="height:305px;overflow: auto">
        <div class="panel-heading">
            <b>Feed Category for Gallery here...</b>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo form_open_multipart('gallery/feedCategory', array('name' => 'frmNewsEvents', 'id' => 'frmNewsEvents', 'role' => 'form')); ?>
                    <div class="form-group">
                        <label>Category</label>
                        <?php
                        $data = array(
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Title for Category',
                            'class' => 'required form-control',
                            'name' => 'txtCategory',
                            'id' => 'txtCategory',
                            'value' => ''
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <?php
                        $data = array(
                            'rows' => '3',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Category Description',
                            'class' => 'required form-control',
                            'name' => 'txtDesc',
                            'id' => 'txtDesc',
                            'value' => ''
                        );
                        echo form_textarea($data);
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
<div class="col-lg-6" id="editCat" style="display:none">
    <div class="panel panel-default" style="height:305px;overflow: auto">
        <div class="panel-heading" style="background:#E13300; color:#ffffff">
            <b>Edit Category</b>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo form_open_multipart('gallery/editCategory', array('name' => 'frmNewsEvents', 'id' => 'frmNewsEvents', 'role' => 'form')); ?>
                    <div class="form-group">
                        <label>Category</label>
                        <?php
                        $data = array(
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Title for Category',
                            'class' => 'required form-control',
                            'name' => 'txtCategory_edit',
                            'id' => 'txtCategory_edit',
                            'value' => '',
                            'style' => 'background:#f5e79e'
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <?php
                        $data = array(
                            'rows' => '3',
                            'autocomplete' => 'off',
                            'required' => 'required',
                            'placeholder' => 'Category Description',
                            'class' => 'required form-control',
                            'name' => 'txtDesc_edit',
                            'id' => 'txtDesc_edit',
                            'value' => '',
                            'style' => 'background:#f5e79e'
                        );
                        echo form_textarea($data);

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
                    <button type="submit" class="btn btn-primary col-sm-12"> EDIT </button>
                    <?php echo form_close(); ?>
                    <div style="color: #ff0000; font-weight: bold; font-style: italic; padding: 5px"><?php echo $this->session->flashdata('edit_msg_'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="panel panel-default" style="height:305px;overflow:auto">
        <div class="panel-heading">
            <b>Existing Categories</b>
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
                            <?php echo form_open('gallery/delete_static_head', $attrib_); ?>
                            <?php if (count($existing) != 0) { ?>
                                <?php foreach ($existing as $item_) { ?>
                                    <tr>
                                        <td style="width:30%"><a href="#"><?php echo strtoupper($item_->CATEGORY); ?></a></td>
                                        <td style="width:50%"><a href="#"><?php echo strtoupper($item_->DESC); ?></a></td>
                                        <td align="right">
                                            <a href="#" id="changeHead_<?php echo $item_->CATEG_ID; ?>" onclick="change_Cat('<?php echo $item_->CATEG_ID; ?>', '<?php echo $item_->CATEGORY; ?>', '<?php echo $item_->DESC; ?>');"><i class="fa fa-pencil-square-o" style="color:#0066cc; font-size: 20px;"></i></a> | 
                                            <a href="#" onclick="delete_head('<?php echo $item_->CATEG_ID; ?>');"><i class="fa fa-times" style="color:#E13300; font-size: 20px;"></i>
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