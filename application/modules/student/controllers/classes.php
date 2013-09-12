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
    	//print_r($this->data['news_detail']);
    	//$this->parse_data();
    	$this->template->parse_view("sidebar","sidebar.html",$this->data);
    	$this->template->parse_view("content","class/content.html",$this->data);
    	$this->template->render();
    }
    /*
    public function parse_data(){
    	// Parser data 
    	$this->template->parse_view('center_bottom' , 'default/template/center_bottom.html' , $this->data);
		$this->template->parse_view('slider' , 'default/home/slider.html' , $this->data); 
		$this->template->parse_view('post_content' , 'default/home/post_content.html' , $this->data);
        $this->template->parse_view('listpj' , 'default/home/listpj.html' , $this->data);
        $this->template->parse_view('listnews' , 'default/template/listnews.html' , $this->data);
        $this->template->parse_view('support' , 'default/template/support.html' , $this->data);
        $this->template->parse_view('sidebar_news' , 'default/template/sidebar_news.html' , $this->data);
        $this->template->parse_view('sidebar_adv' , 'default/template/sidebar_adv.html' , $this->data);
        //$this->template->parse_view('tags' , 'default/template/tags.html' , $this->data);
        $this->template->parse_view('footer' , 'default/template/footer.html' , $this->data);     		
        // Render template
        $this->template->render();
    }
  	*/
 }
 ?>