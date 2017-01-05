<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['contact'] = True;
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
        $this->load->view('contact');
        $this->load->view('home_footer');
    }

    public function send()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

        $this->load->library('email');

        $fromEmail = 'ppl@espol.edu.ec';
        $this->email->from($fromEmail,(empty($name)? 'ppl':$name));
        $this->email->to($fromEmail);
        $body = '<p>From: '.(empty($name)? 'ppl':$name).'</p><p>Email: '.$email.'</p><p>'.$message.'</p>';
        $this->email->subject('Support');
        $this->email->message($body);

        $this->email->send();
        redirect(base_url('index.php'));
    }
}