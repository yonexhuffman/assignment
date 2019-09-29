<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		
    }
    
    public function get_assignmentlist_checked($t_id){
    	$retVal = array();
    	$assignment_list = $this->db
    		->select('*')
    		->from('tbl_assignment')
    		->join('studentgroup' , 'studentgroup.sg_id = tbl_assignment.sg_id' , 'left')
    		->where('studentgroup.t_id' , $t_id)
    		->order_by('give_date' , 'DESC')
    		->get()
    		->result_array();
    	return $assignment_list;
    }
    
    public function get_statisticsdata($sg_id , $ass_id = -1){
        if ($ass_id > 0) {
            $criteria = array(
                'ass.ass_id'    => $ass_id , 
            );
            return $this->db
                ->select('ass.ass_id , stu.s_id , stu.s_name , stu.s_serialNo , ans.s_id , ans.point')
                ->from('tbl_assignment AS ass')
                ->join('tbl_assignment_answers AS ans' , 'ans.ass_id = ass.ass_id' , 'left')
                ->join('student AS stu' , 'ans.s_id = stu.s_id' , 'left')
                ->where($criteria)
                ->order_by('ans.point' , 'DESC')
                ->get()
                ->result_array();
        }
        else {
            $criteria = array(
                'ass.sg_id'    => $sg_id , 
            );
            $statistics_data = $this->db
                ->select('ass.ass_id , stu.s_id , stu.s_name , stu.s_serialNo , ans.s_id , ROUND(SUM(ans.point) , 1) AS total_point')
                ->from('tbl_assignment AS ass')
                ->join('tbl_assignment_answers AS ans' , 'ans.ass_id = ass.ass_id' , 'left')
                ->join('student AS stu' , 'ans.s_id = stu.s_id' , 'left')
                ->where($criteria)
                ->group_by('ans.s_id')
                ->order_by('total_point' , 'DESC')
                ->get()
                ->result_array();
            $retVal = array();
            foreach ($statistics_data as $key => $record) {
                $subcriteria = array(
                    'ans.s_id'      => $record['s_id']
                );
                $assignmentanswer_item = $this->db
                    ->select('*')
                    ->from('tbl_assignment AS ass')
                    ->join('tbl_assignment_answers AS ans' , 'ans.ass_id = ass.ass_id' , 'left')
                    ->where($subcriteria)
                    ->order_by('ass.give_date' , 'DESC')
                    ->get()
                    ->result_array();
                $buffer = array(
                    'final_point' => '' , 
                    'assignment_times'  => 0 , 
                );
                foreach ($assignmentanswer_item as $key_index => $value) {
                    if (!empty($value['point'])) {
                        if ($buffer['final_point'] == '') {
                            $buffer['final_point'] = $value['point'];
                        }
                        $buffer['assignment_times'] ++;
                    }
                }
                $retVal[] = array_merge($statistics_data[$key] , $buffer);
            }

            return $retVal;
        }
    }

}