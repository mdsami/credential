<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logs
 *
 * @author USER
 */
class Logs extends Admin_Controller{
    
    private $error;
    private $success;
    
    public function __construct() {
        parent::__construct();
        
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
        
        $this->data['domain'] = $this->domain->get_list();
        
        // Load the view
        $this->data['sub_view'] = 'panel/logs/index';
        $this->load->view('panel/common/_layout_main', $this->data);
        
    }
    
    public function fatch() {
        
        $datas = $this->logs->get_info($this->input->post('domain_id'));
        
        if($datas){
            foreach ($datas as $data) {
                echo '<tr>
                    <th>'.$data->title.'</th>
                    <th>'.$data->username.'</th>
                    <th>'.$data->status.'</th>
                    <th>'.date ("l - F d Y - h:iA",strtotime($data->date_time)).'</th>
                </tr>';
            }
        } else {
            echo '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No data available in table</td></tr>';
        }
        
        
    }
    
    
}
