<style>
    @media only screen and (max-width: 800px) {
    /* Force table to not be like tables anymore */
    #no-more-tables table,
    #no-more-tables thead,
    #no-more-tables tbody,
    #no-more-tables th,
    #no-more-tables td,
    #no-more-tables tr {
    display: block;
    }
     
    /* Hide table headers (but not display: none;, for accessibility) */
    #no-more-tables thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
    }
     
    #no-more-tables tr { border: 1px solid #ccc; }
      
    #no-more-tables td {
    /* Behave like a "row" */
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 50%;
    white-space: normal;
    text-align:left;
    }
     
    #no-more-tables td:before {
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
    text-align:left;
    font-weight: bold;
    }
     
    /*
    Label the data
    */
    #no-more-tables td:before { content: attr(data-title); }
    }
</style>
<div class="col-lg-12">
<div class="panel panel-default"<?php //echo $style_; ?>>
<div class="panel-heading">
    Show TC's as per your selection...
</div>
<div class="panel-body">
        <div class="col-lg-12">
            <div class="form-group" style="text-align: left">
                <div class="col-sm-5">
                    <label>Show the data of the Year</label>
                    <?php
                        $data = array(
                            'name'  => 'frmViewTc',
                            'id'    => 'frmViewTc',
                            'role'  => 'form'
                        );
                        echo form_open('tc/viewTC', $data); 
                    ?>
                    <?php 
                        $data = array(
                            'name'  => 'cmbYear',
                            'id'    => 'cmbyear',
                            'class' => 'required form-control m-bot8',
                        );
                        $options = array();
                        $yr_ = date('Y');
                        for($loop1=$yr_; $loop1>=2000; $loop1--){
                            $options[$loop1] = $loop1;
                        }
                        echo form_dropdown($data, $options, $thisYear);
                    ?>
                </div>
                <div class="col-sm-4">
                    <label>Show the list of data</label>
                    <?php 
                        $data = array(
                            'name'  => 'cmbLimit',
                            'id'    => 'cmbLimit',
                            'class' => 'required form-control m-bot8',
                        );
                        $options = array(
                                '-1' => 'All'
                        );
                        for($loop1=1; $loop1<=30; $loop1++){
                            $options[$loop1] = $loop1;
                        }
                        echo form_dropdown($data, $options, $limit_);
                    ?>
                </div>
                <div class="col-sm-3" style="padding: 25px 0px 0px 15px">
                    <button type="submit" id="tc_submit" class="btn btn-primary"> GO </button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-lg-12">
    <div id="no-more-tables">
        <table class="col-sm-12 table-bordered table-striped table-condensed cf">
            <thead>
                <tr>
                    <th colspan="7" bgcolor="#f0f0f0">
                        <div class="col-sm-12">
                            <h4>Transfer Certificates for <?php echo $thisYear; ?></h4>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>TC</th>
                    <th>Name</th>
                    <th>TC No.</th>
                    <th>Last Class</th>
                    <th>Leaving Year</th>
                    <th>Modification</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tcData as $item){ ?>
                <?php 
                    $name_ = '';
                    $name_ = $name_ . $item->FNAME;
                    $mname = ($item->MNAME != '')? $item->MNAME : '';
                    $name_ = $name_ . " " .$mname;
                    $lname = ($item->LNAME != '')? $item->LNAME : '';
                    $name_ = $name_ . " " .$lname;
                ?>
                <tr>
                    <td data-title="TC"><a href="<?php echo base_url('_assets_/tc/'.$item->ATTACH_PATH);?>" target="_blank"><img src="<?php echo base_url('_assets_/tc/'.$item->ATTACH_PATH); ?>" class="img-responsive" style="max-width: 50px" /></a></td>
                    <td data-title="Name"><?php echo $name_;?></td>
                    <td data-title="TC No."><?php echo $item->TC_NO;?></td>
                    <td data-title="Last Class"><?php echo $item->LEAVING_CLASS;?></td>
                    <td data-title="year"><?php echo $item->YEAR_;?></td>
                    <td data-title="Modification">
                        <a href="<?php echo site_url('tc/edit_tc/'.$item->TCID.'/'.$thisYear.'/'.$limit_); ?>"><i class="fa fa-pencil-square-o" style="color:#0066cc; font-size: 20px;"></i></a> | 
                        <a href="<?php echo site_url('tc/del_tc/'.$item->detid); ?>"><i class="fa fa-times" style="color:#E13300; font-size: 20px;"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>  
</div>
<div class="col-lg-12">&nbsp;</div>