<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/evaluation.css" type="text/css">
    <script type="text/javascript" src="http://tablesorter.com/jquery-latest.js"></script>
    <script type="text/javascript" src="http://tablesorter.com/__jquery.tablesorter.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/admin_tools.js"></script>
    <script type="text/javascript">
        function peer_evaluation(r_n, ev_id){
            $.ajax({
                type:'POST',
                data:{r_n:r_n,ev_id:ev_id},
                url:'<?php echo site_url('evaluation/peer_evaluation');?>',
                success: function(result){
                    overlay = document.getElementById("overlay");
                    popup = document.getElementById("peer_list");
                    overlay.style.visibility= "visible";
                    popup.innerHTML = result;
                    popup.style.visibility = "visible";
                }
            });
        }
        function team_evaluation(r_n, ev_id){
            $.ajax({
                type:'POST',
                data:{r_n:r_n,ev_id:ev_id},
                url:'<?php echo site_url('evaluation/team_evaluation');?>',
                success: function(result){
                    overlay = document.getElementById("overlay");
                    popup = document.getElementById("team_list");
                    overlay.style.visibility= "visible";
                    popup.innerHTML = result;
                    popup.style.visibility = "visible";
                }
            });
        }
        $(document).ready(function()
            {
                $("#reportTable").tablesorter( {sortList: [[0,0], [1,0]]} );
            }
        );
        function close_popup(){
            overlay = document.getElementById("overlay");
            popup = document.getElementById("peer_list");
            popup1 = document.getElementById("team_list");
            overlay.style.visibility= "hidden";
            popup.style.visibility = "hidden";
            popup1.style.visibility = "hidden";
        }
    </script>
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
        echo "<table style='width: 100%'><tr><th style='width: 16%'>REG. ID</th><th style='width: 24%'>FIRST NAME</th><th style='width: 24%'>LAST NAME</th><th style='width: 24%'>EMAIL</th><th >GROUP</th></tr></table>";
        echo "<div style='overflow: auto ;height: 300px'>";
        echo "<table style='width: 100%'>";
        foreach($groups as $group) {
            echo "<tr><td style='width: 16%'><input type='text' style='border: none; text-overflow: ellipsis; background-color: transparent; width: 100%'  tabindex='-1' value='$group->Registration_number' name='students[$i][id]' readonly></td><td style='width: 24%'><input type='text' style='border: none ; background-color: transparent; text-overflow: ellipsis; width: 100%' tabindex='-1' value='".strtoupper($group->Names)."' readonly></td><td style='width: 24%'><input type='text' style='border: none ; background-color: transparent; text-overflow: ellipsis; width: 100%' tabindex='-1' value='".strtoupper($group->Surnames)."' readonly></td><td style='width: 24%'><input type='text' style='border: none ; background-color: transparent; text-overflow: ellipsis; width: 100%' tabindex='-1' value='$group->Email' readonly></td>";
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
