<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo $setting->site_title; ?></title>

        <!-- Bootstrap -->
        <link href="<?php echo site_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

        <!-- Custom Style --->
        <link href="<?php echo site_url('assets/css/login.css'); ?>" rel="stylesheet">

        <!-- Google Web Font -->
        <link href='https://fonts.googleapis.com/css?family=Courgette|PT+Serif:400,700' rel='stylesheet' type='text/css'>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo site_url('assets/jquery/jquery.min.js') ?>"></script>
        
    </head>
    <body>
        <div class="container">
            <div class="row login_box">
                <div class="col-md-12 col-xs-12" align="center">
                    <div class="line">
                        <script type="text/javascript">
                            document.write ('<h3 style="padding-top: 10px; color: #ddd;"><span id="date-time">', new Date().toLocaleString(), '<\/span><\/h3>')
                                    if (document.getElementById) onload = function () {
                            setInterval ("document.getElementById ('date-time').firstChild.data = new Date().toLocaleString()", 50)
                            }
                        </script>
                    </div>
                    <?php if($setting->logo) {?>
                    <div class="outter">
                        <img id="userImage" src="<?php echo $setting->logo;?>" class="img-responsive"/>
                    </div>
                    <?php } else { ?>
                    <a href="" class="thumbnail">
                        <h1 id="userName"><?php echo $setting->slogan;?></h1>
                    </a>
                    <?php } ?>
                </div>
                <div class="col-md-12 col-xs-12 login_control">
                    <form id="login" name="login" action="" method="post">
                        <?php
                        if (validation_errors()) {
                            echo validation_errors();
                        } else {
                            echo $this->session->flashdata('message');
                        }
                        ?>
                        <div class="control">
                            <div class="label">User Name / Email</div>
                            <input type="text" name="username" id="username" class="form-control input-lg" placehosled="User name / Email"/>
                        </div>

                        <div class="control">
                            <div class="label">Password</div>
                            <input type="password" name="password" id="password" class="form-control input-lg" placehosled="Password"/>
                        </div>
                        
                        <div class="control">
                            <p><a data-toggle="modal" data-target="#squarespaceModal" href="<?php echo site_url('login/forget');?>">Forget Password</a></p>
                        </div>
                        
                        <div align="center">
                            <button id="loginBtn" class="btn btn-orange">LOGIN</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>        

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

        <script type="text/javascript">
            /*$(function(){
                $('#username').focusout(function(){
                    var username = this.value;
                    
                     $.ajax({

                        url: "<?php //echo site_url('login/get_user_info');?>",
                        type: "post",
                        data: {'username':username},
                        success : function(text)
                        {
                            
                        }
                    });
                });
                
                /*$('#username').on("input", function() {
                    var dInput = this.value;
                    
                    alert(dInput);
                    
                });
                
                $( "#login" ).click(function(event) {

                    event.preventDefault();
                          $.ajax({
//
//                        url: "<?php //echo site_url('reservation/loadMap');?>",
//                        type: "post",
//                        data: {'date':bookingDate},
//                        success : function(text)
//                        {
//                            $('#mapWrap').html(text);
//                        }
//                    });
                });
            });*/
        </script>

    </body>
</html>