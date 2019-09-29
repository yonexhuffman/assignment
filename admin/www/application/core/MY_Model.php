<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	public function __construct() {
        parent::__construct();
        
    }

    public function produce_teacheraccountid($post_data){
        $retVal = '';
        $retVal .= $post_data['t_name'];
        $birthday_array = explode('-' , $post_data['t_birth']);
        foreach($birthday_array as $item) {
            $retVal .= $item;
        }
        return $retVal;
    }

    public function produce_studentaccountid($post_data){
        $retVal = '';
        $retVal .= $post_data['s_name'];
        $birthday_array = explode('-' , $post_data['s_birth']);
        foreach($birthday_array as $item) {
            $retVal .= $item;
        }
        return $retVal;
    }

    public function tb_insertdata($tb_name , $insert_data) {
        $retVal = array();
        $retVal['success'] = $this->db->insert($tb_name , $insert_data);
        if ($retVal['success']) {
            $retVal['insert_id'] = $this->db->insert_id();
        }
        else {
            $retVal['insert_id'] = -1;
        }
        return $retVal;
    }

    public function tb_updatedata($tb_name , $criteria , $update_data) {
        return $this->db->where($criteria)->update($tb_name , $update_data);
    }

    public function tb_deletedata($tb_name , $criteria) {
        return $this->db->where($criteria)->delete($tb_name);
    }
    
    public function getLoggedAdminData(){
		return $this->session->userdata('LOGGEDIN_ADMIN_DATA');
    }

	public function file_upload($path, $file_tag_name , $new_file_name = ''){
        $config['upload_path']          = $path;
        if ($new_file_name != '') {
            $config['file_name']        = $new_file_name;
        }
		$config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000000;
        $config['overwrite']            = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
        $retVal = array();
        $retVal['success'] = $this->upload->do_upload($file_tag_name);
        if ($retVal['success']) {
            $retVal['file_name'] = $this->upload->data('file_name');
        }
        else {
            $retVal['file_name'] = NULL;
        }
        return $retVal;
    }
    
    public function file_exist($filepathname) {
        return file_exists($filepathname);
    }

    public function delete_file($filepathname) {
        if ($this->file_exist($filepathname)) {
            return unlink($filepathname);
        }
        return FALSE;
    }

    public function rename_files($old_pathname , $new_pathname) {
        if ($this->file_exist($old_pathname)) {
            return rename($old_pathname , $new_pathname);
        }
        return FALSE;
    }
}