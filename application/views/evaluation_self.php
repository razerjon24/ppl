<!DOCTYPE html>

<head><link rel="stylesheet" href="<?php echo base_url();?>assets/css/peer.css">
</head>

<div class="panel panel-primary">
    <div class='panel-heading' style="font-size: 24px;padding: 20px 25px; text-align: center"><?php echo "<strong>".$course[0]->Course_name."<br></strong>PROJECT <strong>".$evaluation[0]->Project."</strong> SELF ASSESSMENT";?></div>
    <div class='panel-body'>
        <table class="table">
            <?php
                if($evaluation[0]->Format == 'Default - Spanish'){
                    echo "<th id='constructTitle'>Constructor</th><th>Reflexión de auto evaluación</th><th class='score'>Muy Pobre</th><th class='score'>Malo</th><th class='score'>Regular</th><th class='score'>Bueno</th><th class='score'>Excelente</th>";
                    echo "<form role='form' method='post' action=".base_url()."index.php/evaluation/self_send/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number.">";
                    echo "<tr><td class='construct'>Preparación</td><td>¿Qué tan bien preparado estabas para venir a clase?</td><td class='scoreRadio'><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Asistencia</td><td>¿Qué tan bien asististe a las reuniones del grupo?</td><td class='scoreRadio'><input type='radio' name='q2' value='1' required></td><td class='scoreRadio'><input type='radio' name='q2' value='2'></td><td class='scoreRadio'><input type='radio' name='q2' value='3'></td><td class='scoreRadio'><input type='radio' name='q2' value='4'></td><td class='scoreRadio'><input type='radio' name='q2' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Contribución</td><td>¿Qué tan bien contribuistes de manera productiva a la discusión y trabajo en equipo?</td><td class='scoreRadio'><input type='radio' name='q3' value='1' required></td><td class='scoreRadio'><input type='radio' name='q3' value='2'></td><td class='scoreRadio'><input type='radio' name='q3' value='3'></td><td class='scoreRadio'><input type='radio' name='q3' value='4'></td><td class='scoreRadio'><input type='radio' name='q3' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Respeto de ideas</td><td>¿Qué tan bien alentastes a los demás para contribuir con sus ideas?</td><td class='scoreRadio'><input type='radio' name='q4' value='1' required></td><td class='scoreRadio'><input type='radio' name='q4' value='2'></td><td class='scoreRadio'><input type='radio' name='q4' value='3'></td><td class='scoreRadio'><input type='radio' name='q4' value='4'></td><td class='scoreRadio'><input type='radio' name='q4' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Flexibilidad</td><td>¿Qué tan flexible fuistes cuándo ocurrieron los desacuerdos?</td><td class='scoreRadio'><input type='radio' name='q5' value='1' required></td><td class='scoreRadio'><input type='radio' name='q5' value='2'></td><td class='scoreRadio'><input type='radio' name='q5' value='3'></td><td class='scoreRadio'><input type='radio' name='q5' value='4'></td><td class='scoreRadio'><input type='radio' name='q5' value='5'></td></tr>";
                    echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                    echo "</form>";
                }
                elseif($evaluation[0]->Format == 'Default - English'){
                    echo "<th id='constructTitle'>Construct</th><th>Self Assessment Reflection</th><th class='score'>Very Poor</th><th class='score'>Below Average</th><th class='score'>Average</th><th class='score'>Above Average</th><th class='score'>Excellent</th>";
                    echo "<form role='form' method='post' action='<?php echo base_url()?>index.php/evaluation/self_send/<?php echo $course[0]->Course_id.'/'.$evaluation[0]->Project.'/'.$evaluation[0]->Evaluation_number?>'>";
                    echo "<tr><td class='construct'>Preparation</td><td>How well were you prepared to come to class?</td><td class='scoreRadio'><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Attendance</td><td>How well did you attend the group meetings?</td><td class='scoreRadio'><input type='radio' name='q2' value='1' required></td><td class='scoreRadio'><input type='radio' name='q2' value='2'></td><td class='scoreRadio'><input type='radio' name='q2' value='3'></td><td class='scoreRadio'><input type='radio' name='q2' value='4'></td><td class='scoreRadio'><input type='radio' name='q2' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Contribution</td><td>How well did you contribute productively to the team discussion and work?</td><td class='scoreRadio'><input type='radio' name='q3' value='1' required></td><td class='scoreRadio'><input type='radio' name='q3' value='2'></td><td class='scoreRadio'><input type='radio' name='q3' value='3'></td><td class='scoreRadio'><input type='radio' name='q3' value='4'></td><td class='scoreRadio'><input type='radio' name='q3' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Respect for others' ideas</td><td>How well did you encouraged others to contribute their ideas?</td><td class='scoreRadio'><input type='radio' name='q4' value='1' required></td><td class='scoreRadio'><input type='radio' name='q4' value='2'></td><td class='scoreRadio'><input type='radio' name='q4' value='3'></td><td class='scoreRadio'><input type='radio' name='q4' value='4'></td><td class='scoreRadio'><input type='radio' name='q4' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Flexibility</td><td>How flexible were you when disagreements occurred?</td><td class='scoreRadio'><input type='radio' name='q5' value='1' required></td><td class='scoreRadio'><input type='radio' name='q5' value='2'></td><td class='scoreRadio'><input type='radio' name='q5' value='3'></td><td class='scoreRadio'><input type='radio' name='q5' value='4'></td><td class='scoreRadio'><input type='radio' name='q5' value='5'></td></tr>";
                    echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                    echo "</form>";
                }
            ?>

        </table>
    </div>
</div>
</div>
