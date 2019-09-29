<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		
    }

    public function get_data(){
    	$loguserinfo = $this->getLoggedUserData();
        // var
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
            't_phone'   => $input_data['t_phone'] , 
            't_email'   => $input_data['t_email'] , 
        );
        $new_upload_file_name = $input_data['admin_img_name'];
        $upload_result = $this->file_upload($upload_path , 't_photo' , $new_upload_file_name);
        if ($upload_result['success']) {
            $uploaded_filename = $upload_result['file_name'];
            $tea_update_data = array_merge($tea_update_data , array('t_photo' => $uploaded_filename));
        }

        $this->tb_updatedata('teacher' , array('t_id' => $input_data['t_id']) , $tea_update_data);
    }

    public function get_assignment_list($s_id){
        $criteria = array(
            'ans.s_id'  => $s_id , 
            // 'ans.point != ' => ''
        );
        return $this->db->select('ass.ass_id')
            ->from('tbl_assignment AS ass')
            ->join('tbl_assignment_answers AS ans' , 'ans.ass_id = ass.ass_id' , 'left')
            ->where($criteria)
            ->order_by('ass.give_date' , 'DESC')
            ->order_by('ass.ass_id' , 'DESC')
            ->get()
            ->result_array();
    }

    public function get_rival_data($s_id , $s_rival_id) {
        $retVal = array();
        $my_points = $this->db->select('ans.point')
            ->from('tbl_assignment AS ass')
            ->join('tbl_assignment_answers AS ans' , 'ans.ass_id = ass.ass_id' , 'left')
            ->where('ans.s_id' , $s_id)
            ->get()
            ->result_array();
        $mine_point = array(
            'assignment_times'  => 0 , 
            'total_point'       => 0 , 
        );
        foreach ($my_points as $key => $record) {
            if (!empty($record['point'])) {
                $mine_point['assignment_times'] ++;
                $mine_point['total_point'] += $record['point'];
            }
        }
        $retVal['mine_point'] = $mine_point;

        $rivals = explode(',' , $s_rival_id);
        foreach ($rivals as $key => $rival) {
            $rival_points = $this->db->select('ans.point , stu.s_name , stu.s_serialNo')
                ->from('tbl_assignment AS ass')
                ->join('tbl_assignment_answers AS ans' , 'ans.ass_id = ass.ass_id' , 'left')
                ->join('student AS stu' , 'ans.s_id = stu.s_id' , 'left')
                ->where('ans.s_id' , $rival)
                ->get()
                ->result_array();
            $data = array(
                'assignment_times'  => 0 , 
                'total_point'       => 0 , 
                'rival_name'        => '' , 
                's_serialNo'        => '' , 
            );
            if (count($rival_points) > 0) {
                $data['rival_name'] = $rival_points[0]['s_name'];
                $data['s_serialNo'] = $rival_points[0]['s_serialNo'];
            }
            foreach ($rival_points as $rivalkey => $rivalpoint) {
                if (!empty($rivalpoint['point'])) {
                    $data['assignment_times'] ++;
                    $data['total_point'] += $rivalpoint['point'];
                }
            }
            $retVal['rival_point'][] = $data;
        }
        return $retVal;
    }
}