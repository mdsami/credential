<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contact_setting
 *
 * @author MdRubel
 */
class Contact_setting extends Admin_Controller {

    private $error = '';
    private $success = '';

    public function __construct() {
        parent::__construct();
        
        ob_start(); 
        
        if ($this->session->userdata('user_type') != 'Administrator') {
            redirect('index');
        }
       
        $this->form_validation->set_error_delimiters('<dd class="error">', '</dd>');
        
         /* Get Settings */
        $this->data['setting'] = $this->setting->get(4);
    }

    //put your code here

    public function index($id = null) {
        //echo $id;
        //exit();
        
           if ($id) {
            $this->data['nSetting'] = $this->contact_setting->get($id);
        } else {
            $result = $this->contact_setting->getsetting();
            if ($result) {
                $this->data['nSetting'] = $result;
            } else {
                $this->data['nSetting'] = $this->contact_setting->get_new();
            }
        }
   
        $this->data['sub_view'] = 'panel/contact/contact_form_setting';
        $this->load->view('panel/common/_layout_main', $this->data);
    }

    private function handle_error($err) {
        $this->error .= $err . "\r\n";
    }

    private function handle_success($succ) {
        $this->success .= $succ . "\r\n";
    }
    public function addSetting($id = null) {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            //exit();    
        }
        $rules = $this->contact_setting->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == true) {
            $data['smtp_host'] = $this->input->post('smtp_host');
            $data['smtp_port'] = $this->input->post('smtp_port');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');

            $resp = $this->contact_setting->save($data, $id);
            if ($resp === TRUE) {
                $this->error = "Error while saving file info to Database.";
            } else {
                if ($id) {
                    $id = $id;
                    $this->success = "Update Setting Successfully.";
                } else {
                    $id = $this->db->insert_id();
                    $this->success = "Save Setting Successfully.";
                }
            }
        } else {
            $this->error = validation_errors();
        }

        $this->session->set_flashdata('ns_error', $this->error);
        $this->session->set_flashdata('ns_success', $this->success);

        //echo  $this->session->flashdata('error');
        // exit();
        //echo validation_errors();exit();
        redirect("admin/contact_setting/index/" . $id);
    }

   

}
