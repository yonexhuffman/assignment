<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $uploadpath_studentphoto = "./uploads/photo/student/";
	public $uploadpath_teacherphoto = "./uploads/photo/teacher/";
	
	public $uploadpath_assfile = "./uploads/assignment/problem/";
	public $uploadpath_answerfile = "./uploads/assignment/answer/";
	public $uploadpath_referencefile = "./uploads/assignment/reference/";
	public $header_data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MY_Model' , 'basemodel');
		if (!$this->session->has_userdata('LOGGEDIN_USER_DATA')) {
			redirect('/login');
		}		
		else {
			$this->config->load('frontend_config');			
			$this->header_data['cur_userdata']		= $this->basemodel->getLoggedUserData();
			$config_menu = $this->config->item('menu');
			if ($this->header_data['cur_userdata']['user_role'] == 'TEA') {
				$this->header_data['menu'] = $config_menu['TEA'];
				$this->header_data['user_photo_path'] = $this->uploadpath_teacherphoto;
			}
			else if ($this->header_data['cur_userdata']['user_role'] == 'STU') {
				$this->header_data['menu'] = $config_menu['STU'];
				$this->header_data['user_photo_path'] = $this->uploadpath_studentphoto;
			}
		}
	}	

	public function file_exist($filepathname){
		return $this->basemodel->file_exist($filepathname);
	}
	
}