<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logs
 *
 * @author USER
 */
class Logs_m extends MY_Model{
    
    protected $_table_name = 'logs';
    protected $_order_by = 'id';
    
    //put your code here
    public function get_info($domain_id = NULL) {
        
        $this->db->select('users.username');      
        $this->db->select('logs.date_time, logs.status');
        $this->db->select('domain_info.title');
        $this->db->join('domain','logs.domain_id = domain.id', 'left');
        $this->db->join('users','logs.user_id = users.id', 'left');
        $this->db->join('domain_info','logs.credential_id = domain_info.id', 'left');
        $this->db->order_by('logs.id', 'DESC');
        $this->db->where('logs.domain_id',$domain_id);
        if($this->session->userdata('user_type') != 'Master'){
        $this->db->where('domain_info.user_id', $this->session->userdata('id'));
        }
        return parent::get();
        
    }
    
}
