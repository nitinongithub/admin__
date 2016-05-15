<div id="wrapper">

    <!-- Navigation -->
    <?php $this->load->view('templates/navigation'); ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard <span style="font-size: 17px">(<?php echo _SCHOOL_; ?>)</span> </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <?php $data['style_'] = ' style="height: 400px; overflow: auto"'; ?>
            <?php $this->load->view('dashboard/login', $data); ?>
        </div>
    </div>
</div>