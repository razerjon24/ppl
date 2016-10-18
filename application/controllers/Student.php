<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
    function __construct() {
        parent::__construct();}
    public function index($courseID = null)
    {
        if($this->session->userdata('user')=='student'){
            $this->load->model('student_model');
            $this->load->model('course_model');
            $student_name = $this->session->userdata('user_name');
            $courses_validator = $this->course_model->courseValidatorStudent($courseID,$this->session->userdata('user_id'));
            $this->data['student_name'] = $student_name;
            $this->data['courseID'] = $courseID;
            $this->data['courses'] = $this->course_model->getCourses_by_student($this->session->userdata('user_id'));
            $this->data['courseInfo'] = $this->course_model->getCourse_byId($courseID);
            if($courseID != null){
                if($courses_validator){
                    $evaluations = $this->student_model->get_student_evaluations($courseID, $this->session->userdata('user_id'));
                    $this->data['evaluations']= $evaluations;}
                else{
                    echo "<script>window.location.href='".base_url("index.php/student")."';</script>";
                    return 0;
                }
            }
            $this->load->view('student_head', $this->data);
            $this->load->view('student_index', $this->data);
            $this->load->view('home_footer');
        }
        else{
            echo "<script>window.location.href='".base_url()."';</script>";
        }
    }
}