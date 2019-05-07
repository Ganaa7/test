<?php

/**
 *
 */
class User extends CI_Controller
{

	function __construct()
	{
		 parent::__construct();

		 $this->load->model('user_model', 'user');
	}





	// herev tuhain users burguulesn bol haruuulna
	function index(){

		// load view home
		$this->load->view('master', array('page' =>'page/home'));

	}

	// herev tuhain users burguulesn bol haruuulna


	function register(){

		// load view home
			$this->load->view('master', array('page' =>'page/register'));
	}

	function generate(){

		echo $this->user->hash('secret');
	}


}

?>
