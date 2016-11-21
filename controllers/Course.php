<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {
    function __construct() {
        parent::__construct();}
    public function create()
    {
        if($this->session->userdata('user')=='teacher'){
            $this->load->model('course_model');
            $this->data['instructor_name'] = $this->session->userdata('user_name');
            $this->load->view('admin_head',$this->data);
            $this->load->view('new_course');
            $this->load->view('home_footer');
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }

    }
    /*  @function   register()
     *  @params     no params
     *  @details    Function that extract the raw data values and prepare to be registered in the database
     *              Returns to the admin_index page.
     *  @return     Null
     * */
    public function register()
    {
        if(isset($_POST['submit'])&& $this->session->userdata('user')=='teacher'){
            $student_unregistered = 0;
            $data_flag = 0;
            $course_id = strtoupper($_POST['Course_id']);
            $course_name = $_POST['Course_name'];
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file,"r");
            $this->load->model('course_model');
            $this->load->helper('string');
            if($this->course_model->course_checker($course_id) != 1) {
                $this->load->library('email');
                $req_data = array(0,0,0,0);
                while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                    if ($data_flag != 0) {
                        $student_id = $fileop[$req_data[0]-1];
                        $student_family_names = $fileop[$req_data[1]-1];
                        $student_names = $fileop[$req_data[2]-1];
                        $student_email = $fileop[$req_data[3]-1];
                        $password = random_string('alnum', 25);
                        $password_email = $password;
                        $password = sha1($password);
                        if (!empty($student_id) && !empty($student_names) && !empty($student_family_names) && !empty($student_email)) {
                            if(sizeof($student_id)<=35 && sizeof($student_names)<=50 && sizeof($student_family_names)<=50 && sizeof($student_email)<=50){
                                if ($this->course_model->student_checker($student_id, $student_email)== false) {
                                    $this->course_model->student_register($student_id, $student_names, $student_family_names, $student_email,$password);
                                    $this->course_model->student_registration($course_id, $student_id);
                                    $id_registration = $this->course_model->get_student_registration_id($course_id, $student_id);
                                    $this->course_model->group_member_register(0, $id_registration[0]->Registration_id);
                                    $email_body = "<!DOCTYPE html><html><body><p>You have been registered in Peer Project Learning (PPL) website.</p><p>Additionally, you are registered in the course: <strong>".$course_name."</strong></p><p>Available assessments will be notified on the webpage.</p><p>Your account information is:</p><p><strong>Registration ID: </strong>".$student_id."</p><p><strong>Username: </strong>".$student_email."</p><p><strong>Password: </strong>".$password_email."</p><p>P.S. We are still in beta, any bugs report to ppl@espol.edu.ec</p><p>Hope you log in soon!</p><br><a href='http://ppl.espol.edu.ec'>Peer Project Learning</a></body></html>";
                                    $this->email->from('ppl@espol.edu.ec', 'Peer Project Learning');
                                    $this->email->to($student_email);
                                    $this->email->subject('Welcome to Peer Project Learning');
                                    $this->email->message($email_body);
                                    $this->email->send();
                                }
                                else{
                                    if($this->course_model->student_course_registration_checker($student_id,$student_email)==true){
                                        $this->course_model->student_registration($course_id, $student_id);
                                        $id_registration = $this->course_model->get_student_registration_id($course_id, $student_id);
                                        $this->course_model->group_member_register(0, $id_registration[0]->Registration_id);
                                        $email_body = "Hello!<br><br>You have been registered in the course: <span style='text-decoration: underline'>".$course_name."</span>.<br>Available assessments will be notified on the webpage.<br><br><strong>Remember to evaluate your teammates.</strong><br><a href='http://ppl.espol.edu.ec'>Peer Project Learning</a>";
                                        $this->email->from('ppl@espol.edu.ec', 'Peer Project Learning');
                                        $this->email->to($student_email);
                                        $this->email->subject('New Course');
                                        $this->email->message($email_body);
                                        $this->email->send();
                                    }
                                    else{
                                        $student_unregistered++;
                                    }
                                }

                            }
                            else{
                                $student_unregistered++;
                            }
                        }
                        else{
                            $student_unregistered++;
                        }
                    } else {
                        if(count($fileop)>=4 && !empty($fileop[3])){
                            $req_counter = 0;
                            for($i = 1; $i < (count($fileop)+1) ; $i++){
                                if($req_counter!=5 && !empty($fileop[$i-1])){
                                    if(strcasecmp($fileop[$i-1],"id")==0 && $req_data[0]==0){
                                        $req_data[0]=$i;
                                        $req_counter++;
                                    }
                                    elseif(strcasecmp($fileop[$i-1],"lname")==0 && $req_data[1]==0){
                                        $req_data[1]=$i;
                                        $req_counter++;
                                    }
                                    elseif(strcasecmp($fileop[$i-1],"fname")==0 && $req_data[2]==0){
                                        $req_data[2]=$i;
                                        $req_counter++;
                                    }
                                    elseif((strcasecmp($fileop[$i-1],"email")==0 || strcasecmp($fileop[$i-1],"e-mail")==0) && $req_data[3]==0){
                                        $req_data[3]=$i;
                                        $req_counter++;
                                    }
                                }
                            }
                            if($req_counter == 4){
                                $this->course_model->course_register(strtoupper($course_id), $course_name,$this->session->userdata('user_id'));
                                $data_flag = 1;
                            }
                        }
                    }
                }
                if($data_flag == 0)
                    echo "<script> alert('Course not registered, make sure you follow the List Model format as indicated'); window.location.href='".base_url("index.php/admin")."';</script>";
                else{
                    if($student_unregistered==0){
                        echo "<script> alert('Your course have been registered successfully'); window.location.href='".base_url("index.php/admin")."';</script>";
                    }
                    else{
                        echo "<script type='text/javascript'>alert('Your course have been registered successfully, however a student couldn\'t be registered. Please check for student\'s blank fields, invalid email or in the worst case there is already an student with the same registration id or email.'); window.location.href='".base_url("index.php/admin")."';</script>";
                    }
                }
            }
            else{
                echo "<script> alert('There is already a Course with the same identifier'); window.location.href='".base_url("index.php/course/create")."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }

    }
    public function student_registration($course_id = null){
        if($_POST!=null && $course_id!=null && $this->session->userdata('user')=='teacher'){
            $this->load->model('course_model');
            $this->load->helper('string');
            $st_registration = $_POST['st_reg'];
            $student_email = $_POST['email'];
            $registration_flag = 0;
            $course = $this->course_model->getCourse_byId($course_id);
            $course_name = $course[0]->Course_name;
            $this->load->library('email');
            if ($this->course_model->student_checker($st_registration, $student_email)== false) {
                $student_names = $_POST['names'];
                $student_family_names = $_POST['surnames'];
                $password = random_string('alnum', 25);
                $password_email = $password;
                $password = sha1($password);
                $this->course_model->student_register($st_registration, $student_names, $student_family_names, $student_email, $password);
                $this->course_model->student_registration($course_id, $st_registration);
                $id_registration = $this->course_model->get_student_registration_id($course_id, $st_registration);
                $this->course_model->group_member_register(0, $id_registration[0]->Registration_id);
                $email_body = "<!DOCTYPE html><html><body><p>You have been registered in Peer Project Learning (PPL) website.</p><p>Additionally, you are registered in the course: <strong>".$course_name."</strong></p><p>Available assessments will be notified on the webpage.</p><p>Your account information is:</p><p><strong>Registration ID: </strong>".$st_registration."</p><p><strong>Username: </strong>".$student_email."</p><p><strong>Password: </strong>".$password_email."</p><p>P.S. We are still in beta, any bugs report to ppl@espol.edu.ec</p><p>Hope you log in soon!</p><br><a href='http://ppl.espol.edu.ec'>Peer Project Learning</a></body></html>";
                $this->email->from('ppl@espol.edu.ec', 'Peer Project Learning');
                $this->email->to($student_email);
                $this->email->subject('Welcome to Peer Project Learning');
                $this->email->message($email_body);
                $this->email->send();
            }
            else{
                if($this->course_model->student_course_registration_checker($st_registration,$student_email)==true){
                    $this->course_model->student_registration($course_id, $st_registration);
                    $id_registration = $this->course_model->get_student_registration_id($course_id, $st_registration);
                    $this->course_model->group_member_register(0, $id_registration[0]->Registration_id);
                    $email_body = "Hello!<br><br>You have been registered in the course: <span style='text-decoration: underline'>".$course_name."</span>.<br>Available assessments will be notified on the webpage.<br><br><strong>Remember to evaluate your teammates.</strong><br><a href='http://ppl.espol.edu.ec'>Peer Project Learning</a>";
                    $this->email->from('ppl@espol.edu.ec', 'Peer Project Learning');
                    $this->email->to($student_email);
                    $this->email->subject('New Course');
                    $this->email->message($email_body);
                    $this->email->send();
                }
                else{
                    $registration_flag = 1;
                }
            }
            if($registration_flag == 0){
                echo "<script> alert('Student added successfully'); window.location.href='".base_url("index.php/admin/index/".$course_id)."';</script>";
            }
            else{
                echo "<script> alert('Student couldn\'t be added, there is already a student registered with that registration id or email'); window.location.href='".base_url("index.php/admin/index/".$course_id)."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }

    public function student_remove($course_id=null){
        if($_POST!=null && $course_id!=null && $this->session->userdata('user')=='teacher'){
            $this->load->model('course_model');
            $st_registration = $_POST['st_reg'];
            if($this->course_model->student_registration_checker($st_registration,$course_id) == true){
                $id_registration = $this->course_model->get_student_registration_id($course_id, $st_registration);
//                $student_evaluation_info = $this->course_model->get_student_evaluation_info($course_id,$st_registration);
//                foreach($student_evaluation_info as $evaluation_info){
//                    $this->course_model->removeEvaluations($evaluation_info->Evaluation_student_id);
//                }
//                $evaluator_Array = $this->course_model->get_evaluator_respondent($course_id,$st_registration);
//                foreach($evaluator_Array as $evaluator){
//                    $this->course_model->removeStudentRespondent($evaluator->Evaluation_student_id,$st_registration);
//                }
                $this->course_model->removeStudent($id_registration[0]->Registration_id);
                echo "<script> alert('Student removed successfully'); window.location.href='".base_url("index.php/admin/index/".$course_id)."';</script>";
            }
            else{
                echo "<script> alert('Student must be registered in the course before proceeding to remove'); window.location.href='".base_url("index.php/admin/index/".$course_id)."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }

    public function modify_groups($course_id = null){
        if($_POST!=null && $course_id!=null && $this->session->userdata('user')=='teacher'){
            $this->load->model('course_model');
            $array = $_POST['students'];
            $course = $this->course_model->getCourse_byId($course_id);
            $course_name = $course[0]->Course_name;
            $max = sizeof($array);
            for($i=0;$i<$max;$i++){
                $id_registration = $this->course_model->get_student_registration_id($course_id, $array[$i]['id']);
                $this->course_model->group_modify($array[$i]['group'],$id_registration[0]->Registration_id);
            }
            /*for($i=0;$i<$max;$i++){
                $student = $this->course_model->getStudent_by_id($array[$i]['id']);
                $registration = $this->course_model->get_student_registration_id($course_id,$array[$i]['id']);
                $group = $this->course_model->get_student_group($registration[0]->Registration_id);
                $group_members = $this->course_model->get_student_by_group($course_id,$group[0]->Group_number);
                $teammates = array();
                foreach($group_members as $member){
                    if($member->Registration_number != $array[$i]['id'])
                        array_push($teammates, $member->Names." ".$member->Surnames);
                }
            }*/
            echo "<script> alert('Groups modified successfully'); window.location.href='".base_url('index.php/admin/index/'.$course_id)."';</script>";
        }
        else{
            echo "<script>window.location.href='".base_url()."';</script>";
        }
    }
}
