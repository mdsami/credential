<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User <stront class="text-uppercase"><?php echo $user->username;?></strong> Information
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
                                    <label class="col-sm-3 control-label">Full Name:</label>
                                    <div class="col-sm-9">
                                        <?php echo form_hidden('id', set_value('id', $user->id), 'class="form-control" placeholder="id"'); ?>
                                        <?php echo form_input('full_name', set_value('full_name', $user->full_name), 'class="form-control" placeholder="Full Name"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">User Name:</label>
                                    <div class="col-sm-9">
                                        <?php
                                        if ($user->id) {
                                            echo form_input('username', set_value('username', $user->username), 'class="form-control" placeholder="User Name" readonly');
                                        } else {
                                            echo form_input('username', set_value('username', $user->username), 'class="form-control" placeholder="User Name"');
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group" id="priceDiv">
                                    <label class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9">
                                        <?php echo form_password('password', '', 'class="form-control" placeholder="Password"') ?>
                                        <?php echo form_hidden('password2', set_value('password2', $user->password), 'class="form-control" placeholder="Password"') ?>
                                    </div>
                                </div>                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email:</label>
                                    <div class="col-sm-9">
                                        <?php echo form_input('email', set_value('email', $user->email), 'class="form-control" placeholder="Email"') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Contact Number:</label>
                                    <div class="col-sm-9">
                                        <?php echo form_input('contact_no', set_value('contact_no', $user->contact_no), 'class="form-control" placeholder="Contact Number"') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Address:</label>
                                    <div class="col-sm-9">
                                        <?php echo form_input('address', set_value('address', $user->address), 'class="form-control" placeholder="Address"') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Remark:</label>
                                    <div class="col-sm-9">
                                        <?php echo form_textarea('remark', set_value('remark', $user->remark), 'class="form-control" placeholder="Remark"') ?>
                                    </div>
                                </div>
                                <?php
                                echo form_hidden('user_type', set_value('user_type', $user->user_type), 'class="form-control" placeholder="Status"');
                                echo form_hidden('status', set_value('status', $user->status), 'class="form-control" placeholder="Status"');
                                echo form_hidden('date', set_value('date', $user->date), 'class="form-control" placeholder="Date"');
                                ?>
                                <?php echo form_submit('submit', 'Update', 'class="btn btn-success pull-right"'); ?>                            
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
    </div>
</div>

