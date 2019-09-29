<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	private $controller_name = "dashboard";
	private $page_key = 1;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_Model' , 'dashboard');
	}

	public function index()	{
		// header data
		$this->header_data['page_key'] = $this->page_key;
		$this->header_data['plugin_css'] = array(
			// 'datatables/media/js/jquery.dataTables.min.js' , 
		);
		// view_data
		$view_data = array();
		$view_data['userdata']	= $this->dashboard->getLoggedUserData();
		if ($view_data['userdata']['user_role'] == 'STU') {
			$view_data['rival_data'] = $this->dashboard->get_rival_data($view_data['userdata']['member_id'] , $view_data['userdata']['s_rival_id']);
			$view_data['assignment_list'] = $this->dashboard->get_assignment_list($view_data['userdata']['member_id']);
		}
		$view_data['gender']	= $this->config->item('gender');
		$view_data['user_role']	= $this->config->item('user_role');
		// footer data
		$footer_data = array();
		$footer_data['plugin_js'] = array(
			'bootstrap-toastr/toastr.min.js' , 
		);
		$this->template->pageview($this->controller_name , $this->header_data , $view_data , $footer_data);
	}

	public function updatepassword(){
		if ($this->input->post()) {
			$result = array(
				'success'	=> FALSE , 
				'message'	=> '操作失败.' , 
			);
			$input_data = $this->input->post();

			$acc_id = $input_data['acc_id'];
			$prev_user_pass = md5($input_data['prev_user_pass']);
			$cur_userpassmd5 = $this->dashboard->get_singletbdata('tbl_account' , array('acc_id' => $acc_id) , 'user_pass');
			$cur_userpassmd5 = $cur_userpassmd5[0]['user_pass'];
			$user_pass = $input_data['user_pass'];
			$new_user_pass_confirm = $input_data['new_user_pass_confirm'];

			if ($cur_userpassmd5 != $prev_user_pass) {
				$result['success'] = FALSE;
				$result['message'] = '您输入的旧密码不正确.';
			}
			else if ($user_pass != $new_user_pass_confirm) {
				$result['success'] = FALSE;
				$result['message'] = '您输入的确认密码不正确.';
			}
			else {
				if ($this->dashboard->tb_updatedata('tbl_account' , array('acc_id' => $acc_id) , array('user_pass' => md5($user_pass)))) {
					$result['success'] = TRUE;
					$result['message'] = '操作成功.';
				}
			}
			echo json_encode($result);
		}
	}
}
