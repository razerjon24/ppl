<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function management(){
        $this->load->view('evaluation_format');
    }
}