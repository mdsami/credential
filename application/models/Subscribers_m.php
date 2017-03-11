<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of subscribers_m
 *
 * @author Mithucn
 */
class Subscribers_m extends MY_Model {
    //put your code here
      protected $_table_name = 'subscribers';
    protected $_order_by = 'id';

    public $rules = array(
        'email' => array(
                'field' => 'email', 
                'label' => 'Email', 
                'rules' => 'trim|required|valid_email|is_unique[subscribers.email]'
        )
    );
  
    //put your code here
    public function get_new(){
        
        $user = new stdClass();;
        $user->id = '';
        $user->email = '';
        $user->subscription_date = '';
        $user->unsubscribe_date = '';
        $user->status = '';
        return $user;
    }
      public function subscribers_count() {
        return $this->db->count_all_results($this->_table_name);        
    }
      public function get_all_subscribers($limit, $start) {
        $this->db->select('*');
        $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        return parent::get();
    }
    public function getAllActiveSubscribers(){
         $this->db->select('*');
        $this->db->where('status',1);
        return parent::get();
    }
 
}
