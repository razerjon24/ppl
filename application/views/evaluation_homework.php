<!DOCTYPE html>

<head><link rel="stylesheet" href="<?php echo base_url();?>assets/css/peer.css">
</head>

<div class="panel panel-primary">
    <div class='panel-heading' style="font-size: 24px;padding: 20px 25px; text-align: center"><?php echo "<strong>".$course[0]->Course_name."</strong><br>PROJECT <strong>".$evaluation[0]->Project."</strong> HOMEWORK ASSESSMENT";?></div>
    <div class='panel-body'>
        <table class="table">
            <?php
            if($evaluation[0]->Format == 'Default - Spanish'){
                echo "<th id='constructTitle'>Constructor</th><th>Reflexión de evaluación de trabajos</th><th class='score'>0</th><th class='score'>1</th><th class='score'>2</th><th class='score'>3</th><th class='score'>4</th><th class='score'>5</th>";
                echo "<form role='form' method='post' action=".base_url()."index.php/evaluation/homework_send/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number."/".$respondent[0]->Registration_number.">";
                echo "<tr><td class='construct'>Preparación</td><td>En una escala del 0 al 5, ¿c&oacute;mo considera usted fue el rendimiento de <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> en la actividad de resoluci&oacute;n de problemas?</td><td class='scoreRadio'><input type='radio' name='q1' value='0' required></td><td class='scoreRadio'><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                echo "</form>";
            }
            elseif($evaluation[0]->Format == 'Default - English'){
                echo "<th id='constructTitle'>Construct</th><th>Homework Assessment Reflection</th><th class='score'>0</th><th class='score'>1</th><th class='score'>2</th><th class='score'>3</th><th class='score'>4</th><th class='score'>5</th>";
                echo "<form role='form' method='post' action=".base_url()."index.php/evaluation/homework_send/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number."/".$respondent[0]->Registration_number.">";
                echo "<tr><td class='construct'>Preparation</td><td>In a scale from 0 to 5, how do you consider was the performance of <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> in the problem solving activity?</td><td class='scoreRadio'><input type='radio' name='q1' value='0' required></td><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                echo "</form>";
            }
            ?>
        </table>
    </div>
</div>
</div>

