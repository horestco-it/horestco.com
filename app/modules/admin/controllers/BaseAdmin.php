<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BaseAdmin extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}


	protected function is_logged_id()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

    if(!isset($is_logged_in) || $is_logged_in != true)
    {
      return redirect('login', 'refresh');
    }
	}

}

/* End of file BaseAdmin.php */
/* Location: ./application/controllers/BaseAdmin.php */