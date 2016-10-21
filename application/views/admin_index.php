<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/admin_tools.js"></script>
</head>
    <?php
        if(empty($courses)){
            echo "<div class='row' style='width: 100%; height: 200px'>";
            echo "<div class='col-md-offset-3 col-md-6' style='padding-right: 0'>";
            echo "<div class='alert alert-warning' role='alert' style='margin-bottom: 0; text-align: center;'>
                <strong>You don't have any courses registered, please create one</strong><br><br><a class='lead' href=".base_url()."index.php/course/create>Create a New Course</a>
                </div>";
            echo "</div>";
            echo "</div>";
        }
        else{
            echo "<div class='row' style='width: 100%; height: 500px'>";
            echo "<div class='col-md-offset-2 col-sm-offset-1 col-md-2 col-sm-3' style='padding-right: 0'>";
            echo "<div class='panel panel-info' style='border: none'>";
            echo "<div class='panel-heading'>";
            echo "<h2 class='panel-title lead'><strong>My Courses</strong><a class='pull-right' style='margin-right: 1%;' href='".base_url('index.php/course/create')."'><span class='glyphicon glyphicon-plus-sign lead' style='margin-bottom: 0;' data-toggle='tooltip' title='Add Course'></span></a></h2>";
            echo "</div>";
            echo "<div style='overflow: auto ;height: 320px'>";
            foreach($courses as $course){
                if($course->Viewable){
                    if(isset($courseID) && $course->Course_id == $courseID)
                        echo    "<a href=".base_url()."index.php/admin/index/$course->Course_id class='list-group-item lead active'>$course->Course_id<br>$course->Course_name</a>";
                    else
                        echo    "<a href=".base_url()."index.php/admin/index/$course->Course_id class='list-group-item lead' >$course->Course_id<br>$course->Course_name</a>";
                }
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
//            echo "<div id='containerCourses'>";
//            echo "<h3 style='color: white; background-color: gray; margin: 0; padding: 18px 20px; height: 66px'>My Courses <a class='botones_Courses' href=".base_url()."index.php/course/create><button type='button' data-toggle='tooltip' title='Add course' style='background-color: transparent; border-color: transparent; padding: 0; margin-left: 136px; height: 30px'><span class='glyphicon glyphicon-plus-sign'></span></button></a><a class='botones_Courses' href='#'><button type='button' data-toggle='tooltip' title='Remove course' style='background-color: transparent; margin-left: 10px; border-color: transparent; padding: 0; height: 30px'><span class='glyphicon glyphicon-minus-sign'></span></button></a></h3>";
//            echo "<div class='list-group'>";
//            foreach($courses as $course){
//                if(isset($courseID) && $course->Course_id == $courseID)
//                    echo    "<a href=".base_url()."index.php/admin/index/$course->Course_id class='list-group-item course active'>$course->Course_id<br>$course->Course_name</a>";
//                else
//                    echo    "<a href=".base_url()."index.php/admin/index/$course->Course_id class='list-group-item course' >$course->Course_id<br>$course->Course_name</a>";
//            }
//
//            echo "</div>";
//            echo "</div>";
            echo "<div class='col-md-6 col-sm-7' style='border: none'>";
            echo "<div class='panel panel-default'>";
            echo "<div class='panel-heading'>";
            if(isset($groups) && !empty($groups)){
                echo "<form role='form' method='post' action=".base_url('index.php/course/modify_groups/'.$courseInfo[0]->Course_id).">";
                echo "<h2 class='panel-title lead'>Students List of <strong>".$courseInfo[0]->Course_name."</strong>";
                echo "<a class='pull-right' href=".base_url('index.php/evaluation/index/'.$courseInfo[0]->Course_id)."><span style='margin-bottom: 0' data-toggle='tooltip' title='Evaluations' class='glyphicon glyphicon-list-alt lead'></span></a>";
                echo "<a id='saveGroups' style='margin-right: 1%;' href='#' class='pull-right' onclick='verifyEdit()'><span style='margin-bottom: 0' data-toggle='tooltip' title='Save groups' class='glyphicon glyphicon-floppy-disk lead'></span></a>";
                echo "<a class='pull-right' style='margin-right: 1%;' href='#' onclick='groupsActive()'><span style='margin-bottom: 0' data-toggle='tooltip' title='Edit groups' class='glyphicon glyphicon-pencil lead'></span></a>";
                echo "<a id='remove-student' style='margin-right: 1%;' class='pull-right' href='#'><span style='margin-bottom: 0' data-toggle='tooltip' title='Remove Student' class='glyphicon glyphicon-minus-sign lead'></span></a>";
                echo "<a id='add-student' style='margin-right: 1%;' class='pull-right' href='#'><span style='margin-bottom: 0' data-toggle='tooltip' title='Add Student' class='glyphicon glyphicon-plus-sign lead'></span></a>";
                echo "</h2>";
                echo "</div>";
                $i=0;
                echo "<table style='width: 100%'><tr><th style='width: 6%'>#</th><th style='width: 10%'>ID</th><th style='width: 24%'>FIRST NAME</th><th style='width: 24%'>LAST NAME</th><th style='width: 24%'>EMAIL</th><th >GROUP</th></tr></table>";
                echo "<div style='overflow: auto ;height: 300px'>";
                echo "<table style='width: 100%'>";
                foreach($groups as $group) {
                    echo "<tr><td style='width: 6%'>$i+1</td><td style='width: 16%'><input type='text' style='border: none; text-overflow: ellipsis; background-color: transparent; width: 100%'  tabindex='-1' value='$group->Registration_number' name='students[$i][id]' readonly></td><td style='width: 24%'><input type='text' style='border: none ; background-color: transparent; text-overflow: ellipsis; width: 100%' tabindex='-1' value='".strtoupper($group->Names)."' readonly></td><td style='width: 24%'><input type='text' style='border: none ; background-color: transparent; text-overflow: ellipsis; width: 100%' tabindex='-1' value='".strtoupper($group->Surnames)."' readonly></td><td style='width: 24%'><input type='text' style='border: none ; background-color: transparent; text-overflow: ellipsis; width: 100%' tabindex='-1' value='$group->Email' readonly></td>";
                    echo "<td style='text-align: center;'>";
                    echo "<input class='groups_field' style='text-align: center; border: none; width: 100%' max='99' min='1' type='number' name='students[$i][group]' value='$group->Group_number' disabled></td></tr>";
                    $i++;
                }
                echo "</table>";
                echo "</div>";
                echo "</form>";
            }
            elseif(isset($groups) && empty($groups)){
                echo "<h3 class='panel-title'>Students List of <strong>".$courseInfo[0]->Course_name."</strong></h3>";
                echo "</div>"; //heading
                echo "<div class='alert alert-warning' style='margin-bottom: 0;text-align: center;' role='alert'>
                        <strong>You have no students registered. <br><a id='add_student_option' role='button'>Add a student</a></strong>
                    </div>";

            }
            elseif(!empty($courses)){
                echo "<h3 class='panel-title' >Students List</h3>";
                echo "</div>"; //heading
                echo "<div class='alert alert-warning' style='margin-bottom: 0; text-align: center;' role='alert'>
                        <strong>You have not selected any course.</strong>
                    </div>";
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    ?>
</div>
<script>
    $('.course').on('click',function(e){
        var previous = $(this).closest(".list-group").children(".active");
        previous.removeClass('active'); // previous list-item
        $(e.target).addClass('active'); // activated list-item
    });
    $(function() {
        $('#add_student_option').on('click', function(e) {

            // Prevents the default action to be triggered.
            e.preventDefault();

            // Triggering bPopup when click event is fired
            $('#add-student_popup').bPopup();

        });
        $('#add-student').on('click', function(e) {

            // Prevents the default action to be triggered.
            e.preventDefault();

            // Triggering bPopup when click event is fired
            $('#add-student_popup').bPopup();

        });
        $('#remove-student').on('click', function(e) {

            // Prevents the default action to be triggered.
            e.preventDefault();

            // Triggering bPopup when click event is fired
            $('#remove-student_popup').bPopup();

        });});
</script>
<div id="add-student_popup" class="panel panel-primary " style="display: none">
    <div class="panel-heading"><h2 class="panel-title">Add Student</h2></div>
    <div class="panel-body">
        <form role='form' method='post' action="<?php echo base_url('index.php/course/student_registration/'.$courseInfo[0]->Course_id);?>">
            <div class="input-group">
                <label class="input-group-addon" style="width: 40%">Registration ID</label>
                <input name='st_reg' type='text' class="form-control" pattern='[a-zA-Z0-9-]+' title='Spaces and special characters except - are not allowed' maxlength='35' required>
            </div>
            <br>
            <div class="input-group">
                <label class="input-group-addon" style="width: 40%">First Name</label>
                <input name='names' class="form-control" type='text' maxlength='50' required>
            </div>
            <br>
            <div class="input-group">
                <label class="input-group-addon" style="width: 40%">Last Name</label>
                <input name='surnames' class="form-control" type='text' maxlength='50' required>
            </div>
            <br>
            <div class="input-group">
                <label class="input-group-addon" style="width: 40%">E-Mail</label>
                <input name='email' class="form-control" type='email' maxlength='50' required>
            </div>
            <br>
            <div class="text-center">
<!--                <span class="input-group-addon" style="padding: 0"><button class="btn btn-primary" style="font-size:18px;height:60px; width: 100%" type="button" onclick="hideAddStudent()">Cancel</button></span>-->
                <input type='submit' class="btn btn-primary btn-md" value='Register'>
            </div>
        </form>
    </div>
</div>
<div id="remove-student_popup" class="panel panel-primary" style="display: none">
    <div class="panel-heading"><h2 class="panel-title">Remove Student</h2></div>
    <div class="panel-body">
        <form role='form' method='post' onsubmit="return confirm('Do you really want to remove the selected student?');" action="<?php echo base_url('index.php/course/student_remove/'.$courseInfo[0]->Course_id)?>">
            <div class="input-group">
                <label class="input-group-addon" style="width: 20%">Full Name</label>
                <select id="remove-student_ID" name='st_reg' type='text' class='form-control' onselect="showSelectedStudent()">
                    <option value="default">Select a Student...</option>
                    <?php
                    foreach($groups as $group){
                        echo "<option value='$group->Registration_number'>$group->Names $group->Surnames</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <br>
            <div id="remove-student_button" class="text-center">
<!--                <span class="input-group-addon" style="padding: 0"><button class="btn btn-primary" style="font-size:18px;height:60px; width: 100%" type="button" onclick="hideRemoveStudent()">Cancel</button></span>-->
                <input id="remove-student_submit" type='button' class='btn btn-primary btn-md' onclick="verifySelect()" value='Remove'>
            </div>
        </form>
    </div>
</div>