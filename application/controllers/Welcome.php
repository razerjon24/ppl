<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$this->load->view('home_head');
		$this->load->view('home');
		$this->load->view('home_footer');
	}
}