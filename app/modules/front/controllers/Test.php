<?php

/**
* 
*/
class Test extends HRC_Controller
{
	
	public function __construct()
	{
		parent::__construct();

		$config['protocol'] = "smtp";
    $config['smtp_host'] = "ssl://smtp.googlemail.com";
    $config['smtp_port'] = "465";
    $config['smtp_user'] = "huiralb@gmail.com";
    $config['smtp_pass'] = "hHuUs$@1";
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";

		$this->load->library('email', $config);
	}

	public function index()
	{
		$this->email->from('huiralb@gmail.com', 'Irnovi');
		$this->email->to('irnovi@horestco.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();

		echo $this->email->print_debugger();
	}
}