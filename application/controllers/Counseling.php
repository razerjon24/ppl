<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counseling extends CI_Controller{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['counseling'] = True;
        if($this->session->userdata('user')=='teacher'){
            $instructor_name = $this->session->userdata('user_name');
            $data['instructor_name'] = $instructor_name;
            $this->load->view('admin_head',$data);
        }
        elseif($this->session->userdata('user')=='student'){
            $student_name = $this->session->userdata('user_name');
            $data['student_name'] = $student_name;
            $this->load->view('student_head',$data);
        }
        else{
            $this->load->view('home_head',$data);
        }
        $this->load->view('counseling_schedule');
        $this->load->view('home_footer');
    }

}