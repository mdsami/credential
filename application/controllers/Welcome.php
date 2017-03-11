<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Admin_Controller {

    private $error;
    private $success;
    
    public function __construct() {
        parent::__construct();

       ob_start(); 
        
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
    
    

    public function index()
    {
        $this->data['subview'] = 'public/pages/index';
        $this->load->view('public/common/_layout_main', $this->data);
    }
    
    public function get_list() {
        $domains = $this->domain->get_by(['status' => 1]);
        
        if($domains) { foreach ($domains as $domain) {
            
            $data = $this->assign->get_by_domain_status(['domain_id' => $domain->id, 'user_id' => $this->session->userdata('id'), 'status' => 1]);
            
            if($data){
                echo '<li class="list-group-item col-sm-4 text-center"><button class="btn btn-success btn-block" id="'. $domain->id .'" onclick="showId(this.id);">' . $domain->domain_name . '</button></li>';
            }

        }} else {
            echo '<li class="list-group-item">No content to show!</li>';
        }
        
    }
    
    public function getCredential() {
        
        $domain = $this->domain->get($this->input->post('domain_id'));
        
        $credentials = $this->credential->get_by(['domain_id' => $this->input->post('domain_id'), 'status' => 1]);
        
        if($credentials){
            echo '<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">'. $domain->domain_name .'</h3>
            </div>
            <div class="modal-body" >
                <ul style="list-style:none; margin:0; padding:0;">';
//                    echo '<pre>';
//                    print_r($credentials);
//                    echo '</pre>';
//                    exit;
                    foreach ($credentials as $credential) {
                        
                        $data = $this->assign->get_by(['domain_id' => $domain->id, 'domain_info_id' => $credential->id, 'user_id' => $this->session->userdata('id'), 'status' => 1]);

                        if($data){
                            echo '<li><a href="javascript:void(0)" class="text-success credential" id="'. $domain->id .'" data-randomdata="'. $credential->id .'" onclick="showContent(\''.$domain->id.', '.$credential->id.'\');"><i class="fa fa-check"></i> '.$credential->title.'</a></li>';
                        }
                        
                    }
                echo '</ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal" role="button">Close</button>
            </div>';
        } else {
            echo '<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">'. $domain->domain_name .'</h3>
            </div>
            <div class="modal-body" >
                Sorry No Data Available
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal" role="button">Close</button>
            </div>';
        }
        
    }
    
    public function cenckValidity() {
        
        $data = $this->assign->get_by(['domain_id' => $this->input->post('domain_id'), 'domain_info_id' => $this->input->post('credential_id'), 'user_id' => $this->input->post('user_id'), 'status' => 1]);
        
        $domain = $this->domain->get($this->input->post('domain_id'));
        
        if($data){
            
            $credential = $this->credential->get($this->input->post('credential_id'));
            
            if($credential){
                echo '<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel"><a href="javascript:void(0)" id="'. $domain->id .'" onclick="showId(this.id);">'. $domain->domain_name .'</a></h3>
                </div>
                <div class="modal-body" >'.
                    $this->decrypt($credential->detail, 'gh9K*fCsZa2@hBc&hjasLKVfVBNa*%f')
                .'</div>';

                if($this->session->userdata('user_type') === 'Developer' || $this->session->userdata('user_type') === 'Master' || $this->session->userdata('user_type') === 'Administrator'){

                    echo '<div class="btn-group btn-group-justified" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                            <a href="javascript:void(0)" id="'. $domain->id .'" onclick="showId(this.id);" class="btn btn-default">Back</a>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-hover-green" id="'. $credential->id .'" onclick="edit(this.id);" data-action="Edit" role="button">Edit</button>
                        </div>
                    </div>';

                } else {

                    echo '<div class="btn-group btn-group-justified" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                            <a href="javascript:void(0)" id="'. $domain->id .'" onclick="showId(this.id);" class="btn btn-default">Back</a>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                        </div>
                    </div>';

                }
            } else {
                echo '<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel"><a href="javascript:void(0)" id="'. $domain->id .'" onclick="showId(this.id);">'. $domain->domain_name .'</a></h3>
                </div>
                <div class="modal-body" >
                    Sorry No Data Available
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                            <a href="javascript:void(0)" id="'. $domain->id .'" onclick="showId(this.id);" class="btn btn-default">Back</a>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal" role="button">Close</button>    
                        </div>                    
                    </div>
                </div>';
            }
            
        } else {
            
            echo '<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel"><a href="javascript:void(0)" id="'. $domain->id .'" onclick="showId(this.id);">'. $domain->domain_name .'</a></h3>
            </div>
            <div class="modal-body" >
                Access Denied
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                        <a href="javascript:void(0)" id="'. $domain->id .'" onclick="showId(this.id);" class="btn btn-default">Back</a>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal" role="button">Close</button>    
                    </div>                    
                </div>                
            </div>';
            
        }        
        
    }
    
    public function editInfo(){
        
        $credential = $this->credential->get($this->input->post('id')); 
        
        $domain = $this->domain->get($credential->domain_id);
        
        echo '<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel"><a href="javascript:void(0)" id="'. $domain->id .'" onclick="showId(this.id);">'. $domain->domain_name .'</a></h3>
            </div>
            <div class="modal-body" >
                <form action="'.site_url('welcome/update/'.$credential->id).'" method="POST">
                    <div class="form-group">'.
                        form_hidden('id', $credential->id, 'class="form-control" placeholder="id"').
                        form_hidden('domain_id', $credential->domain_id, 'class="form-control" placeholder="domain_id"').
                        form_textarea('detail', $this->decrypt($credential->detail, 'gh9K*fCsZa2@hBc&hjasLKVfVBNa*%f'), 'class="form-control" placeholder="Detail"')
                    .'</div>'.
                    form_submit('submit', 'Update', 'class="btn btn-success "')
                .'</form>
                
                <script src="'.base_url("admin_components/tinymce/tinymce.min.js").'"></script>
                <script type="text/javascript">
                    tinymce.init({
                        selector: "textarea",  
                        menubar: false,
                        toolbar: "sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
                    });
                    
                    /*$(function(){
                        $( "#submitForm" ).click(function( event ) {

                            var formData = {
                                "id"                : $("input[name=id]").val(),
                                "detail"             : $("textarea[name=detail]").val()
                            };

                            event.preventDefault();
                            $.ajax({

                                url: "'.site_url("welcome/update").'",
                                type: "post",
                                data: formData,
                                success : function(text)
                                {
                                    $("#getCode").html(text);

                                    $("#squarespaceModal").modal("show");
                                }
                            });
                        });
                    });*/
                </script>
                
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                        <a href="javascript:void(0)" id="'. $domain->id .'" onclick="showId(this.id);" class="btn btn-default">Back</a>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal" role="button">Close</button>    
                    </div>                    
                </div>               
            </div>';
        
        
        
    }
    
    public function update($id) {
        
        $data['detail'] = $this->encrypt($this->input->post('detail'), 'gh9K*fCsZa2@hBc&hjasLKVfVBNa*%f');
        $data['last_update'] = date('Y-m-d');
        
        $resp = $this->credential->save($data, $id);

        if ($resp === TRUE) {
            $this->handle_error('<div class="alert alert-danger">Error while saving file info to Database.</div>');
        } else {
            
            if($id){
                    
                $log['domain_id'] = $this->input->post('domain_id') ;
                $log['credential_id'] = $id ;
                $log['user_id'] = $this->session->userdata('id');
                $log['date_time'] = date('Y-m-d H:i:s',now());
                $log['status'] = 'Update';

                $resp = $this->logs->save($log);

            }
            
            $this->handle_success('<div class="alert alert-success">Save Data Successfully.</div>');
        }

        $this->session->set_flashdata('n_error', $this->error);
        $this->session->set_flashdata('success', $this->success);
        
        redirect('welcome');
        
        /*$data['detail'] = base64_encode($this->input->post('detail'));
        $id = $this->input->post('id');
        
        echo $data['detail'].' '.$id;
        
        $resp = $this->credential->save($data, $id);
        
        if ($resp === TRUE) {
            
            echo '<div class="modal-body" >
                <div class="alert alert-danger">Error while saving file info to Database.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal" role="button">Close</button>
            </div>';            
            
        } else {
            
            echo '<div class="modal-body" >
                <div class="alert alert-success">Update Data Successfully.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal" role="button">Close</button>
            </div>';
            
        }*/
        
        
        
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
  
    
    public function editProfile($id) {
        
        $this->data['user'] = $this->user->get($id);
        
        $rules = $this->user->rules_update;
        $this->form_validation->set_rules($rules);
        
        if ($this->form_validation->run() == TRUE) {
            $data['full_name'] = $this->input->post('full_name');
            $data['username'] = $this->input->post('username');
            
            if($this->input->post('password') != ''){
                $data['password'] = $this->login->hash($this->input->post('password'));
            }
            
            $data['email'] = $this->input->post('email');
            $data['contact_no'] = $this->input->post('contact_no');
            $data['address'] = $this->input->post('address');
            $data['remark'] = $this->input->post('remark');
            $data['user_type'] = $this->input->post('user_type');
            
            if($this->input->post('date') != ''){
            $data['date'] = $this->input->post('date');
            } else {
            $data['date'] = date('Y-m-d');    
            }
            
            if($this->input->post('status') != ''){
                $data['status'] = $this->input->post('status'); 
            } else {
                $data['status'] = 1;                   
            }
            
            $resp = $this->user->save($data, $id);
            
            $lastid = $this->db->insert_id();
            
            if ($resp === TRUE) {
                $this->handle_error('<div class="alert alert-danger">Error while saving file info to Database.</div>');
            } else {
                $this->handle_success('<div class="alert alert-success">Save Data Successfully.</div>');
            }
            
            $this->session->set_flashdata('n_error', $this->error);
            $this->session->set_flashdata('success', $this->success);
            
            redirect('welcome/editProfile/'.$id); 
        }
        
        $this->data['subview'] = 'public/pages/editProfile';
        $this->load->view('public/common/_layout_main', $this->data);
    }
    
}
