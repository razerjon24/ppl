<!DOCTYPE html>

<head><link rel="stylesheet" href="<?php echo base_url();?>assets/css/peer.css">
</head>

<div class="panel panel-primary">
    <div class='panel-heading' style="font-size: 24px;padding: 20px 25px; text-align: center"><?php echo "<strong>".$course[0]->Course_name."</strong><br>PROJECT <strong>".$evaluation[0]->Project."</strong> PEER ASSESSMENT";?></div>
        <div class='panel-body'>
            <table class="table">
                <?php
                if($evaluation[0]->Format == 'Default - Spanish'){
                    echo "<th id='constructTitle'>Constructor</th><th>Reflexión de evaluación en pares</th><th class='score'>Muy Pobre</th><th class='score'>Malo</th><th class='score'>Regular</th><th class='score'>Bueno</th><th class='score'>Excelente</th>";
                    echo "<form role='form' method='post' action=".base_url()."index.php/evaluation/peer_send/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number."/".$respondent[0]->Registration_number.">";
                    echo "<tr><td class='construct'>Preparación</td><td>¿Qué tan bien preparado estaba <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> para venir a clase?</td><td class='scoreRadio'><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Asistencia</td><td>¿Qué tan bien <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> asistió a las reuniones del grupo?</td><td class='scoreRadio'><input type='radio' name='q2' value='1' required></td><td class='scoreRadio'><input type='radio' name='q2' value='2'></td><td class='scoreRadio'><input type='radio' name='q2' value='3'></td><td class='scoreRadio'><input type='radio' name='q2' value='4'></td><td class='scoreRadio'><input type='radio' name='q2' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Contribución</td><td>¿Qué tan bien <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> contribuyó de manera productiva a la discusión y trabajo en equipo?</td><td class='scoreRadio'><input type='radio' name='q3' value='1' required></td><td class='scoreRadio'><input type='radio' name='q3' value='2'></td><td class='scoreRadio'><input type='radio' name='q3' value='3'></td><td class='scoreRadio'><input type='radio' name='q3' value='4'></td><td class='scoreRadio'><input type='radio' name='q3' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Respeto de ideas</td><td>¿Qué tan bien <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> alentó a los demás para contribuir con sus ideas?</td><td class='scoreRadio'><input type='radio' name='q4' value='1' required></td><td class='scoreRadio'><input type='radio' name='q4' value='2'></td><td class='scoreRadio'><input type='radio' name='q4' value='3'></td><td class='scoreRadio'><input type='radio' name='q4' value='4'></td><td class='scoreRadio'><input type='radio' name='q4' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Flexibilidad</td><td>¿Qué tan flexible fue <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> cuándo ocurrieron los desacuerdos?</td><td class='scoreRadio'><input type='radio' name='q5' value='1' required></td><td class='scoreRadio'><input type='radio' name='q5' value='2'></td><td class='scoreRadio'><input type='radio' name='q5' value='3'></td><td class='scoreRadio'><input type='radio' name='q5' value='4'></td><td class='scoreRadio'><input type='radio' name='q5' value='5'></td></tr>";
                    echo "<tr><td class='comments'>Describa una retroalimentación positiva</td><td>Dile a <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> sobre algo que haga bien. El cual ayudará a que tu equipo trabaje más eficientemente. Por favor dirígase al evaluado en segunda persona (\"tú\").<strong> (max. 100 caracteres)</strong></td><td colspan='5'><textarea name='feedback' maxlength='100' placeholder='Lo que escribas será anónimamente transmitido, sin embargo tu instructor puede leerlo.' required></textarea></td></tr>";
                    echo "<tr><td class='comments'>Describa una sugerencia constructiva</td><td>Dá a <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> una sugerencia constructiva para ayudarlo a convertirse en una más efectiva parte del equipo. Por favor dirígase al evaluado en segunda persona (\"tú\").<strong> (max. 100 caracteres)</strong></td><td colspan='5'><textarea name='suggestion' maxlength='100' placeholder='Lo que escribas será anónimamente transmitido, sin embargo tu instructor puede leerlo.' required></textarea></td></tr>";
                    echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                    echo "</form>";
                }
                elseif($evaluation[0]->Format == 'Default - English'){
                    echo "<th id='constructTitle'>Construct</th><th>Peer Assessment Reflection</th><th class='score'>Very Poor</th><th class='score'>Below Average</th><th class='score'>Average</th><th class='score'>Above Average</th><th class='score'>Excellent</th>";
                    echo "<form role='form' method='post' action=".base_url()."index.php/evaluation/peer_send/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number."/".$respondent[0]->Registration_number.">";
                    echo "<tr><td class='construct'>Preparation</td><td>How well was <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> prepared to come to class?</td><td class='scoreRadio'><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Attendance</td><td>How well did <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> attend the group meetings?</td><td class='scoreRadio'><input type='radio' name='q2' value='1' required></td><td class='scoreRadio'><input type='radio' name='q2' value='2'></td><td class='scoreRadio'><input type='radio' name='q2' value='3'></td><td class='scoreRadio'><input type='radio' name='q2' value='4'></td><td class='scoreRadio'><input type='radio' name='q2' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Contribution</td><td>How well did <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> contribute productively to the team discussion and work?</td><td class='scoreRadio'><input type='radio' name='q3' value='1' required></td><td class='scoreRadio'><input type='radio' name='q3' value='2'></td><td class='scoreRadio'><input type='radio' name='q3' value='3'></td><td class='scoreRadio'><input type='radio' name='q3' value='4'></td><td class='scoreRadio'><input type='radio' name='q3' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Respect for others' ideas</td><td>How well did <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> encouraged others to contribute their ideas?</td><td class='scoreRadio'><input type='radio' name='q4' value='1' required></td><td class='scoreRadio'><input type='radio' name='q4' value='2'></td><td class='scoreRadio'><input type='radio' name='q4' value='3'></td><td class='scoreRadio'><input type='radio' name='q4' value='4'></td><td class='scoreRadio'><input type='radio' name='q4' value='5'></td></tr>";
                    echo "<tr><td class='construct'>Flexibility</td><td>How flexible was <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> when disagreements occurred?</td><td class='scoreRadio'><input type='radio' name='q5' value='1' required></td><td class='scoreRadio'><input type='radio' name='q5' value='2'></td><td class='scoreRadio'><input type='radio' name='q5' value='3'></td><td class='scoreRadio'><input type='radio' name='q5' value='4'></td><td class='scoreRadio'><input type='radio' name='q5' value='5'></td></tr>";
                    echo "<tr><td class='comments'>Describe one positive feedback</td><td>Tell <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> one thing he/she does well. Which helps to make your team more effective. Please address him/her directly in second person (\"you\").<strong> (max. 100 characters)</strong></td><td colspan='5'><textarea name='feedback' maxlength='100' placeholder='The text you write will be anonymously transmitted, however your instructor can read it.' required></textarea></td></tr>";
                    echo "<tr><td class='comments'>Describe one constructive suggestion</td><td>Give <b>".$respondent[0]->Names." ".$respondent[0]->Surnames."</b> one constructive suggestion to help he/she become a more effective part of the team. Please address him/her directly in second person (\"you\").<strong> (max. 100 characters)</strong><br></td><td colspan='5'><textarea name='suggestion' maxlength='100' placeholder='The text you write will be anonymously transmitted, however your instructor can read it.' required></textarea></td></tr>";
                    echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                    echo "</form>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

