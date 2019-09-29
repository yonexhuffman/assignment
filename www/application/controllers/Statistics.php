<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends MY_Controller {
	private $controller_name = "statistics";
	private $page_key = 4;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Statistics_Model' , 'statistics');
		if ($this->header_data['cur_userdata']['user_role'] != 'TEA') {
			redirect('/');
		}
	}

	public function index()	{
		// header data
		$this->header_data['page_key'] = $this->page_key;
		$this->header_data['plugin_css'] = array();
		
		// view_data
		$view_data = array();
		$this->header_data['plugin_css'] = array(
			'datatables/plugins/bootstrap/dataTables.bootstrap.css' ,
		);
		$view_data['assignment_list'] = $this->statistics->get_assignmentlist_checked($this->header_data['cur_userdata']['member_id']);

		// $s_id = -1;
		// if ($this->input->get('s_id')) {
		// 	$s_id = $this->input->get('s_id');	
		// }

		if ($this->input->get('ass_id')) {
			$ass_id = $this->input->get('ass_id');	
		}
		else {
			$ass_id = -1;
		}

		if ($ass_id > 0) {
			$view_data['ass_id'] = $ass_id;
		}
		else {
			$view_data['ass_id'] = -1;	
		}
		if ($ass_id > 0) {
			$view_data['statistics_assignmentdata'] = $this->statistics->get_statisticsdata($this->header_data['cur_userdata']['sg_id'] , $ass_id);
		}
		else {
			$view_data['statistics_data'] = $this->statistics->get_statisticsdata($this->header_data['cur_userdata']['sg_id']);
		}

		// footer data
		$footer_data = array();
		$footer_data['plugin_js'] = array();
		$this->template->pageview($this->controller_name , $this->header_data , $view_data , $footer_data);
	}

}
