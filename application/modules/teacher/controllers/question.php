<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Question extends MX_Controller{
 	
 	var $data = array();
    function __construct(){    	
        parent::__construct();

        $this->load_question_temp();
        // Add title
        $this->template->add_title('Konocy Garden | Teacher');
        /* Add BA css */
        $this->template->add_css('public/css/create_question.css');
        
        /* Add third-party css */
        $this->template->add_css('public/css/bootstrap-toggle.min.css');
        
        /* Add BA js */
        $this->template->add_js('public/js/multichoice_constraints.js');
        $this->template->add_js('public/js/preview.js');
        $this->template->add_js('public/js/ajax_slide_animation.js');
        $this->template->add_js('public/js/auto_add_div.js');        
        $this->template->add_js('public/js/ba_form_submit.js');
        //$this->template->add_js('public/js/ba_validation.js');
        
        /* Add third-party js */
        $this->template->add_js('public/js/jquery.autosize.js');
        $this->template->add_js('public/js/idle-timer.js');
        $this->template->add_js('public/js/config.js');
        $this->template->add_js('public/js/bootstrap-toggle.min.js');
        $this->template->add_js('public/js/tiny_mce/plugins/asciimath/js/ASCIIMathMLwFallback.js');
        //$this->load->model('utilities/utility_model');  
    }

    public function load_common_data(){
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
    }
    
    public function index(){   
    	/* Load common data */ 	        	     
    	$this->load_common_data();

    	/* Load questions list */
	    $this->data['list_questions'] = $this->teacher_model->getListQuestions();  

	    /* Render template view */
    	$this->parse_data(); 
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
    	$choice_array = $this->utf8Urldecode($this->input->post('choice_array'));
    	$choice_array = explode(',"""',$choice_array);
    	$choice_right_array = explode(',',$this->input->post('choice_right_array'));
    	$explain_array = explode(',"""',$this->input->post('explain_array'));
    	$point_array = explode(',',$this->input->post('point_array'));   	
    	$question_content = $this->utf8Urldecode($question_content);    	
    	$question_id = $this->teacher_model->create_question($question_type,$no_right_choice,$right_answer,$subject,$grade,$curriculum,$suffle,$question_content,$detailed_answer_array,$hint_array,$choice_array,$choice_right_array,$explain_array,$point_array);    	
    	/*  	
    	$orders = range(0, count($choice_array)-1);
		shuffle($orders);
		foreach ($orders as $order) {
   			echo $choice_array[$order]."\n";
		}
		*/    		
    	if($question_id) echo $question_id;
    	else echo "Failed";
    }
    
    public function edit_question(){
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
    	$question_id = $this->input->post('question_id');	
    	/*  	
    	$orders = range(0, count($choice_array)-1);
		shuffle($orders);
		foreach ($orders as $order) {
   			echo $choice_array[$order]."\n";
		}
		*/    		
    	if($this->teacher_model->edit_question($question_id,$question_type,$no_right_choice,$right_answer,$subject,$grade,$curriculum,$suffle,$question_content,$detailed_answer_array,$hint_array,$choice_array,$choice_right_array,$explain_array,$point_array)) echo "Success";
    	else echo "Failed";
    }
	
    public function delete_question(){
    	if($this->teacher_model->delete_question($this->input->post('question_id'))) echo "Success";
    	else echo "Failed";	
    }
    
    public function load_data_manage_question(){
    	/* Load questions list */
    	$this->data['list_questions'] = $this->teacher_model->getListQuestions();

    	/* Render template view */
    	$this->template->write_view("manage_question","question/manage_question.html",$this->data,TRUE);    	
    	echo $this->template->render('manage_question');
    	echo "<script src=\"".base_url()."public/js/ajax_slide_animation.js\"></script>"; 
    }
    
    public function load_data_create_question(){
    	/* Load common data */
    	$this->load_common_data();
    	
    	/* Render template view */
    	$this->template->write_view('tab_question_type','question/tab_question_type.html',$this->data,TRUE);
    	$this->template->write_view('tab_multichoice_question_type','question/tab_multichoice_question_type.html',$this->data,TRUE);
    	$this->template->write_view('multichoice_trad','question/multichoice_trad.html',$this->data,TRUE);
    	$this->template->write_view('multichoice_fullpoint','question/multichoice_fullpoint.html',$this->data,TRUE);
    	$this->template->write_view('multichoice_partpoint','question/multichoice_partpoint.html',$this->data,TRUE);
    	$this->template->write_view('short_answer','question/short_answer.html',$this->data,TRUE);
    	$this->template->write_view('cloze','question/cloze.html',$this->data,TRUE);
    	echo $this->template->render('tab_question_type');
    	echo $this->template->render('tab_multichoice_question_type');
    	echo $this->template->render('multichoice_trad');
    	echo $this->template->render('multichoice_fullpoint');
    	echo $this->template->render('multichoice_partpoint');
    	echo $this->template->render('short_answer'); 
    	echo $this->template->render('cloze');  
    	echo "<script src=\"".base_url()."public/js/multichoice_constraints.js\"></script>";
    	echo "<script>$('textarea').autosize(); </script>";  
    	echo "<script src=\"".base_url()."public/js/ajax_slide_animation.js\"></script>"; 	
    	echo "<script src=\"".base_url()."public/js/config.js\"></script>";
    	echo "<script src=\"".base_url()."public/js/auto_add_div.js\"></script>";
    	echo "<script src=\"".base_url()."public/js/preview.js\"></script>";    	
		//echo "test";		
		//$this->template->render();
    }
    
    public function load_data_edit_question(){
    	/* Load common data */
    	$this->load_common_data();
    	$this->data['question_id'] = $this->input->post('question_id');
    	$this->data['type_id'] = $this->input->post('question_type_id');
    	
    	/* Load question data */
    	$specific_questions = $this->teacher_model->getSpecificQuestion($this->input->post('question_id'));
    	foreach($specific_questions as $row);
    	$this->data['question_content'] = $row['question_content'];
    	$this->data['subject_id'] = $row['subject_id'];
    	$this->data['grade_id'] = $row['grade_id'];
    	$this->data['curriculum_type_id'] = $row['curriculum_type_id'];
    	$this->data['shuffle'] = $row['shuffle_or_fix'];
    	$this->data['no_right_choice'] = $row['no_right_choice'];
    	if($row['no_right_choice']==1) $this->data['question_right_answer'] = $this->teacher_model->getQuestionRightAnswer($this->input->post('question_id'));
    	$this->data['hints'] = explode("$$$", $row['hint']);
    	$this->data['detailed_answers'] = explode("$$$", $row['answer']);
    	
    	/* Load question's choices data */
    	$this->data['choices'] = $this->teacher_model->getSpecificQuestionMultichoices($this->input->post('question_id'));        	    	
    	
    	/* Render template view */
    	$this->template->write_view('tab_question_type','question/tab_question_type.html',$this->data,TRUE);
    	$this->template->write_view('tab_multichoice_question_type','question/tab_multichoice_question_type_edit.html',$this->data,TRUE);
    	echo $this->template->render('tab_question_type');
    	echo $this->template->render('tab_multichoice_question_type');
    	switch ($this->data['type_id']){
    		case "0101":
	    		$this->template->write_view('multichoice_trad','question/multichoice_trad_edit.html',$this->data,TRUE);
	    		echo $this->template->render('multichoice_trad');
	    		break;     	
    		case "0104":
    			$this->template->write_view('multichoice_fullpoint','question/multichoice_fullpoint_edit.html',$this->data,TRUE);
    			echo $this->template->render('multichoice_fullpoint'); 	
    			break;	
    		case "0105":
    			$this->template->write_view('multichoice_partpoint','question/multichoice_partpoint_edit.html',$this->data,TRUE);
    			echo $this->template->render('multichoice_partpoint');
    			break;	   
    	}	        	    	  
    	echo "<script src=\"".base_url()."public/js/multichoice_constraints.js\"></script>";    	
    	echo "<script>$('textarea').autosize(); </script>";
    	echo "<script src=\"".base_url()."public/js/ajax_slide_animation.js\"></script>"; 	
    	echo "<script src=\"".base_url()."public/js/config.js\"></script>";
    	echo "<script src=\"".base_url()."public/js/auto_add_div.js\"></script>";
    	echo "<script src=\"".base_url()."public/js/preview.js\"></script>";    	
    } 

    public function load_data_preview_question(){
    	/* Load common data */
    	$this->load_common_data();
    	$this->data['question_id'] = $this->input->post('question_id');
    	$this->data['type_id'] = $this->input->post('question_type_id');
    	
    	/* Load question data */
    	$specific_questions = $this->teacher_model->getSpecificQuestion($this->input->post('question_id'));
    	foreach($specific_questions as $row);
    	$this->data['question_content'] = $row['question_content'];
    	$this->data['subject_id'] = $row['subject_id'];
    	$this->data['grade_id'] = $row['grade_id'];
    	$this->data['curriculum_type_id'] = $row['curriculum_type_id'];
    	$this->data['shuffle'] = $row['shuffle_or_fix'];
    	$this->data['no_right_choice'] = $row['no_right_choice'];
    	if($row['no_right_choice']==1) $this->data['question_right_answer'] = $this->teacher_model->getQuestionRightAnswer($this->input->post('question_id'));
    	$this->data['hints'] = explode("$$$", $row['hint']);
    	$this->data['detailed_answers'] = explode("$$$", $row['answer']);
    	
    	/* Load question's choices data */
    	$this->data['choices'] = $this->teacher_model->getSpecificQuestionMultichoices($this->input->post('question_id'));        	    	    	
    	
    	/* Render view */
    	if($this->input->post('preview_type')=="modal"){
    		$this->load->view('question/modal_preview_question.html',$this->data);
    	}
    	if($this->input->post('preview_type')=="quick"){
    		$this->load->view('question/quick_preview_question.html',$this->data);
    	}
    	echo "<script src=\"".base_url()."public/js/config.js\"></script>";      	       	 
    }
    
    public function parse_data(){
    	// Parser data 
    	$this->template->parse_view("sidebar","sidebar.html",$this->data);
    	$this->template->parse_view("tab_question_type","question/tab_question_type.html",$this->data);
		$this->template->parse_view("tab_multichoice_question_type","question/tab_multichoice_question_type.html",$this->data);
		$this->template->parse_view("multichoice_trad","question/multichoice_trad.html",$this->data);
		$this->template->parse_view("multichoice_fullpoint","question/multichoice_fullpoint.html",$this->data);
		$this->template->parse_view("multichoice_partpoint","question/multichoice_partpoint.html",$this->data);
		$this->template->parse_view("short_answer","question/short_answer.html",$this->data);
		$this->template->parse_view("cloze","question/cloze.html",$this->data);
		$this->template->parse_view("manage_question","question/manage_question.html",$this->data);
        // Render template
        $this->template->render();
    }
  	
 }
 ?>