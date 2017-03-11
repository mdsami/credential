<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add User</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-8">
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
                            <?php if($user->id == $this->session->userdata('id')){?>
                            <div class="form-group" id="priceDiv">
                                <label class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-9">
                                    <?php echo form_password('password', '', 'class="form-control" placeholder="Password"') ?>
                                    <?php echo form_hidden('password2', set_value('password2', $user->password), 'class="form-control" placeholder="Password"') ?>
                                </div>
                            </div>     
                            <?php } ?>
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
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Type:</label>
                                <div class="col-sm-9">
                                    <?php 
                                        if($this->session->userdata('user_type') === 'Administrator'){
                                            echo form_dropdown('user_type', array('Developer' => 'Developer', 'User' => 'User', 'Administrator' => 'Administrator'), $this->input->post('user_type') ? $this->input->post('user_type') : $user->user_type, 'class="form-control tokenize-sample"'); 
                                        } else {
                                            echo form_dropdown('user_type', array('Developer' => 'Developer', 'User' => 'User', 'Administrator' => 'Administrator', 'Master' => 'Master'), $this->input->post('user_type') ? $this->input->post('user_type') : $user->user_type, 'class="form-control tokenize-sample"'); 
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php if ($user->thumb_picture) { ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Upload:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img src="<?php echo $user->thumb_picture; ?>" class="img-responsive img-thumbnail center-block">
                                                <a href="<?php echo site_url('admin/users/removeimage/' . $user->id); ?>" class="btn btn-block btn-warning">Remove Image</a>
                                                <?php
                                                echo form_hidden('thumb_picture', set_value('thumb_picture', $user->thumb_picture), 'class="form-control" placeholder="Date"');
                                                echo form_hidden('orginal_picture', set_value('orginal_picture', $user->orginal_picture), 'class="form-control" placeholder="Date"');
                                                ?>
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
                                            <input type="file" name="userfile" class="btn btn-default" id="userfile" readonly="true"/>
                                            <?php echo form_hidden('filename', 1, 'class="form-control" placeholder="Date"'); ?>
                                        </span>
                                        <a href="#" class="btn btn-default" data-dismiss="fileinput" style="padding-left: 10px">Remove</a>
                                        <span style="padding-left: 10px">jpeg, png</span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <?php
                            echo form_hidden('status', set_value('status', $user->status), 'class="form-control" placeholder="Status"');
                            echo form_hidden('date', set_value('date', $user->date), 'class="form-control" placeholder="Date"');
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
                <i class="fa fa-users fa-fw"></i>
                Member List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="chat">
                    <?php
                    foreach ($users as $user) {
                        echo '<li class="left clearfix">
                        <h5><a href="' . base_url() . 'admin/users/add/' . $user->id . '"><strong class="primary-font">' . $user->username . '</strong></a></h5>
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