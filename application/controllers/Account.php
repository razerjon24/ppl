<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }

    public function verify()
    {
        $this->load->model('account_model');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $type = $this->input->post('type');
        //if($this->account_model->verify_Email_Teacher($email)){
        if($type == "instructor"){
            //$password_admin = password_hash("fisicacespol2015", PASSWORD_BCRYPT);
            //$ispassword = password_verify($password,$password_admin);
	        //$password_admin = password_hash("fisicab2016", PASSWORD_BCRYPT);
            if($email == "fisicac@espol.edu.ec" || $email == "fisicab@espol.edu.ec"){
                if($email == "fisicac@espol.edu.ec" && $password != "fisicacespol2015"){
                    echo "<script> alert('Wrong Password'); window.location.href='".base_url('index.php')."';</script>";
                }
                elseif($email == "fisicab@espol.edu.ec" && $password != "fisicab2016"){
                    echo "<script> alert('Wrong Password'); window.location.href='".base_url('index.php')."';</script>";
                }
                $teacher = $this->account_model->verify_Teacher_Account($email,$password);
                $this->session->set_userdata('user', 'teacher');
                $this->session->set_userdata('user_id', $teacher->Teacher_id);
                $this->session->set_userdata('user_name',ucwords(strtolower($teacher->Names." ".$teacher->Surnames)));
                echo "<script> window.location.href='".base_url('index.php/admin')."';</script>";
            }
            else{
                echo "<script> alert('Sorry, student login is allowed at the moment'); window.location.href='".base_url('index.php')."';</script>";
            }
        }
        elseif($type == "student"){
            if($this->account_model->verify_Email_Student($email)){
                $password = sha1($password);
                $student = $this->account_model->verify_Student_Account($email,$password);
                if(!empty($student)){
                    $this->session->set_userdata('user', 'student');
                    $this->session->set_userdata('user_id', $student->Registration_number);
                    $this->session->set_userdata('user_name',ucwords(strtolower($student->Names." ".$student->Surnames)));
                    echo "<script> window.location.href='".base_url('index.php/student')."';</script>";
                }
                else
                    echo "<script> alert('Wrong password'); window.location.href='".base_url('index.php')."';</script>";
                
            }
            else
                echo '<script>alert("Invalid User");window.location.href = "'.base_url("index.php").'";</script>';
        }
    }

    public function testmail()
    {
        $email = 'jonedmen@espol.edu.ec';

        $this->load->library('email');

        $fromEmail = 'ppl@espol.edu.ec';
        $fromName = 'ppl';
        $this->email->from($fromEmail, $fromName);
        $this->email->to($email);
        $message = "<!DOCTYPE html><html><body><p>Hola test</p></body></html>";
        $this->email->subject('test');
        $this->email->message($message);

        $this->email->send();
        redirect(base_url('index.php'));
    }
    public function register_teacher(){
        if($_POST){
            $this->load->model('account_model');
            $this->load->library('email');
            $this->load->helper('email');
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_email = $password;
            $password = sha1($password);
            if(!($this->account_model->verify_Email_Teacher($email))){
                $this->account_model->register_Teacher_Account($fname,$lname,$email,$password);
                $teacher = $this->account_model->verify_Teacher_Account($email,$password);
                $this->session->set_userdata('user', 'teacher');
                $this->session->set_userdata('user_id', $teacher->Teacher_id);
                $this->session->set_userdata('user_name',ucwords(strtolower($teacher->Names." ".$teacher->Surnames)));
                $email_body = "Hello!<br><br>Thanks for joining (PPL) website as an instructor!<br><br>Your account information is:<br><br><strong>Username: </strong>".$email."<br><strong>Password: </strong>".$password_email."<br><br>You can start creating courses now!<br>http://ppl.espol.edu.ec";
                $this->email->from('ppl@espol.edu.ec', 'Peer Project Learning');
                $this->email->to($email);
                $this->email->subject('Welcome to PPL');
                $this->email->message($email_body);
                $this->email->send();
                redirect('admin');
            }
            else
                echo "<script> alert('User email is already registered');window.location.href='".base_url("index.php")."';</script>";
        }
        else
            $this->load->view('index.html');
    }

    public function register_student(){

        $this->load->model('account_model');
        $this->load->library('email');
        $this->load->helper('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $fname = $this->input->post('reg-firstname');
        $lname = $this->input->post('reg-lastname');
        $email = $this->input->post('reg-email');
        $password = $this->input->post('reg-password');
        $password_email = $password;
        $password = password_hash($password, PASSWORD_BCRYPT);
        $university = $this->input->post('reg-university');
        if(!($this->account_model->verify_Email_Teacher($email))){
            $this->account_model->register_Teacher_Account($fname,$lname,$email,$password);
            $teacher = $this->account_model->verify_Teacher_Account($email,$password);
            $this->session->set_userdata('user', 'teacher');
            $this->session->set_userdata('user_id', $teacher->Teacher_id);
            $this->session->set_userdata('user_name',ucwords(strtolower($teacher->Names." ".$teacher->Surnames)));
            $email_body = "Thanks for joining (PPL) website as an instructor!<br><br>Your account information is:<br><br><strong>Username: </strong>".$email."<br><strong>Password: </strong>".$password_email."<br><br>http://ppl.espol.edu.ec";
            $this->email->from('ppl@espol.edu.ec', 'Peer Project Learning');
            $this->email->to($email);
            $this->email->subject('Welcome to PPL');
            $this->email->message($email_body);
            $this->email->send();
            redirect('admin');
        }
        else
            echo "<script> alert('User email is already registered');window.location.href='".base_url("index.php")."';</script>";


    }

    public function password(){
        if($_POST){
            $this->load->library('email');
            $this->load->model('course_model');
            $old_pass = $_POST['old_pass'];
            $old_pass = sha1($old_pass);
            $new_pass = $_POST['new_pass'];
            $pass_email = $new_pass;
            $new_pass = sha1($new_pass);
            if($this->session->userdata('user')=='student'){
                $student = $this->course_model->getStudent_by_id($this->session->userdata('user_id'));
                if($student[0]->Password == $old_pass){
                    $this->course_model->update_student_password($this->session->userdata('user_id'),$new_pass);
                    $email_body = "Hello!<br><br>You have changed your password correctly.<br><br>Your new account information is:<br><br><strong>Username: </strong>".$student[0]->Email."<br><strong>Password: </strong>".$pass_email."<br><br>http://ppl.espol.edu.ec";
                    $this->email->from('ppl@espol.edu.ec', 'ppl');
                    $this->email->to($student[0]->Email);
                    $this->email->subject('New Password');
                    $this->email->message($email_body);
                    $this->email->send();
                    echo "<script> alert('Your password has been changed');window.location.href='".base_url("index.php/student")."';</script>";
                }
                else{
                    echo "<script> alert('Wrong password, please make sure your old password is well typed');window.location.href='".base_url("index.php/student")."';</script>";
                }

            }
            elseif($this->session->userdata('user')=='teacher'){
                $instructor = $this->course_model->getInstructor_by_id($this->session->userdata('user_id'));
                if($instructor[0]->Password == $old_pass){
                    $this->course_model->update_instructor_password($this->session->userdata('user_id'),$new_pass);
                    $email_body = "Hello!<br><br>You have changed your password correctly.<br><br>Your new account information is:<br><br><strong>Username: </strong>".$instructor[0]->Email."<br><strong>Password: </strong>".$pass_email."<br><br>http://ppl.espol.edu.ec";
                    $this->email->from('ppl@espol.edu.ec', 'ppl');
                    $this->email->to($instructor[0]->Email);
                    $this->email->subject('New Password');
                    $this->email->message($email_body);
                    $this->email->send();
                    echo "<script> alert('Your password has been changed');window.location.href='".base_url("index.php/admin")."';</script>";
                }
                else{
                    echo "<script> alert('Wrong password, please make sure your old password is well typed');window.location.href='".base_url("index.php/admin")."';</script>";
                }
            }
        }
        else{
            $this->load->view('index.html');
        }
    }

    /**
     *
     */
    public function forgot(){
        if($_POST){
            $this->load->library('email');
            $this->load->helper('email');
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            if(count($_POST)>1){
                $this->load->model('account_model');
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email_body = "Your new account information is:<br><br><strong>Username: </strong>".$username."<br><strong>Password: </strong>".$password."<br><br>http://ppl.espol.edu.ec";
                $this->email->from('ppl@espol.edu.ec', 'ppl');
                $this->email->to($username);
                $this->email->subject('Forgot password PPL');
                $this->email->message($email_body);
                $this->email->send();
                $this->account_model->change_Password_Student_Account($username,$password);
                echo "<script> alert('Your account have been updated!');window.location.href='".base_url("index.php")."';</script>";
            }
            elseif(count($_POST)==1){
                $this->load->model('account_model');
                $this->load->helper('string');
                $username = $_POST['username'];
                $key = random_string('alnum',25);
                $email_body = "Since you have forgot your password, a link to verify your account have been sent to you.<br><br>Link: <a href='http://ppl.espol.edu.ec/index.php/account/forgot?user=$username&key=$key'> http://ppl.espol.edu.ec/index.php/account/forgot?user=".$username."&key=".$key."</a>";
                $this->email->from('ppl@espol.edu.ec', 'Peer Project Learning');
                $this->email->to($username);
                $this->email->subject('Forgot password PPL');
                $this->email->message($email_body);
                $this->email->send();
                $this->account_model->update_Token_Student_Account($username,$key);
                echo "<script> alert('A verification link have been sent to your e-mail!');window.location.href='".base_url("index.php")."';</script>";
            }
        }
        elseif($_GET){
            if($_GET['key'] && $_GET['user']){
                $this->load->model('account_model');
                $key = $_GET['key'];
                $username = $_GET['user'];
                $verified = $this->account_model->verify_Token_Student_Account($username,$key);
                if($verified){
                    $this->data['username']=$username;
                    $this->load->view('home_head');
                    $this->load->view('forgot_password',$this->data);
                    $this->load->view('home_footer');
                }
                else{
                    echo "<script> alert('Sorry, the system couldn\'t recognize you. Please verify your email again!');window.location.href='".base_url("index.php")."';</script>";
                }

            }
        }
        else{
            $this->load->view('home_head');
            $this->load->view('forgot_password');
            $this->load->view('home_footer');
        }
    }
    public function logout(){
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        echo "<script>window.location.href='".base_url("index.php")."';</script>";
    }
}
