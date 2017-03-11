
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Newsletter</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li  class="<?php echo ($active_tab == 'Newsletters') ? 'active' : ''; ?>"><a href="#Newsletters" data-toggle="tab">Newsletters</a>
                    </li>
                    <li class="<?php echo ($active_tab == 'Create_Newsletter') ? 'active' : ''; ?>"><a  href="#Create_Newsletter" data-toggle="tab">Create Newsletter</a>
                    </li>
                    <li class="<?php echo ($active_tab == 'Subscriber') ? 'active' : ''; ?>"><a href="#Subscriber" data-toggle="tab">Subscriber</a>
                    </li>
                    <li class="<?php echo ($active_tab == 'Settings') ? 'active' : ''; ?>"><a href="#Settings" data-toggle="tab">Newsletter Settings</a>
                    </li>
                </ul>


                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade <?php echo ($active_tab == 'Newsletters') ? 'in active' : ''; ?>" id="Newsletters">

                        <div class="col-lg-12">
                            <?php
                            if ($this->session->flashdata('success')) {
                                echo '<div class="alert alert-success">';
                                echo '<p>' . $this->session->flashdata('success') . '</p>';
                                echo '</div>';
                            }

                            if ($this->session->flashdata('error')) {
                                echo '<div class="alert alert-warning">';
                                echo '<p>' . $this->session->flashdata('error') . '</p>';
                                echo '</div>';
                            }
                            ?>   
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Newsletter
                            </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>

                                                    <th>Creation Date</th>
                                                    <th>Sent</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($allNewsletters as $allNewsletter) { ?>
                                                    <tr>
                                                        <td><h4><?php echo $allNewsletter->title; ?></h4></td>
                                                        <td><h4><?php echo $allNewsletter->creation_date; ?></h4></td>
                                                        <td><h4><?php echo ($allNewsletter->sent != '0000-00-00') ? $allNewsletter->sent : 'Not yet sent'; ?></h4></td>

                                                        <td>
                                                            <div class="onoffswitch">
                                                                <input type="checkbox" name="n_status" class="n_status onoffswitch-checkbox" data-id="<?php echo $allNewsletter->id; ?>" id="<?php echo 'n_status' . $allNewsletter->id; ?>" value="<?php echo $allNewsletter->status; ?>" <?php
                                                                if ($allNewsletter->status == 1) {
                                                                    echo 'checked';
                                                                }
                                                                ?>>
                                                                <label class="onoffswitch-label" for="<?php echo 'n_status' . $allNewsletter->id; ?>">
                                                                    <span class="onoffswitch-inner"></span>
                                                                    <span class="onoffswitch-switch"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-success" title="View/Edit" href="<?php echo site_url('admin/newsletter/index/Create_Newsletter/' . $allNewsletter->id); ?>"><i class="fa fa-pencil"></i></a>
                                                            <a onclick="return confirm('Are you sure?')" class="btn btn-warning" title="Delete" href="<?php echo site_url('admin/newsletter/delete/' . $allNewsletter->id); ?>"><i class="fa fa-trash"></i></a>
                                                            <a class="btn btn-info" <?php
                                                            if ($allNewsletter->status == 0) {
                                                                echo "disabled='disabled'";
                                                            }
                                                            ?> title="Send to all" href="<?php echo $allNewsletter->status == 0 ? '#' : site_url('admin/newsletter/send/' . $allNewsletter->id); ?>"><i class="fa fa-paper-plane"></i></a>
                                                        </td>
                                                    </tr>    
                                        <?php } ?>
                                            </tbody>
                                        </table>
<?php echo $links ?>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        </p>

                    </div>

                    <div class="tab-pane fade <?php echo ($active_tab == 'Create_Newsletter') ? 'in active' : ''; ?>" id="Create_Newsletter">
                        <!--start add newsletter section-->

                        <br>
                        <?php
                        if ($this->session->flashdata('n_success')) {
                            echo '<div class="alert alert-success">';
                            echo '<p>' . $this->session->flashdata('n_success') . '</p>';
                            echo '</div>';
                        }

                        if ($this->session->flashdata('n_error')) {
                            echo '<div class="alert alert-warning">';
                            echo '<p>' . $this->session->flashdata('n_error') . '</p>';
                            echo '</div>';
                        }
                        ?>   
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Create Newsletter 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
<?php echo form_open('admin/newsletter/add', 'class="form-horizontal style-form" enctype="multipart/form-data" accept-charset="UTF-8"'); ?>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Title:</label>
                                                <div class="col-sm-10">
<?php echo form_hidden('id', set_value('id', $newsletter->id), 'class="form-control" placeholder="id"'); ?>
<?php echo form_input('title', set_value('title', $newsletter->title), 'class="form-control" placeholder="Title"'); ?>
                                                </div>
                                            </div>
                                           <!-- <div class="form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Summary:</label>
                                                <div class="col-sm-10">
