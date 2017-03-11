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
class Users extends Admin_Controller {

    private $error;
    private $success;

    public function __construct() {
        parent::__construct();

        ob_start(); 
        
        $this->file_path = realpath(APPPATH . '../uploads/users/');
        $this->upload_path = base_url() . 'uploads/users/';

        $this->form_validation->set_error_delimiters('<dd class="error">', '</dd>');

        if ($this->session->userdata('user_type') === 'User' || $this->session->userdata('user_type') === 'Developer') {
            redirect('index');
        }
        
        if($this->session->userdata('user_type') != 'Master'){
            redirect('admin');
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

        $this->data['users'] = $this->user->get_active_user();

        if ($id) {
            $this->data['user'] = $this->user->get($id);

            if ($this->data['user']) {
                $this->data['user'];
            } else {
                redirect('admin/users/add');
            }
        } else {
            $this->data['user'] = $this->user->get_new($id);
        }

        // Set up the form
        if ($id) {
            $rules = $this->user->rules_update;
        } else {
            $rules = $this->user->rules;
        }

        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            if (!$this->input->post('orginal_picture')) {
                if ($_FILES['userfile']['size'] > 0) {
                    $config = array(
                        'allowed_types' => 'jpg|jpeg|png',
                        'upload_path' => $this->file_path,
                        'max_size' => 10000
                    );

                    $this->load->library('upload', $config);
                    $this->upload->do_upload();
                    $image_data = $this->upload->data();

                    $config = array(
                        'source_image' => $image_data['full_path'],
                        'new_image' => $this->file_path . '/thumbs',
                        'maintain_ration' => false,
                        'width' => 300,
                        'height' => 160
                    );

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $data['orginal_picture'] = $this->upload_path . $image_data["file_name"];
                    $data['thumb_picture'] = $this->upload_path . 'thumbs/' . $image_data["file_name"];
                } else {

                    if ($id) {

                        $data['orginal_picture'] = $this->input->post('orginal_picture');
                        $data['thumb_picture'] = $this->input->post('thumb_picture');
                    } else {

                        $data['orginal_picture'] = $this->upload_path . 'default.png';
                        $data['thumb_picture'] = $this->upload_path . 'thumbs/default.png';
                    }
                }
            }

            $data['full_name'] = $this->input->post('full_name');
            $data['username'] = $this->input->post('username');

            if ($this->input->post('password') != '') {
                $npassword = $this->input->post('password');
                $data['password'] = $this->login->hash($npassword);
            } else {
                $npassword = $this->randomPassword();
                $data['password'] = $this->login->hash($npassword);
            }
            
            if ($id) {
                $old_email = $this->user->get($id)->email;
            }

            $data['email'] = $this->input->post('email');
            $data['contact_no'] = $this->input->post('contact_no');
            $data['address'] = $this->input->post('address');
            $data['remark'] = $this->input->post('remark');
            $data['user_type'] = $this->input->post('user_type');

            if ($this->input->post('date') != '') {
                $data['date'] = $this->input->post('date');
            } else {
                $data['date'] = date('Y-m-d');
            }

            if ($this->input->post('status') != '') {
                $data['status'] = $this->input->post('status');
            } else {
                $data['status'] = 1;
            }

            $resp = $this->user->save($data, $id);

            $lastid = $this->db->insert_id();

            if ($resp === TRUE) {
                $this->handle_error('<div class="alert alert-danger">Error while saving file info to Database.</div>');
            } else {

                //start mail sent
                $smtp_setting = $this->newletter_setting->getsetting();
                $mail = [];
                $mail['protocol'] = "smtp";
                $mail['smtp_host'] = $smtp_setting->smtp_host;
                $mail['smtp_port'] = $smtp_setting->smtp_port;
                $mail['smtp_user'] = $smtp_setting->email;
                $mail['smtp_pass'] = $smtp_setting->password;
                $mail['to_email'] = $data['email'];
                if ($id) {
                    $mail['subject'] = "Update registration information of " . $this->data['setting']->site_title;
                } else {
                    $mail['subject'] = "Registration information of " . $this->data['setting']->site_title;
                }
                $data['npassword'] = $npassword;
                $mail['info'] = $data;

                $this->load->model('Mailer_Model', 'mail');
                $this->mail->sendeEmail($mail, 'userInfo');
                //end mail sent

                $subscriber = [];
                $subscriber['email'] = $data['email'];
                if ($id) {
                    $result = $this->subscriber->get_by(["email" => $old_email]);
                    if ($result) {
                        $s_id = $result[0]->id;
                    } else {
                        $subscriber['subscription_date'] = @date('Y-m-d');
                        $subscriber['status'] = 1;
                        $s_id = null;
                    }
                } else {

                    $subscriber['subscription_date'] = @date('Y-m-d');
                    $subscriber['status'] = 1;
                    $s_id = null;
                }
                $result = $this->subscriber->get_by(["email" => $subscriber['email']]);
                if ($result == null) {
                    $this->subscriber->save($subscriber, $s_id);
                }

                $this->handle_success('<div class="alert alert-success">Save Data Successfully.</div>');
            }

            $this->session->set_flashdata('n_error', $this->error);
            $this->session->set_flashdata('success', $this->success);

            if ($id) {

                redirect('admin/users/add/' . $id);
            } else {

                redirect('admin/users/add');
            }
        }

        // Load the view
        $this->data['sub_view'] = 'panel/users/add';
        $this->load->view('panel/common/_layout_main', $this->data);
    }

