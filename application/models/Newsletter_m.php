<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Newsletter_m
 *
 * @author Mithucn
 */
class Newsletter_m extends MY_Model {
    //put your code here
     protected $_table_name = 'newsletters';
    protected $_order_by = 'id';
    public $rules_update = array(
        'username' => array(
                'field' => 'username', 
                'label' => 'User Name', 
                'rules' => 'trim|required'
        ), 
    );
    public $rules = array(
        'title' => array(
                'field' => 'title', 
                'label' => 'Title', 
                'rules' => 'trim|required'
        ), 
       /* 'summary' => array(
                'field' => 'summary', 
                'label' => 'Summary', 
                'rules' => 'trim|required'
        ),*/
        'contant' => array(
                'field' => 'contant', 
                'label' => 'Content', 
                'rules' => 'trim|required'
        ),
    );
    
    
    //put your code here
    public function get_new(){
        
        $user = new stdClass();;
        $user->id = '';
        $user->title = '';
        //$user->summary = '';
        $user->contant = '';
        $user->image = '';
        $user->creation_date = '';
        $user->status = '';
        return $user;
    }
    
      public function newsletter_count() {
        return $this->db->count_all_results($this->_table_name);        
    }
      public function get_all_newsletter($limit, $start) {
        $this->db->select('*');
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        return parent::get();
    }
}
