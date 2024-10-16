<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct() 
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_contact');
    }

	public function index()
	{
		$header['setting'] = $this->Model_common->get_setting_data();
		$header['page'] = $this->Model_common->get_page_data();
		$header['comment'] = $this->Model_common->get_comment_code();
		$header['social'] = $this->Model_common->get_social_data();
		$header['language'] = $this->Model_common->get_language_data();
		$header['latest_news'] = $this->Model_common->get_latest_news();
		$header['popular_news'] = $this->Model_common->get_popular_news();

		$subject_text = $this->Model_contact->get_subject();
		$success_text = $this->Model_contact->get_success_text();

		$data['error'] = '';
		$data['success'] = '';

		if(isset($_POST['form_contact'])) 
		{
			$valid = 1;

			$this->form_validation->set_rules('visitor_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('visitor_email', 'Email Address', 'trim|valid_email|required');
			$this->form_validation->set_rules('visitor_phone', 'Phone', 'trim|required');
			$this->form_validation->set_rules('visitor_comment', 'Comment', 'trim|required');
         			
            if($this->form_validation->run() == FALSE) {
				$valid = 0;
            	$data['error'] = validation_errors();
            } 

			if(PROJECT_MODE == 0) {
				$valid = 0;
				$data['error'] = PROJECT_NOTIFICATION;
			}

			if($valid == 1) 
			{
            	$msg = '
            		<h3>Visitor Information</h3>
					Name<br>
					'.$_POST['visitor_name'].'<br><br>
					Email<br>
					'.$_POST['visitor_email'].'<br><br>
					Phone<br>
					'.$_POST['visitor_phone'].'<br><br>
					Comment<br>
					'.nl2br($_POST['visitor_comment']).'
				';

            	$config = [
					'protocol' => 'smtp',
					'smtp_host' => $header['setting']['smtp_host'],
					'smtp_port' => $header['setting']['smtp_port'],
					'smtp_user' => $header['setting']['smtp_username'],
					'smtp_pass' => $header['setting']['smtp_password'],
					'crlf' => "\r\n",
					'newline' => "\r\n",
					'mailtype'  => 'html',
					'charset'   => 'utf-8'
				];

				$this->load->library('email', $config);


				$this->email->from($header['setting']['send_email_from']);
				$this->email->to($header['setting']['receive_email_to']);
				$this->email->reply_to($_POST['visitor_email']);

				$this->email->subject($subject_text['value']);
				$this->email->message($msg);

				$this->email->send();

				$data['success'] = $success_text['value'];
            }

		}

		$this->load->view('view_header',$header);
		$this->load->view('view_contact',$data);
		$this->load->view('view_footer');
		
	}

}