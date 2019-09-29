<?php defined('BASEPATH') OR exit('No direct script access allowed');

class StudentGroup extends MY_Controller {
	private $controller_name = "studentgroup";
	private $table_name = "studentgroup";
	private $page_key = 1;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Studentgroup_Model' , 'studentgroup');
	}

	public function index()	{
		$this->header_data['page_key'] = $this->page_key;
		$view_data = array();
		$view_data['groupdata'] = $this->studentgroup->get_data();
		$view_data['teacherlist'] = $this->studentgroup->get_teacherlist();
		$this->template->pageview($this->controller_name , $this->header_data , $view_data);
	}

	public function showitem(){
		if ($this->input->get('sg_id')) {
			$sg_id = $this->input->get('sg_id');
			$data = $this->studentgroup->get_data($sg_id);
			if (count($data) > 0) {
				$view_data = array(
					'itemdata'	=> $data[0] , 
					'sg_id'		=> $sg_id , 
					'teacherlist'	=> $this->studentgroup->get_teacherlist() , 
				);
				$this->load->view($this->controller_name . '/updaterecord' , $view_data);
			}
		}
	}

	public function insert(){
		if ($this->input->post()) {
			$insert_data = array(
				'sg_number'	=> $this->input->post('sg_number') , 
				'sg_label'	=> $this->input->post('sg_label') , 
				't_id'	=> $this->input->post('t_id') , 
			);	
			$this->studentgroup->tb_insertdata($this->table_name , $insert_data);
		}
		redirect('/' . $this->controller_name);
	}

	public function delete(){
		if ($this->input->post()) {
			$sg_id = $this->input->post('sg_id');
			$criteria = array(
				'sg_id' => $sg_id , 
			);
			echo json_encode(array('success' => $this->studentgroup->tb_deletedata($this->table_name , $criteria)));
		}
	}

	public function update(){
		if ($this->input->post()) {
			$sg_id = $this->input->post('sg_id');
			$criteria = array(
				'sg_id' => $sg_id , 
			);
			$update_data = array(
				'sg_number'	=> $this->input->post('sg_number') , 
				'sg_label'	=> $this->input->post('sg_label') , 
				't_id'	=> $this->input->post('t_id') , 
			);
			$this->studentgroup->tb_updatedata($this->table_name , $criteria , $update_data);
		}
		redirect('/' . $this->controller_name);
	}
}
