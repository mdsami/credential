<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Newletter_setting_m
 *
 * @author Mithucn
 */
class Newletter_setting_m extends MY_Model {
    //put your code here
    //put your code here
     protected $_table_name = 'newsletter_setting';
    protected $_order_by = 'id';
    public $rules = array(
        'smtp_host' => array(
                'field' => 'smtp_host', 
                'label' => 'SMTP HOST', 
                'rules' => 'trim|required'
        ), 
        'smtp_port' => array(
                'field' => 'smtp_port', 
                'label' => 'SMTP PORT', 
                'rules' => 'trim|required'
        ),
        'email' => array(
                'field' => 'email', 
                'label' => 'Email', 
                'rules' => 'trim|required|valid_email'
        ),
          'password' => array(
                'field' => 'password', 
                'label' => 'Password', 
                'rules' => 'trim|required'
        ),
    );
    
    
    //put your code here
    public function get_new(){
        
        $setting = new stdClass();;
        $setting->id = '';
        $setting->smtp_host = '';
        $setting->smtp_port = '';
        $setting->email = '';
        $setting->password = '';
        return $setting;
    }
    public function getSetting(){     
                return $this->db->select('*')->get($this->_table_name)->row();
    }
  
}
