<?php

class Trainee_Model extends MY_Model
{
	protected $_table = 'trainee';

	protected $_order_by = 'firstname';

	var $order = array('id' => 'desc');

	// public $belongs_to = array( 'section' );
	private $fields  = array('firstname', 'lastname', 'register', 'test_id',  'user_test_id', 'test_given', 'test_score', 'given_at');

  public $primary_key = 'id';

	public $validate  = array(

		 array(

			'field' => 'firstname',

			'label' => 'Овог нэр',

			'rules' => 'trim|required'

		),
		array(

			'field' => 'lastname',

			'label' => 'Нэр',

			'rules' => 'trim|required'

		),

		 array(

			'field' => 'register',

			'label' => 'Регистр',

			'rules' => 'required|exact_length[10]|is_unique[trainee.register]'
		),

		 array(

			'field' => 'test_id',

			'label' => 'Сорил',

			'rules' => 'required'
		),

		 array(

			'field' => 'user_test_id',

			'label' => 'Шалгуулагчийн сорил',

			'rules' => 'required|is_unique[trainee_test.id]'
		),

		 array(

			'field' => 'test_given',

			'label' => 'Сорил өгсөн эсэх',

			'rules' => 'trim|required'

		),
		// 'test_score', 'given_at'
		 array(

			'field' => 'test_score',

			'label' => 'Сорилын оноо',

			'rules' => 'trim|required'

		),
		 array(

			'field' => 'given_at',

			'label' => 'Өгсөн огноо',

			'rules' => 'trim|required'

		)

	);

	// var $column = array('firstname','lastname','register','active'); //set column field database for order and search

	function __construct ()
	{

		parent::__construct();
	}

	function array_from_post($fields){

      $data = array();

      foreach ($fields as $field) {

         $data[$field]=$this->input->post($field);

      }

      return $data;

   }

  private function _get_datatables_query()
	 {
			 $this->db->select("id, firstname, lastname, register, test_given, test_score, given_at");
			 $this->db->from($this->_table);
			 // $this->db->join('job_type', 'trainee.job_type_id = job_type.id');
			 $i = 0;
			 foreach ($this->fields as $item) // loop column
			 {
					 if($_POST['search']['value']) // if datatable send POST for search
					 {
							 if($i===0) // first loop
							 {
									 $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
									 $this->db->like($item, $_POST['search']['value']);
							 }
							 else
							 {
									 $this->db->or_like($item, $_POST['search']['value']);
							 }
							 if(count($this->fields) - 1 == $i) //last loop
									 $this->db->group_end(); //close bracket
					 }
					 $column[$i] = $item; // set column array variable to order processing
					 $i++;
			 }
			 if(isset($_POST['order'])) // here order processing
			 {
					 $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			 }
			 else if(isset($this->order))
			 {
					 $order = $this->order;
					 $this->db->order_by(key($order), $order[key($order)]);
			 }
	 }

	 function get_datatables()
	 {
			 $this->_get_datatables_query();
			 if($_POST['length'] != -1)
			 $this->db->limit($_POST['length'], $_POST['start']);
			 $query = $this->db->get();
			 return $query->result();
	 }

	 function count_filtered()
	 {
			 $this->_get_datatables_query();
			 $query = $this->db->get();
			 return $query->num_rows();
	 }

	  function _validate()
	 {
			 $data = array();
			 $data['error_string'] = array();
			 $data['inputerror'] = array();
			 $data['status'] = TRUE;

			 if($this->input->post('lastname') == '')
			 {
					 $data['inputerror'][] = 'lastname';
					 $data['error_string'][] = 'Нэр утга шаардлагатай';
					 $data['status'] = FALSE;
			 }else{

				 if(!$this->_validate_string($this->input->post('lastname')))
				 {
					 $data['inputerror'][] = 'lastname';
					 $data['error_string'][] = 'Утга шаардлагатай';
					 $data['status'] = FALSE;
				 }

			 }

			 if($this->input->post('firstname') == '')
			 {
					 $data['inputerror'][] = 'firstname';
					 $data['error_string'][] = 'Овог нэр утга шаардлагатай';
					 $data['status'] = FALSE;
			 }else{

				 if(!$this->_validate_string($this->input->post('firstname')))
				 {
					 $data['inputerror'][] = 'firstname';
					 $data['error_string'][] = 'Утга шаардлагатай';
					 $data['status'] = FALSE;
				 }

			 }

			 if($this->input->post('register') == '')
			 {
					 $data['inputerror'][] = 'register';
					 $data['error_string'][] = 'Регистр утга шаардлагатай';
					 $data['status'] = FALSE;
			 }
			  // echo "active".$this->input->post('active');
			 // if(!$this->input->get_post('active'))
			 // {
				// 	 $data['inputerror'][] = 'active';
				// 	 $data['error_string'][] = 'Идэвхи утга шаардлагатай';
				// 	 $data['status'] = FALSE;
			 // }

			 if($data['status'] === FALSE)
			 {
					 echo json_encode($data);
					 exit();
			 }
	 }

	 private function _validate_string($string)
	 {
			 $allowed = "АБВГДЕЁЖЗИКЛМНОӨПРСТУҮФХЦЧШЩЪЫЬЭЮЯабвгдеёжзиклмноөпрстуүфхцчшщъыьэюя";
			 for ($i=0; $i<strlen($string); $i++)
			 {
					 if (strpos($allowed, substr($string,$i,1))===FALSE)
					 {
							 return FALSE;
					 }
			 }

			return TRUE;
	 }


}
