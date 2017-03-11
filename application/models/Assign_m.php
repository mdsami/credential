<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Assign_m
 *
 * @author USER
 */
class Assign_m extends MY_Model{
    
    protected $_table_name = 'assign';
    protected $_order_by = 'id';
    public $rules = array(
        'domain_id' => array(
            'field' => 'domain_id', 
            'label' => 'Domain', 
            'rules' => 'trim|required'
        )
    );

    //put your code here
    public function get_new() {

        $domain = new stdClass();
        ;
        $domain->id = '';
        $domain->domain_id = '';
        $domain->user_id = '';
        $domain->status = '';
        return $domain;
    }
    
    public function get_info() {
        $this->db->select('assign.id, assign.status');
        $this->db->select('users.username');      
        $this->db->select('domain.domain_name'); 
        $this->db->select('domain_info.title'); 
        $this->db->join('domain','assign.domain_id = domain.id', 'left');
        $this->db->join('domain_info','assign.domain_info_id = domain_info.id', 'left');
        $this->db->join('users','assign.user_id = users.id', 'left');
        $this->db->order_by('assign.id', 'ASC');
        $this->db->where('assign.status <', 2);
        $this->db->where('domain_info.id', $this->session->userdata('id'));
        return parent::get();
    }
    
    public function get_by_domain_status($where){
        
        $this->db->select('assign.id');
        $this->db->join('domain_info','assign.domain_info_id = domain_info.id', 'left');
        $this->db->order_by('assign.id', 'ASC');
        $this->db->where(['assign.domain_id' => $where['domain_id'], 'assign.user_id' => $where['user_id'], 'assign.status' => $where['status'], 'domain_info.status' => 1, ]);
        return parent::get();
    }
    
}
