<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add User</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                User Information
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
                                <label class="col-sm-3 control-label">Domain:</label>
                                <div class="col-sm-9">
                                    <?php echo form_hidden('id', set_value('id', $assign->id), 'class="form-control" placeholder="id"'); ?>
                                    <?php echo form_dropdown('domain_id', $domains, $this->input->post('domain_id') ? $this->input->post('domain_id') : $assign->domain_id, 'class="form-control tokenize-sample" id="domain_id"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Credential For:</label>
                                <div class="col-sm-9">
                                    <select multiple="multiple" name="domain_info_id[]" class="form-control" id="domain_info_id"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">User:</label>
                                <div class="col-sm-9">
                                    <?php echo form_multiselect('user_id[]', $users, $this->input->post('user_id') ? $this->input->post('user_id') : $assign->user_id, 'class="form-control selectpicker" multiple'); ?>
                                </div>
                            </div>
                            <?php
                            echo form_hidden('status', set_value('status', $assign->status), 'class="form-control" placeholder="Status"');
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
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<script>
    $(function(){
        $('#domain_id').on('change', function() {
            var id = this.value; // or $(this).val()
            
            $.ajax({
                url: "<?php echo site_url('admin/credential/get_list'); ?>",
                type: "post",
                data: {'domain_id': id},
                success: function (text)
                {
                    $('#domain_info_id').html(text);
                }
            });
            
        });
    })
</script>
    