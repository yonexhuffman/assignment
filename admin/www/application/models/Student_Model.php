<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Model extends MY_Model {    
	public function __construct() {
		parent::__construct();		
    }

    public function get_data($id = -1){
    	$query_result = $this->db
    		->from('student')
            ->join('tbl_account' , 'student.acc_id = tbl_account.acc_id' , 'left')
            ->join('studentgroup' , 'student.sg_id = studentgroup.sg_id' , 'left')
            ->where('tbl_account.user_role' , 'STU');
    	if ($id > 0) {
    		$query_result = $query_result->where('s_id' , $id);
    	}
    	$query_result = $query_result->get()->result_array();
    	return $query_result;
    }

    public function get_sg_student_list($sg_id){
        return $this->db->select('s_id , s_name')
            ->from('student')
            ->where('sg_id' , $sg_id)
            ->order_by('s_name' , 'ASC')
            ->get()
            ->result_array();
    }

    public function get_sg_list(){
        $query_result = $this->db
            ->from('studentgroup')
            ->order_by('sg_number' , 'ASC')
            ->get()
            ->result_array();
        return $query_result;
    }

    public function insert_newstudent($insert_data , $upload_path){
        // CREATE ACCOUNT
        $create_account_data = array(
            'user_id'   => $this->produce_studentaccountid($insert_data) , 
            'user_pass' => md5(DEFAULTACCOUNTPASSWORD) , 
            'user_role' => 'STU' , 
        );
        // CREATE student DATA
        $create_account_result = $this->tb_insertdata('tbl_account' , $create_account_data);
        if ($create_account_result['success']) {
            $new_account_id = $create_account_result['insert_id'];

            $student_insert_data = array(
                'acc_id'    => $new_account_id , 
                's_serialNo'    => $insert_data['s_serialNo'] , 
                's_name'    => $insert_data['s_name'] , 
                's_gender'  => $insert_data['s_gender'] , 
                's_birth'   => $insert_data['s_birth'] , 
                's_schoolname'   => $insert_data['s_schoolname'] , 
                's_grade'   => $insert_data['s_grade'] , 
                'sg_id'     => $insert_data['sg_id'] ,  
                's_rival_id'     => $insert_data['s_rival_id'] , 
            );

            $insert_newstudent_result = $this->tb_insertdata('student' , $student_insert_data);

            if ($insert_newstudent_result['success']) {
                $new_student_id = $insert_newstudent_result['insert_id'];
                $new_upload_file_name = $new_account_id . '_' . $new_student_id . '_' . $student_insert_data['s_name'];
                // FILE UPLOAD
                $upload_result = $this->file_upload($upload_path , 's_photo' , $new_upload_file_name);
                if ($upload_result['success']) {
                    $uploaded_filename = $upload_result['file_name'];
                    $this->tb_updatedata('student' , array('s_id' => $new_student_id) , array('s_photo' => $uploaded_filename));
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

    public function update_studentdata($update_data , $upload_path){
        $criteria = array(
            'acc_id'  => $update_data['acc_id']
        );
        $acc_update_data = array(
            'user_id'   => $this->produce_studentaccountid($update_data) , 
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
        if ($_FILES['s_photo']['name'] != '') {
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
            's_id'  => $update_data['s_id']
        );
        $student_update_data = array(
            's_serialNo'    => $update_data['s_serialNo'] , 
            's_name'    => $update_data['s_name'] , 
            's_gender'  => $update_data['s_gender'] , 
            's_birth'   => $update_data['s_birth'] , 
            's_schoolname'   => $update_data['s_schoolname'] , 
            's_grade'   => $update_data['s_grade'] , 
            'sg_id'     => $update_data['sg_id'] , 
            's_rival_id'     => $update_data['s_rival_id'] , 
        );
        $new_upload_file_name = $update_data['acc_id'] . '_' . $update_data['s_id'] . '_' . $student_update_data['s_name'];
        $upload_result = $this->file_upload($upload_path , 's_photo' , $new_upload_file_name);
        if ($upload_result['success']) {
            $uploaded_filename = $upload_result['file_name'];
            $student_update_data = array_merge($student_update_data , array('s_photo' => $uploaded_filename));
        }
        else {
            $seperates = explode('.' , $update_data['uploaded_filename']);
            $file_ext = $seperates[count($seperates) - 1];
            $new_file_name = $new_upload_file_name . '.' . $file_ext;
            $old_file_name = $upload_path . $update_data['uploaded_filename'];
            if ($this->rename_files($old_file_name , $upload_path . $new_file_name)) {
                $student_update_data = array_merge($student_update_data , array('s_photo' => $new_file_name));
            }            
        }

        if ($this->tb_updatedata('student' , $criteria , $student_update_data)) {
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

    public function delete_studentdata($criteria , $upload_path) {
        $cur_record = $this->get_data($criteria['s_id']);
        $cur_record = $cur_record[0];
        $this->delete_file($upload_path . $cur_record['s_photo']);
        $this->tb_deletedata('tbl_account' , array('acc_id' => $criteria['acc_id']));
        $this->tb_deletedata('student' , array('s_id' => $criteria['s_id']));
        return TRUE;
    }

}