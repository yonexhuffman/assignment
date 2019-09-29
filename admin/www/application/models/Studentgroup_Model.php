<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Studentgroup_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		
    }

    public function get_data($id = -1){
    	$query_result = $this->db
    		->from('studentgroup')
            ->join('teacher' , 'teacher.t_id = studentgroup.t_id' , 'left');
    	if ($id > 0) {
    		$query_result = $query_result->where('sg_id' , $id);
    	}
    	$query_result = $query_result->get()->result_array();
    	return $query_result;
    }

    public function get_teacherlist(){
        $query_result = $this->db
            ->from('teacher')
            ->join('tbl_account' , 'tbl_account.acc_id = teacher.acc_id' , 'left')
            ->where('tbl_account.user_role' , 'TEA')
            ->get()
            ->result_array();
        return $query_result;
    }
}