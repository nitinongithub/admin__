<div class="col-lg-6">
    <div class="panel panel-default"<?php echo $style_; ?>>
        <div class="panel-heading" style="background: #fdc9d6">
            All De-Activated Birthdays
        </div>
        <!-- .panel-heading -->
        <div class="panel-body">
            <?php $cnt_ = count($deactivebday_); ?>
            <?php if ($cnt_ != 0) { ?>
            <div class="panel-group" id="accordion1">
                <?php $loop1 = 1; ?>
                <?php foreach ($deactivebday_ as $item) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#collapse_all_<?php echo $item->BID; ?>"><?php echo $item->NAME_; ?></a>
                                <div style="float: right">
                                    <?php echo anchor('bday/delete_bday/' . $item->BID, '<span style="font-size: 11px; color: #ff0000; font-weight: bold; background: #ffff00; padding: 2px">Delete</span>', array('style' => 'float: right')); ?>
                                </div>
                                <div style="float: right">
                                    <?php echo anchor('bday/edit_bday/' . $item->BID, '<span style="font-size: 11px; color: #009000; background: #ffff00; padding: 2px">Edit</span>', array('style' => 'float: right')); ?>
                                </div>
                                <div style="float: right">
                                    <?php echo anchor('bday/active_deactive_bday/' . $item->BID. '/1', '<span style="font-size: 11px; color: #ffffff; background: #808080; padding: 2px">Active</span>', array('style' => 'float: right')); ?>
                                </div>
                            </h4>
                            
                        </div>
                        <div id="collapse_all_<?php echo $item->BID; ?>" class="panel-collapse collapse<?php if($loop1 == 1){ echo " in"; } ?>">
                            <div class="panel-body">
                                <?php if($item->PHOTO_ != 'x'){ ?>
                                <div style="float: left; padding: 2px;"><img src="<?php echo base_url('_assets_/stud_photo/'.$item->PHOTO_); ?>" width="97" /></div>
                                <div style="float: left; padding: 2px; border-radius: 5px; background: #F0F0F0">Birthday: 
                                    <?php 
                                        echo date("d", strtotime($item->DOB)) . "-" . date("F", strtotime($item->DOB));
                                    ?>
                                </div>
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