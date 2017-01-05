<!DOCTYPE html>

<head><link rel="stylesheet" href="<?php echo base_url();?>assets/css/peer.css">
</head>

<div class="panel panel-primary">
    <div class='panel-heading' style="font-size: 24px;padding: 20px 25px; text-align: center"><?php echo "<strong>".$course[0]->Course_name."</strong><br>PROJECT <strong>".$evaluation[0]->Project."</strong> HOMEWORK ASSESSMENT";?></div>
    <div class='panel-body'>
        <table class="table">
            <?php
            if($evaluation[0]->Format == 'Default - Spanish'){
                echo "<th id='constructTitle'>Constructor</th><th>Reflexión de evaluación de trabajos</th><th class='score'>Muy Pobre</th><th class='score'>Malo</th><th class='score'>Regular</th><th class='score'>Bueno</th><th class='score'>Excelente</th>";
                echo "<form role='form' method='post' action=".base_url()."index.php/evaluation/homework_send/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number."/".$respondent[0]->Registration_number.">";
                echo "<tr><td class='construct'>Preparación</td><td>¿Cómo fue el rendimiento de <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> durante el trabajo en clase?</td><td class='scoreRadio'><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                echo "</form>";
            }
            elseif($evaluation[0]->Format == 'Default - English'){
                echo "<th id='constructTitle'>Construct</th><th>Homework Assessment Reflection</th><th class='score'>Very Poor</th><th class='score'>Below Average</th><th class='score'>Average</th><th class='score'>Above Average</th><th class='score'>Excellent</th>";
                echo "<form role='form' method='post' action=".base_url()."index.php/evaluation/homework_send/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number."/".$respondent[0]->Registration_number.">";
                echo "<tr><td class='construct'>Preparation</td><td>How was the performance of <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> during the classwork?</td><td class='scoreRadio'><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                echo "</form>";
            }
            ?>
        </table>
    </div>
</div>
</div>

