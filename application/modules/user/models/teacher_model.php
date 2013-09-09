<?php
class Teacher_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function getListClasses(){
    	$this->db->select('classes.name,goal,number_of_students,subject_name,grades.name');
    	$this->db->from('classes');
    	$this->db->join('class_teacher','classes.id = class_teacher.class_id');
    	$this->db->join('teacher','teacher.teacher_id = class_teacher.teacher_id');
    	$this->db->join('subjects','classes.subject_id = subjects.id');
    	$this->db->join('grades','classes.grade_id = grades.id');
    	$this->db->where('class_teacher.teacher_id',$this->session->userdata('user_id'));
    	$query = $this->db->get();
    	if($query->num_rows() > 0){
    		return $query->result_array();
    	}
    	else return false;
    }
}
?>