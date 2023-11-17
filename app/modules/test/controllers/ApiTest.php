<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class ApiTest extends HRC_Controller{

	public function __construct()
	{
		parent::__construct();

	}

	public function index($param)
	{
		echo Product::find($id)->name;
	}

	public function geo()
	{
		$this->load->library('geo');

		vd($this->geo->getLocation());
	}
}


