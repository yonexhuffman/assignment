<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AssignmentProduce extends MY_Controller {
	private $controller_name = "assignmentproduce";
	private $page_key = 2;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AssignmentProduce_Model' , 'assignmentproduce');
		if ($this->header_data['cur_userdata']['user_role'] != 'TEA') {
			redirect('/');
		}
	}

	public function index()	{
		// header data
		$this->header_data['page_key'] = $this->page_key;
		$this->header_data['plugin_css'] = array(
			'bootstrap-datepicker/css/datepicker3.css' , 
			'bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css' , 
		);
		
		// view_data
		$view_data = array();
		$view_data['studentgroup']	= $this->assignmentproduce->get_singletbdata('studentgroup' , array('t_id' => $this->header_data['cur_userdata']['member_id']));
		
		if ($this->session->has_userdata('POST_RESULT_ALARM_MESSAGE')) {
			$view_data['post_result_alarm_message'] = $this->session->userdata('POST_RESULT_ALARM_MESSAGE');
			$this->session->unset_userdata('POST_RESULT_ALARM_MESSAGE');
		}

		// footer data
		$footer_data = array();
		$footer_data['plugin_js'] = array(
			'bootstrap-datepicker/js/bootstrap-datepicker.js' , 
			'bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js' , 
			'bootbox/bootbox.min.js' , 
		);
		$this->template->pageview($this->controller_name , $this->header_data , $view_data , $footer_data);
	}

	public function newassignment(){
		if ($this->input->post()) {
			$newassignment_insert_status = TRUE;

			$post_data = $this->input->post();
			$student_list = $this->assignmentproduce->get_singletbdata('student' , array('sg_id' => $post_data['sg_id']) , 's_id');
			$insert_data = array(
				// 'assignment_title'	=> $post_data['assignment_title'] , 
				'give_date'	=> $post_data['give_date'] , 
				't_id'	=> $post_data['t_id'] , 
				'sg_id'	=> $post_data['sg_id'] , 
			);
			$insert_result = $this->assignmentproduce->tb_insertdata('tbl_assignment' , $insert_data);
			if ($insert_result['success']) {
				$ass_id = $insert_result['insert_id'];
				$file_count = 0;
				$file_index = 0;
				$problem_index = 0;
				$uploaded_filenames = array();
				$ass_files_count = count($_FILES['ass_files']['name']);
				for ($file_index = 0; $file_index < $ass_files_count ; $file_index ++) { 
					if ($_FILES['ass_files']['name'][$file_index] != '') {
						$_FILES['buffer_file']['name'] = $_FILES['ass_files']['name'][$file_index];
						$_FILES['buffer_file']['type'] = $_FILES['ass_files']['type'][$file_index];
						$_FILES['buffer_file']['tmp_name'] = $_FILES['ass_files']['tmp_name'][$file_index];
						$_FILES['buffer_file']['error'] = $_FILES['ass_files']['error'][$file_index];
						$_FILES['buffer_file']['size'] = $_FILES['ass_files']['size'][$file_index];
						$new_upload_file_name = $ass_id . '_' . $file_index;
		                // FILE UPLOAD
		                $upload_result = $this->assignmentproduce->file_upload($this->uploadpath_assfile , 'buffer_file' , $new_upload_file_name);
		                if ($upload_result['success']) {
		                    $uploaded_filenames[$file_index]['name'] = $upload_result['file_name'];		                    
		                    $uploaded_filenames[$file_index]['file_type'] = $upload_result['file_type'];		                    
		                }   
		                else {
		                	$uploaded_filenames[$file_index] = '';		                    
		                }
					}					
				}
				for ($i = 0 ; $i < count($uploaded_filenames) ; $i ++) { 
					if ($uploaded_filenames[$i] != '') {
						$ass_files_insert_data = array(
							'ass_id'	=> $ass_id , 
							'ass_file_name'	=> $uploaded_filenames[$i]['name'] , 
							'ass_file_type'	=> $uploaded_filenames[$i]['file_type'] , 
						);
						$ass_files_insert_result = $this->assignmentproduce->tb_insertdata('tbl_ass_files' , $ass_files_insert_data);
					}
				}
				foreach ($student_list as $key => $student) {
					$assignment_answerinsetdata = array(
						's_id' => $student['s_id'] , 
						'ass_id'	=> $ass_id , 
					);	
					$this->assignmentproduce->tb_insertdata('tbl_assignment_answers' , $assignment_answerinsetdata);
				}
			}
			else {
				$newassignment_insert_status = FALSE;
			}
			if ($newassignment_insert_status) {
				$post_result = array(
					'success'	=> TRUE , 
	                'post_message'  => '操作成功.' , 
				);
				$this->session->set_userdata('POST_RESULT_ALARM_MESSAGE' , $post_result);
			}
			else {
				$post_result = array(
					'success'	=> FALSE , 
	                'post_message'  => '操作失败.' , 
				);
				$this->session->set_userdata('POST_RESULT_ALARM_MESSAGE' , $post_result);
			}
		}
		redirect('/assignmentproduce');
	}

}
