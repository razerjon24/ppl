<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function checkverified(){
            var send, password, cfpassword, ok;
            ok = document.getElementById("verified");
            send = document.getElementById("send");
            password = document.getElementById("pass");
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
</head>
<body>
<div class="panel panel-primary" style="width: 700px;height: 400px;position:absolute;top:0;bottom:0;right: 0;left: 0; margin:auto;background-color: #F1F1F1">
    <div class="panel-heading" style="font-size: 24px">Change Password</div>
    <div class="panel-body" style="text-align: center">
        <form role='form' method='post' action="<?php echo base_url();?>index.php/account/password">
            <br><label style="font-size: 16px">Dear <span style="color: blue"><?php if(isset($student_name)){ echo $student_name;} elseif(isset($instructor_name)){echo $instructor_name;}?></span>, please fill the boxes:</label><br><br><br>
            <label style="font-size: 16px; width: 200px">Old Password:</label><input id="pass" name="old_pass" type="password" required=""><br>
            <label style="font-size: 16px; width: 200px">Confirm Old Password:</label><input id="cfpass" type="password" onchange="checkverified()" required=""><br><span id="verified" style="margin-left: 10px; visibility: hidden" class="glyphicon glyphicon-ok-sign"></span><br>
            <label style="font-size: 16px; width: 200px">New Password:</label><input name="new_pass" type="password" required><br><br><br><br>
            <input id="send" class="btn-primary" style="font-size: 16px; width: 100px" type="button" value="Change">
        </form>
    </div>
</div>
<footer class="navbar-fixed-bottom" style=" background-color: #28388B; text-align: center; color: #ffffff; font-size: 18px"><strong>P</strong>eer <strong>P</strong>roject <strong>L</strong>earning <span style="color:lightblue"><Strong>Beta Version</Strong></span><br></footer>
</body>
</html>