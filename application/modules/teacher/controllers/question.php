<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Question extends MX_Controller{
 	
 	var $data = array();
    function __construct(){    	
        parent::__construct();

        $this->load_default_temp();
        // Add title
        $this->template->add_title('Konocy Garden | Teacher');
        /* Add BA css */
        $this->template->add_css('public/css/create_question.css');
        
        /* Add third-party css */
        $this->template->add_css('public/css/bootstrap-toggle.min.css');
        
        /* Add BA js */
        $this->template->add_js('public/js/multichoice_constraints.js');
        $this->template->add_js('public/js/preview.js');
        $this->template->add_js('public/js/auto_add_div.js');        
        $this->template->add_js('public/js/ba_form_submit.js');
        //$this->template->add_js('public/js/ba_validation.js');
        
        /* Add third-party js */
        $this->template->add_js('public/js/jquery.autosize.js');
        $this->template->add_js('public/js/tinymce_init.js');
        $this->template->add_js('public/js/bootstrap-toggle.min.js');
        $this->template->add_js('public/js/tiny_mce/plugins/asciimath/js/ASCIIMathMLwFallback.js');
        //$this->load->model('utilities/utility_model');  
    }
    
    public function index(){    	        	     
    	//$this->data['list_classes'] = $this->teacher_model->getListClasses();
    	$this->data['list_subjects'] = $this->teacher_model->getListSubjects();
    	$this->data['list_grades'] = $this->teacher_model->getListGrades();
    	$this->data['list_curriculum'] = $this->teacher_model->getListCurriculum();
    	$this->data['tag_area'] = $this->teacher_model->show_create_tag_area();
    	$this->data['list_question_types'] = $this->teacher_model->getListQuestionTypes();
    	$i = 0;
    	foreach($this->data['list_question_types'] as $row){
    		$this->data['type'.$i] = $row['id'];
    		$i++;
    	}
    	$this->parse_data();        	
    	//echo "test";
    }  
    
	function utf8Urldecode($value){
	    if (is_array($value)) {
	        foreach ($value as $key => $val) {
	            $value[$key] = utf8Urldecode($val);
	        }
	    } else {
	        $value = preg_replace('/%([0-9a-f]{2})/ie', 'chr(hexdec($1))', (string) $value);
	    }
	    return $value;
	}

    public function create_question(){
    	//echo "test";
    	
    	/*    	
    	if($this->teacher_model->create_class($this->security->xss_clean($this->input->post('name')),$this->security->xss_clean($this->input->post('subject')),$this->security->xss_clean($this->input->post('grade')),$this->security->xss_clean($this->input->post('goal')),$this->security->xss_clean($this->input->post('expected_finish')))) echo "Success";
    	else echo "Failed";
    	*/    	
    	$question_type = $this->input->post('type');
    	$subject = $this->input->post('subject');
    	$grade = $this->input->post('grade');
    	$suffle = $this->input->post('suffle');
    	$curriculum = $this->input->post('curriculum');
    	$no_right_choice = $this->input->post('no_right_choice');
    	$right_answer = $this->input->post('right_answer');
    	$question_content = $this->input->post('question_content');
    	$detailed_answer_array = explode(',"""',$this->input->post('detailed_answer_array'));
    	$hint_array = explode(',"""', $this->input->post('hint_array'));
    	$choice_array = explode(',"""',$this->input->post('choice_array'));
    	$choice_right_array = explode(',',$this->input->post('choice_right_array'));
    	$explain_array = explode(',"""',$this->input->post('explain_array'));
    	$point_array = explode(',',$this->input->post('point_array'));   	
    	$question_content = $this->utf8Urldecode($question_content);    	
    	/*  	
    	$orders = range(0, count($choice_array)-1);
		shuffle($orders);
		foreach ($orders as $order) {
   			echo $choice_array[$order]."\n";
		}
		*/
    	/*
    	switch ($type){
    		case "full_point":    			
    			$question_type = '0104';
    			break;
    		case "part_point":
    			$question_type = '0105';
    			break;
    		case "trad":
    			$question_type = '0101';
    			break;	
    		case "short":
    			$question_type = '0200';
    			break;	
    		case "cloze":
    			$question_type = '0300';
    			break;	
    	} 
    	*/
    	//echo $question_content;
    	//if(count($choice_right_array)==1 && type!="trad") $question_type = '0103';
    	//echo $this->teacher_model->create_question($question_type,$no_right_choice,$right_answer,$subject,$grade,$curriculum,$suffle,$question_content,$detailed_answer_array,$hint_array,$choice_array,$choice_right_array,$explain_array,$point_array);
    	//print_r($choice_right_array);  	
    	if($this->teacher_model->create_question($question_type,$no_right_choice,$right_answer,$subject,$grade,$curriculum,$suffle,$question_content,$detailed_answer_array,$hint_array,$choice_array,$choice_right_array,$explain_array,$point_array)) echo "Success";
    	else echo "Failed";
    }    
        
    public function parse_data(){
    	// Parser data 
    	$this->template->parse_view("sidebar","sidebar.html",$this->data);
    	$this->template->parse_view("content","question/create_question.html",$this->data);    	   		
        // Render template
        $this->template->render();
    }
  	
 }
 ?>