<?php //echo form_input('summary', set_value('summary', $newsletter->summary), 'class="form-control" placeholder="Summary"'); ?>
                                                </div>
                                            </div>-->
                                            <div class="form-group">
                                                <label class="col-sm-2 col-sm-2 control-label">Content:</label>
                                                <div class="col-sm-10">
<?php echo form_textarea('contant', set_value('contant', $newsletter->contant), 'class="form-control" placeholder="Content"') ?>
                                                </div>
                                            </div>            


<?php if ($newsletter->image) { ?>
                                                <div class="form-group">
                                                    <label class="col-sm-2 col-sm-2 control-label">Upload:</label>
                                                    <div class="col-sm-10">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <img src="<?php echo $newsletter->image; ?>" class="img-responsive img-thumbnail center-block">
                                                                <a href="<?php echo site_url('admin/newsletter/removeimage/' . $newsletter->id); ?>" class="btn btn-block btn-warning">Remove Image</a>
                                                                <?php
                                                                echo form_hidden('image', set_value('image', $newsletter->image));
                                                                ?>
                                                                <input type="file" name="image" style="display: none" class="btn btn-default" id="userfile" readonly="true"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                            
<?php } else { ?>                               
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail center-block" data-trigger="fileinput" ></div>
                                                        <label for="" class="col-sm-3 control-label">Select image</label>
                                                        <div class="col-sm-9">                                            
                                                            <span class="btn-group">
                                                                <input type="file" name="image" class="btn btn-default" id="userfile" readonly="true"/>
                                                            </span>
                                                            <a href="#" class="btn btn-default" data-dismiss="fileinput" style="padding-left: 10px">Remove</a>
                                                            <span style="padding-left: 10px">jpeg,png</span>
                                                        </div>
                                                    </div>
                                                </div>
                                           
                                                <div class="clearfix" style="margin-bottom: 10px;"></div>

                                                <div class="alert alert-info" role="alert">
                                                    <strong>File Size:</strong><br>
                                                    Size: 500px X 500px
                                                </div>
                                           
                                                <script type="text/javascript">
                                                    var _URL = window.URL || window.webkitURL;

                                                    $("#userfile").change(function (e) {
                                                        var file, img;


                                                        if ((file = this.files[0])) {
                                                            img = new Image();
                                                            img.onload = function () {
                                                                var width = this.width;
                                                                var height = this.height;

                                                                if(width == 500 && height == 500){
                                                                    $("#submit").prop('disabled', false);
                                                                } else {
                                                                    alert('invalid image size. please upload mentioned size image');
                                                                    $("#submit").prop('disabled', true);
                                                                }
                                                            };
                                                            img.onerror = function () {
                                                                alert("not a valid file: " + file.type);
                                                            };
                                                            img.src = _URL.createObjectURL(file);
                                                        }

                                                    });
                                                </script>
                                            <?php } ?>

                                            <?php
                                            echo form_hidden('status', set_value('status', $newsletter->status), 'class="form-control" placeholder="Status"');
                                            echo form_hidden('creation_date', set_value('creation_date', $newsletter->creation_date), 'class="form-control" placeholder="Date"');
                                            ?>
                                        <?php echo form_submit('submit', 'Save', 'class="btn btn-success pull-right" id="submit"'); ?>                            
                                        </div>
<?php echo form_close(); ?>
                                    </div>                    
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                        <!--end add newsletter seciton-->
                    </div>
                    <div class="tab-pane fade <?php echo ($active_tab == 'Subscriber') ? 'in active' : ''; ?>" id="Subscriber">
                        <br>
                        <?php
                        if ($this->session->flashdata('sub_success')) {
                            echo '<div class="alert alert-success">';
                            echo '<p>' . $this->session->flashdata('sub_success') . '</p>';
                            echo '</div>';
                        }

                        if ($this->session->flashdata('sub_error')) {
                            echo '<div class="alert alert-warning">';
                            echo '<p>' . $this->session->flashdata('sub_error') . '</p>';
                            echo '</div>';
                        }
                        ?>   
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Add Subscriber
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
<?php echo form_open('admin/newsletter/Addsubscribers', 'class="form-horizontal style-form" enctype="multipart/form-data" accept-charset="UTF-8"'); ?>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">Email:</label>
                                            <div class="col-sm-6">
                                                <?php echo form_hidden('id', set_value('id', $subscriber->id), 'class="form-control" placeholder="id"'); ?>
                                                <?php echo form_hidden('subscription_date', set_value('subscription_date', $subscriber->subscription_date), 'class="form-control" placeholder="id"'); ?>
                                                <?php echo form_hidden('status', set_value('status', $subscriber->status), 'class="form-control" placeholder="Status"'); ?>

                                        <?php echo form_input('email', set_value('email', $subscriber->email), 'class="form-control" placeholder="Email"'); ?>
                                            </div>
                                            <?php echo form_submit('submit', 'Add', 'class="btn btn-success "'); ?>  
                                        </div>
                                        
                                    </div>
