<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_header');
        $this->load->model('admin/Model_photo');
    }

	public function index()
	{
		$header['setting'] = $this->Model_header->get_setting_data();

		$data['photo'] = $this->Model_photo->show();

		$this->load->view('admin/view_header',$header);
		$this->load->view('admin/view_photo',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$header['setting'] = $this->Model_header->get_setting_data();

		$data['error'] = '';
		$data['success'] = '';
		$error = '';

		if(isset($_POST['form1'])) {

			$valid = 1;

			$this->form_validation->set_rules('photo_caption', 'Photo Caption', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_header->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error .= 'You must have to select a photo for featured photo<br>';
		    }

			if(PROJECT_MODE == 0) {
				$valid = 0;
				$error = PROJECT_NOTIFICATION;
			}

		    if($valid == 1) 
		    {
				$next_id = $this->Model_photo->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        $final_name = 'photo-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $form_data = array(
					'photo_caption' => $_POST['photo_caption'],
					'photo_name' => $final_name,
					'photo_show_home' => $_POST['photo_show_home']
	            );
	            $this->Model_photo->add($form_data);

		        $data['success'] = 'Photo is added successfully!';

		    } 
		    else
		    {
		    	$data['error'] = $error;
		    }

            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_photo_add',$data);
			$this->load->view('admin/view_footer');
            
        } else {
            
            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_photo_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	// If there is no service in this id, then redirect
    	$tot = $this->Model_photo->photo_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/photo');
        	exit;
    	}
       	
       	$header['setting'] = $this->Model_header->get_setting_data();
		$data['error'] = '';
		$data['success'] = '';
		$error = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$this->form_validation->set_rules('photo_caption', 'Photo Caption', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_header->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    }

			if(PROJECT_MODE == 0) {
				$valid = 0;
				$error = PROJECT_NOTIFICATION;
			}


		    if($valid == 1) 
		    {
		    	$data['photo'] = $this->Model_photo->getData($id);

		    	if($path == '') {
		    		$form_data = array(
						'photo_caption' => $_POST['photo_caption'],
						'photo_show_home' => $_POST['photo_show_home']
		            );
		            $this->Model_photo->update($id,$form_data);
				}
				else {

					unlink('./public/uploads/'.$data['photo']['photo_name']);

					$final_name = 'photo-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        	$form_data = array(
						'photo_caption' => $_POST['photo_caption'],
						'photo_name' => $final_name,
						'photo_show_home' => $_POST['photo_show_home']
		            );
		            $this->Model_photo->update($id,$form_data);
				}
				

				$data['success'] = 'Photo is updated successfully';
		    }
		    else
		    {
		    	$data['error'] = $error;
		    }

		    $data['photo'] = $this->Model_photo->getData($id);
	       	$this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_photo_edit',$data);
			$this->load->view('admin/view_footer');
           
		} else {
			$data['photo'] = $this->Model_photo->getData($id);
	       	$this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_photo_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
		// If there is no photo in this id, then redirect
    	$tot = $this->Model_photo->photo_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/photo');
        	exit;
    	}

		if(PROJECT_MODE == 0) {
			redirect($_SERVER['HTTP_REFERER']);
		}

        $data['photo'] = $this->Model_photo->getData($id);
        if($data['photo']) {
            unlink('./public/uploads/'.$data['photo']['photo_name']);
        }

        $this->Model_photo->delete($id);
        redirect(base_url().'admin/photo');
    }

}