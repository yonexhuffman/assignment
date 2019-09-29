<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admininfo extends MY_Controller {
	private $controller_name = "admininfo";
	private $page_key = 5;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admininfo_Model' , 'admininfo');
	}

	public function index()	{
		$this->header_data['page_key'] = $this->page_key;
		$view_data = array();
		$view_data['admindata'] = $this->admininfo->get_data();
		$view_data['gender']	= $this->config->item('gender');
		$this->template->pageview($this->controller_name , $this->header_data , $view_data);
	}

	public function confirmprevpassword(){
		if ($this->input->post()) {
			$result = array();
			$input_data = $this->input->post();

			$cur_pass = $input_data['cur_pass'];
			$prev_user_pass = md5($input_data['prev_user_pass']);
			if ($cur_pass != $prev_user_pass) {
				$result['success'] = FALSE;
			}
			else {
				$result['success'] = TRUE;
			}
			echo json_encode($result);
		}
	}

	public function update(){
		if ($this->input->post()) {
			$input_data = $this->input->post();
			
			$this->admininfo->update_admin($input_data , $this->uploadpath_teacherphoto);
		}
		redirect('/' . $this->controller_name);
	}
}
