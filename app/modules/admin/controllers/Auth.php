<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$newdata = array(
        'username'  => 'johndoe',
        'email'     => 'johndoe@some-site.com'
		);

		$this->session->set_userdata($newdata);
	}

}

/* End of file Verify.php */
/* Location: ./application/controllers/Verify.php */