<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Newsletter
 *
 * @author MdRubel
 */
class Newsletter extends Admin_Controller {

    private $error = '';
    private $success = '';

    public function __construct() {
        parent::__construct();
        
        ob_start(); 
        
        if($this->session->userdata('user_type') === 'User' || $this->session->userdata('user_type') === 'Developer'){
            redirect('index');
        }
        
        if($this->session->userdata('user_type') != 'Master'){
            redirect('admin');
        }
        
        $this->file_path = realpath(APPPATH . '../uploads/newsletters/');
        $this->upload_path = base_url() . 'uploads/newsletters/';

        $this->form_validation->set_error_delimiters('<dd class="error">', '</dd>');
        
         /* Get Settings */
        $this->data['setting'] = $this->setting->get(4);
    }

    //put your code here

    public function index($type = "Newsletters", $id = null) {

        if ($type == 'Newsletters' || $type == 'Create_Newsletter') {

            if ($id) {
                $nid = $id;
            }
        } else if ($type == 'allnewsletters') {
            // echo "mitulerer";
            // exit();
            if ($id) {
                $pid = $id;
            }
            $type = 'Newsletters';
        } else if ($type == 'Subscriber') {
            if ($id) {
                $sid = $id;
            }
        } else if ($type == 'allsubscriber') {
            if ($id) {
                $pid = $id;
            }
            $type = 'Subscriber';
        } else if ($type == 'Settings') {
            if ($id) {
                $snid = $id;
            }
        }
        $config = array();
        $config["base_url"] = base_url() . "admin/newsletter/index/allnewsletters";
        $config["total_rows"] = $this->newsletter->newsletter_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 5;
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

        $page = ($this->uri->segment(4) == 'allnewsletters') ? $this->uri->segment(5) : 0;
        $this->data["allNewsletters"] = $this->newsletter->get_all_newsletter($config["per_page"], $page);
        // print_r($this->data['allNewsletters']);
        //exit();
        $this->data["links"] = $this->pagination->create_links();
        if (isset($nid)) {
            $this->data['newsletter'] = $this->newsletter->get($nid);
        } else {
            $this->data['newsletter'] = $this->newsletter->get_new();
        }
        
        $this->data["allsubcribers"] = $this->subscriber->get();
        if (isset($sid)) {
            $this->data['subscriber'] = $this->subscriber->get($sid);
        } else {
            $this->data['subscriber'] = $this->subscriber->get_new();
        }
        if (isset($snid)) {
            $this->data['nSetting'] = $this->newletter_setting->get($snid);
        } else {
            $result = $this->newletter_setting->getsetting();
            if ($result) {
                $this->data['nSetting'] = $result;
            } else {
                $this->data['nSetting'] = $this->newletter_setting->get_new();
            }
        }
        //end subscribes
        $this->data['active_tab'] = $type;


        $this->data['sub_view'] = 'panel/newsletter/newsletter';
        $this->load->view('panel/common/_layout_main', $this->data);
    }

    private function handle_error($err) {
        $this->error .= $err . "\r\n";
    }

    private function handle_success($succ) {
        $this->success .= $succ . "\r\n";
    }

