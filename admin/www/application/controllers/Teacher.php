<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends MY_Controller {
	private $controller_name = "teacher";
	private $table_name = "teacher";
	private $page_key = 4;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Teacher_Model' , 'teacher');
	}

	public function index()	{
		$this->header_data['page_key'] = $this->page_key;
		$view_data = array();
		$view_data['gender']	= $this->config->item('gender');
		$view_data['groupdata'] = $this->teacher->get_data();
		$view_data['upload_path'] = $this->uploadpath_teacherphoto;
		// $view_data['tg_list']	= $this->teacher->get_tg_list();

		if ($this->session->has_userdata('POST_RESULT_ALARM_MESSAGE')) {
			$view_data['post_result_alarm_message'] = $this->session->userdata('POST_RESULT_ALARM_MESSAGE');
			$this->session->unset_userdata('POST_RESULT_ALARM_MESSAGE');
		}
		

		$this->template->pageview($this->controller_name , $this->header_data , $view_data);
	}

	public function newteacher(){
		$view_data = array();
		$view_data['gender']	= $this->config->item('gender');
		$this->load->view($this->controller_name . '/updaterecord' , $view_data);
	}

	public function insert(){
		if ($this->input->post()) {
			$post_result = $this->teacher->insert_newteacher($this->input->post() , $this->uploadpath_teacherphoto);
			$this->session->set_userdata('POST_RESULT_ALARM_MESSAGE' , $post_result);
		}
		redirect('/' . $this->controller_name);
	}

	public function initpassword(){
		if ($this->input->post()) {
			$t_id = $this->input->post('t_id');
			$cur_teacher_record = $this->teacher->get_data($t_id);
			if (count($cur_teacher_record) > 0) {
				$cur_teacher_record = $cur_teacher_record[0];
				$acc_id = $cur_teacher_record['acc_id'];
				$criteria = array(
					'acc_id' => $acc_id , 
				);
				$update_data = array(
					'user_pass'	=> md5(DEFAULTACCOUNTPASSWORD) , 
				);
				echo json_encode(array('success' => $this->teacher->tb_updatedata('tbl_account' , $criteria , $update_data)));
			}
			else {
				echo json_encode(array('success' => FALSE));
			}			
		}
	}

	public function showitem(){
		if ($this->input->get('t_id')) {
			$t_id = $this->input->get('t_id');
			$data = $this->teacher->get_data($t_id);
			if (count($data) > 0) {
				$view_data = array(
					'itemdata'	=> $data[0] , 
					't_id'		=> $t_id , 
				);
				$view_data['gender']	= $this->config->item('gender');
				$view_data['upload_path'] = $this->uploadpath_teacherphoto;
				$this->load->view($this->controller_name . '/updaterecord' , $view_data);
			}
		}
	}

	public function update(){
		if ($this->input->post()) {
			$update_data = $this->input->post();
			$post_result = $this->teacher->update_teacherdata($update_data , $this->uploadpath_teacherphoto);
			$this->session->set_userdata('POST_RESULT_ALARM_MESSAGE' , $post_result);
		}
		redirect('/' . $this->controller_name);
	}

	public function delete(){
		if ($this->input->post()) {
			$t_id = $this->input->post('t_id');
			$acc_id = $this->input->post('acc_id');
			$criteria = array(
				't_id' => $t_id , 
				'acc_id' => $acc_id , 
			);
			
			echo json_encode(array(
				'success' => $this->teacher->delete_teacherdata($criteria , $this->uploadpath_teacherphoto)
			));
		}
	}
}
