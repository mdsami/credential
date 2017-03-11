<?php

class Mailer_Model extends CI_Model {

    /**
     * sends mail
     * @author Md. Hasib Bin Siddique
     * @param --- $data - information to place in the mail 
     * $templateName - html template to use in mail body          
     * @return --- none
     * modified by ----- MithuCN
     */
    function sendeEmail($mail, $templateName) {
        $config['protocol'] = $mail['protocol'];
        $config['smtp_host'] =$mail['smtp_host'];
        $config['smtp_port'] = $mail['smtp_port'];
        $config['smtp_user'] = $mail['smtp_user'];
        $config['smtp_pass'] = $mail['smtp_pass'];
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->load->library('email', $config);
        $this->email->set_mailtype('html');
        $this->email->from($mail['smtp_user']);
        $this->email->to($mail['to_email']);
        $this->email->subject($mail['subject']);
        $body = $this->load->view("panel/mailScripts/".$templateName, $mail, true);
        //echo $body;exit;
        $this->email->message($body);
        $this->email->send();
        $this->email->clear();
    }
 

}

?>
