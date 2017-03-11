<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Assign
 *
 * @author USER
 */
class Assign extends Admin_Controller{
    
    private $error;
    private $success;
    
    public function __construct() {
        parent::__construct();
        
        ob_start(); 
        
        $this->file_path = realpath(APPPATH . '../uploads/domain/');
        $this->upload_path = base_url() . 'uploads/domain/';
        
        $this->form_validation->set_error_delimiters('<dd class="error">', '</dd>'); 
                
        if($this->session->userdata('user_type') === 'User'){
            redirect('index');
        }
        
        /* Get Settings */
        $this->data['setting'] = $this->setting->get(4);
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
        
        $this->data['domains'] = $this->domain->get_list();
        $this->data['users'] = $this->user->get_user_list();
        
        if($id){
            $this->data['assign'] = $this->assign->get($id);
            
            if($this->data['assign']){
                $this->data['assign'];
            } else {
                redirect('admin/assign/add');
            }
            
        } else {
            $this->data['assign'] = $this->assign->get_new();
        }
        
        // Set up the form
        $rules = $this->assign->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            
//            echo '<pre>';
//            print_r($_POST);
//            echo '</pre>';
//            exit();
            
            $datas = $this->input->post('user_id');
            $roles = $this->input->post('domain_info_id');
            
            foreach ($datas as $value) {
                
                
                foreach ($roles as $role) {
                    
                    $result = $this->assign->get_by(['domain_id' => $this->input->post('domain_id'), 'domain_info_id' => $role, 'user_id' => $value]);
                    
                    if(!$result){
                        $data['domain_id'] = $this->input->post('domain_id');

                        if($this->input->post('status') != ''){
                            $data['status'] = $this->input->post('status'); 
                        } else {
                            $data['status'] = 1;                   
                        }

                        $data['domain_info_id'] = $role;
                        $data['user_id'] = $value;

                        $resp = $this->assign->save($data);
                    }                    
                    
                }
            
            }         
            
            if ($resp === TRUE) {
                $this->handle_error('<div class="alert alert-danger">Error while saving file info to Database.</div>');
            } else {
                $this->handle_success('<div class="alert alert-success">Save Data Successfully.</div>');
            }
                
            $this->session->set_flashdata('error', $this->error);
            $this->session->set_flashdata('success', $this->success);
            
            redirect('admin/assign/add');
            
        }
        
        // Load the view
        $this->data['sub_view'] = 'panel/assign/add';
        $this->load->view('panel/common/_layout_main', $this->data);
    }
    
    public function manage() {
        
        $this->data["assigns"] = $this->assign->get_info();
        
        // Load the view
        $this->data['sub_view'] = 'panel/assign/manage';
        $this->load->view('panel/common/_layout_main', $this->data);
    }
    
    public function changestatus() {
        
        $id = $this->input->post('id');       
        $data['status'] = $this->input->post('status');       
        
        $resp = $this->assign->save($data, $id);
        
        if($data['status'] == 0){
            
            echo '<div class="alert alert-danger">Deactive Permission Successfully</div>';        
            
        } else {
        
            echo '<div class="alert alert-success">Active Permission Successfully</div>';
            
        }        
        
    }
    
    public function delete() {
        
        $id = $this->input->post('id');
        
        $result = $this->assign->get($id);
        
        if($result->status == 1){
            echo 'error';
        } else {
            $resp = $this->assign->delete($id);
            echo 'success';
        }
        
    }
    
}
