<div class="col-lg-6">
    <div class="panel panel-default"<?php echo $style_; ?>>
        <div class="panel-heading">
            Active News
        </div>
        <!-- .panel-heading -->
        <div class="panel-body">
            <?php $cnt_ = count($news_); ?>
            <?php if ($cnt_ != 0) { ?>
            <div class="panel-group" id="accordion">
                <?php $loop1 = 1; ?>
                <?php foreach ($news_ as $item) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $item->ID; ?>"><?php echo $loop1; ?>. <?php echo $item->SUBJECT; ?></a>
                                <?php echo anchor('newsevents/active_deactive_news/'.$item->ID.'/0', '<span style="font-size: 11px; color: #ff0000; background: #ffff00; padding: 2px">Deactivate</span>', array('style'=>'float: right')); ?>
                                
                            </h4>
                            
                        </div>
                        <div id="collapse<?php echo $item->ID; ?>" class="panel-collapse collapse<?php if($loop1 == 1){ echo " in"; } ?>">
                            <div class="panel-body">
                                <?php echo $item->NEWS;?>
                                <br />
                                <?php if($item->PATH_ATTACH != 'x'){ ?>
                                <a style="font-size: 10px; color: #0000ff" href="<?php echo base_url('_assets_/newsdetail/'.$item->PATH_ATTACH);?>" target="_blank">[ Attachment ]</a>
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