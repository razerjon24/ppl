<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/evaluation.css" type="text/css">
    <script type="text/javascript" src="http://tablesorter.com/jquery-latest.js"></script>
    <script type="text/javascript" src="http://tablesorter.com/__jquery.tablesorter.min.js"></script>
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
<body>
<div id="ReportContainer" class="panel panel-primary">
    <?php
        $i = 1;
        echo "<div class='panel-heading' style='color: #ffffff; font-size: 18px; text-align: center'>";
        echo "<span style='font-size: 22px'><strong>".$course[0]->Course_name."<br></strong> PROJECT <strong>".$evaluation[0]->Project." </strong>".strtoupper($evaluation[0]->Type)." ASSESSMENT</span>";
        echo "</div>";
        echo "<table id='reportTable' class='tablesorter'>";
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
<div id="overlay" style="visibility: hidden" onclick="close_popup()"></div>
<div id="peer_list" class="panel panel-primary" style="visibility: hidden"></div>
<div id="team_list" class="panel panel-primary" style="visibility: hidden"></div>
<footer class="navbar-fixed-bottom" style=" background-color: #28388B; text-align: center; color: #ffffff; font-size: 18px"><strong>P</strong>eer <strong>P</strong>roject <strong>L</strong>earning <span style="color:lightblue"><Strong>Beta Version</Strong></span><br></footer>
</body>
</html>