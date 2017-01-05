<!DOCTYPE html>
<head><link rel="stylesheet" href="<?php echo base_url();?>assets/css/student.css">
<script type="text/javascript">
    function get_PeerList(course_id,project,evaluation_number,type){
        $.ajax({
            type:'POST',
            data:{course_id:course_id,project:project,evaluation_number:evaluation_number,type:type},
            url:'<?php echo site_url('evaluation/take');?>',
            success: function(result){
                popup = document.getElementById("peer_list");
                popup.innerHTML = result;
                popup.style.visibility = "visible";
                $('#peer_list').bPopup()

            }
        });
    }
    function get_TeamReport(ev,g_n,ev_st){
        $.ajax({
            type:'POST',
            data:{ev:ev, g_n:g_n,ev_st:ev_st},
            url:'<?php echo site_url('evaluation/team_report');?>',
            success: function(result){
                popup = document.getElementById("peer_list");
                popup.innerHTML = result;
                popup.style.visibility = "visible";
                $('#peer_list').bPopup()

            }
        });
    }
    function get_PeerReport(ev,g_n,ev_st){
        $.ajax({
            type:'POST',
            data:{ev:ev, g_n:g_n,ev_st:ev_st},
            url:'<?php echo site_url('evaluation/peer_report');?>',
            success: function(result){
                popup = document.getElementById("peer_list");
                popup.innerHTML = result;
                popup.style.visibility = "visible";
                $('#peer_list').bPopup()

            }
        });
    }
    function get_HomeworkReport(ev,g_n,ev_st){
        $.ajax({
            type:'POST',
            data:{ev:ev, g_n:g_n,ev_st:ev_st},
            url:'<?php echo site_url('evaluation/homework_report');?>',
            success: function(result){
                popup = document.getElementById("peer_list");
                popup.innerHTML = result;
                popup.style.visibility = "visible";
                $('#peer_list').bPopup()

            }
        });
    }
    function close_popup(){
        overlay = document.getElementById("overlay");
        popup = document.getElementById("peer_list");
        overlay.style.visibility= "hidden";
        popup.style.visibility = "hidden";
    }
</script>
</head>
    <?php
    if(!empty($courses)){
        echo "<div class='row' style='width: 100%; height: 500px'>";
        echo "<div class='col-md-offset-2 col-sm-offset-2 col-md-2 col-sm-2' style='padding-right: 0'>";
        echo "<div class='panel panel-info' style='border: none'>";
        echo "<div class='panel-heading'>";
        echo "<h2 class='panel-title lead'><strong>My Courses</strong></h2>";
        echo "</div>";
        foreach($courses as $course){
            if(isset($courseID) && $course->Course_id == $courseID)
                echo    "<a href=".base_url()."index.php/student/index/$course->Course_id class='list-group-item lead active'>$course->Course_name</a>";
            else
                echo    "<a href=".base_url()."index.php/student/index/$course->Course_id class='list-group-item lead'>$course->Course_name</a>";
        }
        echo "</div>";
        echo "</div>";
    }
    else{
        echo "<div id='infoNew' class='alert alert-info' role='alert' style='background-color: #F1F1F1'>
                    <strong>You are not registered in any course.</strong>
                </div>";
    }?>
