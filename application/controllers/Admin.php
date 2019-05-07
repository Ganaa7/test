<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		 parent::__construct();

		 $this->load->model('trainee_model', 'trainee');

		 $this->load->model('user_model', 'user');
	}

	public function index()
	{

		$this->load->view('master', array('page'=>'admin/index'));
	}

	public function login(){

 		$home = base_url('admin/index');

 		// $this->user_m->loggedin() == TRUE || redirect($home);

 		$rules = $this->user->rules;

 		$this->form_validation->set_rules($rules);

 		if ($this->form_validation->run() == TRUE) {

 					// We can login and redirect
 					if ($this->user->login() == TRUE) {

 							if ( $this->input->get_post('remember_me') ) {

 										 $remember_me= array(
 												 'name'   => 'remember2',
 												 'value'  => 'test',
 												 'expire' => (86400 * 7),
 												 'secure' => TRUE
 										 );

 									$this->input->set_cookie($remember_me);

 									setcookie ( "username", $this->input->get_post('username'), time () + (86400 * 7) );

 									setcookie ( "password", $this->input->get_post('password'), time () + (86400 * 7) );

 									setcookie ( "remember_me", $_POST ['remember_me'], time () + (86400 * 7) );

 							}

 							// print_r($this->session->userdata('role'));

 				 redirect($home);
 							 // echo "here";
 			}
 			else {
 				$this->session->set_flashdata('error', 'Уучлаарай, Таны нэвтрэх нэр эсвэл нууц үг буруу байна!');

 							// redirect('user/login');
 			}
 		}else{

 			$this->session->set_flashdata('error', validation_errors ( '', '<br>' ));
 		}


 			$this->load->view('page/login');
 	}

	function logout()
	{
			$this->user->logout();
	}

	function ajax_list()
	{
			$list = $this->trainee->get_datatables();
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $estudiante) {
					$no++;
					$row = array();
					$row[] = '<input type="checkbox" class="data-check" value="'.$estudiante->id.'" onclick="showBottomDelete()"/>';
					$row[] = $estudiante->firstname;
					$row[] = $estudiante->lastname;
					$row[] = $estudiante->register;
					$row[] = $estudiante->test_given;
					$row[] = $estudiante->test_score;
					$row[] = $estudiante->given_at;
					//add html for action
					$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="editEstudiante('."'".$estudiante->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
								<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="deleteEstudiante('."'".$estudiante->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
					$data[] = $row;
			}
			$output = array(
											"draw" => $_POST['draw'],
											"recordsTotal" => $this->trainee->count_all(),
											"recordsFiltered" => $this->trainee->count_filtered(),
											"data" => $data,
							);
			//output to json format
			echo json_encode($output);
	}


	function ajax_add()
	{
			$this->trainee->_validate();

			$data = $this->trainee->array_from_post(array('firstname', 'lastname', 'register'));

			$data['created_at'] =date('Y-m-d H:i:s');

			if ($id = $this->trainee->insert($data, TRUE)){

			   $this->trainee->insert($data, TRUE);

				 echo json_encode(array("status" => TRUE));

			}else{

					 echo json_encode(array("status" => FALSE));
			}

	}

	function ajax_update()
	{
			$this->trainee->_validate();

			$data = $this->trainee->array_from_post(array('firstname', 'lastname', 'register'));

			$data['created_at'] =date('Y-m-d H:i:s');

			$id = $this->input->post('trainee_id');

			$this->db->update('trainee', $data, "id =$id");

			echo json_encode(array("status" => TRUE));
	}

	function ajax_edit($id)
  {
      $data = $this->trainee->get($id);
      echo json_encode($data);
  }

   function ajax_delete($id)
  {

			$delete_id = $this->trainee->delete($id);

      echo json_encode(array("status" => TRUE));

  }



}
