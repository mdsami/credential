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

        <!-- Bootstrap -->
        <link href="<?php echo site_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

        <!-- Slider Css -->
        <link rel='stylesheet' id='camera-css'  href='<?php echo site_url('assets/camera/css/camera.css'); ?>' type='text/css' media='all'> 

        <!-- Custom Style --->
        <link href="<?php echo site_url('assets/css/custom.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/css/responsive.css'); ?>" rel="stylesheet">

        <!-- Google Web Font -->
        <link href='https://fonts.googleapis.com/css?family=Courgette|PT+Serif:400,700' rel='stylesheet' type='text/css'>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo site_url('assets/jquery/1.11.3/jquery.min.js'); ?>"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
            <style type="text/css">
                section {
                    background: #fff none repeat scroll 0 0;
                    display: block;
                    padding: 50px 0;
                    z-index: 9;
                }

                .gap-fixed-height-large {
                    height: 700px;
                }

                gap {
                    background: transparent none no-repeat scroll center center / cover ;
                }

                #intro {
                    left: 0;
                    margin: 0 auto;
                    padding: 150px 0;
                    position: relative;
                    right: 0;
                    text-align: center;
                    width: 100%;
                    z-index: 1;
                }

                .intro-line {
                    border-bottom: 1px solid #0e214c;
                    margin: 20px auto;
                    text-align: center;
                    width: 750px;
                }

                #intro h1, #intro p {
                    color: #0e214c;
                }
            </style>

            <section class="intro-sec-1 gap gap-fixed-height-large">        
                <div class="skrollable skrollable-between" id="intro">
                    <div class="container">
                        <?php if(empty($status)){ ?>
                             <h1>
                            <i class="fa fa-exclamation-triangle fa-3x"></i>
                            <br>
                            <span class="big-h1">You are already unsubscribed..</span>
                        </h1>
                      <?php   } else{
                          ?>
                        <div class="intro-line"></div>

                        <h1>
                            <i class="fa fa-exclamation-triangle fa-3x"></i>
                            <br>
                            <span class="big-h1">Confirm Unsubscribtion from Nissebeach.se</span>
                        </h1>
                        
                        <div class="intro-line"></div>   
                        
                        <p class="visible-lg text-center">
                        <a href="<?php echo site_url('unsubscribe/request/'.$id.'/1');?>">
                            <i class="fa fa-sign-out"></i>&nbsp;Confirm
                            &nbsp;&nbsp;&nbsp;
                        </a>
                       <a href="<?php echo site_url('Login');?>">
                            <i class="fa fa-times"></i>&nbsp;Cancel
                        </a>
                              </p>
                     <?php  }?>

                  
                    </div> <!-- end container -->
                </div> <!-- end intro -->                
            </section>


        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

        <!-- Custom JS --->
        <script src="<?php echo site_url('assets/js/custom.js') ?>"></script>        

    </body>
</html><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

