<?php

class Promotion extends HRC_Controller
{
	public function __construct()
  {
    parent::__construct();

    $this->data['menus'] = $this->mainMenu();
  }

  public function index()
  {

  	$this->data['sizes'] = $this->getProductsPromotions();

		$this->data['page'] = 'malaysia-furniture-promotions';
		
		// return;
		return $this->load->view('malaysia-furniture-promotions', $this->data);
  }

  public function getProductsPromotions()
  {
  	return ProductSize::whereHas('price', function($q){
			$q->promotion();
		})->get();
  }
}