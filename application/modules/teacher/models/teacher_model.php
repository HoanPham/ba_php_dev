<?php
class Teacher_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function getListClasses(){
    	$this->db->select('classes.name as class_name,goal,number_of_students,subject_name,grades.name as grade_name');
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
    
    public function getListSubjects(){
    	$query = $this->db->get('subjects');
    	return $query->result_array();
    }
    
	public function getListGrades(){
    	$query = $this->db->get('grades');
    	return $query->result_array();
    }
    
    public function getListCurriculum(){
    	$query = $this->db->get('curriculum_types');
    	return $query->result_array();	
    }
    
    public function getListQuestionTypes(){
    	$query = $this->db->get('question_types');
    	return $query->result_array();    	
    }
    
    public function create_class($name,$subject,$grade,$goal,$expected_finish){
    	$create_date = date("Y-m-d H:i:s");
    	$quickcode = random_string("alnum",5);
    	$data_input = array(
    		"name"=>$name,
    		"quick_code"=>$quickcode,
    		"goal"=>$goal,
    		"subject_id"=>$subject,
    		"grade_id"=>$grade,
    		"date_created"=>$create_date,
    		"expected_end_date"=>$expected_finish
    	);
    	$query_insert_class = $this->db->insert("classes",$data_input);  
    	$data_input_class = array(
    		"class_id" => $this->db->insert_id(),    	
    	);  	
    	switch ($role){
    		case 1:
    			$data_input_class['teacher_id'] = $this->session->userdata('user_id');
    			$query_insert_class_user = $this->db->insert("class_teacher",$data_input_class); 
    			break;
    		case 2:
    			$data_input_class['student_id'] = $this->session->userdata('user_id');
    			$query_insert_class_user = $this->db->insert("class_student",$data_input_class); 
    			break;
    	}    	
    	return ($query_insert_class && $query_insert_class_user);
    }
    
    public function create_question($question_type,$no_right_choice,$right_answer,$subject,$grade,$curriculum,$suffle,$question_content,$detailed_answer_array,$hint_array,$choice_array,$choice_right_array,$explain_array,$point_array){
    	$check_insert = 0;
    	$hint_string = "";
    	$detailed_string = "";
    	$data_input_v12_question = array(
    		"subject_id" => $subject,
    		"has_hint" => (isset($hint_array) && $hint_array!=null) ? 1 : 0,
    		"content" => $question_content,
    		"author_id" => $this->session->userdata('user_id'),
    		"typist_id" => $this->session->userdata('user_id'),
    		"grade_id" => $grade,
    		"curriculum_type_id" => $curriculum,
    		"number_of_answers" => count($choice_array),
    		"no_right_choice" => $no_right_choice,
    		"shuffle_or_fix" => $suffle    		
    	);
    	$query_insert_v12_question = $this->db->insert("v12_question",$data_input_v12_question); 
    	$question_id = $this->db->insert_id();
		$data_input_question_type = array(
			"question_id" => $question_id,
			"question_type_id" => $question_type
		);
		$query_insert_question_type = $this->db->insert("questions_question_types",$data_input_question_type);								
		
		for($i=0;$i<count($detailed_answer_array);$i++){
			if(array_key_exists($i,$detailed_answer_array)){
				$detailed_string .= "<!--Step".($i+1)."-->".$detailed_answer_array[$i]."<!--End step".($i+1)."-->"."<br>";				
			}
		}
    	for($i=0;$i<count($hint_array);$i++){
			if(array_key_exists($i,$hint_array)){
				$hint_string .= "<!--Step".($i+1)."-->".$hint_array[$i]."<!--End step".($i+1)."-->"."<br>";				
			}
		}	
		$data_input_detailed_answer = array(
			"question_id" => $question_id,
			"author_type" => 1,
			"author_id" => $this->session->userdata('user_id'),
			"answer" => $detailed_string
		);	
		$data_input_hint = array(
			"question_id" => $question_id,
			"hint" => $hint_string
		);
		$query_insert_detailed_answer = $this->db->insert("detailed_answers",$data_input_detailed_answer);				
		$query_insert_hint = $this->db->insert("question_hints",$data_input_hint);	
		if($question_type=="0101"||$question_type=="0103"||$question_type=="0104"||$question_type=="0105"){
			for($i=0;$i<count($choice_array);$i++){
				$data_input_choices = array(
					"question_id" => $question_id,
					"order" => $i+1,
					"content" => $choice_array[$i],
					"is_right" => $choice_right_array[$i]
				);
				if(isset($explain_array) && $explain_array!=null && array_key_exists($i,$explain_array)){
					$data_input_choices["explaination"] = $explain_array[$i];
				}
				if($question_type==0105){
					$data_input_choices["graded_point"] = $point_array[$i];
				}
				if($this->db->insert("question_multichoice_choices",$data_input_choices)==false) $check_insert++;			
			}	
		}						
		if($no_right_choice==1){
			$data_input_right_answer = array(
				"question_id" => $question_id,
				"answer" => $right_answer
			);
			$query_insert_right_answer = $this->db->insert("question_right_answers",$data_input_right_answer);
		}
		else $query_insert_right_answer = true;
		if($query_insert_detailed_answer && $query_insert_hint && $query_insert_v12_question && $query_insert_question_type && $query_insert_right_answer && $check_insert==0) return true;
		else return false;
    }
    
    public function show_create_tag_area(){
    	return "<div class='row-fluid' style='padding:0;text-align: center;'>
					<div class='span4' style='padding:7px;margin-left: 12px;border-right: 1px solid #ccc;'>
						<div class='page-header' style='margin: 0px;border:none'>
							<h4 style='font-size: 15px;text-align: center;'>Đơn vị kiến thức</h4>
						</div>
						<form>
							<fieldset>
								<input type='text' class='span11'>
							</fieldset>
						</form>
					</div>
					<div class='span4' style='padding:7px;border-right: 1px solid #ccc;'>
						<div class='page-header' style='margin: 0px;border:none'>
							<h4 style='font-size: 15px;text-align: center;'>Phương pháp</h4>
						</div>
						<form>
							<fieldset>
								<input type='text' class='span11'>
							</fieldset>
						</form>
					</div>
					<div class='span4' style='padding:7px;'>
						<div class='page-header' style='margin: 0px;border:none'>
							<h4 style='font-size: 15px;text-align: center;'>Tag</h4>
						</div>
						<form>
							<fieldset>
								<input type='text' class='span11'>
							</fieldset>
						</form>
					</div>
				</div>";
    }
}
?>