<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admininfo_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		
    }

    public function get_data(){
    	$query_result = $this->db
    		->from('tbl_account')
            ->join('teacher' , 'teacher.acc_id = tbl_account.acc_id' , 'left')
            ->where('tbl_account.user_role' , 'ADM')
            ->get()
            ->row_array();

    	return $query_result;
    }

    public function update_admin($input_data , $upload_path) {
        $acc_update_data = array(
            'user_id'       => $input_data['user_id'] , 
            'user_pass'     => md5($input_data['user_pass']) , 
        );
        $this->tb_updatedata('tbl_account' , array('acc_id' => $input_data['acc_id']) , $acc_update_data);

        $tea_update_data = array(
            't_name'    => $input_data['t_name'] , 
            't_gender'  => $input_data['t_gender'] , 
            't_birth'   => $input_data['t_birth'] , 
        );
        $new_upload_file_name = $input_data['admin_img_name'];
        $upload_result = $this->file_upload($upload_path , 't_photo' , $new_upload_file_name);
        if ($upload_result['success']) {
            $uploaded_filename = $upload_result['file_name'];
            $tea_update_data = array_merge($tea_update_data , array('t_photo' => $uploaded_filename));
        }

        $this->tb_updatedata('teacher' , array('t_id' => $input_data['t_id']) , $tea_update_data);
    }

}