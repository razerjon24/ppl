<!DOCTYPE html>

<head><link rel="stylesheet" href="<?php echo base_url();?>assets/css/student.css">
</head>

<?php
    if(!empty($evaluation)){
        if($evaluation[0]->Took == 1)
        {
            echo "<div id='infoNew' class='alert alert-info' role='alert' style='background-color: #F1F1F1'>
                        <strong>You took the evaluation already</strong>
                    </div>";
        }
        elseif(strtotime($date_server) < strtotime($evaluation[0]->Evaluation_start)){
            echo "<div id='infoNew' class='alert alert-info' role='alert' style='background-color: #F1F1F1'>
                        <strong>The evaluation has not started yet</strong>
                    </div>";
        }
        elseif(strtotime($date_server) > strtotime($evaluation[0]->Evaluation_end)){
            echo "<div id='infoNew' class='alert alert-info' role='alert' style='background-color: #F1F1F1'>
                        <strong>The evaluation time has expired</strong>
                    </div>";
        }
        else {
            echo "<div id='container_take' class='panel-primary'>";
            echo "<div class='panel-heading' style='font-size:24px; color: white; padding: 20px 25px'><strong>" . $course[0]->Course_name . "</strong> Project <strong>" . $evaluation[0]->Project . "</strong></div>";
            echo "<div class='panel-body' style='background-color: #F1F1F1; padding: 20px 50px; max-height: 300px; overflow: auto'>";
            if(!empty($peer_list)){
                echo "<div class='panel panel-info' style='margin-top: 20px'>";
                echo "<div class='panel-heading' style='text-align: left'>Peer Assessment</div>";
                echo "<div class='panel-body assessment' style='text-align: left'>";
                foreach ($peer_list as $peer_student) {
                    if ($peer_student->Peer_took == 0 && $peer_student->Respondent != $this->session->userdata('user_id')) {
                        echo "<a href=" . base_url() . "index.php/evaluation/peer/" . $course[0]->Course_id . "/" . $evaluation[0]->Project . "/" . $evaluation[0]->Evaluation_number . "/" . $peer_student->Registration_number . " style='font-size: 20px'>$peer_student->Names $peer_student->Surnames</a>";
                        echo "<br>";
                    }
                }
                echo "</div></div>";
            }
            echo "</div></div>";
        }
    }
    else{
        echo "<div id='infoNew' class='alert alert-info' role='alert' style='background-color: #F1F1F1'>
                        <strong>Evaluation does not exist</strong>
                    </div>";
    }
?>
</div>
