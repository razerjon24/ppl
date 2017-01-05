<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Contact</h1>
        </header>
        <div class="page-content">
            <div class="row">
                <article class="contact-form col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8  page-row">
                    <h3 class="title">Get in touch</h3>
                    <p>We’d love to hear from you. Any inquiry, please do not hesitate to contact us.</p>
                    <?php
                        $attributes = array('method' => 'post');
                        echo form_open('contact/send',$attributes);
                    ?>
                        <div class="form-group name">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control" name="name" placeholder="Enter your name">
                        </div><!--//form-group-->
                        <div class="form-group email">
                            <label for="email">Email<span class="required">*</span></label>
                            <input id="email" type="email" class="form-control" name="email" placeholder="Enter your email" required>
                        </div><!--//form-group-->
                        <div class="form-group message">
                            <label for="message">Message<span class="required">*</span></label>
                            <textarea id="message" class="form-control" name="message" rows="6" placeholder="Enter your message here..." required></textarea>
                        </div><!--//form-group-->
                        <button type="submit" onclick="alert('Thanks for contacting us')" class="btn btn-primary">Send message</button>
                    <?php
                        form_close();
                    ?>
                </article><!--//contact-form-->
            </div><!--//page-row-->
            <div class="page-row">
                <article class="map-section">
                    <h3 class="title">Where to find us</h3>
                    <div id="map"></div><!--//map-->
                </article><!--//map-->
            </div><!--//page-row-->
        </div><!--//page-content-->
    </div><!--//page-wrapper-->
</div><!--//content-->
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/gmaps/gmaps.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/js/map.js"></script>