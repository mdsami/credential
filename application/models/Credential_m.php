<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Location_m
 *
 * @author USER
 */
class Credential_m extends MY_Model{
    
    protected $_table_name = 'domain_info';
    protected $_order_by = 'id';
    public $rules = array(
        'domain_id' => array(
            'field' => 'domain_id', 
            'label' => 'Domain', 
            'rules' => 'trim|required'
        ),
        'title' => array(
            'field' => 'title', 
            'label' => 'Credential', 
            'rules' => 'trim|required'
        ),
    );
    
    //put your code here
    public function get_new() {
        $credential = new stdClass();
        $credential->id = '';
        $credential->domain_id = '';
        $credential->title = '';
        $credential->detail = '';
        $credential->status = '';
        $credential->last_update = '';
        $credential->user_id = '';
        return $credential;
    }
    
    public function get_credential() {
        $this->db->select('domain_info.id,domain_info.last_update,domain_info.title,domain_info.status');
        $this->db->select('domain.domain_name');        
        $this->db->join('domain','domain_info.domain_id = domain.id', 'left');
        $this->db->order_by('domain.id', 'ASC');
        //$this->db->where('domain_info.user_id', $this->session->userdata('id'));
        $this->db->where('domain_info.id', $this->session->userdata('id'));
        $this->db->where('domain_info.status <', 2);
        return parent::get();
    }
    
    public function get_trashed_credential() {
        $this->db->select('domain_info.id,domain_info.last_update,domain_info.title');
        $this->db->select('domain.domain_name');        
        $this->db->join('domain','domain_info.domain_id = domain.id', 'left');
        $this->db->order_by('domain.id', 'ASC');
        $this->db->where('domain_info.id', $this->session->userdata('id'));
        $this->db->where('domain_info.status', 2);
        return parent::get();
    }
    
    public function get_list($domain_id){
        // Fetch pages without parents
        $this->db->select('id, title');
        $this->db->where('domain_id', $domain_id);
        $this->db->where('user_id', $this->session->userdata('id'));
        return $categorys = parent::get();
    }
    
}
