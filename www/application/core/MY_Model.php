<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	public function __construct() {
        parent::__construct();
        
    }

    public function get_singletbdata($tb_name , $criteria = array() , $col = '*') {
        return $this->db->select($col)
            ->from($tb_name)
            ->where($criteria)
            ->get()
            ->result_array();
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

	public function file_upload($path, $file_tag_name , $new_file_name = '' , $special_filetype = ''){
        $config['upload_path']          = $path;
        if ($new_file_name != '') {
            $config['file_name']        = $new_file_name;
        }
        if ($special_filetype != '') {
            $config['allowed_types']        = $special_filetype ;
        }
        else {
            $config['allowed_types']        = '*';
        }
        $config['max_size']             = 1000000000;
        $config['overwrite']            = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
        $retVal = array();
        $retVal['success'] = $this->upload->do_upload($file_tag_name);
        if ($retVal['success']) {
            $retVal['file_name'] = $this->upload->data('file_name');
            $retVal['file_type'] = $this->upload->data('file_type');
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
    
    public function getLoggedUserData(){
		return $this->session->userdata('LOGGEDIN_USER_DATA');
    }
}