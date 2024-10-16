<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_header');
        $this->load->model('admin/Model_menu');
    }
	public function index()
	{
		$data['error'] = '';
		$data['success'] = '';

        $header['setting'] = $this->Model_header->get_setting_data();
		$data['menu'] = $this->Model_menu->show();

		$this->load->view('admin/view_header',$header);
		$this->load->view('admin/view_menu',$data);
		$this->load->view('admin/view_footer');
		
	}
	public function update()
	{
		$data['error'] = '';
		$data['success'] = '';

        $header['setting'] = $this->Model_header->get_setting_data();
		$data['menu'] = $this->Model_menu->show();

		if(isset($_POST['form1'])) {	
			
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_status'  => $_POST['home_status'],
				'about_status' => $_POST['about_status'],
				'gallery_status' => $_POST['gallery_status'],
				'faq_status' => $_POST['faq_status'],
				'service_status' => $_POST['service_status'],
				'portfolio_status' => $_POST['portfolio_status'],
				'testimonial_status'  => $_POST['testimonial_status'],
				'news_status'  => $_POST['news_status'],
				'contact_status' => $_POST['contact_status']
            );
        	$this->Model_menu->update($form_data);   	
        	$data['success'] = 'Menu is updated successfully!';
		}

        $data['menu'] = $this->Model_menu->show();

		$this->load->view('admin/view_header',$header);
		$this->load->view('admin/view_menu',$data);
		$this->load->view('admin/view_footer');
	}
	
}
