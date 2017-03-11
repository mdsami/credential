<?php
class Frontend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();
		
		// Load stuff
		$this->load->library('form_validation');
		$this->load->helper('text');
                /*$this->load->model('Headercontent_m', 'headercontent');
                $this->load->model('Aboutcontent_m', 'aboutcontent');
                $this->load->model('Contact_setting_m', 'contact_setting');
		$this->load->model('Slider_m', 'slider');
                $this->load->model('Settings_m','setting'); */ 
		ini_set('memory_limit', "20000M");
	}
      
}