    public function add($id = null) {

        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        $rules = $this->newsletter->rules;

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == true) {
            $rand_val = @date('YMDHIS') . rand(11111, 99999);

            if ($_FILES['image']['size'] > 0) {

                $config = array(
                    'allowed_types' => '*',
                    'upload_path' => $this->file_path,
                    'max_size' => 10000,
                );
                $this->load->library('upload', $config);

                $this->upload->initialize($config);
                $_FILES['image']['name'] = $rand_val . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                if ($this->upload->do_upload('image')) {
                    $image_data = $this->upload->data();
                    $data['image'] = $this->upload_path . $image_data["file_name"];
                } else {
                    $this->error = $this->upload->display_errors();
                }
            } else {
                if ($id) {
                    //echo "mthu";
                    //exit();
                    if ($this->input->post('image')) {
                        $data['image'] = $this->input->post('image');
                    } else {
                        $data['image'] = $this->upload_path . 'default.png';
                    }
                } else {

                    $data['image'] = $this->upload_path . 'default.png';
                }
            }
            if (!$this->error) {
                $data['title'] = $this->input->post('title');
                //$data['summary'] = $this->input->post('summary');
                $data['contant'] = $this->input->post('contant');
                if ($this->input->post('creation_date') != '') {
                    $data['creation_date'] = $this->input->post('creation_date');
                } else {
                    $data['creation_date'] = @date('Y-m-d');
                }

                if ($this->input->post('status') != '') {
                    $data['status'] = $this->input->post('status');
                } else {
                    $data['status'] = 1;
                }
                $resp = $this->newsletter->save($data, $id);
                if ($resp === TRUE) {
                    $this->error = "Error while saving file info to Database.";
                } else {
                    if ($id) {
                        $id = $id;
                        $this->success = "Update data Successfully.";
                    } else {
                        $id = $this->db->insert_id();
                        $this->success = "Save data Successfully.";
                    }
                }
            }
        } else {
            $this->error = validation_errors();
        }

        $this->session->set_flashdata('n_error', $this->error);
        $this->session->set_flashdata('success', $this->success);

