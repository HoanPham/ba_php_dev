<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Classes extends MX_Controller{
 	
 	var $data = array();
    function __construct(){    	
        parent::__construct();

        $this->load_default_temp();
        // Add title
        $this->template->add_title('Konocy Garden | Teacher');
        //$this->load->model('utilities/utility_model');  
    }
    
    public function index(){        	     
    	$this->data['list_classes'] = $this->teacher_model->getListClasses();
    	$this->data['list_subjects'] = $this->teacher_model->getListSubjects();
    	$this->data['list_grades'] = $this->teacher_model->getListGrades();
    	$this->parse_data();        	
    	//echo "test";
    }    
    
    public function create_class(){    	
    	if($this->teacher_model->create_class($this->security->xss_clean($this->input->post('name')),$this->security->xss_clean($this->input->post('subject')),$this->security->xss_clean($this->input->post('grade')),$this->security->xss_clean($this->input->post('goal')),$this->security->xss_clean($this->input->post('expected_finish')))) echo "Success";
    	else echo "Failed";
    }    
        
    public function parse_data(){
    	// Parser data 
    	$this->template->parse_view("sidebar","sidebar.html",$this->data);
    	$this->template->parse_view("content","class/list_classes.html",$this->data);    	   		
        // Render template
        $this->template->render();
    }
  	
 }
 ?>