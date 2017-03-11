<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Basic Settings</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <?php
        if ($this->session->flashdata('s_success')) {
            echo '<div class="alert alert-success">';
            echo '<p>' . $this->session->flashdata('s_success') . '</p>';
            echo '</div>';
        }

        if ($this->session->flashdata('s_error')) {
            echo '<div class="alert alert-warning">';
            echo '<p>' . $this->session->flashdata('s_error') . '</p>';
            echo '</div>';
        }
        ?>   
        <div class="panel panel-default">
            <div class="panel-heading">
                Site settings
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

                        <?php echo form_open('', 'class="form-horizontal style-form" enctype="multipart/form-data" accept-charset="UTF-8"'); ?>
                        <div class="col-lg-12">

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Site Title:</label>
                                <div class="col-sm-10">
                                    <?php echo form_hidden('id', set_value('id', $settings->id), 'class="form-control" placeholder="id"'); ?>
                                    <?php echo form_input('site_title', set_value('site_title', $settings->site_title), 'class="form-control" placeholder="Full Name"'); ?>
                                </div>
                            </div>
                            <!-- <div class="fileinput fileinput-new" data-provides="fileinput">
 
                                 <div class="fileinput-preview thumbnail" data-trigger="fileinput" ></div>
                                 <div style="border: 1px solid #ccc; padding-left: 0px">
                                     <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                         <input type="file" name="p_image" width="500" class="btn btn-success"></span>
                                     <a href="#" class="btn btn-default"" data-dismiss="fileinput" style="padding-left: 10px">Remove</a>
                                     <span style="padding-left: 30px">jpeg, png</span>
                                 </div>
                             </div> -->
                            <?php if ($settings->logo) { ?>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Upload:</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img src="<?php echo $settings->logo; ?>" class="img-responsive img-thumbnail center-block">
                                                <a href="<?php echo site_url('admin/settings/removeimage/' . $settings->id); ?>" class="btn btn-block btn-warning">Remove Image</a>
                                                <?php
                                                echo form_hidden('logo', set_value('logo', $settings->logo));
                                                ?>
                                                <input type="file" name="logo" style="display: none" class="btn btn-default" id="userfile" readonly="true"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            <?php } else { ?>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Upload:</label>
                                    <div class="col-sm-10">
                                        <label>
                                            <input type="file" name="logo" class="btn btn-default" id="userfile" readonly="true"/>

                                        </label>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Logo Text:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('slogan', set_value('slogan', $settings->slogan), 'class="form-control" placeholder="Slogan"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Site Offline:</label>
                                <div class="col-sm-10">
                                    <?php echo form_dropdown('site_offline', array('0' => 'Off Line', '1' => 'On Line',), $this->input->post('site_offline') ? $this->input->post('site_offline') : $settings->site_offline, 'class="form-control tokenize-sample"'); ?>
                                </div>
                            </div>                                    

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Offline text:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('offline_text', set_value('offline_text', $settings->offline_text), 'class="form-control" placeholder="offline_text"') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Meta description:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('meta_description', set_value('meta_description', $settings->meta_description), 'class="form-control" placeholder="Meta Description"') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Meta keyword:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('meta_keyword', set_value('meta_keyword', $settings->meta_keyword), 'class="form-control" placeholder="Meta Keyword"') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Address:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('address', set_value('address', $settings->address), 'class="form-control" placeholder="Address"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">phone_fax:</label>
                                <div class="col-sm-10">
                                    <?php echo form_textarea('phone_fax', set_value('phone_fax', $settings->phone_fax), 'class="form-control" placeholder="Phone Fax"') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">email:</label>
                                <div class="col-sm-10">
                                    <?php echo form_textarea('email', set_value('email', $settings->email), 'class="form-control" placeholder="Email"') ?>
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Copy Right:</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('copy_right', set_value('copy_right', $settings->copy_right), 'class="form-control" placeholder="Copy Right"') ?>
                                </div>
                            </div> 
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

</div>
<!-- /.row -->