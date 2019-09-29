<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_Model extends MY_Model {    
	public function __construct() {
		parent::__construct();		
    }

    public function get_data($id = -1){
    	$query_result = $this->db
    		->from('teacher')
            ->join('tbl_account' , 'teacher.acc_id = tbl_account.acc_id' , 'left')
            ->where('tbl_account.user_role' , 'TEA');
    	if ($id > 0) {
    		$query_result = $query_result->where('t_id' , $id);
    	}
    	$query_result = $query_result->get()->result_array();
    	return $query_result;
    }

    public function get_tg_list(){
        $query_result = $this->db
            ->from('teachergroup')
            ->order_by('tg_number' , 'ASC')
            ->get()
            ->result_array();
        return $query_result;
    }

    public function insert_newteacher($insert_data , $upload_path){
        // CREATE ACCOUNT
        $create_account_data = array(
            'user_id'   => $this->produce_teacheraccountid($insert_data) , 
            'user_pass' => md5(DEFAULTACCOUNTPASSWORD) , 
            'user_role' => 'TEA' , 
        );
        // CREATE TEACHER DATA
        $create_account_result = $this->tb_insertdata('tbl_account' , $create_account_data);
        if ($create_account_result['success']) {
            $new_account_id = $create_account_result['insert_id'];

            $teacher_insert_data = array(
                'acc_id'    => $new_account_id , 
                't_name'    => $insert_data['t_name'] , 
                't_gender'  => $insert_data['t_gender'] , 
                't_birth'   => $insert_data['t_birth'] , 
            );

            $insert_newteacher_result = $this->tb_insertdata('teacher' , $teacher_insert_data);

            if ($insert_newteacher_result['success']) {
                $new_teacher_id = $insert_newteacher_result['insert_id'];
                $new_upload_file_name = $new_account_id . '_' . $new_teacher_id . '_' . $teacher_insert_data['t_name'];
                // FILE UPLOAD
                $upload_result = $this->file_upload($upload_path , 't_photo' , $new_upload_file_name);
                if ($upload_result['success']) {
                    $uploaded_filename = $upload_result['file_name'];
                    $this->tb_updatedata('teacher' , array('t_id' => $new_teacher_id) , array('t_photo' => $uploaded_filename));
                }   
                return array(
                    'success'   => TRUE , 
                    'post_message'  => '操作成功.' , 
                );
            }
            else {
                $this->tb_deletedata('tbl_account' , array('acc_id' => $new_account_id));
            }
        }       
        return array(
            'success'   => FALSE , 
            'post_message'  => '操作失败.' , 
        );
    }

    public function update_teacherdata($update_data , $upload_path){
        $criteria = array(
            'acc_id'  => $update_data['acc_id']
        );
        $acc_update_data = array(
            'user_id'   => $this->produce_teacheraccountid($update_data) , 
        );
        
        $search_accid = $this->db->select('*')
            ->from('tbl_account')
            ->where('acc_id' , $criteria['acc_id'])
            ->get()
            ->result_array();
        if ($search_accid[0]['user_id'] == $acc_update_data['user_id']) {
            $b_change_accuserid = FALSE;
        }
        else {
            $b_change_accuserid = TRUE;
        }
        $b_old_file_delete = FALSE;
        if ($_FILES['t_photo']['name'] != '') {
            $b_old_file_delete = ($b_change_accuserid && TRUE);
        }
        if ($b_old_file_delete) {
            $this->delete_file($upload_path . $update_data['uploaded_filename']);
        }
        if ($b_change_accuserid) {
            if (!$this->tb_updatedata('tbl_account' , $criteria , $acc_update_data)) {    
                $acc_update_data['user_id'] = $acc_update_data['user_id'] . 'abc';
                $this->tb_updatedata('tbl_account' , $criteria , $acc_update_data);
            }
        }
                
        $criteria = array(
            't_id'  => $update_data['t_id']
        );
        $teacher_update_data = array(
            't_name'    => $update_data['t_name'] , 
            't_gender'  => $update_data['t_gender'] , 
            't_birth'   => $update_data['t_birth'] , 
        );
        $new_upload_file_name = $update_data['acc_id'] . '_' . $update_data['t_id'] . '_' . $teacher_update_data['t_name'];
        $upload_result = $this->file_upload($upload_path , 't_photo' , $new_upload_file_name);
        if ($upload_result['success']) {
            $uploaded_filename = $upload_result['file_name'];
            $teacher_update_data = array_merge($teacher_update_data , array('t_photo' => $uploaded_filename));
        }
        else {
            $seperates = explode('.' , $update_data['uploaded_filename']);
            $file_ext = $seperates[count($seperates) - 1];
            $new_file_name = $new_upload_file_name . '.' . $file_ext;
            $old_file_name = $upload_path . $update_data['uploaded_filename'];
            if ($this->rename_files($old_file_name , $upload_path . $new_file_name)) {
                $teacher_update_data = array_merge($teacher_update_data , array('t_photo' => $new_file_name));
            }            
        }

        if ($this->tb_updatedata('teacher' , $criteria , $teacher_update_data)) {
            return array(
                'success'   => TRUE , 
                'post_message'  => '操作成功.' , 
            );
        }
        else {            
            return array(
                'success'   => FALSE , 
                'post_message'  => '操作失败.' , 
            );
        }
    }

    public function delete_teacherdata($criteria , $upload_path) {
        $cur_record = $this->get_data($criteria['t_id']);
        $cur_record = $cur_record[0];
        $this->delete_file($upload_path . $cur_record['t_photo']);
        $this->tb_deletedata('tbl_account' , array('acc_id' => $criteria['acc_id']));
        $this->tb_deletedata('teacher' , array('t_id' => $criteria['t_id']));
        return TRUE;
    }

}