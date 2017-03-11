<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_Controller
 *
 * @author Hasib
 */
class Admin_Controller extends MY_Controller{
    
    function __construct() {
        
        parent::__construct();
        ini_set('memory_limit', "5000M");
        $this->data['meta_title'] = '';
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->helper('date');
        $this->load->helper('security');
        $this->load->library('form_validation'); 
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->model('Login_m', 'login');
        $this->load->model('User_m', 'user');
        $this->load->model('Domain_m', 'domain');
        $this->load->model('Settings_m','setting');  
        $this->load->model('Credential_m','credential');
        $this->load->model('Newsletter_m','newsletter');
        $this->load->model('Newletter_setting_m','newletter_setting');
        $this->load->model('Subscribers_m','subscriber');
        $this->load->model('Assign_m','assign');
        $this->load->model('Logs_m','logs');
        
        // Login check
        $exception_uris = array(
            'login',
            'login/forget'
        );
        
        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if ($this->login->loggedin() == FALSE) {
                redirect('login');
            }
        }
        
    }
    
    //put your code here
    
    
}
