<!-- /.row -->
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Domain's Panel</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <!-- /.col-lg-6 -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="domain">
                        <thead>
                            <tr>
                                <th>Domain</th>
                                <th>Package</th>
                                <th>Package Summery</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days Left</th>
                                <th>Owner</th>
                                <th>Contact Person</th>
                                <th>Contact Number</th>
                                <th>Contact Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($domains as $domain) { ?>
                            <tr>
                                <td><?php echo $domain->domain_name; ?></td>
                                <td><?php echo $domain->package; ?></td>
                                <td><?php echo $domain->package_summery; ?></td>
                                <td><?php echo $domain->start_date; ?></td>
                                <td><?php echo $domain->end_date; ?></td>
                                <td>
                                    <?php echo (strtotime($domain->end_date) - strtotime(date('Y-m-d'))) / (60 * 60 * 24); ?>
                                </td>
                                <td><?php echo $domain->owner; ?></td>
                                <td><?php echo $domain->contact_person; ?></td>
                                <td><?php echo $domain->phone; ?></td>
                                <td><?php echo $domain->contact_email; ?></td>                                     
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