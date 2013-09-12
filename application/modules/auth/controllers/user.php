<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller{
	var $data = array();
	function __construct(){
		parent::__construct();		
		$this->load->model('auth_model');		
	}
	public function login(){
		if($this->input->post('submit')){
			$email = $this->input->post('email');
			$pass = $this->input->post('pass');
			$string_response = $this->auth_model->check_user($email,$pass);
			if($string_response){				
				$array = explode("\",\"", $string_response);				
				$this->auth_model->set_session_key($array['0'],$array['1'],$array['2'],$array['3']);				
				switch ($array['3']){
					case 1:						
						echo base_url() . 'teacher/question';
						break;
					case 2:
						echo base_url() . 'student/classes';
						break;
				}				
			}			
			else echo "Failed";
		}
		else $this->load->view('login.html',$this->data);
	}
	public function signup(){
		if ($this->input->post('submit')){
			$username = $this->input->post('username');
			$pass = $this->input->post('pass');
			$gender = $this->input->post('gender');
			$email = $this->input->post('email');
			$dob = $this->input->post('dob');
			$cell_number = $this->input->post('cell_number');
			$landline = $this->input->post('landline');
			$add = $this->input->post('add');
			$role = $this->input->post('role');
			$grade = $this->input->post('grade');
			$random_id = $this->auth_model->create_user($username,$pass,$gender,$email,$dob,$cell_number,$landline,$add,$role,$grade);			
			if($random_id){								
				$this->auth_model->set_session_key($random_id,$username,$email,$role);
				switch ($role){
					case 1:
						echo base_url() . 'teacher/question';
						break;
					case 2:
						echo base_url() . 'student/classes';
						break;
				}
			}
			else echo "Failed";
		}
		else{
			$this->data['list_grades'] = $this->auth_model->getListGrades();
			$this->data['list_roles'] = $this->auth_model->getListRoles();
			$this->load->view('signup.html', $this->data);
		}		
	}
	public function logout(){
		$this->session->sess_destroy();
	}
}