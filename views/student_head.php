<!DOCTYPE html>
<html lang="en">
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <title>PPL Student</title>-->
<!--    <link rel="stylesheet" href="--><?php //echo base_url();?><!--bootstrap/css/bootstrap.min.css">-->
<!--    <link rel="icon" href="--><?php //echo base_url();?><!--assets/images/ppl-icon.ico">-->
<!--    <script src="http://code.jquery.com/jquery-latest.js"></script>-->
<!--    <script type="text/javascript" src="--><?php //echo base_url();?><!--bootstrap/js/bootstrap.min.js"></script>-->
<!--</head>-->
<!--<body>-->
<!--<header>-->
<!--    <nav class="navbar navbar-default navbar-fixed-top">-->
<!--        <div class="container-fluid" style="padding-left: 0">-->
<!--            <!-- Brand and toggle get grouped for better mobile display -->
<!--            <div class="navbar-header">-->
<!--                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">-->
<!--                    <span class="sr-only">Toggle navigation</span>-->
<!--                    <span class="icon-bar"></span>-->
<!--                    <span class="icon-bar"></span>-->
<!--                    <span class="icon-bar"></span>-->
<!--                </button>-->
<!--                <a href="--><?php //echo base_url()?><!--index.php/student"><img class="navbar-brand " style="margin: 0; padding: 0; height: 58px; width: 80px" alt="Brand" src="--><?php //echo base_url();?><!--assets/images/ppl-logo.png"></a>-->
<!--            </div>-->
<!---->
<!--            <!-- Collect the nav links, forms, and other content for toggling -->
<!--            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">-->
<!--                <ul class="nav navbar-nav navbar-right" style="margin-bottom: 0">-->
<!--                    <li class="dropdown">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-align: center; font-size: 18px; height: 58px; padding-top: 18px"><span class="glyphicon glyphicon-user"></span> <strong>--><?php //echo $student_name;?><!--</strong><span class="caret"></span></a>-->
<!--                        <ul class="dropdown-menu" role="menu" style='padding: 10px; background-color: #E7E7E7'>-->
<!--                            <li class="text-responsive"><a style="text-align: center; font-size: 18px" href="--><?php //echo base_url()?><!--index.php/account/password"> <strong>Change password</strong></a></li>-->
<!--                            <li class="divider" style="background-color: darkgray; margin: 5px"></li>-->
<!--                            <li class="text-responsive"><a style="text-align: center; font-size: 18px" href="--><?php //echo base_url()?><!--index.php/account/logout"> <strong>Logout</strong></a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </nav>-->
<!--</header>-->
<!--</body>-->
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
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<!--    <script type="text/javascript" src="--><?php //echo base_url();?><!--bootstrap/js/bootstrap.min.js"></script>-->
<!--    <link rel="stylesheet" href="--><?php //echo base_url();?><!--bootstrap/css/bootstrap.min.css">-->
<!--    <script src="http://code.jquery.com/jquery-latest.js"></script>-->

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
            <div class="logo col-md-4 col-sm-4 col-xs-6">
                <img id="logo" class="img-responsive center-block" src="<?php echo base_url() ?>/assets/images/ppl_logo.png" alt="Logo">
            </div>
            <div class="logo col-md-5 col-sm-5 col-xs-3">
                <img class="img-responsive center-block" src="<?php echo base_url() ?>/assets/images/vicerrectorado.png" alt="Logo">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3" >
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
                    <?php if(isset($video) or isset($contact) or isset($advisory)){
                        echo '<li class="nav-item"><a href="'.base_url('index.php/student/index').'">Home</a></li>';
                    }
                    else{
                        echo '<li class="nav-item active"><a href="'.base_url('index.php/student/index').'">Home</a></li>';
                    }?>
                    <?php if(isset($video)){
                        echo '<li class="nav-item active"><a href="'.base_url('index.php/video').'">Videos <? echo base_url();?></a></li>';
                    }
                    else{
                        echo '<li class="nav-item"><a href="'.base_url('index.php/video').'">Videos <? echo base_url();?></a></li>';
                    }?>
                    <?php if(isset($advisory)){
                        echo '<li class="nav-item active"><a href="'.base_url('index.php/advisory').'">Advisory <? echo base_url();?></a></li>';
                    }
                    else{
                        echo '<li class="nav-item"><a href="'.base_url('index.php/advisory').'">Advisory <? echo base_url();?></a></li>';
                    }?>
                    <li class="nav-item"><a href="https://app.perusall.com">Perusall</a></li>
                    <?php if(isset($about)){
                        echo '<li class="nav-item active"><a href="'.base_url('index.php/about').'">About <? echo base_url();?></a></li>';
                    }
                    else{
                        echo '<li class="nav-item"><a href="'.base_url('index.php/about').'">About <? echo base_url();?></a></li>';
                    }?>
                    <?php if(isset($contact)){
                        echo '<li class="nav-item active"><a href="'.base_url('index.php/contact').'">Contact</a></li>';
                    }
                    else{
                        echo '<li class="nav-item"><a href="'.base_url('index.php/contact').'">Contact</a></li>';
                    }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $student_name;?> <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="text-responsive"><a id="cpassword" href="#"> <strong>Change Password</strong></a></li>
                            <li class="text-responsive"><a href="<?php echo base_url('index.php/account/logout')?>"> <strong>Logout</strong></a></li>
                        </ul>
                    </li><!--//dropdown-->
                </ul><!--//nav-->
            </div><!--//navabr-collapse-->
        </div><!--//container-->
    </nav><!--//main-nav-->
    <div id="cpasswordpanel" class="panel panel-primary" style="display: none;">
        <div class="panel-heading"><h2 class="panel-title">Change Password</h2></div>
        <div class="panel-body">
            <form role='form' method='post' class="form-horizontal" action="<?php echo base_url();?>index.php/account/password">
                <div class="input-group">
                    <label class="input-group-addon" style="width: 43%">Old Password</label>
                    <input id="pass" class="form-control" name="old_pass" type="password" onchange="checkverified()" required>
                </div>
                <br>
                <div class="input-group">
                    <label class="input-group-addon" style="width: 43%">Confirm Password</label>
                    <input id="cfpass" class="form-control" type="password" onchange="checkverified()" required>
                </div>
                <div class="form-group text-center btn-lg" style="margin-bottom: 0">
                    <span id="verified" class="glyphicon glyphicon-remove-circle"></span>
                </div>
                <div class="input-group">
                    <label class="input-group-addon" style="width: 43%">New Password</label>
                    <input class="form-control" name="new_pass" type="password" required>
                </div>
                <br>
                <div class="text-center">
                    <input id="send" class="btn btn-primary btn-md" class="btn-primary" type="button" value="Change">
                </div>
            </form>
        </div>
    </div>
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
    <script>
        function checkverified(){
            var send, password, cfpassword, ok;
            ok = document.getElementById("verified");
            send = document.getElementById("send");
            password = document.getElementById("pass");
            cfpassword = document.getElementById("cfpass");
            if(password.value == cfpassword.value){
                ok.setAttribute("class","glyphicon glyphicon-ok-circle");
                send.setAttribute('type', 'submit');
            }
            else{
                ok.setAttribute("class","glyphicon glyphicon-remove-circle");
                send.setAttribute('type', 'button');
            }
        }
        $(function() {
            $('#cpassword').on('click', function(e) {

                // Prevents the default action to be triggered.
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#cpasswordpanel').bPopup();

            });
        });
    </script>
