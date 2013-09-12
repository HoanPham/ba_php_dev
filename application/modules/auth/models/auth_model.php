<?php
class Auth_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
	public function getListGrades(){
    	$query = $this->db->get('grades');
    	return $query->result_array();
    }
    
	public function getListRoles(){
    	$query = $this->db->get('roles');
    	return $query->result_array();
    }
    
    public function check_user($email,$pass){    	
    	$this->db->where('email',$email);
    	$this->db->where('password',md5($pass));
    	$query = $this->db->get('person');
    	if($query->num_rows() > 0){
    		$user_info = $query->row_array();    		
    		$this->db->where('person_id',$user_info['id']);
    		$query = $this->db->get('person_roles');
    		if($query->num_rows() > 0 && $query->num_rows() <= 1){
    			$role = $query->row()->role_id;
	    		switch($query->row()->role_id){
	    			case 1:
	    				$this->db->where('person_id',$user_info['id']);
	    				$query = $this->db->get('teachers');
	    				foreach ($query->result_array() as $row);
	    				return $row['teacher_id']."\",\"".$row['display_name']."\",\"".$email."\",\"".$role;	    				
	    				break;
	    			case 2:
	    				$this->db->where('person_id',$user_info['id']);
	    				$query = $this->db->get('students');
	    				foreach ($query->result_array() as $row);
	    				return $row['student_id']."\",\"".$row['display_name']."\",\"".$email."\",\"".$role;	    				
	    				break;
	    		}    		
    		}
    		else{
    			$this->db->select('name');
    			$this->db->from('roles');
    			$this->db->join('person_roles','roles.id = person_roles.role_id');
    			$this->db->where('person_roles.person_id'.$user_info['id']);
    			$query = $this->db->get();
    			return $query->result_array()."_"."select";
    		}    		
    	}
    	else return false;
    }
    public function create_user($username,$pass,$gender,$email,$dob,$cell_number,$landline,$add,$role,$grade){
    	//echo $username." ".$pass." ".$gender." ".$email." ".$dob." ".$cell_number." ".$landline." ".$add." ".$role." ".$grade;    	
    	$data_input_person = array(
    		"password" => md5($pass),
    		"gender" => $gender,
    		"email" => $email,
    		"dob" => $dob,
    		"cell_number" => $cell_number,
    		"landline_number" => $landline,
    		"address" => $add,
    		"joined_date" => date("Y-m-d H:i:s")  		
    	);
    	$query_insert_person = $this->db->insert("person",$data_input_person);    	    	
    	$person_id = $this->db->insert_id();    	
		$data_input_user = array(
			"person_id" => $person_id,
			"display_name" => $username
		);
		$random_id = random_string("numeric",7);
    	if($role==1){
    		$data_input_user["teacher_id"] = (int)$random_id;
    		$query_input_user = $this->db->insert("teachers",$data_input_user);
    	}
    	elseif($role==2){
    		$data_input_user["student_id"] = $random_id;
    		$data_input_user["grade"] = $grade;
    		$query_input_user = $this->db->insert("students",$data_input_user);
    	} 
    	$data_input_role = array(
    		"person_id" => $person_id,
    		"role_id" => $role
    	); 
    	$query_insert_role = $this->db->insert("person_roles",$data_input_role);    	    	
		if($query_insert_person && $query_input_user && $query_insert_role){
			//$this->set_session_key($random_id,$username,$email,$role);
			return $random_id;
		}
		else return false;		
    }
    
    public function set_session_key($random_id,$username,$email,$role){
    	$data_sess = array(
    		"user_id" => $random_id,
    		"username" => $username,
    		"email" => $email,
    		"role" => $role
    	);
    	$this->session->set_userdata($data_sess);
    }
}
?>