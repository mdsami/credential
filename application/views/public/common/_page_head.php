<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $setting->site_title; ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="javascript:void(0)"><i class="fa fa-user"></i>  <?php echo $this->session->userdata('username');?></a></li>
                <?php if($this->session->userdata('user_type') != 'User' && $this->session->userdata('user_type') != 'Developer'){ ?>
                <li><a href="<?php echo site_url('admin/panel');?>"><i class="fa fa-tachometer"></i> CMS</a></li>  
                <?php } else { ?>
                <li><a href="<?php echo site_url('welcome/index/');?>"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="<?php echo site_url('welcome/editProfile/'.$this->session->userdata('id'));?>"><i class="fa fa-pencil"></i> Edit Profile</a></li>
                <?php } ?>
                <?php if($this->session->userdata('user_type') === 'Administrator'){ ?>
                <li><a href="<?php echo site_url('welcome/editProfile/'.$this->session->userdata('id'));?>"><i class="fa fa-pencil"></i> Edit Profile</a></li>
                <?php } ?>
                <li><a href="<?php echo site_url('login/logout');?>"><i class="fa fa-sign-out"></i> Logout</a></li>                
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>