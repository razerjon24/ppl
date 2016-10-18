<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    function __construct() {
        parent::__construct();}
    public function index($courseID = null)
    {
        if($this->session->userdata('user')=='teacher'){
            $this->load->model('course_model');
            $instructor_name = $this->session->userdata('user_name');
            $courses_validator = $this->course_model->courseValidator($courseID,$this->session->userdata('user_id'));
            $this->data['instructor_name'] = $instructor_name;
            $this->data['courseID'] = $courseID;
            $this->data['courses'] = $this->course_model->getCourses($this->session->userdata('user_id'));
            $this->data['courseInfo'] = $this->course_model->getCourse_byId($courseID);
            if($courseID != null){
                if($courses_validator)
                    $this->data['groups']= $this->course_model->get_student_groups($courseID);
                else{
                    $this->load->view('index.html');
                    return 0;
                }
            }
            $this->load->view('admin_head',$this->data);
            $this->load->view('admin_index', $this->data);
            $this->load->view('home_footer');
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }
}