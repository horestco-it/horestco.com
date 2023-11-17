<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Api extends HRC_Controller{

	public function __construct()
	{
		parent::__construct();

	}

	public function index($id)
	{
		echo Product::find($id)->name;
	}
}


