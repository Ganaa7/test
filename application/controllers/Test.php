<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/test/application/libraries/php-excel-reader/excel_reader2.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/test/application/libraries/SpreadsheetReader.php');

class Test extends CI_Controller {

	function __construct()
	{
		 parent::__construct();

		 $this->load->model('test_model', 'test');

		 $this->load->model('answer_model', 'answer');

		 $this->load->model('quiz_model', 'quiz');

	}

	public function index()
	{

		// $data['job_type'] = $this->job_type->dropdown('id', 'type');

		$data['page']='test/index';

		$this->load->view('master', $data);
	}

		public function import()
		{
			   echo $this->input->get_post('job_type_id');

				if($this->input->get_post('job_type_id')){

						$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

						if(in_array($_FILES["file"]["type"],$allowedFileType)){

								//echo "TEST id is:".mysql_insert_id();
					        $targetPath = '/public/uploads/'.$_FILES['file']['name'];

					        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

					        $job_type_id = $this->input->post('job_type_id', true);

									$last_test_id = $this->test->insert(array(

														'test' =>'test1',
														'job_type_id' => $job_type_id,
														'create_at' =>'NOW()'
													));

					        $Reader = new SpreadsheetReader($targetPath);

					        $sheetCount = count($Reader->sheets());

					        for($i=0;$i<$sheetCount;$i++)
					        {

					            $Reader->ChangeSheet($i);

					          foreach ($Reader as $Row)
					            {

					                $quiz = "";
					                if(isset($Row[0])) {
					                    $quiz = $Row[0];
					                }
					                if(isset($Row[6])) {
					                    $diff = $Row[6];
					                }
					                $right_answer_num = "";
					                if(isset($Row[5])) {
					                    $right_answer_num = $Row[5];
					                }

													$last_quiz_id = $this->quiz->insert( array(
															'test_id'=>$last_test_id,

															'diff' => $diff,

															'quiz' => $quiz,

															'right_answer_num' => $right_answer_num
														), FALSE
													);

					                for ($x = 1; $x <= 4; $x++)
													{
					                    $a = "";

					                    if(isset($Row[$x])) {

																$answer_id = $this->answer->insert( array(		'quiz_id'=>$last_quiz_id,

																																'answer_num' => $x,

																																'answer' => $a
																														), FALSE	);
					                    }
					     						}

					                if (! empty($answer_id)) {
					                    $type = "success";
					                    $message = "Excel Data Imported into the Database";
					                    }
					                else
					               {
					                    $type = "error";
					                    $message = "Problem in Importing Excel Data";
					               }

					             }
					        }

					  }
					  else
					  {
					        $type = "error";
					        $message = "Invalid File Type. Upload Excel File.";
					  }


				}
			  echo $type;
				echo "<br />";
				echo $message;
		}

		function ajax_list()
		{
				$list = $this->test->get_datatables();
				$data = array();
				$no = $_POST['start'];
				foreach ($list as $estudiante) {
						$no++;
						$row = array();
						$row[] = '<input type="checkbox" class="data-check" value="'.$estudiante->id.'" onclick="showBottomDelete()"/>';
						$row[] = $estudiante->test;
						// $row[] = $estudiante->job_type_id;
						$row[] = $estudiante->created_at;
						//add html for action
						$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="editEstudiante('."'".$estudiante->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Цааш..</a>
									<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="deleteEstudiante('."'".$estudiante->id."'".')"><i class="glyphicon glyphicon-trash"></i> Устгах</a>';
						$data[] = $row;
				}

				$output = array(
												"draw" => $_POST['draw'],
												"recordsTotal" => $this->test->count_all(),
												"recordsFiltered" => $this->test->count_filtered(),
												"data" => $data,
								);
				//output to json format


				echo json_encode($output);
		}


		function ajax_add()
		{
				$this->test->_validate();

				$data = $this->test->array_from_post(array('firstname', 'lastname', 'register', 'active'));

				$data['created_at'] =date('Y-m-d H:i:s');

				if ($id = $this->test->insert($data, TRUE)){

				   $this->test->insert($data, TRUE);

					 echo json_encode(array("status" => TRUE));

				}else{

						 echo json_encode(array("status" => FALSE));
				}

		}

		function ajax_update()
		{
				$this->test->_validate();

				$data = $this->test->array_from_post(array('firstname', 'lastname', 'register', 'active'));

				$data['created_at'] =date('Y-m-d H:i:s');

				$id = $this->input->post('test_id');

				$this->db->update('test', $data, "id =$id");

				echo json_encode(array("status" => TRUE));
		}

		function ajax_edit($id)
	  {
	      $data = $this->test->get($id);
	      echo json_encode($data);
	  }

	   function ajax_delete($id)
	  {

				$delete_id = $this->test->delete($id);

	      echo json_encode(array("status" => TRUE));

	  }



}
