<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Export extends CI_Controller {
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

                $this->load->view('export_excel',$this->data);

            }
            else{
                echo "<script>window.location.href='".base_url("index.php/admin")."';</script>";
            }
        }
        else{
            echo "<script>window.location.href='".base_url("index.php")."';</script>";
        }
    }



}