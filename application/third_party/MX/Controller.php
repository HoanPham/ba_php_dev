<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2011 Wiredesignz
 * @version 	5.4
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	public $data = array();
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->_init($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
	}
	
	public function __get($class) {
		return CI::$APP->$class;
	}
	
	public function load_css_js(){
    	$this->template->add_css('public/css/bootstrap.css','link','screen');
    	$this->template->add_css('public/css/bootstrap-responsive.css','link','screen');
    	$this->template->add_css('public/css/style.css','link','screen');
    	$this->template->add_css('public/css/jquery-ui.css');
    	$this->template->add_js('public/js/jquery.js');
    	$this->template->add_js('public/js/jquery-ui.js');
    	//$this->template->add_js('public/js/jquery.validate.js');
    	$this->template->add_js('public/js/bootstrap.min.js');
    	$this->template->add_js('public/js/tiny_mce/tiny_mce.js');
    	
    }
    
	public function load_default_temp(){
    	$this->load->model('teacher_model');
        $this->load->library('template');
        $this->template->set_template('default');
        // Add DocType
        $this->template->add_doctype('XHTML5');        
            	        
        // Add meta
        $this->template->add_meta('viewport','width=device-width, initial-scale=1.0');
        $this->template->add_meta('keywords','Konocy');
        $this->template->add_meta('robots','noodp, noydir');
        $this->template->add_meta('robots','index, follow');
    	$this->load_css_js();
		$this->template->parse_view('navbar' , 'navbar.html' , $this->data);                    
    }
    
	public function load_question_temp(){
    	$this->load->model('teacher_model');
        $this->load->library('template');
        $this->template->set_template('question');
        // Add DocType
        $this->template->add_doctype('XHTML5');        
            	        
        // Add meta
        $this->template->add_meta('viewport','width=device-width, initial-scale=1.0');
        $this->template->add_meta('keywords','Konocy');
        $this->template->add_meta('robots','noodp, noydir');
        $this->template->add_meta('robots','index, follow');
    	$this->load_css_js();
		$this->template->parse_view('navbar' , 'navbar.html' , $this->data);                    
    }
}