<!-- /.row -->
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Domain Trash</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    
    <?php 
        if ($this->session->flashdata('success')) {
            echo '<div class="col-lg-12">'.$this->session->flashdata('success').'</div>';
        }

        if ($this->session->flashdata('error')) {
            echo '<div class="col-lg-12">'.$this->session->flashdata('error').'</div>';
        }
    ?>

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
                                <th>Credential For</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($credentials as $credential) { ?>
                            <tr>
                                <td><h4><?php echo $credential->domain_name; ?></h4></td>
                                <td><h4><?php echo $credential->title; ?></h4></td>
                                <td>
                                    <a class="btn btn-info" href="<?php echo site_url('admin/credential/undo/'.$credential->id);?>"><i class="fa fa-undo"></i> Undo From Trash</a>
                                    <a class="btn btn-danger" href="<?php echo site_url('admin/credential/remove/'.$credential->id);?>" onclick="return confirm('Do you want to delete!')"><i class="fa fa-times"></i> Delete Permanently</a>
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