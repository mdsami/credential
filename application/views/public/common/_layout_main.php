
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $setting->meta_description; ?>">
        <meta name="keywords" content="<?php echo $setting->meta_keyword; ?>">
        <meta name="author" content="<?php echo $setting->site_title; ?>">
        <meta property="og:title" content="<?php echo $setting->site_title; ?>" />
        <meta property="og:description" content="<?php echo $setting->meta_description; ?>" />
        
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo $setting->site_title; ?></title>

        <!-- Bootstrap CSS-->
        <link  href="<?php echo site_url('assets/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url('assets/bootstrap/css/bootstrap-theme.css'); ?>" rel="stylesheet" type="text/css"/>

        <!-- Custom Css-->
        <link href="<?php echo site_url('assets/css/custom.css'); ?>" rel="stylesheet" type="text/css"/>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.min.js'); ?>" ></script>

    </head>
    <body>
        <?php if ($setting->site_offline == 0) { ?>
            <section class="intro-sec-1 gap gap-fixed-height-large">        
                <div class="skrollable skrollable-between" id="intro">
                    <div class="container">
                        <div class="intro-line"></div>

                        <h1>
                            <i class="fa fa-exclamation-triangle fa-3x"></i>
                            <br>
                            <span class="big-h1"><?php echo $setting->offline_text; ?></span>
                        </h1>
                        
                        <div class="intro-line"></div>                           
                        
                    </p>
                    </div> <!-- end container -->
                </div> <!-- end intro -->                
            </section>
        <?php } else { 
        $this->load->view('public/common/_page_head');
        $this->load->view($subview);
        $this->load->view('public/common/_page_tail');
        } ?>

        <script src="<?php echo site_url('assets/bootstrap/js/bootstrap.js'); ?>" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo site_url('assets/js/custom.js'); ?>" ></script>

    </body>
</html>