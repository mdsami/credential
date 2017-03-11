<!-- /.row -->
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Domain</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div id="message">
        <?php
        if ($this->session->flashdata('success')) {
            echo '<div class="col-lg-12">' . $this->session->flashdata('success') . '</div>';
        }

        if ($this->session->flashdata('error')) {
            echo '<div class="col-lg-12">' . $this->session->flashdata('error') . '</div>';
        }
        ?>
    </div>  

    <!-- /.col-lg-6 -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="domain">
                        <thead>
                            <tr>
                                <th>Domain</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days Left</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($domains as $domain) { ?>
                            <tr>
                                <td><h4><?php echo $domain->domain_name; ?></h4></td>
                                <td><h4><?php echo $domain->start_date; ?></h4></td>
                                <td><h4><?php echo $domain->end_date; ?></h4></td>
                                <td>
                                    <h4><?php echo (strtotime($domain->end_date) - strtotime(date('Y-m-d'))) / (60 * 60 * 24); ?></h4>
                                </td>
                                <td>
                                    <div class="onoffswitch">

                                        <input type="checkbox" name="status" class="status onoffswitch-checkbox" data-id="<?php echo $domain->id; ?>" id="<?php echo 'status' . $domain->id; ?>" value="<?php echo $domain->status; ?>" <?php if ($domain->status == 1) {echo 'checked';} ?>>

                                        <label class="onoffswitch-label" for="<?php echo 'status' . $domain->id; ?>">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-success" href="<?php echo site_url('admin/domain/add/' . $domain->id); ?>"><i class="fa fa-pencil"></i></a>                                    
                                    <a class="btn btn-warning delete" data-id="<?php echo $domain->id; ?>" id="<?php echo 'delete' . $domain->id; ?>" href=""><i class="fa fa-trash"></i></a>
                                </td>                                        
                            </tr>    
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<!-- /.row -->

<script>
    $(document).ready(function () {
        $('#domain').DataTable({
            responsive: true
        });
    });
</script>

<script type="text/javascript">
    $(document).on('click', '.status', function () {

        var id = ($(this).data("id"));

        if ($("#status" + id).val() == '1') {
            var status = 0;
        } else {
            var status = 1;
        }

        $.ajax({
            url: "<?php echo site_url('admin/domain/changestatus'); ?>",
            type: "post",
            data: {'id': id, 'status': status, },
            success: function (text)
            {
                $('#message').html(text);
                $("#status" + id).val(status);
            }
        });

    });
    
    $(document).on('click', '.delete', function (e) {

        e.preventDefault();

        var id = ($(this).data("id"));

        $.ajax({
            url: "<?php echo site_url('admin/domain/delete'); ?>",
            type: "post",
            data: {'id': id, 'status': 2},
            success: function (text)
            {
                if (text === 'error') {
                    alert('Please deactive status first');
                } else {
                    $('#message').html('<div class="alert alert-danger">Delete domain successfully</div>');
                    $("#status" + id).val(status);

                    window.setTimeout(function () {
                        window.location.replace("<?php echo site_url('admin/domain/manage');?>");
                    }, 2000);

                }
            }
        });

    });

</script>