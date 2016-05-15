<div class="col-lg-12">
    <div class="panel panel-default"<?php echo $style_; ?>>
        <div class="panel-heading" style="background: #c3f9cb">
            Active Activities
        </div>
        <!-- .panel-heading -->
        <div class="panel-body">
            <?php $cnt_ = count($activity_); ?>
            <?php if ($cnt_ != 0) { ?>
            <div class="panel-group" id="accordion">
                <?php $loop1 = 1; ?>
                <?php foreach ($activity_ as $item) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $item->ID; ?>"><?php echo $loop1; ?>. <?php echo $item->TITLE_; ?></a>
                                <?php echo anchor('activity/active_deactive_activity/'.$item->ID.'/0', '<span style="font-size: 11px; color: #ff0000; background: #ffff00; padding: 2px">Deactivate</span>', array('style'=>'float: right')); ?>
                            </h4>
                            
                        </div>
                        <div id="collapse<?php echo $item->ID; ?>" class="panel-collapse collapse<?php if($loop1 == 1){ echo " in"; } ?>">
                            <div class="panel-body">
                                <a href="<?php echo base_url('_assets_/activities/photos/'.$item->PICTURE_PATH);?>" target="_blank">
                                    <img src="<?php echo base_url('_assets_/activities/photos/'.$item->PICTURE_PATH);?>" border="0" hspace="15" vspace="15" align="left" width="200" />
                                </a>
                                <?php echo $item->BRIEF_;?>
                                <br />
                                <span style="font-size: 11px; color: #009000">Date of Activity: <?php echo $item->DATE_OF_ACTIVITY;?></span>
                                <br />
                                <?php if($item->DET_PATH != 'x'){ ?>
                                <a style="font-size: 10px; color: #0000ff" href="<?php echo base_url('_assets_/activities/'.$item->DET_PATH);?>" target="_blank">[ Attachment ]</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php $loop1 += 1; ?>
                <?php } ?>
            </div>
            <?php } else { ?>
                <div style="padding: 5px; float: left; color: #0000FF;">No Data Found !</div>
            <?php } ?>
        </div>
    </div>
</div>