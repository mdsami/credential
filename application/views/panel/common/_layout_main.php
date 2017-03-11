<?php $this->load->view('panel/common/_page_head');?>

<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('admin/panel');?>"><?php echo $setting->slogan;?> Admin</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="<?php echo site_url();?>" target="_blank">
                    <?php echo $setting->slogan;?>
                </a>                    
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <?php if($this->session->userdata('user_type') === 'Master'){ ?>
                    <li><a href="<?php echo site_url('admin/users/add/'.$this->session->userdata('id'));?>"><i class="fa fa-user fa-fw"></i> Edit Profile</a></li>
                    <li class="divider"></li>
                    <?php } ?>
                    <li><a href="<?php echo site_url('login/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->    
        
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php $this->load->view('panel/common/sidebar');?>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <?php $this->load->view($sub_view, FALSE);?>
    </div>
    <!-- /#page-wrapper --> 
</div>
<!-- /#wrapper -->
        
<?php $this->load->view('panel/common/_page_tail');?>