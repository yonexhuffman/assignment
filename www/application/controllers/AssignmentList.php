<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AssignmentList extends MY_Controller {
	private $controller_name = "assignmentlist";
	private $page_key = 3;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AssignmentList_Model' , 'assignmentlist');
		if ($this->header_data['cur_userdata']['user_role'] != 'STU') {
			redirect('/');
		}
	}

	public function index()	{
		// header data
		$this->header_data['page_key'] = $this->page_key;
		$this->header_data['plugin_css'] = array(
			'emoticon/css/froala_editor.css' ,
			'emoticon/css/froala_style.css' ,
			'emoticon/css/plugins/emoticons.css' ,  
		);

		// view_data
		$view_data = array();
		$view_data['uploadpath_referencefile'] = $this->uploadpath_referencefile;
		$view_data['uploadpath_assfile'] = $this->uploadpath_assfile;
		$view_data['uploadpath_answerfile'] = $this->uploadpath_answerfile;
		$view_data['assignment_list']	= $this->assignmentlist->get_assignmentlist($this->header_data['cur_userdata']['member_id'] , $this->header_data['cur_userdata']['sg_id']);

		if ($this->input->get('ass_id')) {
			$ass_id = $this->input->get('ass_id');	
		}
		else {
			if (count($view_data['assignment_list']) > 0) {
				$ass_id = $view_data['assignment_list'][0]['ass_id'];
			}
			else {
				$ass_id = -1;
			}
		}
		if ($ass_id > 0) {
			$view_data['ass_id'] = $ass_id;
			$view_data['answer_data'] = $this->assignmentlist->get_answer_data($this->header_data['cur_userdata']['member_id'] , $ass_id);
		}
		else {
			$view_data['ass_id'] = -1;	
			$view_data['answer_data'] = array();	
		}
		
		if ($this->session->has_userdata('POST_RESULT_ALARM_MESSAGE')) {
			$view_data['post_result_alarm_message'] = $this->session->userdata('POST_RESULT_ALARM_MESSAGE');
			$this->session->unset_userdata('POST_RESULT_ALARM_MESSAGE');
		}

		// footer data
		$footer_data = array();
		$footer_data['plugin_js'] = array(
			'bootbox/bootbox.min.js' , 
			'emoticon/codemirror.min.js' , 
			'emoticon/xml.min.js' , 
			'emoticon/js/froala_editor.min.js' , 
			'emoticon/js/plugins/link.min.js' , 
			'emoticon/js/plugins/emoticons.min.js' , 
		);
		$this->template->pageview($this->controller_name , $this->header_data , $view_data , $footer_data);
	}

	public function submit() {
		if ($this->input->post()) {
			$old_files = $this->assignmentlist->get_singletbdata('tbl_ans_files' , array('ans_id' => $_POST['ans_id']));
			foreach ($old_files as $key => $oldfile) {
				if ($oldfile['ans_file_name'] != '') {
					$this->assignmentlist->delete_file($this->uploadpath_answerfile . $oldfile['ans_file_name']);
				}
			}
			$this->assignmentlist->tb_deletedata('tbl_ans_files' , array('ans_id' => $_POST['ans_id']));

			$ass_id = $_POST['ass_id'];
			$ans_id = $_POST['ans_id'];
			$file_index = 0;
			$ans_files_count = count($_FILES['ans_files']['name']);
			$submit_status = TRUE;
			$uploaded_filenames = array();
			for ($file_index = 0; $file_index < $ans_files_count ; $file_index ++) { 
				if ($_FILES['ans_files']['name'][$file_index] != '') {
					$_FILES['buffer_file']['name'] = $_FILES['ans_files']['name'][$file_index];
					$_FILES['buffer_file']['type'] = $_FILES['ans_files']['type'][$file_index];
					$_FILES['buffer_file']['tmp_name'] = $_FILES['ans_files']['tmp_name'][$file_index];
					$_FILES['buffer_file']['error'] = $_FILES['ans_files']['error'][$file_index];
					$_FILES['buffer_file']['size'] = $_FILES['ans_files']['size'][$file_index];
					$new_upload_file_name = $ass_id . '_' . $ans_id . '_' . $file_index;
	                // FILE UPLOAD
	                $upload_result = $this->assignmentlist->file_upload($this->uploadpath_answerfile , 'buffer_file' , $new_upload_file_name);
	                if ($upload_result['success']) {
	                    $uploaded_filenames[$file_index]['name'] = $upload_result['file_name'];		                    
	                    $uploaded_filenames[$file_index]['file_type'] = $upload_result['file_type'];		                    
	                }   
	                else {
	                	$uploaded_filenames[$file_index] = '';	
						$submit_status = FALSE;                 	                    
	                }
				}					
			}
			for ($i = 0 ; $i < count($uploaded_filenames) ; $i ++) { 
				if ($uploaded_filenames[$i] != '') {
					$ans_files_insert_data = array(
						'ans_id'	=> $ans_id , 
						'ans_file_name'	=> $uploaded_filenames[$i]['name'] , 
						'ans_file_type'	=> $uploaded_filenames[$i]['file_type'] , 
					);
					$ans_files_insert_result = $this->assignmentlist->tb_insertdata('tbl_ans_files' , $ans_files_insert_data);
				}
			}

			if ($submit_status) {
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
			redirect('/assignmentlist?ass_id=' . $ass_id);		
		}
		redirect('/assignmentlist');		
	}

	public function referencefiles(){
		// header data
		$this->header_data['page_key'] = 4;
		$this->header_data['plugin_css'] = array();

		// view_data
		$view_data = array();
		$view_data['uploadpath_referencefile'] = $this->uploadpath_referencefile;
		
		$view_data['assignment_list']	= $this->assignmentlist->get_assignmentlist($this->header_data['cur_userdata']['member_id'] , $this->header_data['cur_userdata']['sg_id']);

		if ($this->input->get('ass_id')) {
			$ass_id = $this->input->get('ass_id');	
		}
		else {
			if (count($view_data['assignment_list']) > 0) {
				$ass_id = $view_data['assignment_list'][0]['ass_id'];
			}
			else {
				$ass_id = -1;
			}
		}
		if ($ass_id > 0) {
			$view_data['ass_id'] = $ass_id;
			$view_data['referencefiles'] = $this->assignmentlist->get_referencefiles($this->header_data['cur_userdata']['sg_id']);
		}
		else {
			$view_data['ass_id'] = -1;	
			$view_data['referencefiles'] = array();	
		}

		// footer data
		$footer_data = array();
		$footer_data['plugin_js'] = array();
		$this->template->pageview('referencefiles' , $this->header_data , $view_data , $footer_data);
	}
}
