<?php

/**
* 
*/
class Test extends HRC_Controller
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->library('auth');
		
	}

	public function index($value='')
	{
		$arr1 = ['satu'=>1];
		$arr2 = ['dua'=>2];

		vd(array_merge($arr1, $arr2));
	}

	public function google()
	{
		$this->load->library('google');

		$stock = $this->google->getStock('HDC206');

		vd($stock);
	}

	
}