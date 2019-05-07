<?php

/**
 *
 */
class Home extends CI_Controller
{

	function __construct()
	{
		 parent::__construct();
	}


	function index(){

		// load view home
		$this->load->view('master', array('page' =>'page/home'));

	}


}

?>
