<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Slider_m
 *
 * @author USER
 */
class Domain_m extends MY_Model {

    protected $_table_name = 'domain';
    protected $_order_by = 'id';
    public $rules = array(
        'domain_name' => array(
            'field' => 'domain_name',
            'label' => 'Domain Name',
            'rules' => 'trim|required'
        ),
    );

    //put your code here
    public function get_new() {

        $domain = new stdClass();
        ;
        $domain->id = '';
        $domain->domain_name = '';
        $domain->package = '';
        $domain->package_summery = '';
        $domain->start_date = '';
        $domain->end_date = '';
        $domain->owner = '';
        $domain->contact_person = '';
        $domain->phone = '';
        $domain->contact_email = '';
        $domain->status = '';
        return $domain;
    }
    
    public function get_list() {
        // Fetch pages without parents
        $this->db->select('id, domain_name');
        $categorys = parent::get();

        // Return key => value pair array
        $array = array(
            '' => 'Select Domain',
        );
        if (count($categorys)) {
            foreach ($categorys as $category) {
                $array[$category->id] = $category->domain_name;
            }
        };

        return $array;
    }
    
    public function get_domain_list(){
        $this->db->select('domain.id, domain.domain_name, domain.status as domain_status');
        $this->db->select('assign.user_id, assign.status');      
        $this->db->join('assign','domain.id = assign.domain_id', 'left');
        $this->db->order_by('domain.id', 'ASC');
        return parent::get();
    }
    
    public function get_domain_list_by_parm(){
        $this->db->select('domain.domain_name, domain.status as domain_status');
        $this->db->select('assign.user_id, assign.status');      
        $this->db->join('assign','domain.id = assign.domain_id', 'left');
        $this->db->order_by('domain.id', 'ASC');
        $this->db->where(['domain.status' => 1, 'assign.status' => 1]);
        return parent::get();
    }

}
