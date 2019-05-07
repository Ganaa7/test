<?php

class User_model extends MY_Model
{
	protected $_table = 'users';

	// protected $_order_by = 'name';

	public $belongs_to = array( 'section' );

	public $primary_key = 'id';

	public $rules = array(
		'username' => array(

			'field' => 'email',

			'label' => 'Нэвтрэх нэр',

			'rules' => 'trim|required'

		),

		'password' => array(

			'field' => 'password',

			'label' => 'Нууц үг',

			'rules' => 'trim|required'
		)
	);

	function __construct ()
	{

		parent::__construct();
	}


	public function login ()
	{

		$user = $this->get_by(array(

				'email' => $this->security->xss_clean($this->input->post('email')),

				'password' => $this->hash($this->input->post('password')),

			), TRUE);

		if (count($user)) {

			//get user_position: role'=>$user->role,

			$data = array(

				'username' => $user->username,

				'name' => $user->firstname.' '.$user->lastname,

				'email' => $user->email,

				'user_id' => $user->id,

				'loggedin' => TRUE

			);

			$this->session->set_userdata($data);

			return TRUE;

		}else

		   return FALSE;
	}


	public function logout ()
	{
		$this->session->sess_destroy();
	}

	public function loggedin ()
	{
		return (bool) $this->session->userdata('loggedin');
	}

	public function hash ($string)
	{
		return hash('sha256', $string . config_item('encryption_key'));
	}


	function generator($length, $is_lower) {

	   $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

	   $str = '';

	   $size = strlen ( $chars );

	   for($i = 0; $i < $length; $i ++) {

			$str .= $chars [rand ( 0, $size - 1 )];
	   }

	   return ($is_lower)?  strtolower($str): $str;
	}


}
