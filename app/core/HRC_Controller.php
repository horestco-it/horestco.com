<?php

/**
* HRC Base Controller 
*/

class HRC_Controller extends MX_Controller
{
	protected $currency;

	// global data store
	protected $data = array();

	// google
	protected $googleSheet = [];
	
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('product');

		$this->load->helper('image_helper');

		$this->currency = 'MYR';

		$this->data['currency'] = 'MYR';
		// store categories
		$this->data['categories'] = $this->getCategories();

		$this->data['menus'] = $this->mainMenu();

		$this->data['redirectToShop'] = base_url('furniture/area/dining');

		$this->data['version'] = '';
		$this->data['page'] = $this->uri->uri_string();
	}
	/**
	 * @return Timestamps Date now
	 */
	protected function dateNow()
	{
		return \Carbon\Carbon::now('Asia/Jakarta');
	}
	
	/**
	 * @param  [type]
	 * @return [type]
	 */
	protected function pages($category = null)
	{
		if(is_null($category))
		{
			return Page::en()->enabled()->get();
		}

		if (is_string($category))
		{
			return Page::en()->enabled()->where('category', $category)->get();
		}
		
		if (is_array($category))
		{
			$site = new stdClass();
			foreach ((array)$category as $cat) {
				$site->$cat = Page::en()->enabled()->where('category', $cat)->get();
			}
			return $site;
		}

	}

	protected function metaData()
	{
		$page = Page::slug('/')
									->en()
									->with(array(
										'metas'
									))
									->first();
		return $page->metas;
	}

	protected function mainMenu()
	{
		return Menu::with(array('submenus' => function($q){
			$q->where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
		}))->where('is_active', 1)->orderBy('sort_order', 'asc')->get();
	}

	/*
	 * Retrieve single product
	*/
	protected function product($name, $id)
	{
		$product = Product::where('id', $id)
						->with(array(
							'category',
							'subcategory',
							'prices' => function($query){
								
							},
							'relations',
							'images' => function($query){
								$query->orderBy('sort_order');
							}
						))
						->first();
		// redirect to 404
		if (is_null($product)) show_404();

		return $product;
	}

	public function getProducts($req = null)
	{
		$products = Product::orderBy('name')
										->with(array(
											'subcategory',
											'images'
										))
										->get();
		switch ($req) {
			case 'json':
				return $products->toJson();
				break;
			case 'code':
				return $products->lists('code');
				break;
			default:
				return $products;
		}
	}

	protected function addPrices($productId)
	{

		return ProductPrice::insertGetId([
			'product_id' => $productId,
			'created_at' => \Carbon\Carbon::now('Asia/Jakarta')
		]);

	}

	protected function submenuRefsubcatid()
	{
		return Submenu::where('id', '<', 31)
												->orderBy('id')
												->whereNotNull('subcategory_id')
												->lists('subcategory_id');
	}

	protected function getSubcategories($req = null)
	{
		$cat = \Category::where('id', $this->input->post('id'))
												->with([
													'subcategories'=> function($query){
														$query->enabled()->orderBy('name');
													}
												])
												->first();
		return $req == 'json' ? print_r($cat->subcategories->toJson())	: $cat->subcategories;
	}

	protected function getCategories($req = null)
	{
		$categories = \Category::enabled()->get();

		return $req == 'json' ? print_r($categories->toJson) : $categories;
	}

	protected function relations($relations)
	{
		$html = '';
		foreach ($relations as $product) {
			foreach ($product->images as $image) {
				if ($image->sort_order == 1) {
					$html .= '<div class="col xs12 s6 m4"><div class="card"><div class="card-image">';
					$html .= image_thumb(product_img_url("$image->name"), 300);
					$html .= '</div><div class="card-content">'.$product->name.'</div></div></div>';
				}
			}
		}
		return $html;
	}

	protected function getPortfolios($slug)
	{
		return Page::enabled()
                      ->slug($slug)
                      ->en()
                      ->with(array(
                        'clients' => function($query){
                          $query
                          ->enabled()
                          ->with(array(
                          	'page',
                            'images' => function($query){
                              $query->where('is_primary', 1);
                            },
                            'image',
                          ));
                        }
                      ))
                      ->first();
	}

}