<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MX_Controller {

	protected $db;

	public function __construct()
	{
		parent::__construct();

		$this->is_logged();
	}

	public function index()
	{
		$data['user'] = $this->session->user;

		$data['page'] = 'dashboard';

		$this->load->view('templates/default', $data);
	}


	protected function is_logged()
	{
		// var_dump($this->session->has_userdata('logged_in'));
		if($this->session->has_userdata('logged_in'))
		{
			$session = $this->session->userdata('logged_in');

			$this->session->set_flashdata('user', $session);
		}
		else{
			$this->session->set_flashdata('item', 'value');

			redirect('admin/login');
		}
	}


}







/* End of file Dashboard.php */



/* Location: ./application/controllers/Dashboard.php */