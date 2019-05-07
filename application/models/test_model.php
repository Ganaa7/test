<?php

class Test_Model extends MY_Model
{
	protected $_table = 'test';

	protected $_order_by = 'test';

	// public $belongs_to = array( 'section' );
	private $fields  = array('test', 'job_type_id', 'created_at');

  public $primary_key = 'id';

	public $validate  = array(

		 array(

			'field' => 'test',

			'label' => 'Сорилын нэр',

			'rules' => 'trim|required'

		),
		array(

			'field' => 'job_type_id',

			'label' => 'Ажлын нэршил',

			'rules' => 'trim|required'

		),

		 array(

			'field' => 'created_at',

			'label' => 'Огноо',

			'rules' => 'required|exact_length[10]|is_unique[trainee.register]'
		),

		 array(

			'field' => 'created_by',

			'label' => 'Үүсгэсэн',

			'rules' => 'trim|required'

		)

	);

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
			 $this->db->select("id, test, job_type_id, created_at");

			 $this->db->from($this->_table);

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
					 $order = $this->_order_by;
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

			 if($this->input->post('test') == '')
			 {
					 $data['inputerror'][] = 'test';
					 $data['error_string'][] = 'Тест утга шаардлагатай';
					 $data['status'] = FALSE;
			 }else{

				 if(!$this->_validate_string($this->input->post('test')))
				 {
					 $data['inputerror'][] = 'test';
					 $data['error_string'][] = 'Утга шаардлагатай';
					 $data['status'] = FALSE;
				 }

			 }

			 if(!$this->input->post('job_type_id'))
			 {
					 $data['inputerror'][] = 'job_type_id';
					 $data['error_string'][] = 'Ажлын байр утга шаардлагатай';
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

	  function lqry(){

			  echo $this->db->last_query();

		}


}
