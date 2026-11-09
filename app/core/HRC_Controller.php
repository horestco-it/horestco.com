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
		$this->load->library('wcstore');

		$this->currency = 'MYR';
		$this->data['currency'] = 'MYR';

		// store categories
		$this->data['categories'] = $this->getCategories();
		$this->data['menus'] = $this->mainMenu();

		$this->data['redirectToShop'] = base_url('furniture');
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
		try {
			if (class_exists('Page') && isset($this->db) && $this->db->table_exists('pages')) {
				$page = Page::slug('/')->en()->with(['metas'])->first();
				if ($page) return $page->metas;
			}
		} catch (\Exception $e) {}
		return [];
	}

	protected function mainMenu()
	{
		return $this->buildFallbackMenu();
	}

	protected function buildFallbackMenu()
	{
		return [
			(object)[
				'name' => 'Dining',
				'url' => 'furniture/area/dining',
				'image' => 'assets/images/menus/dining-furniture-bahamas-dining-table-682-857.jpg',
				'submenus' => [
					(object)['name' => 'Dining Chairs', 'url' => base_url('furniture/dining/dining-chairs'), 'image' => 'assets/images/menus/accura-chair-562-181_300.jpg'],
					(object)['name' => 'Dining Tables', 'url' => base_url('furniture/dining/dining-tables-malaysia-wood-marble-restaurant-tables'), 'image' => 'assets/images/menus/dining-furniture-bahamas-dining-table-682-857.jpg'],
					(object)['name' => 'Bar Chairs & Stools', 'url' => base_url('furniture/dining/bar-chairs'), 'image' => 'assets/images/menus/accura-chair-562-181_300.jpg'],
					(object)['name' => 'Bar Tables', 'url' => base_url('furniture/dining/bar-tables-dining'), 'image' => 'assets/images/menus/dining-furniture-bahamas-dining-table-682-857.jpg'],
					(object)['name' => 'Table Bases', 'url' => base_url('furniture/dining/table-bases'), 'image' => 'assets/images/menus/dining-furniture-bahamas-dining-table-682-857.jpg'],
					(object)['name' => 'Table Tops', 'url' => base_url('furniture/dining/table-tops'), 'image' => 'assets/images/menus/dining-furniture-bahamas-dining-table-682-857.jpg'],
					(object)['name' => 'Booth Seating Sofas', 'url' => base_url('furniture/dining/booth-seating-sofas'), 'image' => 'assets/images/menus/living-furniture-koorg-sofa-872-255_300.jpg'],
					(object)['name' => 'Restaurant Service Furniture & Sideboards', 'url' => base_url('furniture/dining/furniture-dining-service-furniture-sideboards'), 'image' => 'assets/images/menus/dining-furniture-bahamas-dining-table-682-857.jpg'],
				]
			],
			(object)[
				'name' => 'Outdoor',
				'url' => 'furniture/area/outdoor',
				'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg',
				'submenus' => [
					(object)['name' => 'Outdoor Dining Tables', 'url' => base_url('furniture/outdoor/outdoor-dining-tables'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
					(object)['name' => 'Outdoor Dining Chairs', 'url' => base_url('furniture/outdoor/outdoor-chairs'), 'image' => 'assets/images/menus/accura-chair-562-181_300.jpg'],
					(object)['name' => 'Sun Loungers', 'url' => base_url('furniture/outdoor/sun-loungers'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
					(object)['name' => 'Outdoor Sofa', 'url' => base_url('furniture/outdoor/outdoor-sofa'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
					(object)['name' => 'Outdoor Coffee & Side Tables', 'url' => base_url('furniture/outdoor/outdoor-coffee-side-tables'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
					(object)['name' => 'Outdoor Furniture Umbrellas', 'url' => base_url('furniture/outdoor/outdoor-furniture-umbrella'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
					(object)['name' => 'Umbrella Stands', 'url' => base_url('furniture/outdoor/umbrella-stands'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
					(object)['name' => 'Outdoor Benches', 'url' => base_url('furniture/outdoor/outdoor-benches'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
					(object)['name' => 'Terrace Sets', 'url' => base_url('furniture/outdoor/terrace-sets'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
					(object)['name' => 'Miscellaneous', 'url' => base_url('furniture/outdoor/miscellaneous-outdoor'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
					(object)['name' => 'Outdoor Cushions & Covers', 'url' => base_url('furniture/outdoor/outdoor-cushions-covers-canopies'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
				]
			],
			(object)[
				'name' => 'Living',
				'url' => 'furniture/area/living',
				'image' => 'assets/images/menus/living-furniture-koorg-sofa-872-255_300.jpg',
				'submenus' => [
					(object)['name' => 'Sofas', 'url' => base_url('furniture/living/sofas'), 'image' => 'assets/images/menus/living-furniture-koorg-sofa-872-255_300.jpg'],
					(object)['name' => 'TV Consoles', 'url' => base_url('furniture/living/tv-consoles'), 'image' => 'assets/images/menus/living-furniture-florence-director-chair-880-697_465.jpg'],
					(object)['name' => 'Coffee & Side Tables', 'url' => base_url('furniture/living/coffee-side-tables'), 'image' => 'assets/images/menus/living-furniture-florence-director-chair-880-697_465.jpg'],
					(object)['name' => 'Storage', 'url' => base_url('furniture/living/storage-living-room-storage-cabinets'), 'image' => 'assets/images/menus/living-furniture-florence-director-chair-880-697_465.jpg'],
					(object)['name' => 'Lazy Outdoor Chairs', 'url' => base_url('furniture/outdoor/lazy-outdoor-chairs'), 'image' => 'assets/images/menus/living-furniture-florence-director-chair-880-697_465.jpg'],
				]
			],
			(object)[
				'name' => 'Bedroom',
				'url' => 'furniture/area/bedroom',
				'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg',
				'submenus' => [
					(object)['name' => 'Bedside Tables', 'url' => base_url('furniture/bedroom/bedside-tables'), 'image' => 'assets/images/menus/outdoor-furniture-accura-day-bed-1041-911_465.jpg'],
				]
			],
			(object)[
				'name' => 'Office & Bath',
				'url' => 'furniture/area/home-office',
				'image' => 'assets/images/menus/living-furniture-florence-director-chair-880-697_465.jpg',
				'submenus' => [
					(object)['name' => 'Home Office', 'url' => base_url('furniture/home-office/home-office'), 'image' => 'assets/images/menus/living-furniture-florence-director-chair-880-697_465.jpg'],
					(object)['name' => 'Bathroom Furniture', 'url' => base_url('furniture/bathroom/bathroom'), 'image' => 'assets/images/menus/dining-furniture-bahamas-dining-table-682-857.jpg'],
				]
			],
			(object)[
				'name' => 'Sale',
				'url' => 'furniture/area/promotions',
				'image' => 'assets/images/menus/accura-chair-562-181_300.jpg',
				'submenus' => [
					(object)['name' => 'Clearance Promotions', 'url' => base_url('furniture/area/promotions'), 'image' => 'assets/images/menus/accura-chair-562-181_300.jpg'],
				]
			]
		];
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
		try {
			if (class_exists('Category') && isset($this->db) && $this->db->table_exists('categories')) {
				$categories = \Category::enabled()->get();
				return $req == 'json' ? print_r($categories->toJson) : $categories;
			}
		} catch (\Exception $e) {}

		$categories = isset($this->wcstore) ? $this->wcstore->getCategories() : [];
		return $req == 'json' ? json_encode($categories) : $categories;
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