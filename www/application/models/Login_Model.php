<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
		
    }

	public function get_user_info($criteria){
		if ($criteria['is_teacher'] == 1) {
			$query=$this->db
				->from('tbl_account')
				->join('teacher' , 'teacher.acc_id = tbl_account.acc_id')
				->join('studentgroup' , 'teacher.t_id = studentgroup.t_id')
				->where('tbl_account.user_id', $criteria['username'])
				->where('tbl_account.user_pass', md5($criteria['password']))
				->where('tbl_account.user_role', 'TEA')
				->where('tbl_account.user_role != ' , 'ADM')
				->where('studentgroup.sg_number' , $criteria['sg_number'])
				->get();		
				// ->get_compiled_select();	
		}
		else{
			$query=$this->db
				->from('tbl_account')
				->where('tbl_account.user_id', $criteria['username'])
				->where('tbl_account.user_pass', md5($criteria['password']))
				->where('tbl_account.user_role', 'STU')
				->where('tbl_account.user_role != ' , 'ADM')
				->get();
		}
		return $query->row_array();
	}

	public function registerSession($user_data){
		if ($user_data['user_role'] == 'TEA') {
			$sess_savedata = $this->db
				->select('tbl_account.* , teacher.t_id AS member_id , teacher.t_name AS name , teacher.t_gender AS gender , teacher.t_photo AS photo , teacher.t_birth AS birth , studentgroup.sg_id')
				->from('tbl_account')
				->join('teacher' , 'tbl_account.acc_id = teacher.acc_id' , 'left')
				->join('studentgroup' , 'studentgroup.t_id = teacher.t_id' , 'left')
				->where('tbl_account.acc_id' , $user_data['acc_id'])
				->get()
				->row_array();
		}
		else if($user_data['user_role'] == 'STU') {
			$sess_savedata = $this->db
				->select('tbl_account.* , student.s_id AS member_id , student.s_serialNo , student.s_name AS name , student.s_gender AS gender , student.s_photo AS photo , student.s_birth AS birth , student.s_schoolname AS s_schoolname , student.s_grade AS s_grade , student.s_rival_id AS s_rival_id , studentgroup.*')
				->from('tbl_account')
				->join('student' , 'tbl_account.acc_id = student.acc_id' , 'left')
				->join('studentgroup' , 'studentgroup.sg_id = student.sg_id' , 'left')
				->where('tbl_account.acc_id' , $user_data['acc_id'])
				->get()
				->row_array();
		}
		
		$this->session->set_userdata('LOGGEDIN_USER_DATA' , $sess_savedata);
	}

	public function destroySession(){
		$this->session->unset_userdata('LOGGEDIN_USER_DATA');
		$this->session->sess_destroy();
	}

	public function is_signin(){
		return $this->session->has_userdata('LOGGEDIN_USER_DATA');
	}

	public function get_loggedin_user_data(){
		return $this->session->userdata('LOGGEDIN_USER_DATA');
	}

}