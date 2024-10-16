<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Why_choose extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_header');
        $this->load->model('admin/Model_why_choose');
    }

	public function index()
	{
		$header['setting'] = $this->Model_header->get_setting_data();

		$data['why_choose'] = $this->Model_why_choose->show();

		$this->load->view('admin/view_header',$header);
		$this->load->view('admin/view_why_choose',$data);
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

			$this->form_validation->set_rules('heading', 'Heading', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');

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
				$next_id = $this->Model_why_choose->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        $final_name = 'why-choose-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $form_data = array(
					'photo'   => $final_name,
					'heading' => $_POST['heading'],
					'content' => $_POST['content']
					
	            );
	            $this->Model_why_choose->add($form_data);

		        $data['success'] = 'Why Choose Us is added successfully!';

		        unset($_POST['heading']);
		        unset($_POST['content']);
		    } 
		    else
		    {
		    	$data['error'] = $error;
		    }

            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_why_choose_add',$data);
			$this->load->view('admin/view_footer');
            
        } else {
            
            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_why_choose_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	// If there is no why choose in this id, then redirect
    	$tot = $this->Model_why_choose->why_choose_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/why-choose');
        	exit;
    	}
       	
       	$header['setting'] = $this->Model_header->get_setting_data();
		$data['error'] = '';
		$data['success'] = '';
		$error = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$this->form_validation->set_rules('heading', 'Heading', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');

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
		    	$data['why_choose'] = $this->Model_why_choose->getData($id);

		    	if($path == '') {
		    		$form_data = array(
						'heading' => $_POST['heading'],
						'content' => $_POST['content']
		            );
		            $this->Model_why_choose->update($id,$form_data);
				}
				else {
					unlink('./public/uploads/'.$data['why_choose']['photo']);

					$final_name = 'why-choose-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        	$form_data = array(
						'photo'   => $final_name,
						'heading' => $_POST['heading'],
						'content' => $_POST['content']
		            );
		            $this->Model_why_choose->update($id,$form_data);
				}
				
				$data['success'] = 'Why Choose Us is updated successfully';
		    }
		    else
		    {
		    	$data['error'] = $error;
		    }

		    $data['why_choose'] = $this->Model_why_choose->getData($id);
	       	$this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_why_choose_edit',$data);
			$this->load->view('admin/view_footer');
           
		} else {
			$data['why_choose'] = $this->Model_why_choose->getData($id);
	       	$this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_why_choose_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
		// If there is no why choose in this id, then redirect
    	$tot = $this->Model_why_choose->why_choose_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/why-choose');
        	exit;
    	}

		if(PROJECT_MODE == 0) {
			redirect(base_url().'admin/why-choose');
		}

        $data['why_choose'] = $this->Model_why_choose->getData($id);
        if($data['why_choose']) {
            unlink('./public/uploads/'.$data['why_choose']['photo']);
        }

        $this->Model_why_choose->delete($id);
        redirect(base_url().'admin/why-choose');
    }

    public function main_photo() {

    	$header['setting'] = $this->Model_header->get_setting_data();
		$data['error'] = '';
		$data['success'] = '';
    	
    	if(isset($_POST['form1'])) {
			$valid = 1;
			
		    $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_header->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $data['error'] = 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    } else {
		    	$valid = 0;
		        $data['error'] = 'You must have to select a photo for featured photo<br>';
		    }

			if(PROJECT_MODE == 0) {
				$valid = 0;
				$data['error'] = PROJECT_NOTIFICATION;
			}

			if($valid == 1) {

				$data['why_choose'] = $this->Model_why_choose->get_photo();

				unlink('./public/uploads/'.$data['why_choose']['main_photo']);

				$final_name = 'why-choose-main-photo'.'.'.$ext;
		    	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

				$form_data = array(
					'main_photo' => $final_name
	            );
	            $this->Model_why_choose->update_why_choose_photo($form_data);			   

			    $data['success'] = 'Why Choose Us (Main Photo) is updated successfully!';
			}

			$data['why_choose'] = $this->Model_why_choose->get_photo();
	       	$this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_why_choose_main_photo',$data);
			$this->load->view('admin/view_footer');

		} else {
			$data['why_choose'] = $this->Model_why_choose->get_photo();
	       	$this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_why_choose_main_photo',$data);
			$this->load->view('admin/view_footer');
		}

    }



    public function item_bg() {

    	$header['setting'] = $this->Model_header->get_setting_data();
		$data['error'] = '';
		$data['success'] = '';
    	
    	if(isset($_POST['form1'])) {
			$valid = 1;
			
		    $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_header->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $data['error'] = 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    } else {
		    	$valid = 0;
		        $data['error'] = 'You must have to select a photo for featured photo<br>';
		    }

			if(PROJECT_MODE == 0) {
				$valid = 0;
				$data['error'] = PROJECT_NOTIFICATION;
			}

			if($valid == 1) {

				$data['why_choose'] = $this->Model_why_choose->get_photo();

				unlink('./public/uploads/'.$data['why_choose']['item_bg']);

				$final_name = 'why-choose-item-bg'.'.'.$ext;
		    	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

				$form_data = array(
					'item_bg' => $final_name
	            );
	            $this->Model_why_choose->update_why_choose_photo($form_data);			   

			    $data['success'] = 'Why Choose Us (Item Background) is updated successfully!';
			}

			$data['why_choose'] = $this->Model_why_choose->get_photo();
	       	$this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_why_choose_item_bg',$data);
			$this->load->view('admin/view_footer');

		} else {
			$data['why_choose'] = $this->Model_why_choose->get_photo();
	       	$this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_why_choose_item_bg',$data);
			$this->load->view('admin/view_footer');
		}

    }

}