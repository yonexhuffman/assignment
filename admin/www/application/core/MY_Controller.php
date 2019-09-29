<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $uploadpath_studentphoto = "../uploads/photo/student/";
	public $uploadpath_teacherphoto = "../uploads/photo/teacher/";
	public $header_data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MY_Model' , 'basemodel');
		
		if (!$this->session->has_userdata('LOGGEDIN_ADMIN_DATA')) {
			redirect('/login');
		}		
		else {
			$this->config->load('admin_config');
			
			$this->header_data['cur_userdata']		= $this->basemodel->getLoggedAdminData();
			$this->header_data['admin_photo_path']	= $this->uploadpath_teacherphoto;

			$this->header_data['menu'] = $this->config->item('menu');
		}
	}	

	public function file_exist($filepathname){
		return $this->basemodel->file_exist($filepathname);
	}
	
}