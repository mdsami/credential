<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Domainr
 *
 * @author USER
 */
class Domain extends Admin_Controller{
    
    private $error;
    private $success;
    
    public function __construct() {
        parent::__construct();
        
        ob_start(); 
        
        $this->file_path = realpath(APPPATH . '../uploads/domain/');
        $this->upload_path = base_url() . 'uploads/domain/';
        
        $this->form_validation->set_error_delimiters('<dd class="error">', '</dd>'); 
                
        if($this->session->userdata('user_type') === 'User' || $this->session->userdata('user_type') === 'Developer'){
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
        
        $this->data['domains'] = $this->domain->get_by(['status <' => '2']);
        
        if($id){
            $this->data['domain'] = $this->domain->get($id);
            
            if($this->data['domain']){
                $this->data['domain'];
            } else {
                redirect('admin/domain/add');
            }
            
        } else {
            $this->data['domain'] = $this->domain->get_new($id);
        }
        
        // Set up the form
        $rules = $this->domain->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            
            $data['domain_name'] = $this->input->post('domain_name');
            $data['package'] = $this->input->post('package');
            $data['package_summery'] = $this->input->post('package_summery');
            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');
            $data['owner'] = $this->input->post('owner');
            $data['contact_person'] = $this->input->post('contact_person');
            $data['phone'] = $this->input->post('phone');
            $data['contact_email'] = $this->input->post('contact_email');
            
            if($this->input->post('status') != ''){
                $data['status'] = $this->input->post('status'); 
            } else {
                $data['status'] = 1;                   
            }
            
            $resp = $this->domain->save($data, $id);
            
            if ($resp === TRUE) {
                $this->handle_error('<div class="alert alert-danger">Error while saving file info to Database.</div>');
            } else {
                $this->handle_success('<div class="alert alert-success">Save Data Successfully.</div>');
            }
                
            $this->session->set_flashdata('error', $this->error);
            $this->session->set_flashdata('success', $this->success);
            
            if($id){
                
                redirect('admin/domain/add/'.$id);            
            
            } else {
            
                redirect('admin/domain/add');
                
            }
            
        }

        // Load the view
        $this->data['sub_view'] = 'panel/domain/add';
        $this->load->view('panel/common/_layout_main', $this->data);
    }
    
    public function removeimage($id) {
        
        $result = $this->domain->get($id);
        
        $url = $result->orginal_picture;
        
        $url      = $result->orginal_picture;
        $url_path = parse_url($url, PHP_URL_PATH);
        $basename = pathinfo($url_path, PATHINFO_BASENAME);
        
        if($basename != 'default.png'){
        
            unlink(FCPATH.'uploads/domain/'.$basename);
            unlink(FCPATH.'uploads/domain/thumbs/'.$basename);
            
        }
        
        $data['orginal_picture'] = '';
        $data['thumb_picture'] = '';
        
        $resp = $this->domain->save($data, $id);

        $this->handle_success('<div class="alert alert-success">Remove Image Successfully.</div>');
        
        $this->session->set_flashdata('success', $this->success);

        // Load the view
        redirect('admin/domain/add/'.$id);
        
    }
    
    public function manage() {
        
        $this->data["domains"] = $this->domain->get_by(['status <' => '2']);
        
        // Load the view
        $this->data['sub_view'] = 'panel/domain/manage';
        $this->load->view('panel/common/_layout_main', $this->data);
    }
    
    public function delete() {
        
        $id = $this->input->post('id');
        $data['status'] = $this->input->post('status');
        
        $result = $this->domain->get($id);
        
        if($result->status == 1){
            echo 'error';
        } else {
            $resp = $this->domain->save($data, $id);
            echo 'success';
        }
        
    }    
    
    public function trash(){
        
        $this->data['domains'] = $this->domain->get_by(['status' => 2]);
        
        // Load the view
        $this->data['sub_view'] = 'panel/domain/manage_trash';
        $this->load->view('panel/common/_layout_main', $this->data);
    }
    
    public function undo($id){
        $data['status'] = 0;       
        
        $resp = $this->domain->save($data, $id);

        $this->handle_success('<div class="alert alert-success">Undo Domain Successfully</div>');

        $this->session->set_flashdata('success', $this->success);
        
        // Load the view
        redirect('admin/domain/trash');
    }
    
    public function remove($id){
        
        $assigns = $this->assign->get_by(['domain_id' => $id]);
        
        if($assigns){
            
            foreach($assigns as $assign){
                
                $this->assign->delete($assign->id);
                
            }
            
        }
        
        $credentials = $this->credential->get_by(['domain_id' => $id]);
        
        if($credentials){
            
            foreach($credentials as $credential){
                
                $this->credential->delete($credential->id);
                
            }
            
        }
        
        $result = $this->domain->get($id);
        
        $resp = $this->domain->delete($id);

        $this->handle_success('<div class="alert alert-danger">Remove Domain Parmanently</div>');

        $this->session->set_flashdata('success', $this->success);

        // Load the view
        redirect('admin/domain/trash');
    }
    
    public function changestatus() {
        
        $id = $this->input->post('id');       
        $data['status'] = $this->input->post('status');       
        
        $resp = $this->domain->save($data, $id);
        
        if($data['status'] == 0){
            
            echo '<div class="alert alert-danger">Deactive Domain Successfully</div>';        
            
        } else {
        
            echo '<div class="alert alert-success">Active Domain Successfully</div>';
            
        }
        
        
    }
    
    public function change_set_banner(){
        $id = $this->input->post('id');       
        $data['set_banner'] = $this->input->post('set_banner');  
       
        if($data['set_banner'] == 0){
            $resp = $this->domain->save($data, $id);  
            $message=array(  
                "data"=>'<div class="alert alert-danger">Deactive banner Successfully</div>',
                "status"=>1
            );
            
        }else{
           $count= $this->domain->get_by(['set_banner'=>1]);
            if($count == null){
                 $resp = $this->domain->save($data, $id); 
                 $message=array(  
                "data"=>'<div class="alert alert-success">Active Banner Successfully</div>',
                "status"=>1
            );
            } else{
                  $message=array(  
                "data"=>'<div class="alert alert-danger">Already active a image as a banner.So first deactive this to make another as a banner .</div>',
                "status"=>0
            );
            }
        } 
        echo json_encode($message);
    }
}
