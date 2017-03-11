<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site_Settings
 *
 * @author MdRubel
 */
class Settings_m extends MY_Model {

    protected $_table_name = 'settings';
    protected $_order_by = 'id';
    public $rules = array(
        'site_title' => array(
            'field' => 'site_title',
            'label' => 'Site Title',
            'rules' => 'trim|required'
        )
        
    );
    /*
     'slogan' => array(
            'field' => 'slogan',
            'label' => 'Slogan',
            'rules' => 'trim|required'
        ),
        'site_offline' => array(
            'field' => 'site_offline',
            'label' => 'Site Offline',
            'rules' => 'trim|required'
        ),
        'offline_text' => array(
            'field' => 'offline_text',
            'label' => 'Offline Text',
            'rules' => 'trim|required'
        ),
        'meta_description' => array(
            'field' => 'meta_description',
            'label' => 'Meta Description',
            'rules' => 'trim|required'
        ),
        'meta_keyword' => array(
            'field' => 'meta_keyword',
            'label' => 'Meta Keyword',
            'rules' => 'trim|required'
        ),
        'address' => array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim|required'
        ),
        'phone_fax' => array(
            'field' => 'phone_fax',
            'label' => 'Phone Fax',
            'rules' => 'trim|required'
        ),
        'email' => array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required'
        ),
        'copy_right' => array(
            'field' => 'copy_right',
            'label' => 'Copy Right',
            'rules' => 'trim|required'
        )
     */
     

    //put your code here
    public function get_new() {

        $settings = new stdClass();
        $settings->id = '';
        $settings->site_title = '';
        $settings->logo = '';
        $settings->slogan = '';
        $settings->site_offline = '';
        $settings->offline_text = '';
        $settings->meta_description = '';
        $settings->meta_keyword = '';
        $settings->address = '';
        $settings->phone_fax = '';
        $settings->email = '';
        $settings->copy_right = '';
        $settings->google_analytic = '';

        return $settings;
    }

    public function getSetting() {
        return $this->db->select('*')->get($this->_table_name)->row();
    }

}