<?php echo form_close(); ?>


                                </div>
                            </div>

                        </div>
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="subscribtion_table">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Subscription Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
            <?php foreach ($allsubcribers as $allsubsciber) { ?>

                                                <tr class="gradeA">
                                                    <td class="center"><?php echo $allsubsciber->email; ?></td>
                                                    <td class="center"><?php echo $allsubsciber->subscription_date; ?></td>
                                                    <td class="center"> <div class="onoffswitch">
                                                            <input type="checkbox" name="s_status" class="s_status onoffswitch-checkbox" data-id="<?php echo $allsubsciber->id; ?>" id="<?php echo 's_status' . $allsubsciber->id; ?>" value="<?php echo $allsubsciber->status; ?>" <?php
                                                            if ($allsubsciber->status == 1) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                                                            <label class="onoffswitch-label" for="<?php echo 's_status' . $allsubsciber->id; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div></td>
                                                    <td class="center"> <a class="btn btn-success btn-sm" href="<?php echo site_url('admin/newsletter/index/Subscriber/' . $allsubsciber->id); ?>"><i class="fa fa-pencil"></i></a>
                                                        <a onclick="return confirm('Are you sure?')"  class="btn btn-warning btn-sm" href="<?php echo site_url('admin/newsletter/deleteSubcriber/' . $allsubsciber->id); ?>"><i class="fa fa-trash"></i></a></td>

                                                </tr>
            <?php } ?>


                                        </tbody>
                                    </table>
                                </div>

                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>


                    </div>
                    <div class="tab-pane fade <?php echo ($active_tab == 'Settings') ? 'in active' : ''; ?>" id="Settings">
                        <br>
                        <?php
                        if ($this->session->flashdata('ns_success')) {
                            echo '<div class="alert alert-success">';
                            echo '<p>' . $this->session->flashdata('ns_success') . '</p>';
                            echo '</div>';
                        }

                        if ($this->session->flashdata('ns_error')) {
                            echo '<div class="alert alert-warning">';
                            echo '<p>' . $this->session->flashdata('ns_error') . '</p>';
                            echo '</div>';
                        }
                        ?>   
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Newletter Setting
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
<?php echo form_open('admin/newsletter/addNewletterSetting', 'class="form-horizontal style-form" enctype="multipart/form-data" accept-charset="UTF-8"'); ?>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">SMTP Host:</label>
                                            <div class="col-sm-10">  
<?php echo form_hidden('id', set_value('id', $nSetting->id), 'class="form-control" placeholder="id"'); ?>
<?php echo form_input('smtp_host', set_value('smtp_host', $nSetting->smtp_host), 'class="form-control" placeholder="Example:mail.Domain.com"'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">SMTP Port:</label>
                                            <div class="col-sm-10">  
<?php echo form_input('smtp_port', set_value('smtp_port', $nSetting->smtp_port), 'class="form-control" placeholder="Example:25"'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">Email:</label>
                                            <div class="col-sm-10">  
<?php echo form_input('email', set_value('email', $nSetting->email), 'class="form-control" placeholder="example@domain.com"'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">Password:</label>
                                            <div class="col-sm-10">  
                                        <?php echo form_password('password', set_value('password', $nSetting->password), 'class="form-control" placeholder="Password"'); ?>
                                            </div>
                                        </div>
                                    <?php echo form_submit('submit', 'save', 'class="btn btn-success pull-right"'); ?>      
                                    </div>
<?php echo form_close(); ?>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>
<!-- /.row --> 
</div>
<!-- /.row -->   
<script type="text/javascript">
    $(document).on('click', '.n_status', function () {

        var id = ($(this).data("id"));

        if ($("#n_status" + id).val() == '1') {
            var status = 0;
        } else {
            var status = 1;
        }

        $.ajax({
            url: "<?php echo site_url('admin/newsletter/ChangeNstatus'); ?>",
            type: "post",
            data: {'id': id, 'status': status, },
            success: function (text)
            {
                window.location.href = '<?php echo site_url('admin/newsletter/index/Newsletters'); ?>';

            }
        });

    });
    $(document).on('click', '.s_status', function () {

        var id = ($(this).data("id"));

        if ($("#s_status" + id).val() == '1') {
            var status = 0;
        } else {
            var status = 1;
        }

        $.ajax({
            url: "<?php echo site_url('admin/newsletter/ChangeSstatus'); ?>",
            type: "post",
            data: {'id': id, 'status': status, },
            success: function (text)
            {
                 window.location.href = '<?php echo site_url('admin/newsletter/index/Subscriber'); ?>';


            }
        });

    });


</script>
<script>
    $(document).ready(function () {
        $('#subscribtion_table').DataTable({
            responsive: true
        });
    });
</script>
