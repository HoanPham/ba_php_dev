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
		$level = $this->CI->session->userdata('ses_level');
		$role = 'guest';
		switch($level){
			case '1':
				$role = 'member';
				break;
			case '2':
				$role = 'admin';
				break;
		}
		if(!$this->CI->Zend_Acl->isAllowed($role, $module . ':' . $controller, $action)){
			redirect(base_url() . 'index.php/auth/login');
		}
	}
	public function setRoles(){
		$this->CI->Zend_Acl ->addRole(new Zend_Acl_Role('teacher'))
							->addRole(new Zend_Acl_Role('student'), 'guest')
							->addRole(new Zend_Acl_Role('admin'), 'member');
	}
	public function setResources(){
		$this->CI->Zend_Acl ->add(new Zend_Acl_Resource('admin'))
							->add(new Zend_Acl_Resource('admin:cates_hai'), 'admin')
							->add(new Zend_Acl_Resource('admin:news'), 'admin')
							->add(new Zend_Acl_Resource('default'))
							->add(new Zend_Acl_Resource('default:index'), 'default')
							->add(new Zend_Acl_Resource('auth'))
							->add(new Zend_Acl_Resource('auth:auth'), 'auth');
	}
	public function setAccess(){
		$this->CI->Zend_Acl ->allow('guest', array('default', 'auth'))
							->allow('member', 'admin', 'index')
							->allow('admin', null);
	}
	
}