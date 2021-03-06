
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/evaluation.css" type="text/css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/admin_tools.js"></script>


    <script type="text/javascript" >
        function peer_evaluation(r_n, ev_id){
            $.ajax({
                type:'POST',
                data:{r_n:r_n,ev_id:ev_id},
                url:'<?php echo site_url('evaluation/peer_evaluation');?>',
                success: function(result){
                    popup = document.getElementById("peer_list");
                    popup.innerHTML = result;
                    popup.style.visibility = "visible";
                    $('#peer_list').bPopup();
                }
            });
        }
        function team_evaluation(r_n, ev_id){
            $.ajax({
                type:'POST',
                data:{r_n:r_n,ev_id:ev_id},
                url:'<?php echo site_url('evaluation/team_evaluation');?>',
                success: function(result){
                    popup = document.getElementById("team_list");
                    popup.innerHTML = result;
                    popup.style.visibility = "visible";
                    $('#team_list').bPopup();
                }
            });
        }
        $(document).ready(function() {
            $("#reportTable").tablesorter();
            $(".botonExcel").click(function(event) {
                $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
                $("#FormularioExportacion").submit();
            });
        });
        function close_popup(){
            popup = document.getElementById("peer_list");
            popup1 = document.getElementById("team_list");
            popup.style.visibility = "hidden";
            popup1.style.visibility = "hidden";
        }

    </script>

</head>

<div class="row" style='width: 100%; height: 700px'>
    <div class="col-md-offset-3 col-md-6 col-sm-6">
        <div class='panel panel-default'>
            <div class="panel-heading">
                <h2 class='panel-title lead'><strong><?php echo $course[0]->Course_name.' Project'.$evaluation[0]->Project; ?>
                        <form action=<?php echo site_url('export/preview/'.$course[0]->Course_id.'/'.$evaluation[0]->Evaluation_number.'/'.$evaluation[0]->Project)?> method="post" target="_blank" id="FormularioExportacion">
                            <span style='margin-bottom: 0' data-toggle='tooltip' title='Export to Excel' >
                                <img src= "http://www.ppl.espol.edu.ec/assets/images/exportar_a_excel.png" align="right" style='margin-right: 1%;'  class='botonExcel' alt="Export to Excel"  height="20px" width="20px" />
                            </span>
                        </form>
                        <?php echo strtoupper($evaluation[0]->Type).' ASSESSMENT';?></strong>


                </h2>
            </div>

    <?php
    $i = 1;
    $Final_WF = 1;
    echo "<div style='overflow: auto; height: 600px'>";
    echo "<table id='reportTable'>";
    echo "<thead><tr><th style='width: 50px'><span class='glyphicon glyphicon-sort' style='color: lightblue'></span> #</th><th style='width: 120px'>REG. ID</th><th style='width: 280px'>FIRST NAME</th><th style='width: 280px'>LAST NAME</th><th style='width: 108px; text-align: center'>GROUP NUMBER";
    if($evaluation[0]->Type == 'Peer')
        echo "</th><th style='width: 128px; text-align: center'>PEER ASSESSMENT</th><th style='text-align: center'>WEIGHTING FACTOR";
    elseif($evaluation[0]->Type == 'Team')
        echo "</th><th style='width: 128px; text-align: center'>TEAM ASSESSMENT";
    elseif($evaluation[0]->Type == 'Self')
        echo "</th><th style='width: 128px; text-align: center'>SELF ASSESSMENT";
    echo "</th></tr></thead>";
    $evaluation_id = $evaluation[0]->Evaluation_id;
    echo "<tbody>";
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
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    ?>

            

        </div>
    </div>
</div>
<div id="peer_list" class="panel panel-primary" style="display: none"></div>
<div id="team_list" class="panel panel-primary" style="display: none"></div>
</div>
