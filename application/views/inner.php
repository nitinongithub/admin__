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
            <div class="col-lg-12" style="color: #ff0000; padding: 0px; text-align: center; border: #ff0000 solid 0px">
                <?php echo $this->session->flashdata('_msg_'); ?>
            </div>
            <div style="clear: both; padding: 10px"></div>
        </div>
        <div class="row">
            <?php $data['style_'] = ' style="height: 400px; overflow: auto"'; ?>
            <?php $this->load->view($folder_ . '/' . $page__, $data); ?>
        </div>

        <div class="row">
            <?php $this->load->view($folder_ . '/' . $view1, $data); ?>
            <?php if (isset($view2)) { ?>
                <?php $this->load->view($folder_ . '/' . $view2, $data); ?>
            <?php } ?>
        </div>
        
        <?php if (isset($view3)) { ?>
            <div class="row">
                <?php $this->load->view($folder_ . '/' . $view3, $data); ?>
            </div>
        <?php } ?>
    </div>
</div>