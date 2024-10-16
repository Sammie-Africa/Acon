<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_header');
        $this->load->model('admin/Model_page');
    }
	public function index()
	{
		$data['error'] = '';
		$data['success'] = '';

		$header['setting'] = $this->Model_header->get_setting_data();
		$data['page'] = $this->Model_page->show();

		$this->load->view('admin/view_header',$header);
		$this->load->view('admin/view_page',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function delete_about_photo()
	{
		if(PROJECT_MODE == 0) {
			redirect(base_url().'admin/page');
		}

		$t = $this->Model_page->get_about_photo_name();
		unlink('./public/uploads/'.$t['about_photo']);

        $form_data = array(
			'about_photo' => ''
        );
        $this->Model_page->about_photo_update($form_data);

        redirect(base_url().'admin/page');
	}

	public function update()
	{
		$data['error'] = '';
		$data['success'] = '';

		$data['page'] = $this->Model_page->show();

		if(isset($_POST['form_about_photo'])) {
			$valid = 1;
			$path = $_FILES['about_photo']['name'];
		    $path_tmp = $_FILES['about_photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_header->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $data['error'] = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $data['error'] = 'You must have to select a photo<br>';
		    }

			if(PROJECT_MODE == 0) {
				$valid = 0;
				$data['error'] = PROJECT_NOTIFICATION;
			}

		    if($valid == 1) {

		    	if($_POST['current_about_photo'] != '')
		    	{
			    	// removing the existing photo
			    	unlink('./public/uploads/'.$_POST['current_about_photo']);	
		    	}
		    	
		    	// updating the data
		    	$final_name = 'about_photo'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'about_photo' => $final_name
	            );
	        	$this->Model_page->update($form_data);
	        	$data['success'] = 'About Photo is updated successfully!';		    	
		    }        	
		}

		if(isset($_POST['form_home'])) {
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}			

        	$form_data = array(
				'mt_home' => $_POST['mt_home'],
				'mk_home' => $_POST['mk_home'],
				'md_home' => $_POST['md_home']
            );
        	$this->Model_page->update($form_data);
        	$data['success'] = 'Home Page Setting is updated successfully!';
		}

		if(isset($_POST['form_about'])) {	
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}		

        	$form_data = array(
				'about_heading' => $_POST['about_heading'],
				'about_content' => $_POST['about_content'],
				'mission_heading' => $_POST['mission_heading'],
				'mission_content' => $_POST['mission_content'],
				'vision_heading' => $_POST['vision_heading'],
				'vision_content' => $_POST['vision_content'],
				'mt_about'      => $_POST['mt_about'],
				'mk_about'      => $_POST['mk_about'],
				'md_about'      => $_POST['md_about']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'About Page Setting is updated successfully!';
		}


		if(isset($_POST['form_gallery'])) {	
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}		

        	$form_data = array(
				'gallery_heading' => $_POST['gallery_heading'],
				'mt_gallery'      => $_POST['mt_gallery'],
				'mk_gallery'      => $_POST['mk_gallery'],
				'md_gallery'      => $_POST['md_gallery']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'Gallery Page Setting is updated successfully!';
		}


		if(isset($_POST['form_faq'])) {		
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}	

        	$form_data = array(
				'faq_heading' => $_POST['faq_heading'],
				'mt_faq'      => $_POST['mt_faq'],
				'mk_faq'      => $_POST['mk_faq'],
				'md_faq'      => $_POST['md_faq']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'FAQ Page Setting is updated successfully!';
		}


		if(isset($_POST['form_service'])) {		
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'service_heading' => $_POST['service_heading'],
				'mt_service'      => $_POST['mt_service'],
				'mk_service'      => $_POST['mk_service'],
				'md_service'      => $_POST['md_service']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'Service Page Setting is updated successfully!';
		}


		if(isset($_POST['form_portfolio'])) {	
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}		

        	$form_data = array(
				'portfolio_heading' => $_POST['portfolio_heading'],
				'mt_portfolio'      => $_POST['mt_portfolio'],
				'mk_portfolio'      => $_POST['mk_portfolio'],
				'md_portfolio'      => $_POST['md_portfolio']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'Portfolio Page Setting is updated successfully!';
		}


		if(isset($_POST['form_testimonial'])) {	
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}		

        	$form_data = array(
				'testimonial_heading' => $_POST['testimonial_heading'],
				'mt_testimonial'      => $_POST['mt_testimonial'],
				'mk_testimonial'      => $_POST['mk_testimonial'],
				'md_testimonial'      => $_POST['md_testimonial']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'Testimonial Page Setting is updated successfully!';
		}


		if(isset($_POST['form_news'])) {	
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}		

        	$form_data = array(
				'news_heading' => $_POST['news_heading'],
				'mt_news'      => $_POST['mt_news'],
				'mk_news'      => $_POST['mk_news'],
				'md_news'      => $_POST['md_news']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'News Page Setting is updated successfully!';
		}


		if(isset($_POST['form_contact'])) {	
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}		

        	$form_data = array(
				'contact_heading' => $_POST['contact_heading'],
				'mt_contact'      => $_POST['mt_contact'],
				'mk_contact'      => $_POST['mk_contact'],
				'md_contact'      => $_POST['md_contact']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'Contact Page Setting is updated successfully!';
		}


		if(isset($_POST['form_search'])) {	
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}		

        	$form_data = array(
				'search_heading' => $_POST['search_heading'],
				'mt_search'      => $_POST['mt_search'],
				'mk_search'      => $_POST['mk_search'],
				'md_search'      => $_POST['md_search']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'Search Page Setting is updated successfully!';
		}


		if(isset($_POST['form_term'])) {		
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}	

        	$form_data = array(
				'term_heading' => $_POST['term_heading'],
				'term_content' => $_POST['term_content'],
				'mt_term'      => $_POST['mt_term'],
				'mk_term'      => $_POST['mk_term'],
				'md_term'      => $_POST['md_term']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'Term Page Setting is updated successfully!';
		}

		if(isset($_POST['form_privacy'])) {	
			if(PROJECT_MODE == 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}		
			
        	$form_data = array(
				'privacy_heading' => $_POST['privacy_heading'],
				'privacy_content' => $_POST['privacy_content'],
				'mt_privacy'      => $_POST['mt_privacy'],
				'mk_privacy'      => $_POST['mk_privacy'],
				'md_privacy'      => $_POST['md_privacy']
            );
        	$this->Model_page->update($form_data);        	
        	$data['success'] = 'Privacy Page Setting is updated successfully!';
		}


		$header['setting'] = $this->Model_header->get_setting_data();
		$data['page'] = $this->Model_page->show();

		$this->load->view('admin/view_header',$header);
		$this->load->view('admin/view_page',$data);
		$this->load->view('admin/view_footer');
	}
	
}
