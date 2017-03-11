<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Location
 *
 * @author USER
 */
class Credential extends Admin_Controller{
    
    private $error;
    private $success;
    
    public function __construct() {
        parent::__construct();
        
        ob_start(); 
        
        $this->file_path = realpath(APPPATH . '../uploads/promotions/');
        $this->upload_path = base_url() . 'uploads/promotions/';
        
        $this->form_validation->set_error_delimiters('<dd class="error">', '</dd>');  
                
        if($this->session->userdata('user_type') === 'User' || $this->session->userdata('user_type') === 'Developer'){
            redirect('index');
        }
        
        /* Get Settings */
        $this->data['setting'] = $this->setting->get(4);
    }
    
    public function clear_field_data() {

        $this->_field_data = array();
        return $this;
    }
    
    //put your code here
    private function handle_error($err) {
        $this->error .= $err . "\r\n";
    }

    private function handle_success($succ) {
        $this->success .= $succ . "\r\n";
    }
    
    public function index() {
        $this->add();
    }

    public function add($id = NULL) {
        
        $this->data['credentials'] = $this->credential->get_credential();
        $this->data['domain'] = $this->domain->get_list();
        
        if($id){
            
            $value = $this->credential->get($id);
            
            $credential = new stdClass();
            $credential->id = $value->id;
            $credential->domain_id = $value->domain_id;
            $credential->title = $value->title;
            $credential->detail = $this->decrypt($value->detail, 'gh9K*fCsZa2@hBc&hjasLKVfVBNa*%f');
            $credential->status = $value->status;
            $credential->last_update = $value->last_update;
            $credential->user_id = $value->user_id;
            $this->data['credential'] =  $credential;
            
            $this->data['users'] = $this->user->get_active_assign_list($id);
            
        } else {
            
            $this->data['users'] = $this->user->get_user_list();
            $this->data['credential'] = $this->credential->get_new();
            
        }
        
        // Set up the form
        $rules = $this->credential->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            
            $data['domain_id'] = $this->input->post('domain_id');
            $data['title'] = $this->input->post('title');
            $data['detail'] = $this->encrypt($this->input->post('detail'), 'gh9K*fCsZa2@hBc&hjasLKVfVBNa*%f');
            $data['title'] = $this->input->post('title');
            
            if($this->input->post('user_id') != ''){
                $data['id'] = $this->input->post('user_id'); 
            } else {
                $data['id'] = $this->session->userdata('id');                   
            }
            
            if($this->input->post('status') != ''){
                $data['status'] = $this->input->post('status'); 
            } else {
                $data['status'] = 1;                   
            }
            
            if($id){
                $data['last_update'] = date('Y-m-d'); 
            }
            
            $resp = $this->credential->save($data, $id);
            $insert_id = $this->db->insert_id();
            
            if ($resp === TRUE) {
                $this->handle_error('<div class="alert alert-danger">Error while saving file info to Database.</div>');
            } else {
                
                if($id){
                    $results = $this->assign->get_by(['domain_id' => $this->input->post('domain_id'), 'domain_info_id' => $id]);
                
                    if($results) {
                        foreach ($results as $result) {
                            $this->assign->delete($result->id);
                        }
                    }  else {
                        echo 'afsd';
                    }                    
                }
                
                $datas = $this->input->post('users_id');
                
                foreach ($datas as $value) {
                    
                     $data2['domain_id'] = $this->input->post('domain_id');
                    
                    if ($id) {
                        $data2['domain_info_id'] = $id;
                    } else {
                        $data2['domain_info_id'] = $insert_id;
                    }
                    
                    $data2['user_id'] = $value;
                    $data2['status'] = 1;

                    $this->assign->save($data2);
                }
                    
                /*$log['domain_id'] = $data['domain_id'] ;
                if($id){
                    $log['credential_id'] = $id ;
                } else {
                    $log['credential_id'] = $insert_id ;
                }
                $log['user_id'] = $this->session->userdata('id');
                $log['date_time'] = date('Y-m-d H:i:s',now());
                if($id){
                    $log['status'] = 'Update';
                } else {
                    $log['status'] = 'Create';
                }

                $resp = $this->logs->save($log);*/
                
                $this->handle_success('<div class="alert alert-success">Save Data Successfully.</div>');
            }
            
            $this->session->set_flashdata('n_error', $this->error);
            $this->session->set_flashdata('success', $this->success);
            
            if($id){
                
                redirect('admin/credential/add/'.$id);            
            
            } else {
            
                redirect('admin/credential/add');
            }
            
        }
        
