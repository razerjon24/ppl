<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Peer Project Learning</title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/ppl_ico.ico">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/college-green/assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/college-green/assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/college-green/assets/plugins/flexslider/flexslider.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/college-green/assets/plugins/pretty-photo/css/prettyPhoto.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?php echo base_url() ?>/assets/college-green/assets/css/styles.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body class="home-page">
<div class="wrapper">
    <header class="header">
        <div class="top-bar">
            <div class="container">
                <ul class="social-icons col-md-6 col-sm-6 col-xs-12 hidden-xs">
                    <li><a href="https://www.facebook.com/profile.php?id=100010529286647" ><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.youtube.com/channel/UCWLfhHLM0yT-NymsVWe9M1A" ><i class="fa fa-youtube"></i></a></li>
                </ul><!--//social-icons-->
            </div>
        </div><!--//to-bar-->
        <div class="header-main container">
            <div class="logo col-md-2 col-sm-2 col-xs-3">
                <a href="<?php echo base_url()?>"  ><img id="logo" class="img-responsive center-block" src="<?php echo base_url() ?>/assets/images/ppl_logo.png" alt="Logo"></a>
            </div>
            <div class="logo col-md-7 col-sm-7 col-xs-9">
                <img class="img-responsive pull-left" src="<?php echo base_url() ?>/assets/images/ppl_words.png" alt="Logo">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6" >
                <a href="http://www.fcnm.espol.edu.ec/" ><img class="img-responsive center-block" src="<?php echo base_url() ?>/assets/images/fcnm_logo.png" alt="Logo"></a>
            </div>
        </div><!--//header-main-->
    </header><!--//header-->
    <!-- ******NAV****** -->
    <nav class="main-nav" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><!--//nav-toggle-->
            </div><!--//navbar-header-->
            <div class="navbar-collapse collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php /*if(isset($video)){
                        echo '<li class="nav-item"><a href="'.base_url().'">Home</a></li>';
                    }*/
                    if(isset($contact)){
                        echo '<li class="nav-item"><a href="'.base_url().'">Home</a></li>';
                    }
                    else{
                        echo '<li class="nav-item active"><a href="'.base_url().'">Home</a></li>';
                    }?>
                    <!--<li class="nav-item"><a id="reg-button" href="#">Register</a></li>-->
                    <li class="nav-item"><a id="log-button" href="#">Login</a></li>
                     <?php if(isset($about)){
                                            echo '<li class="nav-item active"><a href="'.base_url().'index.php/about">About <? echo base_url();?></a></li>';
                                        }
                                        else{
                                            echo '<li class="nav-item"><a href="'.base_url().'index.php/about">About <? echo base_url();?></a></li>';
                                        }?>
                    <?php if(isset($contact)) {
                        echo '<li class="nav-item active" ><a href ="'.base_url().'index.php/contact">Contact</a ></li >';
                    }
                    else{
                        echo '<li class="nav-item" ><a href ="'.base_url().'index.php/contact">Contact</a ></li >';
                    }?>
                </ul><!--//nav-->
            </div><!--//navabr-collapse-->
        </div><!--//container-->
    </nav><!--//main-nav-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/pretty-photo/js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/flexslider/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/jflickrfeed/jflickrfeed.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/js/main.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/js/bpopup.js"></script>
    <div class="panel panel-primary" style="display: none;" id="register">
        <div class="panel-heading"><h2 class="panel-title">Register</h2></div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/account/register_student/') ?>">
                <div class="form-group">
                    <label class="col-sm-3 control-label bold">First name</label>
                    <div class="col-sm-9">
                        <input type="text" size="30" maxlength="100" class="form-control" name="reg-firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label bold">Last name</label>
                    <div class="col-sm-9">
                        <input type="text" maxlength="100" class="form-control" name="reg-lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label bold">Email</label>
                    <div class="col-sm-9">
                        <input type="email" maxlength="50" class="form-control" name="reg-email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label bold">Password</label>
                    <div class="col-sm-9">
                        <input type="password" maxlength="50" class="form-control" name="reg-password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label bold">University</label>
                    <div class="col-sm-9">
                        <select name="reg-university" class="form-control">
                            <option class="form-control">ESPOL</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <a href="<?php echo base_url()?>index.php/contact" class="bold" data-toggle="tooltip" data-placement="bottom" title="Contact us">Is your university not listed?</a>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary btn-md disabled" data-toggle="tooltip" data-placement="bottom" title="Disabled for now">Register</button>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-primary" style="display: none;" id="login">
        <div class="panel-heading"><h2 class="panel-title">Login</h2></div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/account/verify/') ?>">
                <div class="form-group">
                    <label class="col-sm-4 control-label bold">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="login-email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label bold">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="login-password" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <a href="<?php echo base_url('index.php/account/forgot') ?>" class="bold" title="Forgot Password">Forgot Password?</a>
                    </div>
                </div>
                <div class="text-center">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="submit" name="type" class="btn btn-primary btn-md" value="instructor">Instructor</button>
                        <button type="submit" name="type" class="btn btn-primary btn-md" value="student">Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function() {
            $('#log-button').on('click', function(e) {

                // Prevents the default action to be triggered.
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#login').bPopup();

            });
            $('#reg-button').on('click', function(e) {

                // Prevents the default action to be triggered.
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#register').bPopup();

            });
        });
        $(".nav-item").on("click", function(){
            $(".nav").find(".active").removeClass("active");
            $(this).addClass("active");
        });
    </script>