    public function removeimage($id) {

        $result = $this->user->get($id);

        $url = $result->orginal_picture;

        $url = $result->orginal_picture;
        $url_path = parse_url($url, PHP_URL_PATH);
        $basename = pathinfo($url_path, PATHINFO_BASENAME);

        if ($basename != 'default.png') {

            unlink(FCPATH . 'uploads/users/' . $basename);
            unlink(FCPATH . 'uploads/users/thumbs/' . $basename);
        }

        $data['orginal_picture'] = '';
        $data['thumb_picture'] = '';

        $resp = $this->user->save($data, $id);

        $this->handle_success('<div class="alert alert-success">Remove Image Successfully.</div>');

        $this->session->set_flashdata('success', $this->success);

        // Load the view
        redirect('admin/users/add/' . $id);
    }

    public function manage() {

        $config = array();
        $config["base_url"] = base_url() . "admin/users/manage";
        $config["total_rows"] = $this->user->active_user_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["users"] = $this->user->get_active_users($config["per_page"], $page);
        $this->data["links"] = $this->pagination->create_links();

        // Load the view
        $this->data['sub_view'] = 'panel/users/manage';
        $this->load->view('panel/common/_layout_main', $this->data);
    }

    public function delete() {

        $id = $this->input->post('id');
        $data['status'] = $this->input->post('status');

        $result = $this->user->get($id);

        if ($result->status == 1) {
            echo 'error';
        } else {
            $resp = $this->user->save($data, $id);
            echo 'success';
        }
    }

    public function trash() {

        $config = array();
        $config["base_url"] = base_url() . "admin/users/trash";
        $config["total_rows"] = $this->user->trashed_user_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["users"] = $this->user->get_trashed_users($config["per_page"], $page);
        $this->data["links"] = $this->pagination->create_links();

        //$this->data['users'] = $this->user->get_by(['status' => 2]);
        // Load the view
        $this->data['sub_view'] = 'panel/users/manage_trash';
        $this->load->view('panel/common/_layout_main', $this->data);
    }

    public function undo($id) {
        $data['status'] = 0;

        $resp = $this->user->save($data, $id);

        $this->handle_success('<div class="alert alert-success">Undo User Successfully</div>');

        $this->session->set_flashdata('n_error', $this->error);
        $this->session->set_flashdata('success', $this->success);

        // Load the view
        redirect('admin/users/trash');
    }

    public function remove($id) {

        $assigns = $this->assign->get_by(['user_id' => $id]);

        if ($assigns) {

            foreach ($assigns as $assign) {

                $this->assign->delete($assign->id);
            }
        }

        $logs = $this->logs->get_by(['user_id' => $id]);

        if ($logs) {

            foreach ($logs as $log) {

                $this->logs->delete($log->id);
            }
        }

        $result = $this->user->get($id);

        $url = $result->orginal_picture;

        $url = $result->orginal_picture;
        $url_path = parse_url($url, PHP_URL_PATH);
        $basename = pathinfo($url_path, PATHINFO_BASENAME);

        if ($basename != 'default.png') {

            unlink(FCPATH . 'uploads/users/' . $basename);
            unlink(FCPATH . 'uploads/users/thumbs/' . $basename);
        }

        $resp = $this->user->delete($id);

        $this->handle_success('<div class="alert alert-danger">Remove User Parmanently</div>');

        $this->session->set_flashdata('success', $this->success);

        // Load the view
        redirect('admin/users/trash');
    }

    public function changestatus() {

        $id = $this->input->post('id');
        $data['status'] = $this->input->post('status');

        $resp = $this->user->save($data, $id);

        if ($data['status'] == 0) {

            echo '<div class="alert alert-danger">Deactive User Successfully</div>';
        } else {

            echo '<div class="alert alert-success">Active User Successfully</div>';
        }
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
