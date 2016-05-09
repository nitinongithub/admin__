<div class="col-lg-6">
    <div class="panel panel-default"<?php echo $style_; ?>>
        <div class="panel-heading">
            De-Active Newsletters
        </div>
        <!-- .panel-heading -->
        <div class="panel-body">
            <?php $cnt_ = count($newsletter_d); ?>
            <?php if ($cnt_ != 0) { ?>
                <div class="panel-group" id="accordion1">
                    <?php $loop1 = 1; ?>
                    <?php foreach ($newsletter_d as $item) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo $item->NID; ?>_"><?php echo $loop1; ?>. <?php echo $item->TITLE_; ?></a>
                                    <div style="float: right">
                                        <?php echo anchor('newsletter/delete_newsletter/' . $item->NID, '<span style="font-size: 11px; color: #ff0000; font-weight: bold; background: #ffff00; padding: 2px">Delete</span>', array('style' => 'float: right')); ?>
                                    </div>
                                    <div style="float: right;">
                                        <?php echo anchor('newsletter/active_deactive_newsletter/' . $item->NID . '/1', '<span style="font-size: 11px; color: #ffffff; background: #909090; padding: 2px">Activate</span>', array('style' => 'float: right')); ?>
                                    </div>
                                    <div style="float: right">
                                        <?php echo anchor('newsletter/edit_newsletter/' . $item->NID, '<span style="font-size: 11px; color: #009000; background: #ffff00; padding: 2px">Edit</span>', array('style' => 'float: right')); ?>
                                    </div>
                                    <div style="float: right">
                                    	<span style="float: right; font-size: 11px; color: #0000ff; padding: 4px 10px 4px 4px">Year: <?php echo $item->YEAR_; ?>, Vol.: <?php echo $item->VOLUME_; ?></span>
                                    </div>
                                </h4>

                            </div>
                            <div id="collapse<?php echo $item->NID; ?>_" class="panel-collapse collapse<?php
                            if ($loop1 == 1) {
                                echo " in";
                            }
                            ?>">
                                <div class="panel-body">
                                    <?php if($item->COVER_ != 'x'){ ?>
                                    Front Cover: <br />
                                    <img src="<?php echo base_url('_assets_/newsletters/fronts/'.$item->COVER_);?>" border="0" width="100" />
                                    <br />
                                    <?php } ?>
                                    Title: <?php echo $item->TITLE_;?>
	                                <br />
	                                Year: <?php echo $item->YEAR_;?>
	                                <br />
	                                Volume: <?php echo $item->VOLUME_;?>
                                    <?php if($item->PATH_ != 'x'){ ?>
                                    <a style="font-size: 10px; color: #0000ff; float: right" href="<?php echo base_url('_assets_/newsletters/'.$item->PATH_);?>" target="_blank">[ Download Newsletter ] </a>
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