<?php
$current_date = date('Y-m-d H:i:s');
if(isset($evaluations) && !empty($evaluations)){
    echo "<div class='col-md-6 col-sm-6' style='border: none'>";
    echo "<div class='panel panel-default'>";
    echo "<div class='panel-heading'>";
    echo "<h3 class='panel-title lead'>Survey List of <strong>".$courseInfo[0]->Course_name."</strong></h3>";
    echo "</div>";
    echo "<table style='width: 100%'><tr><th style='width: 5%'>#</th><th style='width: 18%'>STARTS</th><th style='width: 18%'>ENDS</th><th style='width: 12%'>PROJECT</th><th style='width: 24%'>EVALUATION</th><th style='width: 12%'>REPORT</th><th>STATUS</th></tr></table>";
    echo "<table style='width: 100%'>";
    $i = 1;
    foreach($evaluations as $evaluation){
        echo "<tr style='text-align: center'><td style='width: 5%'>$i</td>";
        if($current_date < $evaluation->Evaluation_start)
            echo "<td style='width: 18%; color: red'>".date('M j\, Y',strtotime($evaluation->Evaluation_start))."</td>";
        else
            echo "<td style='width: 18%;'>".date('M j\, Y',strtotime($evaluation->Evaluation_start))."</td>";
        if($current_date > $evaluation->Evaluation_end && !$evaluation->Took)
            echo "<td style='width: 18%; color: red'>".date('M j\, Y',strtotime($evaluation->Evaluation_end))."</td>";
        else
            echo "<td style='width: 18%;'>".date('M j\, Y',strtotime($evaluation->Evaluation_end))."</td>";
        echo "<td style='width: 12%'>$evaluation->Project</td>";
        if($current_date <= $evaluation->Evaluation_end && !$evaluation->Took && $current_date >= $evaluation->Evaluation_start) {
            if ($evaluation->Type == 'Peer') {
                $course_id = $courseInfo[0]->Course_id;
                echo "<td style='width: 24%'><a onclick='get_PeerList(\"$course_id\", $evaluation->Project, $evaluation->Evaluation_number, \"$evaluation->Type\")'>$evaluation->Type Assessment</a></td>";
            }
            elseif($evaluation->Type == 'Self'){
                $course_id = $courseInfo[0]->Course_id;
                echo "<td style='width: 24%'><a href=".base_url('index.php/evaluation/self/'.$course_id.'/'.$evaluation->Project.'/'.$evaluation->Evaluation_number).">$evaluation->Type Assessment</a></td>";
            }
            elseif($evaluation->Type == 'Team'){
                $course_id = $courseInfo[0]->Course_id;
                echo "<td style='width: 24%'><a href=".base_url('index.php/evaluation/team/'.$course_id.'/'.$evaluation->Project.'/'.$evaluation->Evaluation_number).">$evaluation->Type Assessment</a></td>";
            }
            elseif($evaluation->Type == 'Homework') {
                $course_id = $courseInfo[0]->Course_id;
                echo "<td style='width: 24%'><a onclick='get_PeerList(\"$course_id\", $evaluation->Project, $evaluation->Evaluation_number, \"$evaluation->Type\")'>$evaluation->Type Assessment</a></td>";
            }
        }
        else
            echo "<td style='width: 24%'>$evaluation->Type Assessment</td>";
        if($current_date > $evaluation->Evaluation_end && $evaluation->Took){
            if ($evaluation->Type === 'Peer')
                echo "<td style='width: 12%'><a style='color: blue' class='glyphicon glyphicon-list-alt' onclick='get_PeerReport($evaluation->Evaluation_id,$evaluation->Group_number, $evaluation->Evaluation_student_id)'></a></td>";
            elseif ($evaluation->Type === 'Team')
                echo "<td style='width: 12%'><a style='color: blue' class='glyphicon glyphicon-list-alt' onclick='get_TeamReport($evaluation->Evaluation_id,$evaluation->Group_number, $evaluation->Evaluation_student_id)'></a></td>";
            elseif ($evaluation->Type === 'Self')
                echo "<td style='width: 12%'><span style='color: blue' class='glyphicon glyphicon-list-alt'></span></td>";
            elseif ($evaluation->Type === 'Homework')
                echo "<td style='width: 12%'><a style='color: blue' class='glyphicon glyphicon-list-alt' onclick='get_HomeworkReport($evaluation->Evaluation_id,$evaluation->Group_number, $evaluation->Evaluation_student_id)'></a></td>";
        }
        else
            echo "<td><span style='color: gray' class='glyphicon glyphicon-list-alt'></span></td>";
        if($evaluation->Took)
            echo "<td><span style='color: blue' class='glyphicon glyphicon-ok'></span></td>";
        else
            echo "<td><span style='color: gray' class='glyphicon glyphicon-remove'></span></td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
}
elseif(isset($evaluations) && empty($evaluations)){
    echo "<div class='col-md-6 col-sm-6' style='border: none'>";
    echo "<div class='panel panel-default'>";
    echo "<div class='panel-heading'>";
    echo "<h3 class='panel-title lead'>Survey List of <strong>".$courseInfo[0]->Course_name."</strong></h3>";
    echo "</div>";
    echo "<div class='alert alert-warning' style='text-align: center; margin-bottom: 0' role='alert'>
                <strong>The selected course doesn't have surveys to fill.</strong>
            </div>";
    echo "</div>";
    echo "</div>";
}
elseif(!empty($courses)){
    echo "<div class='col-md-6 col-sm-6' style='border: none'>";
    echo "<div class='panel panel-default'>";
    echo "<div class='panel-heading'>";
    echo "<h3 class='panel-title lead'>Survey List</h3>";
    echo "</div>";
    echo "<div class='alert alert-warning' style='text-align: center; margin-bottom: 0' role='alert'>
            <strong>Please select a course.</strong>
        </div>";
    echo "</div>";
    echo "</div>";
}?>
<script>
    $('.course').on('click',function(e){
        var previous = $(this).closest(".list-group").children(".active");
        previous.removeClass('active'); // previous list-item
        $(e.target).addClass('active'); // activated list-item
    });
</script>
<div id="peer_list" class="panel panel-primary" style="display:none"></div>
</div>
</div>