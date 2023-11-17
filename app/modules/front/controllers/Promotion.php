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

  	$this->data['products'] = ProductPrice::promotion()->with([
	  		'product' => function($query){
	  			$query->sort()->with([
	  					'sizes' => function($query){
	  						$query->orderBy('sort_order');
	  					},
	  					'images' => function($query){
	  						$query->orderBy('is_primary', 'desc');
	  					}
	  				]);
	  		}
	  	])->get();;

		$this->data['page'] = 'malaysia-furniture-promotions';
		
		// return;
		$this->load->view('pages/malaysia-furniture-promotions', $this->data);
  }
}