<?php

class Users extends Controller
{
	function __construct()
	{
		parent::Controller();
		$this->load->model('user_model');
	}
	
	function index()
	{
		$data['view_file'] = 'admin/users/index';
		$data['section_name'] = array(
									array(
										'title' => 'Dashboard',
										'url' => 'admin'
									),
									array(
										'title' => 'Users',
										'url' => 'admin/users/index'
									)
								);
		
		$data['users'] = $this->user_model->get_users();
		$this->load->view('admin/layout', $data);
	}
	
	function delete()
	{
		$user_id = $this->uri->segment(4);
		if (!is_valid_number($user_id))
		{
			$this->session->set_flashdata('notice','Invalid Request');
			redirect('admin/users/index');
		}
		
		$this->user_model->delete_user($user_id);
		$this->session->set_flashdata('notice','User Deleted');
		redirect('admin/users/index');
	}
}