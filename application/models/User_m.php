<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_m
 *
 * @author USER
 */
class User_m extends MY_Model{
    protected $_table_name = 'users';
    protected $_order_by = 'id';
    public $rules_update = array(
        'username' => array(
                'field' => 'username', 
                'label' => 'User Name', 
                'rules' => 'trim|required'
        ), 
    );
    public $rules = array(
        'username' => array(
                'field' => 'username', 
                'label' => 'User Name', 
                'rules' => 'trim|required|is_unique[users.username]'
        ),
    );
    
    
    //put your code here
    public function get_new(){
        
        $user = new stdClass();;
        $user->id = '';
        $user->full_name = '';
        $user->username = '';
        $user->password = '';
        $user->email = '';
        $user->contact_no = '';
        $user->address = '';
        $user->orginal_picture = '';
        $user->thumb_picture = '';
        $user->remark = '';
        $user->user_type = '';
        $user->status = '';
        $user->date = '';
        return $user;
    }
    
    public function active_user_count() {
        return $this->db->where('status <', 2)->count_all_results("users");        
    }
    
    public function get_active_users($limit, $start) {
        $this->db->select('id, full_name, username, user_type, status');
        $this->db->where('status <', 2);
        if($this->session->userdata('user_type') === 'Administrator'){
        $this->db->where('user_type != ', 'Master');
        }
        $this->db->limit($limit, $start);
        return parent::get();
    }
    
    public function trashed_user_count() {
        return $this->db->where('status', 2)->count_all_results("users");        
    }
    
    public function get_trashed_users($limit, $start) {
        $this->db->select('id, full_name, username, user_type, status');
        $this->db->where('status', 2);
        $this->db->where('id >', 1);
        $this->db->limit($limit, $start);
        return parent::get();
    }
    
    public function get_active_user() {
        
        $this->db->select('id, full_name, username, user_type, status');
        $this->db->where('status <', 2);
        if($this->session->userdata('user_type') === 'Administrator'){
        $this->db->where('user_type != ', 'Master');
        }
        return parent::get();
        
    }
    
    public function get_user_list() {
        $this->db->select('id, username');
        $this->db->where('status', 1);
        if($this->session->userdata('user_type') === 'Administrator'){
        $this->db->where('user_type !=', 'Master');
        }
        $categorys = parent::get();

        // Return key => value pair array
        if (count($categorys)) {
            foreach ($categorys as $category) {
                $array[$category->id] = $category->username;
            }
        };

        return $array;
    }
    
    public function get_by_email($email) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row();
    }
    
    public function get_active_assign_list($id) {
        $this->db->select('id, username');
        $categorys = parent::get();
        
        $string = '';
        
        if (count($categorys)) {
            foreach ($categorys as $category) {
                $data = $this->assign->get_by(['domain_info_id' => $id, 'user_id' => $category->id]);
                
                if($data){
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                
                $string.='<option value="'.$category->id.'" '.$selected.'>'.$category->username.'</option>';
            }
        };
        
        return $string;
    }
    
}
