<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Horestco\My\Model;

class Api extends HRC_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library(['order']);

		$this->get = (object)$this->input->get();
	}

	public function customer($id)
	{
		$customer = Horestco\My\Model\Customer::find();

		echo $customer->toJson();
	}

	public function order()
	{
		if( !is_null($this->input->get('latest')) )
		{
			$order = Transaction::orderBy('id', 'desc')->first();

			$lastRow = $order->id + 1;

			echo $this->order->createRefId( $lastRow );
		}
	}

	public function hasRefId($refId)
	{
		/////////////////////
		// admin authentic //
		/////////////////////
		if( !$this->hasAdmin( $this->input->get('_e'),   $this->input->get('_p')) )
		{
			echo "error";
			exit;
		}

		echo in_array($refId, Transaction::lists('reference_id')) ? 1 : 0;
		exit;
	}

	public function takeOrder()
	{
		/////////////////////
		// admin authentic //
		/////////////////////
		if( !$this->hasAdmin( $this->input->get('_e'),   $this->input->get('_p')) )
		{
			echo "error";
			exit;
		}

		$refId = Transaction::insertGetId([
				'reference_id'				=> $this->input->get('refId'), 
				'transaction_id'			=> 'Google App Scripts', 
				'customer_id'					=> 1,
				'payment_id'					=> 1,
				'amount'							=> 'MYR '.$this->input->get('amount'),
				'remark'							=> $this->input->get('remark'),
				'product_description'	=> $this->input->get('description'),
				'status'							=> 1,
				'error'								=> '',
				'created_at'					=> $this->dateNow(),
			]);
	}

	public function productById($id)
	{
		/////////////////////
		// admin authentic //
		/////////////////////
		if( !$this->hasAdmin( $this->input->get('_e'),   $this->input->get('_p')) )
		{
			echo "error";
			exit;
		}

		$product = Product::findOrFail($id);

		$product->slug = str_slug($product->name).'-'.$product->id;

		echo $product->toJson();
	}

	public function subcategoriesByCat($category)
	{
		/////////////////////
		// admin authentic //
		/////////////////////
		if( !$this->hasAdmin( $this->input->get('_e'),   $this->input->get('_p')) )
		{
			echo "error";
			exit;
		}

		$cat = Category::whereSlug($category)
										->with([
												'subcategories' => function($q){
													$q->where('is_enabled', 1);
												}
											])
										->first();
		// vd($cat->subcategories->toArray());
		echo $cat->subcategories->toJson();
	}

	/**
	 * send data to Gdrive
	 * @param  [type] $subcategory [description]
	 * @return [type]              [description]
	 * Usage : /api/productBySub/indoor-dining-chairs?_e=email@domain.com&_p=password
	 */
	public function productsBySub($subcategory)
	{
		/////////////////////
		// admin authentic //
		/////////////////////
		if( !$this->hasAdmin( $this->input->get('_e'),   $this->input->get('_p')) )
		{
			echo "error";
			exit;
		}
		//////////////
		// get data //
		//////////////
		// leftJoin() Docs see https://laravel.com/docs/5.0/queries#joins
		
		$sub = Subcategory::whereSlug($subcategory)
											->leftJoin('products', function ($join){
												$join->on('products.subcategory_id', '=', 'subcategories.id')
                 							->where('products.is_enabled', '=', 1);
											})
											->select(
												'subcategories.name as subcategory', 
												'products.id', 
												'products.name', 
												'products.code'
											)
											->get();

		echo $sub->toJson();
	}

	private function hasAdmin($email, $password)
	{
		$user = Model\User::find(1);

		return $email == $user->email && password_verify($password, $user->password ) ;
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */