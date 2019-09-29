<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $post_message = "";
	public function __construct() {
		parent::__construct();
		
		$this->load->model('login_model' , 'login');
	}

	public function index()	{		
		if ($this->session->has_userdata('POSTERROR_MESSAGE')) {
			$this->post_message = $this->session->userdata('POSTERROR_MESSAGE');
			$this->session->unset_userdata('POSTERROR_MESSAGE');
		}
		$view_data = array();
		$is_signin = $this->login->is_signin();		
		$view_data['is_signin']	= $is_signin;
		$view_data['error']		= $this->post_message;
		
		$this->load->view('login/index' , $view_data);
	}

	public function signIn(){
		$criteria = $this->input->post();
		$user_data = $this->login->get_user_info($criteria);
		if(empty($user_data)){
			$post_message = "您输入的用户不存在.";
			$this->session->set_userdata('POSTERROR_MESSAGE' , $post_message);
			redirect('login');
		} else {
			$this->login->registerSession($user_data);
		}		

		redirect('/studentgroup');
	}	

	public function signUp(){
		$this->login->destroySession();
		redirect('/login');
	}

}
