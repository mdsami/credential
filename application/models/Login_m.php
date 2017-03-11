<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Hasib
 */
class Login_M extends MY_Model{
    
    protected $_table_name = 'users';
    protected $_order_by = 'user_type';
    public $rules_login = array(
            'username' => array(
                    'field' => 'username', 
                    'label' => 'Username', 
                    'rules' => 'trim|required'
            ), 
            'password' => array(
                    'field' => 'password', 
                    'label' => 'Password', 
                    'rules' => 'trim|required'
            )
    );    
    public $rules_forget = array(
            'email' => array(
                    'field' => 'email', 
                    'label' => 'Email', 
                    'rules' => 'trim|required'
            ),
    );        
    
    function __construct() {
        parent::__construct();
    }
    
    //put your code here
    public function login ()
    {
        $username = $this->input->post('username');
        $password = $this->hash($this->input->post('password'));
        
        $query_result = $this->db->select('*')
            ->where("(users.username = '$username' OR users.email = '$username') AND users.password = '$password' ")
            ->get('users');
        $user = $query_result->row();
        
        if (count($user)) {
            // Log in user
            $data = array(
                'username' => $user->username,                
                'user_type' => $user->user_type,
                'status' => $user->status,
                'id' => $user->id,
                'loggedin' => TRUE,
            );
            $this->session->set_userdata($data);
            return TRUE;
        }

    // If we get to here then login did not succeed
    return FALSE;
    }
    
    public function loggedin ()
    {
        return (bool) $this->session->userdata('loggedin');
    }

    public function logout ()
    {
        $this->session->sess_destroy();// Log in user
    }

    public function hash ($string)
    {
        return hash('sha512', $string . config_item('encryption_key'));
    }
    
    public function member_count() {
        $this->db->where('user_type','user');
        return $this->db->count_all("applied_list");
    }
    
    public function get_user() {
        
        $this->db->select('users.id');
        $this->db->select('user_personal_details.name');
        $this->db->select('user_employment_history.position_held, user_employment_history.company_name');
        $this->db->select('user_upload.upload');
        $this->db->where('users.user_type', 'user');
        $this->db->join('user_personal_details','user_personal_details.user_id = users.id', 'left');
        $this->db->join('user_employment_history','user_employment_history.user_id = users.id', 'left');
        $this->db->join('user_upload','user_upload.user_id = users.id', 'left');
        $this->db->group_by('users.id');
        $this->db->order_by("users.id", "DESC");
        $this->db->limit(5);
        $query_result = $this->db->get('users');
        return $result = $query_result->result();
        
        
        $this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
        $this->db->join('pages as p', 'pages.parent_id=p.id', 'left');
        return parent::get($id, $single);
    }
    
}
