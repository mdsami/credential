<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Logs</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-offset-2 control-label" style="margin-top: 5px;">Select Domain:</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown('domain_id', $domain, '', 'class="form-control selectpicker" id="domain_id" data-show-subtext="true" data-live-search="true"'); ?>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="logs">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>User Name</th>
                                <th>Status</th>
                                <th>Action Time</th>
                            </tr>
                        </thead>
                        <tbody id="logsReport">
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#domain_id').on('change', function() {
            var id = this.value; // or $(this).val()
            
            $.ajax({
                url: "<?php echo site_url('admin/logs/fatch'); ?>",
                type: "post",
                data: {'domain_id': id},
                success: function (text)
                {
                    $('#logsReport').html(text);
                }
            });
            
        });
    })
    
    
    $(document).ready(function () {
        $('#logs').DataTable({
            responsive: true
        });
    });
</script>

