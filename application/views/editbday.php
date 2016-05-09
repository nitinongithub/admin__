<div id="wrapper">

        <!-- Navigation -->
        <?php $this->load->view('templates/navigation'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $page_head; ?> <span style="font-size: 17px">(<?php echo _SCHOOL_; ?>)</span> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php $data['style_'] = ' style="height: 400px; overflow: auto"'; ?>
            <?php $this->load->view($folder_.'/editbday',$data); ?>
            </div>
            <div class="row">
                <div class="col-lg-12" style="color: #ff0000; padding: 3px; text-align: center">
                    <?php echo $this->session->flashdata('feed_bday_msg_'); ?>
                </div>
                <div style="clear: both; padding: 10px"></div>
            </div>
            
            <div class="row">
                <?php $this->load->view($folder_.'/'.$view1,$data); ?>
                <?php $this->load->view($folder_.'/'.$view2,$data); ?>
            </div>
            <div class="row">
                <?php $this->load->view($folder_.'/'.$view3,$data); ?>
            </div>
        </div>
</div>