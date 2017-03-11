<link rel="stylesheet" href="<?php echo site_url('admin_components/bootstrap/dist/css/bootstrap-select.min.css');?>" />
<script src="<?php echo site_url('admin_components/bootstrap/dist/js/bootstrap-select.min.js');?>"></script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Credential</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Credential Information
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('', 'class="form-horizontal style-form" enctype="multipart/form-data" accept-charset="UTF-8"'); ?>
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
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Domain:</label>
                                <div class="col-sm-9">
                                    <?php echo form_hidden('id', set_value('id', $credential->id), 'class="form-control" placeholder="id"'); ?>
                                    <?php 
                                        if($credential->id){ 
                                            
                                            echo form_dropdown('domain_id', $domain, $this->input->post('domain_id') ? $this->input->post('domain_id') : $credential->domain_id, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true" disabled="true"'); 
                                            echo form_hidden('domain_id', $credential->domain_id, 'class="form-control"'); 
                                            
                                        } else { 
                                            
                                            echo form_dropdown('domain_id', $domain, $this->input->post('domain_id') ? $this->input->post('domain_id') : $credential->domain_id, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); 
                                            
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Credential For:</label>
                                <div class="col-sm-9">
                                    <?php echo form_input('title', $credential->title, 'class="form-control" placeholder="Credential For"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Detail:</label>
                                <div class="col-sm-9">
                                    <?php echo form_textarea('detail', $credential->detail, 'class="form-control" placeholder="Detail"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Assign For:</label>
                                <div class="col-sm-9">
                                    <?php if($credential->id){ ?> 
                                    <select name="users_id[]" id="users_id" class="form-control js-example-basic-multiple" multiple="multiple">
                                        <?php echo $users;?>
                                    </select>    
                                    <?php } else { 
                                    //echo form_multiselect('users_id[]', $users, 'id="users_id" class="form-control js-example-basic-multiple" multiple="multiple"');
                                    echo form_dropdown('users_id[]', $users, '', ' id="users_id" class="form-control js-example-basic-multiple" multiple="multiple"');
                                    } ?>
                                </div>
                            </div>
                            <?php
                            echo form_hidden('user_id', set_value('user_id', $credential->user_id), 'class="form-control" placeholder="Status"');
                            echo form_hidden('status', set_value('status', $credential->status), 'class="form-control" placeholder="Status"');
                            echo form_hidden('last_update', set_value('last_update', $credential->last_update), 'class="form-control" placeholder="Last Update"');
                            ?>
                            <?php if($credential->id){ echo form_submit('submit', 'Update', 'class="btn btn-success "'); } else { echo form_submit('submit', 'Add', 'class="btn btn-success "'); } ?>  
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
                <i class="fa fa-key fa-fw"></i>
                Credential List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="chat">
                    <?php
                    foreach ($credentials as $credential) {
                        echo '<li class="left clearfix">
                        <h5><a href="' . base_url() . 'admin/credential/add/' . $credential->id . '"><strong class="primary-font">' . $credential->title . ' ( '.$credential->domain_name.' )</strong></a></h5>
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

<script src="<?php echo base_url() ?>admin_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        menubar: "edit format",
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'textcolor',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'sizeselect | bold italic | fontselect |  fontsizeselect | forecolor | backcolor | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });
</script>

<link href="<?php echo site_url('admin_components/select2/select2.min.css');?>" rel="stylesheet" />
<script src="<?php echo site_url('admin_components/select2/select2.min.js');?>"></script>

<script type="text/javascript">
    $('#users_id').select2();
</script>