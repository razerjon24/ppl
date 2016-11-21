<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/video.css">
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/video.js"></script>
</head>
<!-- ******CONTENT****** -->
<div class="content container">
    <div id="video_pop" style="display: none; width: 70%; height: 70%;" align="center">
        <iframe id="video" style="width: 100%; height: 100%" frameborder="0" allowfullscreen></iframe>
<!--        <video id="video" style="width: 100%; height: auto" controls autoplay><source type="video/mp4"></video>-->
    </div>
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <?php if(isset($modulo)){
                echo '<h1 class="heading-title pull-left">'.$modulo.'</h1>';
            }
            else{
                echo '<h1 class="heading-title pull-left">PPL Videos</h1>';
            }
            ?>
        </header>
        <div class="page-content">
            <?php
            if(!isset($modulos)) {
                echo '<div class="row page-row">';
                echo '<div class="news-wrapper col-md-12 col-sm-12">';
                foreach ($videos as $video) {
                    echo '<article class="news-item page-row has-divider clearfix row">';
                    echo '<figure class="thumb col-md-4 col-sm-7 col-xs-6">';
                    echo '<img class="img-responsive center-block" src="' . base_url() . $video->imagen . '" alt="" />';
                    echo '</figure>';
                    echo '<div class="details col-md-8 col-sm-5 col-xs-5">';
                    echo '<h2 class="title"><a>' . $video->nombre . '</a></h2>';
                    echo '<p class="lead">' . $video->descripcion . '</p>';
                    echo '<a class="btn btn-primary pull-right btn-lg watch" onclick="onVideoClick(\''.$video->url.'\',this)">Watch now  <i class="fa fa-chevron-right"></i></a>';
                    echo '</div>';
                    echo '</article>';
                }
                echo "<div class='text-center'>";
                echo $links;
                echo "</div>";
                echo '</div><!--//news-wrapper-->';
                echo '</div><!--//page-row-->';
            }
            else {
                echo '<ul class="custom-list-style">';
                foreach ($modulos as $modulo){
                    echo '<li><i class="fa fa-caret-square-o-right fa-2x"></i>';
                    echo '<a class="lead" href="'.base_url("index.php/video/index/modulo".$modulo->idmodulo).'">'.$modulo->modulo.'</a>';
                    echo '</li>';
                }
                echo '</ul>';
            }?>
        </div><!--//page-content-->
    </div><!--//page-->
</div><!--//content-->
</div><!--//wrapper-->
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/plugins/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/plugins/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/plugins/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/plugins/pretty-photo/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/plugins/flexslider/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/plugins/jflickrfeed/jflickrfeed.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/college-green/assets/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bpopup.js"></script>
<script>
    function onVideoClick(theLink,button) {
        $('#video_pop').bPopup({
            onOpen: function(){
                $('.watch').each(function(){
                    if($(this).hasClass('active')){
                        $(this).removeClass('active');
                    }
                });
                $(button).addClass('active');
            },
            onClose: function(){
                $('#video').attr('src', $('#video').attr('src'));
            }
        });
        document.getElementById("video").setAttribute('src',theLink);
    }
</script>




