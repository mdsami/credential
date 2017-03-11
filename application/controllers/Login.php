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
class Login extends Admin_Controller{
    
    function __construct() {
        
        parent::__construct();
        
        ob_start(); 
        
        $this->form_validation->set_error_delimiters("<div class='alert alert-warning'>", '</div>');
        
         /* Get Settings */
        $this->data['setting'] = $this->setting->get(4);
        
    }

    //put your code here
    public function index($id = NULL) {
        // Redirect a user if he's already logged in
        $dashboard = 'index';
        
        if($this->session->userdata('id') && $this->session->userdata('status') == 1){
            redirect("welcome");
        }
        
        // Set form
        $rules = $this->login->rules_login;
        $this->form_validation->set_rules($rules);

        // Process form
        if ($this->form_validation->run() == TRUE) {
           
            if($this->login->login() == TRUE && $this->session->userdata('status') == 1){

                redirect("welcome");
                
                
            } else {
              
                $msg['message']="<div class='alert alert-danger'>Account not active or not valid.</div>";
                $this->session->set_flashdata($msg);
                redirect('login', 'refresh');
                
            }
        }

        // Load view
        $this->load->view('public/login/index', $this->data);
        
    }
    
    public function logout ()
    {
        $this->login->logout();
        redirect('login');
    }
    
    public function forget(){
        
        // Set form
        $rules = $this->login->rules_forget;
        $this->form_validation->set_rules($rules);

        // Process form
        if ($this->form_validation->run() == TRUE) {
           
            $email = $this->input->post('email');
            
            $result = $this->user->get_by_email($email);
            
            if($result){
                
                $npassword = $this->randomPassword();
                $info['password'] = $this->login->hash($npassword);
                $this->user->save($info, $result->id);
                
                
                $data['username'] = $result->username;
                $data['email'] = $result->email;
                $data['password'] = $npassword;
                
                //start mail sent
                $smtp_setting = $this->newletter_setting->getsetting();
                $mail = [];
                $mail['protocol'] = "smtp";
                $mail['smtp_host'] = $smtp_setting->smtp_host;
                $mail['smtp_port'] = $smtp_setting->smtp_port;
                $mail['smtp_user'] = $smtp_setting->email;
                $mail['smtp_pass'] = $smtp_setting->password;
                $mail['to_email'] = $data['email'];
                $mail['subject'] = "Password recovery email of " . $result->username;
                $data['npassword'] = $npassword;
                $mail['info'] = $data;

                $this->load->model('Mailer_Model', 'mail');
                $this->mail->sendeEmail($mail, 'retrievePassword');
                //end mail sent
                
                $msg['message']="<div class='alert alert-success'>Password reset successfully. Plz check email.</div>";
                $this->session->set_flashdata($msg);
                redirect('login');
                
            } else {
                $msg['message']="<div class='alert alert-danger'>Email ID Not Exist.</div>";
                $this->session->set_flashdata($msg);
                redirect('login/forget');
            }
            
        }
        
        // Load view
        $this->load->view('public/login/forget', $this->data);
    }
    
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
}
