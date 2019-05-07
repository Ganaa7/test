<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		if($this->session->userdata('loggedin') == TRUE)
		    
		    $this->load->view('master', array('page'=>'admin/index'));

		else $this->load->view('master', array('page'=>'page/home'));
	}

	public function login(){
		echo "login here";
	}


}
