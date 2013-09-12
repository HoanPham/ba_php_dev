<?php
class Access{
	public $CI;
	public function __construct(){
		$this->CI =& get_instance();
	}
	public function start(){		
		$this->CI->zend->load('Zend_Acl');
		$this->setRoles();
		$this->setResources();
		$this->setAccess();		
		$module = $this->CI->router->fetch_module();
		$controller = $this->CI->router->fetch_class();
		$action = $this->CI->router->fetch_method();				
		$user_role = $this->CI->session->userdata('role');				
		$role = 'guest';			
		switch($user_role){
			case 1:
				$role = 'teacher';
				break;
			case 2:
				$role = 'student';
				break;
			case 3:
				$role = 'admin';
				break;
		}	
		if(!$this->CI->Zend_Acl->isAllowed($role, $module . ':' . $controller, $action)){
			//echo "test";
			redirect(base_url() . 'auth/user/login');
		}	
	}
	public function setRoles(){		
		$this->CI->Zend_Acl ->addRole(new Zend_Acl_Role('teacher'))
							->addRole(new Zend_Acl_Role('student'))
							->addRole(new Zend_Acl_Role('admin'))
							->addRole(new Zend_Acl_Role('guest'));
	}
	public function setResources(){
		$this->CI->Zend_Acl ->add(new Zend_Acl_Resource('teacher'))
							->add(new Zend_Acl_Resource('teacher:classes'), 'teacher')
							->add(new Zend_Acl_Resource('teacher:question'), 'teacher')
							->add(new Zend_Acl_Resource('student'))
							->add(new Zend_Acl_Resource('student:student'), 'student')
							->add(new Zend_Acl_Resource('auth'))
							->add(new Zend_Acl_Resource('auth:user'), 'auth');
	}
	public function setAccess(){
		$this->CI->Zend_Acl ->allow('teacher', 'teacher')
							->allow('student', 'student')
							->allow('admin', null)
							->allow('guest', 'auth');
	}
}