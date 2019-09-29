<?php defined('BASEPATH') OR exit('No direct script access allowed');

class GivePoint extends MY_Controller {
	private $controller_name = "givepoint";
	private $page_key = 3;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('GivePoint_Model' , 'givepoint');
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
			'emoticon/css/froala_editor.css' ,
			'emoticon/css/froala_style.css' ,
			'emoticon/css/plugins/emoticons.css' ,  
			'literallycanvas/_assets/literallycanvas.css'
		);

		// view_data
		$view_data = array();
		$view_data['uploadpath_referencefile'] = $this->uploadpath_referencefile;
		$view_data['uploadpath_assfile'] = $this->uploadpath_assfile;
		$view_data['uploadpath_answerfile'] = $this->uploadpath_answerfile;
		$view_data['assignment_list']	= $this->givepoint->get_assignmentlist($this->header_data['cur_userdata']['member_id']);
		if (count($view_data['assignment_list']) > 0) {
			if ($this->input->get('ass_id')) {
				$ass_id = $this->input->get('ass_id');	
			}
			else {
				$ass_id = $view_data['assignment_list'][0]['ass_id'];
			}
		}
		else {
			$ass_id = -1;
		}

		if ($ass_id > 0) {
			$view_data['ass_id'] = $ass_id;
			$view_data['assignment_student_list'] = $this->givepoint->get_assignment_studentlist($view_data['ass_id']);
			$s_id = -1;
			if ($this->input->get('s_id')) {
				$s_id = $this->input->get('s_id');
			}
			else {
				if (count($view_data['assignment_student_list']) > 0) {
					$s_id = $view_data['assignment_student_list'][0]['s_id'];
				}
			}
			$problemanswer_criteria = array('ass_id'	=> $ass_id);
			if ($s_id > 0) {
				$problemanswer_criteria['s_id'] = $s_id;
				$view_data['s_id'] = $s_id;
			}

			$view_data['assignment_answer'] = $this->givepoint->get_assignment_answer($problemanswer_criteria);
			// $view_data['ans_file_url'] = $this->uploadpath_answerfile . $view_data['unchecked_assignment']['answer_file'];
		}
		else {
			$view_data['ass_id'] = -1;	
			$view_data['assignment_answer'] = array();	
			$view_data['assignment_student_list'] = array();	
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
			'literallycanvas/_js_libs/react-0.14.3.js' , 
			'literallycanvas/_js_libs/literallycanvas.js' , 
		);
		$this->template->pageview($this->controller_name , $this->header_data , $view_data , $footer_data);
	}

	public function submit() {
		if ($this->input->post()) {
			$old_files = $this->givepoint->get_singletbdata('tbl_ans_files' , array('ans_id' => $_POST['ans_id']));
			foreach ($old_files as $key => $oldfile) {
				if ($oldfile['ans_file_name'] != '') {
					$this->givepoint->delete_file($this->uploadpath_answerfile . $oldfile['ans_file_name']);
				}
			}
			// $this->givepoint->tb_deletedata('tbl_ans_files' , array('ans_id' => $_POST['ans_id']));


			$post_data = $this->input->post();
            // FILE UPLOAD
			$new_upload_file_name = $post_data['ass_id'] . '_' . $_FILES['ref_file']['name'];
            $upload_result = $this->givepoint->file_upload($this->uploadpath_referencefile , 'ref_file' , $new_upload_file_name , 'mp4|webm');
            if ($upload_result['success']) {
            	$tbl_reffile_updatedata = array(
            		'ref_file'		=> $upload_result['file_name'] , 
            		'ref_file_type'	=> $upload_result['file_type'] , 
            	);
            	$this->givepoint->tb_updatedata('tbl_assignment' , array('ass_id' => $post_data['ass_id']) , $tbl_reffile_updatedata);
            }   


			//server-side code where we save the given drawing in a PNG file
			// $images = filter_input(INPUT_POST, 'upload_image', FILTER_SANITIZE_URL);
				// var_dump($_POST['image_name']);
			foreach ($_POST['upload_image'] as $key => $image) {
				$image = str_replace(' ', '+', str_replace('data:image/png;base64,', '', $image));
				$data = base64_decode($image);
				$realname = $_POST['ass_id'] . '_' . $_POST['ans_id'] . '_' . $key . '.png';
				write_file($this->uploadpath_answerfile . $realname , $data);
				$insert_data = array(
					'ans_id'		=> $_POST['ans_id'] ,
					'ans_file_name'	=> $realname , 
					'ans_file_type'	=> 'image/png' , 
				);
				$this->givepoint->tb_updatedata('tbl_ans_files' , array('ans_file_id' => $old_files[$key]['ans_file_id']) , $insert_data);
			}
			$tbl_assignment_answers_updatedata = array(
				'point'			=> $post_data['point'] , 
				'comment'		=> $post_data['comment'] , 
			);
            $submit_status = $this->givepoint->tb_updatedata('tbl_assignment_answers' , array('ans_id' => $post_data['ans_id']) , $tbl_assignment_answers_updatedata);

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
            redirect('givepoint?ass_id=' . $post_data['ass_id'] . '&s_id=' . $post_data['s_id']);
		}
		redirect('givepoint');
	}

}
