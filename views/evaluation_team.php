<!DOCTYPE html>

<head><link rel="stylesheet" href="<?php echo base_url();?>assets/css/peer.css">
</head>

<div class="panel panel-primary">
    <div class='panel-heading' style="text-align: center;font-size: 24px;padding: 20px 25px"><?php echo "<strong>".$course[0]->Course_name."</strong><br>PROJECT <strong>".$evaluation[0]->Project."</strong> TEAM ASSESSMENT";?></div>
    <div class='panel-body'>
        <table class="table">
            <?php
            if($evaluation[0]->Format == 'Default - Spanish'){
                echo "<th id='constructTitle'>Constructor</th><th>Reflexión de evaluación en equipo</th><th class='score'>Muy Pobre</th><th class='score'>Malo</th><th class='score'>Regular</th><th class='score'>Bueno</th><th class='score'>Excelente</th>";
                echo "<form role='form' method='post' action=".base_url()."index.php/evaluation/team_send/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number.">";
                echo "<tr><td class='construct'>Comunicación</td><td>¿Cómo calificaría la capacidad de su equipo para comunicarse de manera efectiva con sus miembros?</td><td class='scoreRadio'><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                echo "<tr><td class='construct'>Interdependencia</td><td>¿Cómo calificaría su capacidad de dependencia con los compañeros de su equipo?</td><td class='scoreRadio'><input type='radio' name='q2' value='1' required></td><td class='scoreRadio'><input type='radio' name='q2' value='2'></td><td class='scoreRadio'><input type='radio' name='q2' value='3'></td><td class='scoreRadio'><input type='radio' name='q2' value='4'></td><td class='scoreRadio'><input type='radio' name='q2' value='5'></td></tr>";
                echo "<tr><td class='construct'>Compromiso con el éxito del equipo o metas compartidas</td><td>¿Cómo calificaría el nivel de compromiso de su equipo para un objetivo en común?</td><td class='scoreRadio'><input type='radio' name='q3' value='1' required></td><td class='scoreRadio'><input type='radio' name='q3' value='2'></td><td class='scoreRadio'><input type='radio' name='q3' value='3'></td><td class='scoreRadio'><input type='radio' name='q3' value='4'></td><td class='scoreRadio'><input type='radio' name='q3' value='5'></td></tr>";
                echo "<tr><td class='construct'>Distribución</td><td>¿Cómo calificaría la claridad y la distribución de roles en su equipo?</td><td class='scoreRadio'><input type='radio' name='q4' value='1' required></td><td class='scoreRadio'><input type='radio' name='q4' value='2'></td><td class='scoreRadio'><input type='radio' name='q4' value='3'></td><td class='scoreRadio'><input type='radio' name='q4' value='4'></td><td class='scoreRadio'><input type='radio' name='q4' value='5'></td></tr>";
                echo "<tr><td class='construct'>Productividad</td><td>¿Cómo calificaría la capacidad de su equipo para trabajar juntos con eficiencia y eficacia?</td><td class='scoreRadio'><input type='radio' name='q5' value='1' required></td><td class='scoreRadio'><input type='radio' name='q5' value='2'></td><td class='scoreRadio'><input type='radio' name='q5' value='3'></td><td class='scoreRadio'><input type='radio' name='q5' value='4'></td><td class='scoreRadio'><input type='radio' name='q5' value='5'></td></tr>";
                echo "<tr><td class='comments'>Describa una retroalimentación positiva</td><td>Redacte algo que su equipo haga bien.<strong> (max. 100 caracteres)</strong></td><td colspan='5'><textarea name='feedback' maxlength='100' required></textarea></td></tr>";
                echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                echo "</form>";
            }
            elseif($evaluation[0]->Format == 'Default - English'){
                echo "<th id='constructTitle'>Construct</th><th>Team Assessment Reflection</th><th class='score'>Very Poor</th><th class='score'>Below Average</th><th class='score'>Average</th><th class='score'>Above Average</th><th class='score'>Excellent</th>";
                echo "<form role='form' method='post' action=".base_url()."index.php/evaluation/team_send/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number.">";
                echo "<tr><td class='construct'>Communication</td><td>How would you rate your team's ability to communicate effectively with team members?</td><td class='scoreRadio'><input type='radio' name='q1' value='1' required></td><td class='scoreRadio'><input type='radio' name='q1' value='2'></td><td class='scoreRadio'><input type='radio' name='q1' value='3'></td><td class='scoreRadio'><input type='radio' name='q1' value='4'></td><td class='scoreRadio'><input type='radio' name='q1' value='5'></td></tr>";
                echo "<tr><td class='construct'>Interdependence</td><td>How would you rate your ability to depend upon your teammates?</td><td class='scoreRadio'><input type='radio' name='q2' value='1' required></td><td class='scoreRadio'><input type='radio' name='q2' value='2'></td><td class='scoreRadio'><input type='radio' name='q2' value='3'></td><td class='scoreRadio'><input type='radio' name='q2' value='4'></td><td class='scoreRadio'><input type='radio' name='q2' value='5'></td></tr>";
                echo "<tr><td class='construct'>Commitment to team success or shared goals</td><td>How would you rate your team's level of commitment to a shared goal?</td><td class='scoreRadio'><input type='radio' name='q3' value='1' required></td><td class='scoreRadio'><input type='radio' name='q3' value='2'></td><td class='scoreRadio'><input type='radio' name='q3' value='3'></td><td class='scoreRadio'><input type='radio' name='q3' value='4'></td><td class='scoreRadio'><input type='radio' name='q3' value='5'></td></tr>";
                echo "<tr><td class='construct'>Distribution</td><td>How would you rate the clarity and distribution of roles on your team?</td><td class='scoreRadio'><input type='radio' name='q4' value='1' required></td><td class='scoreRadio'><input type='radio' name='q4' value='2'></td><td class='scoreRadio'><input type='radio' name='q4' value='3'></td><td class='scoreRadio'><input type='radio' name='q4' value='4'></td><td class='scoreRadio'><input type='radio' name='q4' value='5'></td></tr>";
                echo "<tr><td class='construct'>Productivity</td><td>How would you rate your team's ability to work effectively and efficiently together?</td><td class='scoreRadio'><input type='radio' name='q5' value='1' required></td><td class='scoreRadio'><input type='radio' name='q5' value='2'></td><td class='scoreRadio'><input type='radio' name='q5' value='3'></td><td class='scoreRadio'><input type='radio' name='q5' value='4'></td><td class='scoreRadio'><input type='radio' name='q5' value='5'></td></tr>";
                echo "<tr><td class='comments'>Describe one positive feedback</td><td>Tell one thing your team does well.<strong> (max. 100 characters)</strong></td><td colspan='5'><textarea name='feedback' maxlength='100' required></textarea></td></tr>";
                echo "<tr><td colspan='7' style='text-align: center'><input class='btn btn-primary' type='submit' value='Send'></td></tr>";
                echo "</form>";
            }
            ?>
        </table>
    </div>
</div>
</div>

