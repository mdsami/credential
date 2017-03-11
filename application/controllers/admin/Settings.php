<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author USER
 */
class Settings extends Admin_Controller {

    var $file_path;
    var $upload_path;
    private $error;
    private $success;

    public function __construct() {
        parent::__construct();
        
        ob_start(); 
        
        if($this->session->userdata('user_type') === 'User' || $this->session->userdata('user_type') === 'Developer'){
            redirect('index');
        }
        
        if($this->session->userdata('user_type') != 'Master'){
            redirect('admin');
        }
        
        $this->file_path = realpath(APPPATH . '../uploads/settings/');
        $this->upload_path = base_url() . 'uploads/settings/';

        $this->form_validation->set_error_delimiters('<dd class="error">', '</dd>');
        
        /* Get Settings */
        $this->data['setting'] = $this->setting->get(4);
    }

    public function index() {
        $this->basic_settings();
    }

    //put your code here
    private function handle_error($err) {
        $this->error .= $err . "\r\n";
    }

    private function handle_success($succ) {
        $this->success .= $succ . "\r\n";
    }

    public function basic_settings($id = null) {
        //echo "<pre>";
        //print_r($_POST);
        // exit();

        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        $rules = $this->setting->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == true) {
            $rand_val = date('YMDHIS') . rand(11111, 99999);

            if ($_FILES['logo']['size'] > 0) {

                $config = array(
                    'allowed_types' => '*',
                    'upload_path' => $this->file_path,
                    'max_size' => 10000,
                );
                $this->load->library('upload', $config);

                $this->upload->initialize($config);
                $_FILES['logo']['name'] = $rand_val . "." . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);

                if ($this->upload->do_upload('logo')) {
                    $image_data = $this->upload->data();
                    $data['logo'] = $this->upload_path . $image_data["file_name"];
                } else {
                    $this->error = $this->upload->display_errors();
                }
            } else {
                if ($id) {
                    if ($this->input->post('logo')) {
                        $data['logo'] = $this->input->post('logo');
                    } else {
                        $data['logo'] = $this->upload_path . 'default.png';
                    }
                } else {

                    $data['logo'] = $this->upload_path . 'default.png';
                }
            }
            if (!$this->error) {
                $data['site_title'] = $this->input->post('site_title');
                $data['slogan'] = $this->input->post('slogan');
                $data['site_offline'] = $this->input->post('site_offline');
                $data['offline_text'] = $this->input->post('offline_text');
                $data['meta_description'] = $this->input->post('meta_description');
                $data['meta_keyword'] = $this->input->post('meta_keyword');
                $data['address'] = $this->input->post('address');
                $data['phone_fax'] = $this->input->post('phone_fax');
                $data['email'] = $this->input->post('email');
                $data['copy_right'] = $this->input->post('copy_right');
                
                $resp = $this->setting->save($data, $id);
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
            }
        } else {
            $this->error = validation_errors();
        }


        if ($id) {
            $this->data['settings'] = $this->setting->get($id);
        } else {
            $result = $this->setting->getsetting();
            if ($result) {
                $this->data['settings'] = $this->setting->get($result->id);
            } else {
                $this->data['settings'] = $this->setting->get_new();
            }
        }

        if ($this->session->flashdata('s_error') == '') {
            $this->session->set_flashdata('s_error', $this->error);
        }
        if ($this->session->flashdata('s_success') == '') {
            $this->session->set_flashdata('s_success', $this->success);
        }


        $this->data['sub_view'] = 'panel/settings/basic_settings';
        $this->load->view('panel/common/_layout_main', $this->data);
    }

    public function removeimage($id) {

        $result = $this->setting->get($id);

        $url = $result->logo;

        $url = $result->logo;
        $url_path = parse_url($url, PHP_URL_PATH);
        $basename = pathinfo($url_path, PATHINFO_BASENAME);

        if ($basename != 'default.png') {
            unlink(FCPATH . 'uploads/settings/' . $basename);
        }

        $data['logo'] = '';


        $resp = $this->setting->save($data, $id);
        if ($resp === TRUE) {
            $this->error = "Error while saving file info to Database.";
        } else {
            $this->success = "Remove logo Successfully.";
        }
        $this->session->set_flashdata('s_error', $this->error);
        $this->session->set_flashdata('s_success', $this->success);
        redirect("admin/settings/basic_settings");
    }

}
