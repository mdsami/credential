<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Panel
 *
 * @author USER
 */
class Panel extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        
        ob_start(); 
        
        if($this->session->userdata('user_type') === 'User' || $this->session->userdata('user_type') === 'Developer'){
            redirect('index');
        }
        
        /* Get Settings */
        $this->data['setting'] = $this->setting->get(4);
    }

    //put your code here
    public function index() {
      
        $this->data["domains"] = $this->domain->get();
        
        $this->data['sub_view'] = 'panel/dashboard/index';
        $this->load->view('panel/common/_layout_main', $this->data);
    }

    public function homepage() {

        /* Get Welcomenote */
        $this->data['welcomenote'] = $this->headercontent->get_by(['status' => 1]);

        /* Get Events */

        $this->data['sub_view'] = 'panel/dashboard/homepage';
        $this->load->view('panel/common/_layout_main', $this->data);
    }

}
