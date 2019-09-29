<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AssignmentList_Model extends MY_Model {
	
    public function __construct() {
		parent::__construct();
		
    }
    
    public function get_assignmentlist($s_id , $sg_id){
    	$assignment_list = $this->db
    		->select('*')
    		->from('tbl_assignment')
    		->where('tbl_assignment.sg_id' , $sg_id)
    		->order_by('give_date' , 'DESC')
            ->order_by('tbl_assignment.ass_id' , 'DESC')
    		->get()
    		->result_array();

    	return $assignment_list;
    }

    public function get_answer_data($s_id , $ass_id) {
        $retVal = array();
    	$problem_answer = $this->db
    		->select('*')
    		->from('tbl_assignment')
    		->join('tbl_assignment_answers' , 'tbl_assignment_answers.ass_id = tbl_assignment.ass_id' , 'left')
    		->where('tbl_assignment.ass_id' , $ass_id)
    		->where('tbl_assignment_answers.s_id' , $s_id)
    		->get()
    		->row_array();

        $ass_files = $this->db
            ->select('tbl_ass_files.*')
            ->from('tbl_ass_files')
            ->where('tbl_ass_files.ass_id' , $ass_id)
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

    public function get_referencefiles($sg_id) {
        $referencefiles = $this->db
            ->select('ass_id , ref_file , ref_file_type')
            ->from('tbl_assignment')
            ->where('sg_id' , $sg_id)
            ->where('ref_file != ' , NULL)
            ->order_by('give_date' , 'DESC')
            ->order_by('tbl_assignment.ass_id' , 'DESC')
            ->get()
            ->result_array();

        return $referencefiles;
    }

}