        //echo  $this->session->flashdata('error');
        // exit();
        //echo validation_errors();exit();
        //redirect("admin/newsletter/index/Create_Newsletter/" . $id);
        if ($this->error) {
            redirect("admin/newsletter/index/Create_Newsletter/" . $id);
        } else {
            redirect("admin/newsletter/index/Newsletters");
        }
    }

    public function removeimage($id) {

        $result = $this->newsletter->get($id);

        $url = $result->image;

        $url = $result->image;
        $url_path = parse_url($url, PHP_URL_PATH);
        $basename = pathinfo($url_path, PATHINFO_BASENAME);

        if ($basename != 'default.png') {
            unlink(FCPATH . 'uploads/newsletters/' . $basename);
        }

        $data['image'] = '';


        $resp = $this->newsletter->save($data, $id);
        if ($resp === TRUE) {
            $this->error = "Error while saving file info to Database.";
        } else {
            $this->success = "Update Newletter Successfully.";
        }


        $this->session->set_flashdata('n_error', $this->error);
        $this->session->set_flashdata('n_success', $this->success);

        //echo  $this->session->flashdata('error');
        // exit();
        //echo validation_errors();exit();
        redirect("admin/newsletter/index/Create_Newsletter/" . $id);
    }

    public function delete($id) {

        $result = $this->newsletter->get($id);

        $url = $result->image;

        $url = $result->image;
        $url_path = parse_url($url, PHP_URL_PATH);
        $basename = pathinfo($url_path, PATHINFO_BASENAME);

        if ($basename != 'default.png') {
            unlink(FCPATH . 'uploads/newsletters/' . $basename);
        }


        $resp = $this->newsletter->delete($id);

        if ($resp === TRUE) {
            $this->error = "Error while saving file info to Database.";
        } else {
            $this->success = "Data Delete Successfully.";
        }

        $this->session->set_flashdata('error', $this->error);
        $this->session->set_flashdata('success', $this->success);

        //echo  $this->session->flashdata('error');
        // exit();
        //echo validation_errors();exit();
        redirect("admin/newsletter/index");
    }

    public function ChangeNstatus() {

        //echo '<pre>';
        // print_r($_POST);
        //echo '</pre>';

        $id = $this->input->post('id');

        $data['status'] = $this->input->post('status');
        if ($data['status'] == 1) {
            $letter = $this->newsletter->get($id);
            if ($letter->sent != '0000-00-00') {
                $this->session->set_flashdata('error', 'You already sent this newsletter.Please make new one');
            }else{
                 $this->newsletter->save($data, $id);
            }
        } else {
          $this->newsletter->save($data, $id);
        }
    }

    public function Addsubscribers($id = null) {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            //exit();    
        }
        $rules = $this->subscriber->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == true) {
            $data['email'] = $this->input->post('email');
            if ($this->input->post('subscription_date') != '') {
                $data['subscription_date'] = $this->input->post('subscription_date');
            } else {
                $data['subscription_date'] = @date('Y-m-d');
            }
            if ($this->input->post('status') != '') {
                $data['status'] = $this->input->post('status');
            } else {
                $data['status'] = 1;
            }

            $resp = $this->subscriber->save($data, $id);
            if ($resp === TRUE) {
                $this->error = "Error while saving file info to Database.";
            } else {
                if ($id) {
                    $id = $id;
                    $this->success = "Update data Successfully.";
                } else {
                    //$id = $this->db->insert_id();
                    $this->success = "Save data Successfully.";
                }
            }
        } else {
            $st=  strpos(validation_errors(), "unique");
            if($st==true){
                 $this->error ="The email address already exist!";
            }else{
                $this->error = validation_errors();
            }
 
        }

        $this->session->set_flashdata('sub_error', $this->error);
        $this->session->set_flashdata('sub_success', $this->success);

        //echo  $this->session->flashdata('error');
        // exit();
        //echo validation_errors();exit();
        //redirect("admin/newsletter/index/Subscriber/" . $id);
        if ($id) {
            redirect("admin/newsletter/index/Subscriber/" . $id);
        } else {
            redirect("admin/newsletter/index/Subscriber");
        }
    }

    public function deleteSubcriber($id) {
        //echo $id;
        //exit();
        $resp = $this->subscriber->delete($id);


        if ($resp === TRUE) {
            $this->error = "Error while saving file info to Database.";
        } else {
            $this->success = "Subscribers Delete Successfully.";
        }

        $this->session->set_flashdata('sub_error', $this->error);
        $this->session->set_flashdata('sub_success', $this->success);

        //echo  $this->session->flashdata('error');
        // exit();
        //echo validation_errors();exit();
        redirect("admin/newsletter/index/Subscriber");
    }

    public function ChangeSstatus() {
        $id = $this->input->post('id');
        $data['status'] = $this->input->post('status');
        $resp = $this->subscriber->save($data, $id);
    }

    public function addNewletterSetting($id = null) {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            //exit();    
        }
        $rules = $this->newletter_setting->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == true) {
            $data['smtp_host'] = $this->input->post('smtp_host');
            $data['smtp_port'] = $this->input->post('smtp_port');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');

            $resp = $this->newletter_setting->save($data, $id);
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
        redirect("admin/newsletter/index/Settings/" . $id);
    }

    public function send($id) {
        
        $this->load->model('Mailer_Model', 'mail');

        $data['newsletter'] = $this->newsletter->get($id);

        if ($data['newsletter']->sent == '0000-00-00') {
            $data['setting'] = $this->newletter_setting->getsetting();
            $data['allSubscribers'] = $this->subscriber->getAllActiveSubscribers();
            $url = $data['newsletter']->image;
            $url_path = parse_url($url, PHP_URL_PATH);
            $basename = pathinfo($url_path, PATHINFO_BASENAME);

            if ($basename != 'default.png') {
                $image = $data['newsletter']->image;
            } else {
                $image = null;
            }
            foreach ($data['allSubscribers'] as $d) {
                $mail = [];
                $mail['smtp_user'] = $data['setting']->email;
                $mail['smtp_pass'] = $data['setting']->password;
                $mail['smtp_host'] = $data['setting']->smtp_host;
                $mail['protocol'] = "smtp";
                $mail['smtp_port'] = $data['setting']->smtp_port;
                $mail['to_email'] = $d->email;
                $mail['s_id'] = $d->id;
                $mail['subject'] = $data['newsletter']->title;
                $mail['summary'] = $data['newsletter']->summary;
                $mail['content'] = $data['newsletter']->contant;
                $mail['image'] = $image;
                $this->mail->sendeEmail($mail, 'sendMessageView');
                sleep(.001);
            }
            
            $letter['sent'] = Date('Y-m-d');
            $letter['status'] = 0;
            $this->newsletter->save($letter, $id);
            $this->session->set_flashdata('success', 'Newsletter sent Successfully..!');
            redirect("admin/newsletter/index/Newsletters");
        } 
   }


}
