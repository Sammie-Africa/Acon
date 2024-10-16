<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget_password extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_forget_password');
    }

    public function index()
    {
        $data['error'] = '';
        $data['success'] = '';
        $data['setting'] = $this->Model_forget_password->get_setting_data();
        $error = '';

        if(isset($_POST['form1'])) {

            $valid = 1;

            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

            if($this->form_validation->run() == FALSE) {
                $valid = 0;
                $error .= validation_errors();
            } else {
                $tot = $this->Model_forget_password->check_email($_POST['email']);
                if(!$tot) {
                    $valid = 0;
                    $error .= 'You email address is not found in our system.<br>';
                }    
            }

            if(PROJECT_MODE == 0) {
                $valid = 0;
                $error = PROJECT_NOTIFICATION;
            }
             

            if($valid == 1) {

                $token = md5(rand());

                // Update Database
                $form_data = array(
                    'token' => $token
                );
                $this->Model_forget_password->update($_POST['email'],$form_data);
                
                // Send Email
                $msg = '<p>To reset your password, please <a href="'.base_url().'admin/reset-password/index/'.$_POST['email'].'/'.$token.'">click here</a> and enter a new password';
                
                $config = [
					'protocol' => 'smtp',
					'smtp_host' => $data['setting']['smtp_host'],
					'smtp_port' => $data['setting']['smtp_port'],
					'smtp_user' => $data['setting']['smtp_username'],
					'smtp_pass' => $data['setting']['smtp_password'],
					'crlf' => "\r\n",
					'newline' => "\r\n",
					'mailtype'  => 'html',
					'charset'   => 'utf-8'
				];

				$this->load->library('email', $config);
                
                $this->email->reply_to($data['setting']['receive_email_to']);
                $this->email->from($data['setting']['send_email_from']);
                $this->email->to($_POST['email']);

                $subject = 'Password Reset Request';

                $this->email->subject($subject);
                $this->email->message($msg);

                $this->email->send();

                $data['success'] = 'An email is sent to your email address. Please follow instruction in there.';
            } else {
                $data['error'] = $error;
            }

            $this->load->view('admin/view_forget_password',$data);    
            
        } else {
            $this->load->view('admin/view_forget_password',$data);    
        }
        
    }
}
