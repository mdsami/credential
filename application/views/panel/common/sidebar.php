<ul class="nav" id="side-menu">
    <li>
        <a href="<?php echo site_url('admin/panel');?>"><i class="fa fa-dashboard fa-fw"></i> Panel</a>
    </li>
    <?php if($this->session->userdata('user_type')=='Administrator' || $this->session->userdata('user_type')=='Master'){ ?>
    <li>
        <a href="#"><i class="fa fa-globe fa-fw"></i> Domain<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="<?php echo site_url('admin/domain/add');?>">Create Domain</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/domain/manage');?>">Manage Domain</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/domain/trash');?>">Trash</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <?php } ?>
    <li>
        <a href="#"><i class="fa fa-key fa-fw"></i> Credential<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="<?php echo site_url('admin/credential/add')?>">Create Credential</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/credential/manage');?>">Manage Credential</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/credential/trash');?>">Trash</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/assign/manage');?>">Manage Assign</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="<?php echo site_url('admin/logs');?>"><i class="fa fa-info-circle fa-fw"></i> Logs</a>
    </li>   
    <?php if($this->session->userdata('user_type')=='Master'){ ?>
    <li>
        <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="<?php echo site_url('admin/users/add');?>">Create User</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/users/manage');?>">Manage User</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/users/trash');?>">Trash</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="<?php echo site_url('admin/newsletter');?>"><i class="fa fa-newspaper-o fa-fw"></i> Newsletters</a>        
    </li>
    <li>
        <a href="<?php echo site_url('admin/settings')?>"><i class="fa fa-cog fa-fw"></i> Settings</a>
    </li>    
    <?php } ?>    
</ul>