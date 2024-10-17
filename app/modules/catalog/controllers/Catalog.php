<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Carbon\Carbon;
use Illuminate\Support\Str;

class Catalog extends HRC_Controller {

	protected $page = 'furniture';

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('image');

		$this->load->helper('product');

		$this->load->library(['google']);

		$this->data['page'] = $this->page;
	}
	 // product lists
	public function lists()
	{
		$subcatid = Submenu::getSubcatIds();

		$iSubcatid = implode(',', $subcatid);

		$this->data['subcategories'] = Subcategory::productLists('id', $subcatid)->orderByRaw("FIELD(id, $iSubcatid)")->get();

		return $this->load->view('lists', $this->data);
	}

	public function detail($name, $id, $version = null)
	{
		$product = Product::active()->find($id);

		/////////////////////////////////////////////////////////////////////////////////////
		// BEGIN sync url 
		// syncronization url antara nama product dengan id product
		/////////////////////////////////////////////////////////////////////////////////////
		if( is_null($product) )
		{
			$product = Product::findBy('code', $id )->first();

			if(is_null($product))
			{
				show_404();
			}
			redirect('/'.$this->uri->segment(1).'/'.Str::slug($product->name).'-'.$product->id);
		}

		if(Str::slug($product->name) != $name || (string)$product->id != $id)
		{
			redirect('/'.$this->uri->segment(1).'/'.Str::slug($product->name).'-'.$product->id);
		}
		// end sync url /////////////////////////////////////////////////////////////////////

		$product->sizes = $product->sizes()->enabled()->orderBy('sort_order')->with(['prices'])->get();

		// images
		$product->images = $product->images()->where('is_enabled', 1)->orderBy('is_primary', 'desc')->get();

		///////////////////////////////////////////////
		// get stock product from google spreadsheet //
		///////////////////////////////////////////////
		$product->stocks = (array)$this->google->stock($product->code, 'all');

		// collect data
		$data = array(
			'product'	=> $product,
			'materials'	=> [
											'id' => $product->materials->pluck('id')->toArray(),
											'category_id' => $product->materials->pluck('material_category_id')->toArray(),
											'subcategory_id' => $product->materials->pluck('material_subcategory_id')->toArray(),
											],
			'Material' => [
											// [ 1=>'synthetic wicker', 2=>'cushion fabrics', 3=>'finishing', 4=>'uphloastery']
											'required' => MaterialCategory::whereIn('id',[1,3])->get(),
											'optional' => MaterialCategory::whereIn('id',[2,4])->get(),
										],
			'materialId_image' => MaterialCategory::associateWithImage($product->id),
			'price'		=> $this->prices($product),
			'attr' 		=> [
										'alt' => 'Teak Furniture Malaysia '.strtolower($product->subcategory['name'].' '. $product->name),
										'title' => strtolower($product->subcategory['name'].' - '. $product->name),
										'class'=> 'responsive-img'
										],
			'metadata' => [
				'title' => [ ucwords(strtolower($product->name)),$product->code, '- Horestco Furniture'],
				'keywords' => [ ucwords(strtolower($product->name)), 
					'item code '. $product->code, 
					'area '. $product->category['name'], 
					$product->subcategory['name'], 
					'Horestco - Kuala Lumpur, Malaysia' 
				],
				'description' => explode('.', str_replace(["\n\r", "\n"], "", $product->description)),
			]
		);

		if($this->input->get('action') == 'get-sizes')
		{
			if( !check_ajax() )
			{
				show_404();
			}
			echo $product->sizes()->where('is_enabled', 1)->orderBy('sort_order')->with('prices')->get()->toJson();
			return;
		}

		$version = is_null($version) ? '' : "-$version";

		$this->load->view('detail'.$version, array_merge($this->data, $data));
	}

	public function category($slug)
	{
		$this->categoryProductList($slug);
		// $this->category0($slug);
	}

	private function categoryProductList($slug)
	{
		$category = Category::whereSlug($slug)->enabled()->first();

		$this->data['version'] = $this->input->get('v') ? '-'.$this->input->get('v') : '';

		// redirect
		if(is_null($category)) show_404();

		$subcategories = Subcategory::productLists('category_id', $category->id)->first();
		$slugs = Subcategory::where('category_id', $category->id)->enabled()->pluck('slug');
		/**
		 * additional subcategory in category DINING
		 * - outdoor chairs (65)
		 * - outdoor tables (66)
		 * ----------------------------------------------
		 */
		if($slug == 'dining')
		{
			$outdoorSlugs = ['outdoor-chairs', 'outdoor-tables'];
			$slugs->merge($outdoorSlugs);
		}

		$nextSlug = $this->nextSlug($subcategories->slug, $slugs->toArray());

		$data = array(
			'category'			=> $category,
			'subcategories'	=> [$subcategories],
			'slugs' => $slugs->toArray(),
			'hasLoadMore' => ($subcategories != null),
			'loadMoreSrc' => base_url().'catalog/load_more/'.$nextSlug,
		);

		$this->load->view('category/index', array_merge($this->data, $data) );
	}

	public function load_more($slug) {
		$category = Category::whereSlug($this->input->post('category'))->enabled()->first();
		$subcategory = Subcategory::productLists('slug', $slug)->first();
		$slugs = Subcategory::where('category_id', $category->id)->enabled()->pluck('slug')->toArray();
		/**
		 * additional subcategory in category DINING
		 * - outdoor chairs (65)
		 * - outdoor tables (66)
		 * ----------------------------------------------
		 */
		if($category->slug == 'dining')
		{
			$outdoorSlugs = ['outdoor-chairs', 'outdoor-tables'];
			$slugs = array_merge($slugs, $outdoorSlugs);
		}

		$nextSlug = $this->nextSlug($subcategory->slug, $slugs);

		$html = $this->load->view('category/subcategory', [
			'subcategory' => $subcategory,
			'category' => $category,
			'hasLoadMore' => $nextSlug ? true : false,
			'loadMoreSrc' => $nextSlug ? base_url().'catalog/load_more/'.$nextSlug : '',
		], TRUE);

		echo json_encode([
			'slugs' => $slugs,
			'next' => $nextSlug,
			'html' => $html,
			'category' => $category,
			'hasLoadMore' => $nextSlug ? true : false,
			'loadMoreSrc' => $nextSlug ? base_url().'catalog/load_more/'.$nextSlug : '',
		]);
	}

	private function nextSlug($key, $array = [])
	{
		$currentKey = key($array);
		while ($currentKey !== null && $currentKey != array_search($key, $array)) {
			next($array);
			$currentKey = key($array);
		}
		return next($array);
	}

	private function category0($slug)
	{
		$category = Category::whereSlug($slug)->enabled()->first();

		$this->data['version'] = $this->input->get('v') ? '-'.$this->input->get('v') : '';

		// redirect
		if(is_null($category)) show_404();

		$data = array(
			'category'			=> $category,
			'subcategories'	=> Subcategory::productLists('category_id', $category->id)->get()
		);

		// additional subcategory in category DINING 
		// - outdoor chairs (65)
		// - outdoor tables (66)
		$data['addSubcategory'] = '';
		if($slug == 'dining')
		{
			$addSubcategory = ['outdoor-chairs', 'outdoor-tables'];

			$data['addSubcategory'] = Subcategory::productLists('slug', $addSubcategory)->get();
		}

		$this->load->view('category', array_merge($this->data, $data) );
	}

	public function subcategory($catName, $slug)
	{
		$subcategory = Subcategory::enabled()->where('slug', $slug)->first();

		// redirect
		if(is_null($subcategory)) show_404();

		$products = $this->queryProducts()->where('subcategory_id', $subcategory->id);

		//============== appends more products in subcategory ============
		if( $subcategory->products_more->count() ){
			$products->orWhereIn('id', $subcategory->products_more()->enabled()->pluck('id')->toArray());
		}

		$this->data['subcategory']	= $subcategory;
		$this->data['products']	= $products->get();

		if( count($subcategory->relations) > 0 )
		{
			$relation = Subcategory::where('slug', $subcategory->relations[0]['slug'])->first();
			$relationProducts = $this->queryProducts()->where('subcategory_id', $relation->id);

			//============== appends more products in subcategory ============
			if( $relation->products_more->count() ){
				$relationProducts->orWhereIn('id', $relation->products_more()->enabled()->pluck('id')->toArray())->get();
			}
			$this->data['relation'] = $relation;
			$this->data['relationProducts'] = $relationProducts->get();

		}

		$this->load->view('subcategory', $this->data );
	}

	private function queryProducts()
	{
		return Product::query()
		->where('is_enabled', true)
				->sort()
				->with([
					'images' => function($query){
						$query->enabled()->sort('sort_order', 'desc');
					},
					'imageThumb' => function($query){
						$query->where('is_primary', 1);
					},
					'sizes' => function($query){
						$query->sort('sort_order');
					}
				])
				;
	}

	/**
	 * ajax get image to display on product detail primary
	 * @return [type] [description]
	 */
	public function getImage()
	{
		$image = Image::find($this->input->post('id'));
		$html  = "<a class=\"item fancybox\" href=\"".base_url().product_img_url(strtolower($image->name))."\">";
		$html .= "<i class=\"fa fa-arrows-alt fa-2x zooming-icon\"></i>";
		$html .= image_thumb(product_img_url($image->name), 465, ['class'=>'responsive-img']);
		$html .= "</a>";
		
		$data['html'] = $html;
		$data['id'] = $image->id;
		print_r(json_encode($data));
	}

	protected function prices($product)
	{
		if(is_null($product)) return;

		if($product->prices['normal'] && $product->prices['normal'] != 0.00)
		{
			$price = $this->currency." ".$product->prices['normal'];
		}
		else{
			$price = '<a href="tel:+628551069988"><span style="color:#29b6f6">Call</span></a>';
		}

		if ($product->is_promo && $product->prices['promo'] && $product->prices['promo'] != 0.00) {
			$price  = "<span style=\"font-family:consolas\">".$this->currency."</span> <del class=\"grey-text\">".$product->prices['normal']."</del>  ";
			$price .= "<span class=\"red-text text-darken-2\" style=\"font-size:20px\">".$product->prices['promo']."</span>";
		}

		return $price;
	}

	public function utility($area, $materialMix = null, $sub = null)
	{
		$open = 1;

		if(!$open)
		{
			echo "closed";
			return false;
		}

		if(is_null($materialMix))
		{
			echo "input material mix. eg: c / f / fc / wc / fwc";
			return false;
		}

		$sub = Subcategory::where('slug', $sub)->first(); // by subcategory

		// if(is_null($sub)) return false;
		$items = $this->getMaterialCollective();

		$items = $items[$area][$materialMix];
		
		$products = Product::whereIn('id', $items)->get();

		$materials = [
			'finishing' 	=> [12,14,16],//[29,30,70],
			'wicker'			=> [1,2,3,4,5,7,8,69,67],
			'fabric' 			=> (array)Material::where('material_category_id', 2)->pluck('id')->toArray(),
		];
		// set materials
		$setting = [
			'null'	=> [],
			'c'			=> $materials['fabric'],
			'f'			=> $materials['finishing'],
			'fc' 		=> array_merge($materials['finishing'], $materials['fabric']),
			'wc' 		=> array_merge($materials['wicker'], $materials['fabric']),
			'fwc' 	=> array_merge($materials['fabric'], array_merge($materials['finishing'], $materials['wicker'])),
		];

		foreach ($products as $key => $product) {
			$sync = $product->materials()->sync( $setting[$materialMix] );
			echo "$product->name <br>";
		}
	}

	protected function getMaterialCollective()
	{
		return [
			'dining' => [
				'c' 	=> [
					// dining chair
					857,940,942,943,944,879,
					// bar chair
					937
				],
				'f'		=> [
					// bar chair
					628,738
				],
				'fc'	=> [
					// dining chair
					484,488,677,749,735,502,566,572,640,718,714,576,643,858,615,616,678,679,620,739,941,917,
					// bar chair
					480,478,629,882,479,936,859,722,860,560,486,737,
				],
				'wc' 	=> [
					// bar chair
					659,694,674
				],
				'fwc'	=> [
					// dining chair
					725
				],
			],
			'living'	=> [
				'f'		=> [
					// mix
					417,416,881,751,956,769,770,867,958,801,756,883,878,873,758,895,798,757,935,
				],
				'fc'	=> [
					// sofa
					864,728,730,796,891,872,925,929,924,870,
					// mix
					257,880,774
				],
				'fwc'	=> [
					// sofa
					926,927,928,
					256,
				],
				'null'	=> [
					760,761,763,762,759
				],
			],
			'bedroom'	=> [
				'f'		=> [324,450,156,158,155,452,360,865,855,900,369,851,892,874,957,775,886,893,914,915],
				'fc'		=> [896],
			],
			'outdoor' => [
				// cushion
				'c' => [781],
				//finishing+cushion
				'fc' =>  [
					// outdoor chair
					562,773,779,526,545,945,740
				],
				// wicker+cushion
				'wc' =>  [546,906,654,655,661,666,676,741],
				// finishing+wicker+cushion
				'fwc' => [544,698,726],
			],
		];
	}

}
