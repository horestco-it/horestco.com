<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductApi extends HRC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return show_error(404);
	}

	public function all()
	{
		$products = Product::enabled()->orderBy('name')->lists('name', 'id');
		echo json_encode($products);
	}

	public function getImagesByProductId($id)
	{
		$product = Product::find($id);

		echo $product->images()->enabled()->select(['id', 'name', 'is_primary'])->get()->toJson();
	}

}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */