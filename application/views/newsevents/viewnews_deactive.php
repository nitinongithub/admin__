<div class="col-lg-6">
    <div class="panel panel-default"<?php echo $style_; ?>>
        <div class="panel-heading" style="background: #fdc9d6">
            De-Active News
        </div>
        <!-- .panel-heading -->
        <div class="panel-body">
            <?php $cnt_ = count($news_d); ?>
            <?php if ($cnt_ != 0) { ?>
                <div class="panel-group" id="accordion1">
                    <?php $loop1 = 1; ?>
                    <?php foreach ($news_d as $item) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo $item->ID; ?>_"><?php echo $loop1; ?>. <?php echo $item->SUBJECT; ?></a>
                                    <div style="float: right">
                                        <?php echo anchor('newsevents/delete_news_events/' . $item->ID, '<span style="font-size: 11px; color: #ff0000; font-weight: bold; background: #ffff00; padding: 2px">Delete</span>', array('style' => 'float: right')); ?>
                                    </div>
                                    <div style="float: right;">
                                        <?php echo anchor('newsevents/active_deactive_news/' . $item->ID . '/1', '<span style="font-size: 11px; color: #ffffff; background: #909090; padding: 2px">Activate</span>', array('style' => 'float: right')); ?>
                                    </div>
                                    <div style="float: right">
                                        <?php echo anchor('newsevents/edit_news_events/' . $item->ID, '<span style="font-size: 11px; color: #009000; background: #ffff00; padding: 2px">Edit</span>', array('style' => 'float: right')); ?>
                                    </div>
                                </h4>

                            </div>
                            <div id="collapse<?php echo $item->ID; ?>_" class="panel-collapse collapse<?php
                            if ($loop1 == 1) {
                                echo " in";
                            }
                            ?>">
                                <div class="panel-body">
                                    <?php echo $item->NEWS; ?>
                                    <br />
                                    <?php if($item->PATH_ATTACH != 'x'){ ?>
                                    <a style="font-size: 10px; color: #0000ff" href="<?php echo base_url('_assets_/newsdetail/'.$item->PATH_ATTACH);?>" target="_blank">[ Attachment ]</a>
                                    <a style="float:right; font-size: 10px; color: #ff0000" href="<?php echo site_url('newsevents/delete_attachment/'.$item->ID);?>">Delete Attachment?</a>
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