<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
		
    }

	public function get_user_info($criteria){
		$query=$this->db
				->from('tbl_account')
				->join('teacher' , 'tbl_account.acc_id = teacher.acc_id' , 'left')
				->where('tbl_account.user_id', $criteria['username'])
				->where('tbl_account.user_pass', md5($criteria['password']))
				->where('tbl_account.user_role' , 'ADM')
				->get();
		return $query->row_array();
	}

	public function registerSession($user_data){
		$this->session->set_userdata('LOGGEDIN_ADMIN_DATA' , $user_data);
	}

	public function destroySession(){
		$this->session->unset_userdata('LOGGEDIN_ADMIN_DATA');
		$this->session->sess_destroy();
	}

	public function is_signin(){
		return $this->session->has_userdata('LOGGEDIN_ADMIN_DATA');
	}

	public function get_loggedin_user_data(){
		return $this->session->userdata('LOGGEDIN_ADMIN_DATA');
	}

}