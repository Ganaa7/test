<?php

/**
 *
 */
class Trainee extends CI_Controller
{

	protected $trainee;

	function __construct()
	{
		 parent::__construct();

		 $this->load->model ( 'trainee_model' );

		 $this->trainee = new trainee_model();

		 $this->load->model('test_model', 'test');

	}


	// herev tuhain users burguulesn bol haruuulna
	function index($id){

		//check register check
			$data['page'] = 'page/trainee';

		// load view trainee
		if($trainee = $this->trainee->get($id)){

			$data['trainee'] = $trainee;




		}else{

			   $this->session->set_flashdata('message',
           	array (
              'status' =>'error',
              'message' =>'Таны мэдээлэл бүртгэгдээгүй тул та мэдээлэлээ оруулна уу!'
           ));



		}

			$this->load->view('master', $data);


	}

	// herev tuhain users burguulesn bol haruuulna
	function register(){

		 $data['test'] = $this->test->dropdown('id', 'test');

		 $data['page'] = 'page/register';

		 // load view home
		 $this->load->view('master', $data);
	}


	function create(){

		//validation here
		unset($this->trainee->validate[3]);
		unset($this->trainee->validate[4]);
		unset($this->trainee->validate[5]);
		unset($this->trainee->validate[6]);
		unset($this->trainee->validate[7]);

		if($this->trainee->validate($this->trainee->validate)){

			   $data = $this->trainee->array_from_post(array('firstname', 'lastname', 'register'));

		        $data['created_at'] =date('Y-m-d H:i:s');

            if ($id = $this->trainee->insert($data, TRUE)){


              $this->session->set_flashdata('message',
	              	array (
	                    'status' => 'success',
	                    'message' => 'Амжилттай хадгаллаа'
	              		)
	            );

              redirect('/trainee/index/'.$id);

            }else{

                  $this->session->set_flashdata('message',
                		array (
	                    'status' => 'failed',
	                    'message' => 'Өгөгдлийн санд хадгалахад алдаа гарлаа'
	              		)
                	);

            }

		}
		else{



           $this->session->set_flashdata('message',
           	array (
              'status' =>'error',
              'message' => validation_errors ( '', '<br>' )
           ));



      }
      	$data['page'] = 'page/register';

      	redirect('/trainee/register/');

 			// $this->load->view('master', $data);


	}


	function get(){

	}

	function edit(){

	}

	function delete(){

	}


}

?>
