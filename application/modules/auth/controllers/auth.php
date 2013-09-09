<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends MX_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function login(){
		$err = '';
		if(isset($_POST['ok'])){
			$u = $_POST['txtuser'];
			$p = $_POST['txtpass'];
			if($u == 'admin' && $p == '123456'){
				$item = array(
							'ses_username' => admin,
							'ses_level' => 2,
				);
				$this->session->set_userdata($item);
				redirect(base_url() . 'admin/cates');
			}
			if($u == 'member' && $p == '123456'){
				$item = array(
							'ses_username' => admin,
							'ses_level' => 1,
				);
				$this->session->set_userdata($item);
				redirect(base_url() . 'index.php/admin/cates');
			}
		}
		$this->load->view('login.html', $data);
	}
	public function logout(){
		$this->session->sess_destroy();
	}
}