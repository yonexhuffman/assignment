<?php defined('BASEPATH') OR exit('No direct script access allowed');

class GivePoint_Model extends MY_Model {
	public function __construct() {
		parent::__construct();
		
    }
    
    public function get_assignmentlist($t_id){
    	$assignment_list = $this->db
    		->select('*')
    		->from('tbl_assignment')
    		->where('tbl_assignment.t_id' , $t_id)
    		->order_by('give_date' , 'DESC')
    		->get()
    		->result_array();

    	return $assignment_list;
    }

    public function get_assignment_studentlist($ass_id) {
        $student_list = $this->db->select('student.s_id , student.s_name')
            ->from('tbl_assignment')
            ->join('tbl_assignment_answers' , 'tbl_assignment_answers.ass_id = tbl_assignment.ass_id' , 'left')
            ->join('student' , 'tbl_assignment_answers.s_id = student.s_id' , 'left')
            ->where('tbl_assignment.ass_id' , $ass_id)
            ->order_by('student.s_name' , 'ASC')
            ->get()
            ->result_array();
        return $student_list;
    }

    public function get_assignment_answer($criteria) {
        $retVal = array();
    	$problem_answer = $this->db
    		->select('tbl_assignment.* , tbl_assignment_answers.* , student.s_name , student.s_serialNo')
    		->from('tbl_assignment')
    		->join('tbl_assignment_answers' , 'tbl_assignment_answers.ass_id = tbl_assignment.ass_id' , 'left')
            ->join('student' , 'tbl_assignment_answers.s_id = student.s_id' , 'left')
    		->where('tbl_assignment.ass_id' , $criteria['ass_id']);

        if (isset($criteria['s_id'])) {
            $problem_answer = $problem_answer->where('tbl_assignment_answers.s_id' , $criteria['s_id']);
        }

		$problem_answer = $problem_answer
            ->order_by('tbl_assignment.give_date' , 'DESC')
            ->order_by('student.s_name' , 'ASC')
    		->get()
    		->row_array();

            
        $ass_files = $this->db
            ->select('tbl_ass_files.*')
            ->from('tbl_ass_files')
            ->where('tbl_ass_files.ass_id' , $criteria['ass_id'])
            ->get()
            ->result_array();

        $ans_id = $problem_answer['ans_id'];
        $ans_files = $this->db
            ->select('tbl_ans_files.*')
            ->from('tbl_ans_files')
            ->where('tbl_ans_files.ans_id' , $ans_id)
            ->get()
            ->result_array();
        $retVal['data'] = $problem_answer;
        $retVal['ass_files'] = $ass_files;
        $retVal['ans_files'] = $ans_files;
        
    	return $retVal;
    }

}