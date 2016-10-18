<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="content container">
    <div class="page-wrapper">

        <div class="page-content">
            <div class="row">
                <article class="contact-form col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8  page-row">
                    <div class="panel panel-primary" style="width: 600px;height: 400px;position:relative; background-color: #F1F1F1">
                        <div class="panel-heading" style="font-size: 24px">Forgot Password?</div>
                        <div class="panel-body" style="text-align: center">
                            <form role='form' method='post' action="<?php echo base_url();?>index.php/account/forgot"><br>
                                <?php
                                if(isset($username)){
                                    echo "<label style='font-size: 16px; width: 200px; text-overflow: ellipsis;'>E-mail:</label><input name='username' type='text' value='$username' readonly><br>";
                                    echo "<label style='font-size: 16px; width: 200px'>Password:</label><input id='fpass' name='password' type='password' required><br>";
                                    echo "<label style='font-size: 16px; width: 200px'>Confirm Password:</label><input id='cfpass' type='password' onchange='checkverified()' required><br><span id='verified' style='margin-left: 10px; visibility: hidden' class='glyphicon glyphicon-ok-sign'></span><br>";
                                    echo "<input id='send' class='btn-primary' style='font-size: 16px; width: 100px' type='button' value='Change'>";
                                }
                                else{
                                    echo "<br><label style='font-size: 16px; width: 200px'>E-mail:</label><input name='username' type='text' required><br><br><br><br>";
                                    echo "<input id='send' class='btn-primary' style='font-size: 16px; width: 100px' type='submit' value='Verify'>";
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </article><!--//contact-form-->
            </div><!--//page-row-->

        </div><!--//page-content-->
    </div><!--//page-wrapper-->
</div><!--//content-->
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/plugins/gmaps/gmaps.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/college-green/assets/js/map.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    function checkverified(){

        var send, password, cfpassword, ok;
        ok = document.getElementById("verified");
        send = document.getElementById("send");
        password = document.getElementById("fpass");
        cfpassword = document.getElementById("cfpass");
        if(password.value == cfpassword.value){
            ok.style.visibility = "visible";
            send.setAttribute('type', 'submit');
        }
        else{
            ok.style.visibility = "hidden";
            send.setAttribute('type', 'button');
        }
    }
</script>
