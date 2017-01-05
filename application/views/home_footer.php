<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Javascript -->
<!-- ******FOOTER****** -->
<footer class="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-2 col-sm-2 about">
                    <div class="footer-col-inner">
                        <h3>About</h3>
                        <ul>
                            <li><a href="<?php echo base_url()?>index.php/about"><i class="fa fa-caret-right"></i>About us</a></li>
                            <li><a href="<?php echo base_url()?>index.php/contact"><i class="fa fa-caret-right"></i>Contact us</a></li>
                        </ul>
                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col-->
                <div class="footer-col col-md-offset-2 col-sm-offset-2 col-md-3 col-sm-3 contact">
                    <div class="footer-col-inner">
                        <h3 style="text-align: center">Universities</h3>
                        <section class="awards">
                            <div id="awards-carousel" class="awards-carousel carousel slide" style="background-color: #444444">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <ul class="logos">
                                            <li class="col-md-6 col-sm-6 col-xs-6">
                                                <a href="http://www.espol.edu.ec/" ><img class="img-responsive" src="<?php echo base_url() ?>/assets/images/espol_logo.png" alt="Logo"></a>
                                            </li>
                                            <li class="col-md-6 col-sm-6 col-xs-6">
                                                <a href="http://www.harvard.edu/" ><img class="img-responsive" src="<?php echo base_url() ?>/assets/images/harvard_logo.png" alt="Logo"></a>
                                            </li>
                                        </ul><!--//slides-->
                                    </div><!--//item-->
                                </div><!--//carousel-inner-->
                            </div>
                        </section>
                    </div>
                </div>
                <div class="footer-col col-md-offset-2 col-sm-offset-2  col-md-3 col-sm-3 contact">
                    <div class="footer-col-inner">
                        <h3>Contact us</h3>
                        <div class="row">
                            <p class="adr clearfix col-md-12 col-sm-4">
                                <i class="fa fa-map-marker pull-left"></i>
                                <span class="adr-group pull-left">
                                    <span class="street-address">ESPOL - FCNM</span><br>
                                    <span class="region">Campus Gustavo Galindo Velasco</span><br>
                                    <span class="postal-code">Km. 30.5 Via Perimetral</span><br>
                                    <span class="country-name">Guayaquil - Ecuador</span>
                                </span>
                            </p>
                            <p class="email col-md-12 col-sm-4"><i class="fa fa-envelope"></i><a>ppl@espol.edu.ec</a></p>
                        </div>
                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col-->
            </div>
        </div>
    </div><!--//footer-content-->
    <div class="bottom-bar">
        <div class="container">
            <div class="row">
                <small class="copyright col-md-6 col-sm-12 col-xs-12">Peer Project Learning <strong>Beta Version</strong></small>
            </div><!--//row-->
        </div><!--//container-->
    </div><!--//bottom-bar-->
</footer><!--//footer-->
</body>
</html>