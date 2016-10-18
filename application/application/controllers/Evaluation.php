<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation extends CI_Controller {
    function __construct() {
        parent::__construct();}

    /*
     *
     * INSTRUCTOR FUNCTIONS
     *
     * */
    public function index($course_id)
    {
        if($this->session->userdata('user')=='teacher' && $course_id!=null){
            $this->load->model('course_model');
            $instructor_name = $this->session->userdata('user_name');
            $instructor_id = $this->session->userdata('user_id');
            $courses_validator = $this->course_model->courseValidator($course_id,$instructor_id);
            if($courses_validator){
                $this->data['instructor_name'] = $instructor_name;
                $this->load->model('evaluation_model');
                $this->data['evaluations'] = $this->evaluation_model->getEvaluations($course_id);
                $this->data['courseInfo'] = $this->course_model->getCourse_byId($course_id);
                $this->load->view('admin_head',$this->data);
                $this->load->view('evaluation_index');
                $this->load->view('home_footer');
            }
            else{
                echo "<script>window.location.href='".base_url("index.php/admin")."';</script>";
            }
        }
        else {
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }

    public function create($course_id){
        if($_POST!=null && $this->session->userdata('user')=='teacher') {
            $this->load->model('course_model');
            $this->load->model('evaluation_model');
            $this->load->library('email');
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $course = $this->course_model->getCourse_byId($course_id);
            $course_name = $course[0]->Course_name;
            $project = $_POST['project'];
            $date_start = $_POST['date_start'];
            $date_end = $_POST['date_end'];
            $format = $_POST['format'];
            $type = $_POST['type'];
            $evaluation_number = $this->evaluation_model->get_evaluation_number($course_id,$project);
            $evaluation_number = intval($evaluation_number)+1;
            $this->evaluation_model->register_evaluation($course_id,$evaluation_number,$project,$date_start,$date_end,$type,$format);
            $evaluation_id = $this->evaluation_model->get_evaluation_id($course_id,$evaluation_number, $project);
            $groups = $this->course_model->get_student_groups($course_id);
            foreach ($groups as $student){
                $this->evaluation_model->register_evaluation_student($evaluation_id[0]->Evaluation_id, $student->Registration_number, $student->Group_number);
                $evaluation_student_id = $this->evaluation_model->get_evaluation_student_id($evaluation_id[0]->Evaluation_id,$student->Registration_number);
                if($type === 'Team'){
                    $this->evaluation_model->register_team_assessment($evaluation_student_id[0]->Evaluation_student_id);
                    $email_body = "Hello!<br><br>The course <span style='text-decoration: underline'>".$course_name."</span> has released a new ".$type." evaluation for project <strong>".$project."</strong>.<br><br>The evaluation will start on <strong>".date('M j\, Y',strtotime($date_start))."</strong> until <strong>".date('M j\, Y',strtotime($date_end))."</strong>.<br><br><strong>Remember to evaluate your teammates.</strong><br>http://ppl.espol.edu.ec";
                }
                elseif($type === 'Peer'){
                    $students_by_group = $this->course_model->get_student_by_group($course_id, $student->Group_number);
                    $email_body = "Hello!<br><br>The course <span style='text-decoration: underline'>".$course_name."</span> has released a new ".$type." evaluation for project <strong>".$project."</strong>.<br><br>The evaluation will start on <strong>".date('M j\, Y',strtotime($date_start))."</strong> until <strong>".date('M j\, Y',strtotime($date_end))."</strong>.<br><br><strong>Remember to evaluate your teammates.</strong><br>http://ppl.espol.edu.ec";
                    foreach($students_by_group as $student_group){
                        if($student->Registration_number != $student_group->Registration_number)
                            $this->evaluation_model->register_peer_assessment($evaluation_student_id[0]->Evaluation_student_id, $student_group->Registration_number);
                    }
                }
                elseif($type === 'Self'){
                    $email_body = "Hello!<br><br>The course <span style='text-decoration: underline'>".$course_name."</span> has released a new <strong>".$type."</strong> evaluation for project <strong>".$project."</strong>.<br><br>The evaluation will start on <strong>".date('M j\, Y',strtotime($date_start))."</strong> until <strong>".date('M j\, Y',strtotime($date_end))."</strong>.<br><br><strong>Remember to evaluate your teammates.</strong><br>http://ppl.espol.edu.ec";
                    $this->evaluation_model->register_self_assessment($evaluation_student_id[0]->Evaluation_student_id);
                }
                $this->email->from('ppl@espol.edu.ec', 'ppl');
                $this->email->to($student->Email);
                $this->email->subject('New Evaluation');
                $this->email->message($email_body);
                $this->email->send();
            }
            echo "<script> alert('Evaluation released successfully'); window.location.href='".base_url("index.php/evaluation/index/".$course_id)."';</script>";
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }

    }


    public function preview($course_id, $evaluation_number, $project){
        if($this->session->userdata('user')=='teacher'){
            $this->load->model('course_model');
            $instructor_name = $this->session->userdata('user_name');
            $instructor_id = $this->session->userdata('user_id');
            $courses_validator = $this->course_model->courseValidator($course_id,$instructor_id);
            if($courses_validator){
                $this->data['instructor_name'] = $instructor_name;
                $this->load->model('evaluation_model');
                $evaluation_id = $this->evaluation_model->get_evaluation_id($course_id,$evaluation_number,$project);
                $this->data['course'] = $this->course_model->getCourse_byId($course_id);
                $this->data['students'] = $this->evaluation_model->get_evaluation_student_list($evaluation_id[0]->Evaluation_id);
                $this->data['evaluation'] = $evaluation_id;
                $this->load->view('admin_head',$this->data);
                $this->load->view('evaluation_preview',$this->data);
                $this->load->view('home_footer',$this->data);
            }
            else{
                echo "<script>window.location.href='".base_url("index.php/admin")."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }

    /*
     *
     * STUDENT FUNCTIONS
     *
     * */

    public function take(){
        $course_id = $_POST['course_id'];
        $project_number = $_POST['project'];
        $evaluation_number = $_POST['evaluation_number'];
        if($course_id != null && $evaluation_number != null && $project_number != null && $this->session->userdata('user')=='student'){
            $this->load->model('course_model');
            $this->load->model('evaluation_model');
            $this->load->view('home_footer');
            $registration_id = $this->session->userdata('user_id');
            $courses_validator = $this->course_model->courseValidatorStudent($course_id,$registration_id);
            if($courses_validator){
                $evaluation = $this->evaluation_model->get_student_evaluation($course_id,$project_number,$evaluation_number,$registration_id);
                $peer_list = $this->evaluation_model->get_peer_list($evaluation[0]->Evaluation_student_id);
                $course = $this->course_model->getCourse_byId($course_id);
                if(!empty($peer_list)){
                    echo "<div class='panel panel-primary' style='margin-bottom: 0'>";
                    echo "<div class='panel-heading' style='text-align: left; text-align: center'>Group's Member List</div>";
                    echo "<div class='panel-body' style='text-align: left;text-align: center; max-height: 150px; overflow: auto'>";
                    foreach ($peer_list as $peer_student) {
                        if ($peer_student->Peer_took == 0 && $peer_student->Respondent != $this->session->userdata('user_id')) {
                            echo "<a href=".base_url("index.php/evaluation/peer/".$course[0]->Course_id."/".$evaluation[0]->Project."/".$evaluation[0]->Evaluation_number."/".$peer_student->Registration_number)." style='font-size: 20px'>$peer_student->Names $peer_student->Surnames</a>";
                            echo "<br>";
                        }
                    }
                    echo "</div></div>";
                }
            }
        }
    }

    public function peer($course_id = null, $project_number = null, $evaluation_number = null, $peer_Registration_number = null){
        if($course_id != null && $evaluation_number != null && $this->session->userdata('user')=='student' && $peer_Registration_number != null){
            $this->load->model('course_model');
            $this->load->model('evaluation_model');
            $student_name = $this->session->userdata('user_name');
            $registration_id = $this->session->userdata('user_id');
            $courses_validator = $this->course_model->courseValidatorStudent($course_id,$registration_id);
            if($courses_validator) {
                $this->data['course'] = $this->course_model->getCourse_byId($course_id);
                $this->data['student_name'] = $student_name;
                $evaluation = $this->evaluation_model->get_student_evaluation($course_id, $project_number, $evaluation_number, $this->session->userdata('user_id'));
                $student_checker = $this->evaluation_model->verify_peer_student($evaluation[0]->Evaluation_student_id, $peer_Registration_number);
                $peer_checker = $this->evaluation_model->verify_peer_took($evaluation[0]->Evaluation_student_id, $peer_Registration_number);
                if (!empty($evaluation) && $peer_checker == 0 && $student_checker == 1 && ($this->session->userdata('user_id') != $peer_Registration_number)) {
                    $this->data['respondent'] = $this->course_model->getStudent_by_id($peer_Registration_number);
                    $this->data['evaluation'] = $evaluation;
                    $this->load->view('student_head', $this->data);
                    $this->load->view('evaluation_peer', $this->data);
                    $this->load->view('home_footer', $this->data);
                } else {
                    echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
                }
            }
            else{
                echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
            }

        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }

    public function self($course_id = null, $project_number = null, $evaluation_number = null){
        if($course_id != null && $evaluation_number != null && $this->session->userdata('user')=='student'){
            $this->load->model('course_model');
            $this->load->model('evaluation_model');
            $student_name = $this->session->userdata('user_name');
            $registration_id = $this->session->userdata('user_id');
            $courses_validator = $this->course_model->courseValidatorStudent($course_id,$registration_id);
            if($courses_validator) {
                $this->data['student_name'] = $student_name;
                $this->data['course'] = $this->course_model->getCourse_byId($course_id);
                $this->data['evaluation'] = $this->evaluation_model->get_student_evaluation($course_id, $project_number, $evaluation_number, $this->session->userdata('user_id'));
                if (!empty($this->data['evaluation'])) {
                    $this->load->view('student_head',$this->data);
                    $this->load->view('evaluation_self', $this->data);
                    $this->load->view('home_footer', $this->data);

                } else {
                    echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
                }
            }
            else{
                echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }
    public function team($course_id = null, $project_number = null, $evaluation_number = null){
        if($course_id != null && $evaluation_number != null && $this->session->userdata('user')=='student'){
            $this->load->model('course_model');
            $this->load->model('evaluation_model');
            $student_name = $this->session->userdata('user_name');
            $registration_id = $this->session->userdata('user_id');
            $courses_validator = $this->course_model->courseValidatorStudent($course_id,$registration_id);
            if($courses_validator) {
                $this->data['student_name'] = $student_name;
                $this->data['course'] = $this->course_model->getCourse_byId($course_id);
                $evaluation = $this->evaluation_model->get_student_evaluation($course_id, $project_number, $evaluation_number, $this->session->userdata('user_id'));
                $team_verified = $this->evaluation_model->verify_team_took($evaluation[0]->Evaluation_student_id);
                if (!empty($evaluation) && $team_verified == 0) {
                    $this->load->view('student_head',$this->data);
                    $this->data['evaluation'] = $evaluation;
                    $this->load->view('evaluation_team', $this->data);
                } else {
                    echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
                }
            }
            else{
                echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }

    public function team_send($course_id = null, $project_number = null, $evaluation_number = null){
        if($_POST && $course_id != null && $evaluation_number != null && $project_number != null && $this->session->userdata('user')=='student'){
            $this->load->model('course_model');
            $this->load->model('evaluation_model');
            $registration_id = $this->session->userdata('user_id');
            $courses_validator = $this->course_model->courseValidatorStudent($course_id,$registration_id);
            if($courses_validator) {
                $evaluation = $this->evaluation_model->get_student_evaluation($course_id, $project_number, $evaluation_number,$this->session->userdata('user_id'));
                $team_verified = $this->evaluation_model->verify_team_took($evaluation[0]->Evaluation_student_id);
                if (!empty($evaluation) && !$team_verified) {
                    $score = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'];
                    $feedback = $_POST['feedback'];
                    $this->evaluation_model->register_team_assessment_score($evaluation[0]->Evaluation_student_id, $score, $feedback);
                    $average = $this->evaluation_model->get_avg_team_assessment_score($evaluation[0]->Evaluation_id, $evaluation[0]->Group_number);
                    $this->evaluation_model->register_student_avg_team_score($evaluation[0]->Evaluation_id, $evaluation[0]->Group_number, round($average[0]->Score, 2));
                    $this->evaluation_model->update_student_evaluations_took($evaluation[0]->Evaluation_student_id);
                    echo "<script> alert('Evaluation sent successfully!'); window.location.href='".base_url("index.php/student/index/".$course_id)."';</script>";
                } else {
                    echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
                }
            }
            else{
                echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }
    public function self_send($course_id = null, $project_number = null, $evaluation_number = null ){
        if($course_id != null && $evaluation_number != null && $project_number!= null && $this->session->userdata('user')=='student'){
            $this->load->model('course_model');
            $this->load->model('evaluation_model');
            $registration_id = $this->session->userdata('user_id');
            $courses_validator = $this->course_model->courseValidatorStudent($course_id,$registration_id);
            if($courses_validator) {
                $evaluation = $this->evaluation_model->get_student_evaluation($course_id, $project_number, $evaluation_number,$this->session->userdata('user_id'));
                $self_took = $this->evaluation_model->verify_self_took($evaluation[0]->Evaluation_student_id);
                if(!empty($evaluation) && !$self_took){
                    $score = $_POST['q1']+$_POST['q2']+$_POST['q3']+$_POST['q4']+$_POST['q5'];
                    $this->evaluation_model->update_student_self_evaluation($evaluation[0]->Evaluation_student_id, $score);
                    $this->evaluation_model->update_student_avg_self_score($evaluation[0]->Evaluation_student_id, $score);
                    $this->evaluation_model->update_student_evaluations_took($evaluation[0]->Evaluation_student_id);
                    echo "<script> alert('Evaluation sent successfully!'); window.location.href='".base_url("index.php/student/index/".$course_id)."';</script>";
                }
                else{
                    echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
                }
            }
            else{
                echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }
    public function peer_send($course_id = null, $project_number = null, $evaluation_number = null, $peer_Registration_number = null){
        if($course_id != null && $evaluation_number != null && $project_number != null && $peer_Registration_number != null && $this->session->userdata('user')=='student'){
            $this->load->model('course_model');
            $this->load->model('evaluation_model');
            $registration_id = $this->session->userdata('user_id');
            $courses_validator = $this->course_model->courseValidatorStudent($course_id,$registration_id);
            if($courses_validator) {
                $evaluation = $this->evaluation_model->get_student_evaluation($course_id, $project_number, $evaluation_number,$this->session->userdata('user_id'));
                $student_checker = $this->evaluation_model->verify_peer_student($evaluation[0]->Evaluation_student_id, $peer_Registration_number);
                $peer_checker = $this->evaluation_model->verify_peer_took($evaluation[0]->Evaluation_student_id, $peer_Registration_number);
                if(!empty($evaluation) && !$peer_checker && $student_checker && ($this->session->userdata('user_id') != $peer_Registration_number)){
                    $score = $_POST['q1']+$_POST['q2']+$_POST['q3']+$_POST['q4']+$_POST['q5'];
                    $feedback = $_POST['feedback'];
                    $suggestion = $_POST['suggestion'];
                    $this->evaluation_model->update_student_peer_evaluation($evaluation[0]->Evaluation_student_id,$peer_Registration_number, $score, $feedback, $suggestion);
                    $verifyPeerNotTaken = $this->evaluation_model->verify_student_evaluation_peer_took($evaluation[0]->Evaluation_student_id);
                    if(!$verifyPeerNotTaken){
                        $this->evaluation_model->update_student_evaluations_took($evaluation[0]->Evaluation_student_id);
                        $group_list = $this->evaluation_model->get_evaluation_team_list($evaluation[0]->Evaluation_id,$evaluation[0]->Group_number);
                        foreach($group_list as $member){
                            if($member->Registration_number != $this->session->userdata('user_id')){
                                $average = $this->evaluation_model->get_avg_peer_assessment_score($evaluation[0]->Evaluation_id, $member->Registration_number);
                                $this->evaluation_model->register_student_avg_peer_score($member->Evaluation_student_id, round($average[0]->Score,2));
                            }
                        }
                        $team_list = $this->evaluation_model->get_evaluation_team_list($evaluation[0]->Evaluation_id,$evaluation[0]->Group_number);
                        $avg_PA = $this->evaluation_model->get_avg_PA($evaluation[0]->Evaluation_id, $evaluation[0]->Group_number);
                        foreach($team_list as $student){
                            if($student->Avg_Peer != 0 && $student->Registration_number != $this->session->userdata('user_id')) {
                                $average = $this->evaluation_model->get_avg_peer_assessment_score($evaluation[0]->Evaluation_id, $student->Registration_number);
                                $evaluation_WF = round($average[0]->Score, 2) / round($avg_PA[0]->Avg_Peer, 2);
                                $this->evaluation_model->register_student_evaluation_WF($student->Evaluation_student_id, round($evaluation_WF, 2));
                            }
                        }
                        echo "<script> alert('All peer evaluations have been taken!'); window.location.href='".base_url("index.php/student/index/".$course_id)."';</script>";
                    }
                    else{
                        echo "<script> alert('Evaluation sent successfully!'); window.location.href='".base_url("index.php/student/index/".$course_id)."';</script>";
                    }
                }
                else{
                    echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
                }
            }
            else{
                echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }

    public function peer_report(){
        $evaluation_id = $_POST['ev'];
        $group_number = $_POST['g_n'];
        $evaluation_student_id = $_POST['ev_st'];
        if($evaluation_id != null && $group_number != null && $evaluation_student_id != null && $this->session->userdata('user')=='student') {
            $registration_number = $this->session->userdata('user_id');
            $this->load->model('evaluation_model');
            $this->load->model('student_model');
            $score = $this->student_model->get_avg($evaluation_student_id);
            $wf = $score[0]->Evaluation_WF;
            $score = $score[0]->Avg_Peer;
            $team_list = $this->evaluation_model->get_evaluation_team_list($evaluation_id,$group_number);
            if(!empty($team_list)){
                echo "<div class='panel panel-primary' style='margin-bottom: 0'>";
                echo "<div class='panel-heading' style='text-align: left; text-align: center'>Peer Assessment's Report</div>";
                echo "<div class='panel-body' style='text-align: left;text-align: center; max-height: 90px'>";
                echo "<p>Peer score: <strong>$score</strong> of 5</p>";
                echo "<p>Weighting Factor: <strong>$wf</strong></p>";
                echo "</div>";
                echo "<div class='panel-body' style='text-align: left;text-align: center; max-height: 250px; overflow: auto; margin-bottom: 20px'>";
                $suggestions = array();
                $fbs = array();
                foreach ($team_list as $student) {
                    if ($student->Took == 1 && $student->Evaluation_student_id != $evaluation_student_id) {
                        $commentary = $this->student_model->get_peer_evaluation($student->Evaluation_student_id, $registration_number);
                        $feedback = $commentary[0]->Feedback;
                        $suggestion = $commentary[0]->Suggestion;
                        array_push($fbs, $feedback);
                        array_push($suggestions, $suggestion);
                    }
                }
                echo "<p style='color: blue'>Feedbacks:</p>";
                foreach ($fbs as $fb){
                    echo "<textarea style='text-align: center' readonly>$fb</textarea>";
                    echo "<br>";
                }
                echo "<p style='color: blue'>Suggestions:</p>";
                foreach ($suggestions as $sg){
                    echo "<textarea style='text-align: center' readonly>$sg</textarea>";
                    echo "<br>";
                }
                echo "</div></div>";
            }
        }
    }
    public function team_report(){
        $evaluation_id = $_POST['ev'];
        $group_number = $_POST['g_n'];
        $evaluation_student_id = $_POST['ev_st'];
        if($evaluation_id != null && $group_number != null && $evaluation_student_id != null && $this->session->userdata('user')=='student') {
            $this->load->model('evaluation_model');
            $this->load->model('student_model');
            $score = $this->student_model->get_avg($evaluation_student_id);
            $score = $score[0]->Avg_Team;
            $team_list = $this->evaluation_model->get_evaluation_team_list($evaluation_id,$group_number);
            if(!empty($team_list)){
                echo "<div class='panel panel-primary' style='margin-bottom: 0'>";
                echo "<div class='panel-heading' style='text-align: left; text-align: center'>Team Assessment's Report</div>";
                echo "<div class='panel-body' style='text-align: left;text-align: center; max-height: 90px'>";
                echo "<p>Team score: <strong>$score</strong> of 5</p>";
                echo "<p style='color: blue'>Group's commentaries:</p>";
                echo "</div>";
                echo "<div class='panel-body' style='text-align: left;text-align: center; max-height: 250px; overflow: auto; margin-bottom: 20px'>";
                foreach ($team_list as $student) {
                    if ($student->Took == 1) {
                        $commentary = $this->student_model->get_team_evaluation($student->Evaluation_student_id);
                        $commentary = $commentary[0]->Commentary;
                        echo "<textarea style='text-align: center' readonly>$commentary</textarea>";
                        echo "<br>";
                    }
                }
                echo "</div></div>";
            }
        }
    }

    public function peer_evaluation(){
        $evaluation_id = $_POST['ev_id'];
        $registration_number = $_POST['r_n'];
        if($evaluation_id != null && $registration_number != null && $this->session->userdata('user')=='teacher') {
            $this->load->model('evaluation_model');
            $this->load->model('student_model');
            $this->load->model('course_model');
            $student = $this->course_model->getStudent_by_id($registration_number);
            $evaluation_student_id = $this->evaluation_model->get_evaluation_student_id($evaluation_id,$registration_number);
            $peer_list = $this->student_model->preview_peer_evaluation($evaluation_student_id[0]->Evaluation_student_id);
            if(!empty($peer_list)){
                echo "<div class='panel-heading' style='color: #ffffff; font-size: 18px; text-align: center'>Evaluator: <strong>".$student[0]->Names." ".$student[0]->Surnames."</strong></div>";
                echo "<table id='reportTable' class='tablesorter'>";
                echo "<thead><tr><th style='width: 120px'>REG. ID</th><th style='width: 200px'>FIRST NAME</th><th style='width: 200px'>LAST NAME</th><th style='width: 108px; text-align: center'>SCORE</th><th style='width: 200px; text-align: center'>FEEDBACK</th><th style='width: 200px; text-align: center'>SUGGESTION</th></tr></thead>";
                foreach($peer_list as $member){
                    $respondent = $this->course_model->getStudent_by_id($member->Respondent);
                    $surnames = $respondent[0]->Surnames;
                    $names = $respondent[0]->Names;
                    $r_n = $respondent[0]->Registration_number;
                    echo "<tr class='reportRows'>";
                    echo "<td style='text-align:left; padding-left: 18px'><input type='text' style='border: none ;width: 120px; text-overflow: ellipsis; background-color: transparent' value='$r_n' readonly></td><td style='text-align:left; padding-left: 18px'><input type='text' style='border: none ;width: 200px; text-overflow: ellipsis; background-color: transparent' value='$names' readonly></td><td style='text-align: left; padding-left: 18px'><input type='text' style='border: none ;width: 200px; text-overflow: ellipsis; background-color: transparent' value='$surnames' readonly></td><td style='text-align: center'>".$member->Score."</td><td style='padding: 0 5px; text-align: center'>".$member->Feedback."</td><td style='padding: 0 5px; text-align: center'>".$member->Suggestion."</td></tr>";
                }
                echo "</table>";
            }
        }
        }
    public function team_evaluation(){
        $evaluation_id = $_POST['ev_id'];
        $registration_number = $_POST['r_n'];
        if($evaluation_id != null && $registration_number != null && $this->session->userdata('user')=='teacher') {
            $this->load->model('evaluation_model');
            $this->load->model('student_model');
            $this->load->model('course_model');
            $student = $this->course_model->getStudent_by_id($registration_number);
            $evaluation_student_id = $this->evaluation_model->get_evaluation_student_id($evaluation_id,$registration_number);
            $team_info = $this->student_model->get_team_evaluation($evaluation_student_id[0]->Evaluation_student_id);
            $score = $team_info[0]->Score;
            $feedback = $team_info[0]->Commentary;
            echo "<div class='panel-heading' style='color: #ffffff; font-size: 18px; text-align: center'>Evaluator: <strong>".$student[0]->Names." ".$student[0]->Surnames."</strong></div>";
            echo "<table id='reportTable' class='tablesorter'>";
            echo "<thead><tr><th style='width: 108px; text-align: center'>SCORE</th><th style='width: 200px; text-align: center'>COMMENTARY</th></tr></thead>";
            echo "<tr class='reportRows'>";
            echo "<td style='text-align: center'>".$score."</td><td style='padding: 0 5px; text-align: center'>".$feedback."</td></tr>";
            echo "</table>";

        }
    }
}