        // Load the view
        $this->data['sub_view'] = 'panel/credential/add';
        $this->load->view('panel/common/_layout_main', $this->data);
    }
    
    public function manage() {
        
        $this->data["credentials"] = $this->credential->get_credential();
        
        // Load the view
        $this->data['sub_view'] = 'panel/credential/manage';
        $this->load->view('panel/common/_layout_main', $this->data);
    }
    
    public function delete() {
        
        $id = $this->input->post('id');
        $data['status'] = $this->input->post('status');
        
        $resp = $this->credential->save($data, $id);
        echo 'success';
        
        $result = $this->credential->get($id);
        
        if($resp){
            $log['domain_id'] = $result->domain_id;
            $log['user_id'] = $this->session->userdata('id');
            $log['date_time'] = date('Y-m-d H:i:s',now());
            $log['status'] = 'Delete';

            $resp = $this->logs->save($log);
        }
        
        $result = $this->credential->get($id);
        
        $result2 = $this->domain->get($result->domain_id);
        
        if($result2->status == 2){
            $resp = $this->credential->save($data, $id);
            echo 'success';
        } else {
            echo 'error';            
        }
        
    }    
    
    public function trash(){
        
        $this->data['credentials'] = $this->credential->get_trashed_credential();
        
        // Load the view
        $this->data['sub_view'] = 'panel/credential/manage_trash';
        $this->load->view('panel/common/_layout_main', $this->data);
    }
    
    public function undo($id){
        $data['status'] = 1;       
        
        $resp = $this->credential->save($data, $id);

        $this->handle_success('<div class="alert alert-success">Undo Domain Info Successfully</div>');

        $this->session->set_flashdata('success', $this->success);
        
        // Load the view
        redirect('admin/credential/trash');
    }
    
    public function remove($id){
        $result = $this->credential->get($id);
        
        $resp = $this->credential->delete($id);

        $this->handle_success('<div class="alert alert-danger">Remove Domain Info Parmanently</div>');

        $this->session->set_flashdata('success', $this->success);

        // Load the view
        redirect('admin/credential/trash');
    }
    
    function encrypt($string, $key){
        $result = "";
        for($i=0; $i<strlen($string); $i++){
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)+ord($keychar));
                $result.=$char;
        }
        $salt_string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxys0123456789~!@#$^&*()_+`-={}|:<>?[]\;',./";
        $length = rand(1, 15);
        $salt = "";
        for($i=0; $i<=$length; $i++){
                $salt .= substr($salt_string, rand(0, strlen($salt_string)), 1);
        }
        $salt_length = strlen($salt);
        $end_length = strlen(strval($salt_length));
        return base64_encode($result.$salt.$salt_length.$end_length);
    }
    
    function decrypt($string, $key){
        $result = "";
        $string = base64_decode($string);
        $end_length = intval(substr($string, -1, 1));
        $string = substr($string, 0, -1);
        $salt_length = intval(substr($string, $end_length*-1, $end_length));
        $string = substr($string, 0, $end_length*-1+$salt_length*-1);
        for($i=0; $i<strlen($string); $i++){
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)-ord($keychar));
                $result.=$char;
        }
        return $result;
    }
    
    public function get_list() {
        
        $datas = $this->credential->get_list($this->input->post('domain_id'));
        foreach ($datas as $data){
            echo '<option value="'.$data->id.'">'.$data->title.'</option>';
        }
        
    }
    
    public function changestatus() {

        $id = $this->input->post('id');
        $data['status'] = $this->input->post('status');

        $resp = $this->credential->save($data, $id);

        if ($data['status'] == 0) {

            echo '<div class="alert alert-danger">Deactive User Successfully</div>';
        } else {

            echo '<div class="alert alert-success">Active User Successfully</div>';
        }
    }

}
