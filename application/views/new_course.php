<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/subject.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/course_create.js"></script>
</head>
<div class="row" style='width: 100%; height: 700px'>
    <div class="col-md-offset-3 col-md-6 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading" style="height: 66px; padding: 0"><h3 style="margin: 0; padding-top: 18px; padding-left: 18px">New Course</h3></div>
            <div class="panel-body" style="text-align: center; margin-bottom: 0;padding: 40px;">
                <form class="form-group" role="form" method="post" style="margin-bottom: 0" onsubmit="showBar()" action="<?php echo base_url('index.php/course/register')?>" enctype="multipart/form-data">
                    <input class="form-control" name="Course_id" type="text" maxlength="40" pattern="[a-zA-Z0-9-]+" title="Spaces and special characters except - are not allowed" placeholder="COURSE IDENTIFIER" style="width: 50%; margin-bottom: 1%" required>
                    <input class="form-control" name="Course_name" type="text" maxlength="100" placeholder="COURSE NAME" required><br>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-danger btn-file" style="font-size: 18px; padding: 3px 10px"><span class="glyphicon glyphicon-file"></span>
                                Browse File&hellip; <input type="file" id="file" name="file" accept=".csv" onchange="check_file()" required>
                            </span>

                        </span>
                        <input type="text" class="form-control" style="width: 416px; font-size: 18px" readonly>
                        <button type="button" class="btn btn-success" onclick="show_popup()" style="font-size: 18px; padding: 3px 10px"><span class="glyphicon glyphicon-eye-open"></span> Preview List Model</button>

                    </div>
                    <br><br><div style="border:1px solid #E6E6E6; background-color: #E6E6E6; height: 98px; margin-bottom: 10px"><img src="<?php echo base_url();?>assets/images/infoSign.png" style="width: 100px; height: 96px; float: left; padding:10px; background-color: #ffffff"><div style="color: blue; font-size: 18px; text-align: center; padding: 15px; float: left; width: 665px; height: 96px; line-height: 35px">Upload the list of students in comma-separated values format (.csv)<br>The file must contain all four student's fields showed in Preview List Model.<br></div></div>
                    <div style="border:1px solid #E6E6E6; background-color: #E6E6E6; height: 98px"><img src="<?php echo base_url();?>assets/images/WarningSign.png" style="width: 100px; height: 96px; float: left; padding:10px; background-color: #ffffff"><div style="color: red; font-size: 18px; text-align: center; padding: 15px; float: left; width: 665px; height: 96px; line-height: 35px">Students with any missing information cannot be registered. <br>Add them manually after creating the course.<br></div></div><br><br>
                    <div><button class="btn btn-primary btn-large" name="submit" type="submit" style="font-size: 20px; float: right"> Create</button></div>
                </form>
                <form role="form" method="post" action="<?php echo base_url();?>index.php/admin"><button class="btn btn-primary btn-large" type="submit" style="font-size: 20px;float: left"> Cancel</button></form>
            </div>
        </div>
        </div>
    </div>
<div id="popup_preview" style="display: none">
    <img src="<?php echo base_url();?>assets/images/preview_list.JPG">
</div>
<script>
    function show_popup(){
        // bg_disabler = document.getElementById("background_disabler");
        popup = document.getElementById("popup_preview");
        $(popup).bPopup();
        // bg_disabler.style.visibility = "visible";
        // popup.style.visibility = "visible";
    }
    function showBar(){
        $('#loading-bar').bPopup({
            escClose : false,
            modalClose: false
        });
    }
</script>
<div id="loading-bar" style="display: none">
    <img src="<?php echo base_url();?>assets/images/loading-bar.gif">
</div>
</div>
