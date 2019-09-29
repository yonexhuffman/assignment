<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends MY_Controller {
	private $controller_name = "student";
	private $table_name = "student";
	private $page_key = 2;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Student_Model' , 'student');
	}

	public function index()	{
		$this->header_data['page_key'] = $this->page_key;
		$view_data = array();
		$view_data['gender']	= $this->config->item('gender');
		$view_data['groupdata'] = $this->student->get_data();
		$view_data['upload_path'] = $this->uploadpath_studentphoto;
		$view_data['sg_list']	= $this->student->get_sg_list();

		if ($this->session->has_userdata('POST_RESULT_ALARM_MESSAGE')) {
			$view_data['post_result_alarm_message'] = $this->session->userdata('POST_RESULT_ALARM_MESSAGE');
			$this->session->unset_userdata('POST_RESULT_ALARM_MESSAGE');
		}
		

		$this->template->pageview($this->controller_name , $this->header_data , $view_data);
	}

	public function newstudent(){
		$view_data = array();
		$view_data['gender']	= $this->config->item('gender');
		$view_data['sg_list']	= $this->student->get_sg_list();
		$this->load->view($this->controller_name . '/updaterecord' , $view_data);
	}

	public function insert(){
		if ($this->input->post()) {
			$post_result = $this->student->insert_newstudent($this->input->post() , $this->uploadpath_studentphoto);
			$this->session->set_userdata('POST_RESULT_ALARM_MESSAGE' , $post_result);
		}
		redirect('/' . $this->controller_name);
	}

	public function initpassword(){
		if ($this->input->post()) {
			$s_id = $this->input->post('s_id');
			$cur_student_record = $this->student->get_data($s_id);
			if (count($cur_student_record) > 0) {
				$cur_student_record = $cur_student_record[0];
				$acc_id = $cur_student_record['acc_id'];
				$criteria = array(
					'acc_id' => $acc_id , 
				);
				$update_data = array(
					'user_pass'	=> md5(DEFAULTACCOUNTPASSWORD) , 
				);
				echo json_encode(array('success' => $this->student->tb_updatedata('tbl_account' , $criteria , $update_data)));
			}
			else {
				echo json_encode(array('success' => FALSE));
			}			
		}
	}

	public function showitem(){
		if ($this->input->get('s_id')) {
			$s_id = $this->input->get('s_id');
			$data = $this->student->get_data($s_id);
			if (count($data) > 0) {
				$view_data = array(
					'itemdata'	=> $data[0] , 
					's_id'		=> $s_id , 
				);
				$view_data['gender']	= $this->config->item('gender');
				$view_data['sg_list']	= $this->student->get_sg_list();
				$view_data['upload_path'] = $this->uploadpath_studentphoto;
				$view_data['sg_members'] = $this->student->get_sg_student_list($view_data['itemdata']['sg_id']);
				$this->load->view($this->controller_name . '/updaterecord' , $view_data);
			}
		}
	}

	public function update(){
		if ($this->input->post()) {
			$update_data = $this->input->post();
			$post_result = $this->student->update_studentdata($update_data , $this->uploadpath_studentphoto);
			$this->session->set_userdata('POST_RESULT_ALARM_MESSAGE' , $post_result);
		}
		redirect('/' . $this->controller_name);
	}

	public function delete(){
		if ($this->input->post()) {
			$s_id = $this->input->post('s_id');
			$acc_id = $this->input->post('acc_id');
			$criteria = array(
				's_id' => $s_id , 
				'acc_id' => $acc_id , 
			);
			
			echo json_encode(array(
				'success' => $this->student->delete_studentdata($criteria , $this->uploadpath_studentphoto)
			));
		}
	}

	public function get_student_list(){
		if ($this->input->post('sg_id')) {
			echo json_encode($this->student->get_sg_student_list($this->input->post('sg_id')));
		}
	}
}
