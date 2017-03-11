<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function () {
        $("#start_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        
        $("#end_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Slide</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Domain Information
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('', 'class="form-horizontal style-form" enctype="multipart/form-data" accept-charset="UTF-8"'); ?>
                        <div class="col-lg-12">
                            <?php
                            if ($this->session->flashdata('success')) {
                                echo $this->session->flashdata('success');
                            }

                            if ($this->session->flashdata('error')) {
                                echo $this->session->flashdata('error');
                            }

                            if (validation_errors()) {
                                echo validation_errors('<div class="alert alert-warning">', '</div>');
                            }
                            ?>        
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Domain:</label>
                                <div class="col-sm-10">
                                    <?php echo form_hidden('id', set_value('id', $domain->id), 'class="form-control" placeholder="id"'); ?>
                                    <?php echo form_input('domain_name', set_value('title1', $domain->domain_name), 'class="form-control" placeholder="Domain Name"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Package:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('package', set_value('package', $domain->package), 'class="form-control" placeholder="Package"'); ?>
                                </div>
                            </div>
                            <div class="form-group" id="priceDiv">
                                <label class="col-sm-2 col-sm-2 control-label">Summery:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('package_summery', set_value('package_summery', $domain->package_summery), 'class="form-control" placeholder="Summery"'); ?>
                                </div>
                            </div>
                            <div class="form-group" id="priceDiv">
                                <label class="col-sm-2 col-sm-2 control-label">Start Date:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('start_date', set_value('start_date', $domain->start_date), 'class="form-control" id="start_date" placeholder="Start Date"'); ?>
                                </div>
                            </div>
                            <div class="form-group" id="priceDiv">
                                <label class="col-sm-2 col-sm-2 control-label">End Date:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('end_date', set_value('end_date', $domain->end_date), 'class="form-control" id="end_date" placeholder="End Date"'); ?>
                                </div>
                            </div>
                            <div class="form-group" id="priceDiv">
                                <label class="col-sm-2 col-sm-2 control-label">Owner:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('owner', set_value('owner', $domain->owner), 'class="form-control" placeholder="Owner"'); ?>
                                </div>
                            </div>
                            <div class="form-group" id="priceDiv">
                                <label class="col-sm-2 col-sm-2 control-label">Contact Person:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('contact_person', set_value('contact_person', $domain->contact_person), 'class="form-control" placeholder="Contact Person"'); ?>
                                </div>
                            </div>
                            <div class="form-group" id="priceDiv">
                                <label class="col-sm-2 col-sm-2 control-label">Phone:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('phone', set_value('phone', $domain->phone), 'class="form-control" placeholder="Phone"'); ?>
                                </div>
                            </div>
                            <div class="form-group" id="priceDiv">
                                <label class="col-sm-2 col-sm-2 control-label">Contact Email:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('contact_email', set_value('contact_email', $domain->contact_email), 'class="form-control" placeholder="Contact Email"'); ?>
                                </div>
                            </div>

                            <?php
                            echo form_hidden('status', set_value('status', $domain->status), 'class="form-control" placeholder="Status"');
                            ?>
                            <?php echo form_submit('submit', 'Submit', 'class="btn btn-success pull-right"'); ?>                            
                        </div>
                        <?php echo form_close(); ?>
                    </div>                    
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-8 -->

    <div class="col-lg-4">
        <!-- /.panel -->
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-globe fa-fw"></i>
                Domain List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="chat">
                    <?php
                    foreach ($domains as $domain) {
                        echo '<li class="left clearfix">
                        <h5><a href="' . base_url() . 'admin/domain/add/' . $domain->id . '"><strong class="primary-font">' . $domain->domain_name . '</strong></a></h5>
                    </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.panel .chat-panel -->
    </div>
    <!-- /.col-lg-4 -->
</div>
<!-- /.row -->