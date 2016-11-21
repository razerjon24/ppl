<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=ficheroExcel.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_POST['datos_a_enviar'];
?>

<head>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/evaluation.css" type="text/css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/admin_tools.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bpopup.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.3.2.min.js"></script>
</head>

<div class="row" style='width: 100%; height: 400px'>
    <div class="col-md-offset-3 col-md-6 col-sm-6">
        <div class='panel panel-default'>
            <div class="panel-heading">
                <h2 class='panel-title lead' align="center"><strong><?php echo $course[0]->Course_name.' Project'.$evaluation[0]->Project. '</br>' .strtoupper($evaluation[0]->Type).' ASSESSMENT';?></strong>
                </h2>
            </div>

            <?php
            $i = 1;
            $Final_WF = 1;
            echo "<div style='overflow: auto ;height: 300px'>";
            echo "<table id='reportTable' class='tablesorter' border='2'>";
            echo "<thead><tr><th style='width: 50px'><span class='glyphicon glyphicon-sort' style='color: lightblue'></span> #</th><th style='width: 120px'>REG. ID</th><th style='width: 280px'>FIRST NAME</th><th style='width: 280px'>LAST NAME</th><th style='width: 108px; text-align: center'>GROUP NUMBER";
            if($evaluation[0]->Type == 'Peer')
                echo "</th><th style='width: 128px; text-align: center'>PEER ASSESSMENT</th><th style='text-align: center'>WEIGHTING FACTOR";
            elseif($evaluation[0]->Type == 'Team')
                echo "</th><th style='width: 128px; text-align: center'>TEAM ASSESSMENT";
            elseif($evaluation[0]->Type == 'Self')
                echo "</th><th style='width: 128px; text-align: center'>SELF ASSESSMENT";
            echo "</th></tr></thead>";
            $evaluation_id = $evaluation[0]->Evaluation_id;
            foreach($students as $student){
                if($student->Took == 1)
                    echo "<tr class='reportRows'>";
                else
                    echo "<tr class='reportRows' style='background-color: #ffff00'>";
                if($evaluation[0]->Type == 'Peer'){
                    echo "<td>$i</td><td style='text-align:left; padding-left: 18px'><a onclick='peer_evaluation($student->Registration_number,$evaluation_id)'>".$student->Registration_number."</a></td><td style='text-align:left; padding-left: 18px'>".strtoupper($student->Names)."</td><td style='text-align: left; padding-left: 18px'>".strtoupper($student->Surnames)."</td><td style='width: 108px; text-align: center'>$student->Group_number";
                    echo "</td><td style='width: 108px; text-align: center'>$student->Avg_Peer";
                    if($student->Took == 0){
                        $Final_WF = $student->Evaluation_WF*0;
                        echo "</td><td>$Final_WF";
                    }
                    else
                        echo "</td><td>$student->Evaluation_WF";
                }
                elseif($evaluation[0]->Type == 'Team'){
                    echo "<td>$i</td><td style='text-align:left; padding-left: 18px'><a onclick='team_evaluation($student->Registration_number,$evaluation_id)'>".$student->Registration_number."</a></td><td style='text-align:left; padding-left: 18px'>".strtoupper($student->Names)."</td><td style='text-align: left; padding-left: 18px'>".strtoupper($student->Surnames)."</td><td style='width: 108px; text-align: center'>$student->Group_number";
                    echo "</td><td>$student->Avg_Team";
                }
                elseif($evaluation[0]->Type == 'Self') {
                    echo "<td>$i</td><td style='text-align:left; padding-left: 18px'>".$student->Registration_number."</td><td style='text-align:left; padding-left: 18px'>" . strtoupper($student->Names) . "</td><td style='text-align: left; padding-left: 18px'>" . strtoupper($student->Surnames) . "</td><td style='width: 108px; text-align: center'>$student->Group_number";
                    echo "</td><td>$student->Avg_Self";
                }
                echo "</td></tr>";
                $i++;
            }

            echo "</table>";


            echo "</div>";

            ?>


        </div>
    </div>
</div>
</div>
