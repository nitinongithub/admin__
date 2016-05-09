<style type="text/css">
    #loader{display: none}
    #preview{display: none}
</style>
<div class="col-lg-12" id="my">
    <div class="panel panel-default" style="height:auto;overflow:auto">
        <div class="panel-heading">
            <b>Add Images in Selected Gallery</b>
        </div>
        <!-- .panel-heading -->
        <div class="panel-body">
            <div class="row"> 
                <div class="col-sm-4">
                    <?php echo form_open_multipart('gallery/do_upload', array('name' => 'frmupload', 'id' => 'frmupload', 'role' => 'form', 'enctype' => 'multipart/form-data', 'method' => 'POST')); ?>
                    <div class="col-sm-4"><label style="color:#0066cc; font-weight: bold; font-size:14px;">Choose Category</label></div>
                    <div class="col-sm-8">
                        <?php
                        $data = array(
                            'class' => 'required form-control m-bot8',
                            'name' => 'txtCategory',
                            'id' => 'txtCategory',
                            'required' => 'required',
                            'onchange' => 'loadgallery(this);'
                        );
                        $options = array();
                        $options[0] = 'Choose Category';
                        foreach ($existing as $item_) {
                            $options[$item_->CATEG_ID] = $item_->CATEGORY;
                        }
                        echo form_dropdown($data, $options);
                        ?>
                    </div>

                    <div class="col-sm-12" style="margin-top:40px;">
                        <div class="form-group">
                            <?php
                            $data = array(
                                'type' => 'file',
                                'autocomplete' => 'off',
                                'class' => 'required form-control',
                                'name' => 'userfile',
                                'id' => 'userfile',
                                'value' => ''
                            );
                            echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info btn-block" style="width: 200px;" value="Add">
                        </div>  
                        <div class="form-group">
                            <img id="loader" src="<?php echo base_url() ?>_assets_/images/load.GIF" style="height: 30px;">
                        </div>
                        <div class="form-group">
                            <img id="preview" src="#" style="height: 80px;border: 1px solid #DDC; " />
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <div class="col-sm-8">
                    <div class="row clear-fix">
                        <div class="col-md-12">
                            <div id="response">

                            </div>  
                        </div>
                    </div>
                    <div class="row clear-fix">
                        <div class="col-md-12">
                            <div style="margin-top: 1%;">
                                <blockquote>
                                    <ul class="list-inline"  id="gallery">

                                    </ul>
                                </blockquote>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>