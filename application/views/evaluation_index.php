<!DOCTYPE html>
<head>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/evaluation.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/datepicker/css/datepicker.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/datepicker/js/datepicker.js"></script>
</head>
<div class="row" style='width: 100%; height: 400px; margin:0'>
    <div class="col-md-offset-1 col-md-10">
        <div class='panel panel-default'>
            <div class="panel-heading">
                <h2 class='panel-title lead'>Assessments List of <strong><?php echo $courseInfo[0]->Course_name.' '.$courseInfo[0]->Course_id;?></strong>
                    <a class='pull-right' href="<?php echo base_url('index.php/survey/management')?>"><span class='glyphicon glyphicon-list lead' data-toggle='tooltip' title='Survey Format' style="margin-bottom: 0"></span></a>
                    <a id="evaluation_button" class='pull-right' href="#" onclick="showCreateEvaluation()" style='margin-right: 1%;'><span data-toggle='tooltip' title='New Evaluation' class='glyphicon glyphicon-plus-sign lead' style='margin-bottom: 0'></span></a>
<!--                <button class='evaluation_button' style="margin-left: 5px"  data-toggle='tooltip' title='Full Report' role='button'><span class='glyphicon glyphicon-book'></span></button>-->
                </h2>
            </div>
        <?php
            if(!empty($evaluations)){
                echo "<table style='width: 100% ;font-size:16px; margin:0 2% 0 2%'><tr><th style='width: 6%'>#</th><th style='width: 13%'>START DATE</th><th style='width: 13%'>START TIME</th><th style='width: 13%'>END DATE</th><th style='width:13%'>END TIME</th><th style='width: 12%'>PROJECT</th><th style='width: 20%'>FORMAT</th><th>REPORT</th></tr></table>";
                echo "<table id='evaluation_list' style='width:100%; margin:0 2% 0 2%; font-size:16px; height: 300px; overflow:auto'>";
                $i = 1;
                foreach($evaluations as $evaluation){
                    echo "<tr><td style='width: 6%'>$i</td><td style='width: 13%'>".date('M j\, Y',strtotime($evaluation->Evaluation_start))."</td><td style='width:13%'>".date('g:i a',strtotime($evaluation->Evaluation_start))."</td><td style='width: 13%'>".date('M j\, Y',strtotime($evaluation->Evaluation_end))."</td><td style='width:13%'>".date('g:i a',strtotime($evaluation->Evaluation_end))."</td><td style='width:12%'>$evaluation->Project</td><td style='width:20%'>$evaluation->Format</td><td><a href=".base_url()."index.php/evaluation/preview/".$courseInfo[0]->Course_id."/".$evaluation->Evaluation_number."/".$evaluation->Project.">".$evaluation->Type."</a></td></tr>";
                    $i++;
                }
                echo "</table>";
            }
            else{
                echo "<div class='alert alert-warning' style='margin-bottom: 0;text-align: center;' role='alert'>
                        <strong>There are no evaluations for the selected course. <br><a role='button' onclick='showCreateEvaluation()'>Create a new evaluation</a></strong>
                    </div>";
            }

        ?>
        </div>
    </div>
</div>
</div>
<img id="loading-bar" src="<?php echo base_url();?>assets/images/loading-bar.gif" style="display: none">
<div class="col-md-offset-4 col-md-4 col-sm-4">
    <div id="create-evaluation_popup" class="panel panel-primary" style="display: none">
        <div class="panel-heading">
            <h2 class="panel-title">Create New Evaluation</h2>
        </div>
        <div class="panel-body">
            <form class="form_send" role='form' method='post' onsubmit="showBar()" action="<?php echo base_url('index.php/evaluation/create/'.$courseInfo[0]->Course_id)?>">
                <div class="input-group">
                    <label class="input-group-addon" style="width: 40%">Start Date</label>
                    <input id="evaluation_start" class="form-control"  name="date_start" type="text" data-date-format="yyyy-mm-dd" required>
                </div>
		<br>
		<div class="input-group" style="width: 100%">
                    <label class="input-group-addon" style="width: 40%">Start Time</label>
                    <input class="form-control" type ="time" name="starttime" required/>		    
		</div>
		<br>
                <div class="input-group">
                    <label class="input-group-addon" style="width: 40%">End Date</label>
                    <input id="evaluation_end" class="form-control"  name="date_end" type="text" data-date-format="yyyy-mm-dd" required>
                </div>
                <br>
		<div class="input-group" style="width: 100%">
                    <label class="input-group-addon" style="width: 40%">End Time</label>
                    <input class="form-control" type="time" name="endtime" required/>		    		    
		</div>
		<br>
                <div class="input-group" style="width: 100%">
                    <label class="input-group-addon" style="width: 40%">Type</label>
                    <select name="type" class="form-control">
                        <option value="Peer">Peer</option>
                        <option value="Team">Team</option>
                        <option value="Self">Self</option>
                        <option value="Homework">Homework</option>
                    </select>
                </div>
                <br>
                <div class="input-group " style="width: 100%">
                    <label class="input-group-addon" style="width: 40%">Language</label>
                    <select name="format" class="form-control">
                        <option value="Default - Spanish">Spanish</option>
                        <option value="Default - English">English</option>
                    </select>
                </div>
                <br>
                <div class="input-group" style="width: 100%">
                    <label class="input-group-addon" style="width: 40%">Project Number</label>
                    <input name="project" class="form-control" style="width: 40%" type="number" min="1" max="99" required>
                </div>
                <br>
                <div class="text-center">
                    <input id="submit_evaluation" type="submit" class="btn btn-primary"  onclick="date_checker()" value="Release Evaluation">
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#evaluation_start').datepicker().on('show', function(ev){
          $('.datepicker.dropdown-menu').css('z-index',10000);
        }).on('changeDate', function(ev){
            $('.datepicker.dropdown-menu').hide();
        });
        $('#evaluation_end').datepicker().on('show', function(ev){
            $('.datepicker.dropdown-menu').css('z-index',10000);
        }).on('changeDate', function(ev){
            $('.datepicker.dropdown-menu').hide();
        });
    });
</script>
