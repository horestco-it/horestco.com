<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Carbon\Carbon;
use Illuminate\Support\Str;

class Catalog extends HRC_Controller {

	protected $page = 'furniture';

	public function __construct()
	{
		parent::__construct();

		///////////////////////////////////////
		// Global data -> ke depan pakai ini //
		///////////////////////////////////////
		$this->data['menus'] = $this->mainMenu();
		$this->data['page']	 = $this->page;

		// load image helper
		$this->load->helper('image');

		$this->load->helper('product');
	}
	 // product lists
	public function index()
	{
		$subcatid = Submenu::getSubcatIds();

		$iSubcatid = implode(',', $subcatid);

		$data = array(
			'page'	=> $this->page,
			'menus' => $this->mainMenu(),
			'subcategories' => Subcategory::productLists('id', $subcatid)->orderByRaw("FIELD(id, $iSubcatid)")->get()
		);
		$this->load->view('pages/products/lists', $data);
	}

	public function detail($name, $id, $version = null)
	{
		$product = Product::find($id);

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

		$product->sizes = $product->sizes()->enabled()->orderBy('sort_order')->with(['prices'])->get();

		$data = array(
			'product'	=> $product,
			// 'currency' => '<span class="grey-text">'.$this->currency.'</span>',
			'materials'	=> MaterialCategory::associateWithProduct($product->id),
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


		$this->load->view('pages/products/detail'.$version, array_merge($this->data, $data));

	}

	public function category($slug)
	{
		$category = Category::whereSlug($slug)->first();

		// redirect
		if(is_null($category)) show_404();

		$data = array(
			'page'					=> $this->page,
			'menus'					=> $this->mainMenu(),
			'category'			=> $category,
			'subcategories'	=> Subcategory::productLIsts('category_id', $category->id)->get()
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

		$this->load->view('pages/products/category', $data);
	}

	public function subcategory($catName, $slug)
	{
		$subcategory = Subcategory::productLists('slug', $slug)->first();
		
		// vd($subcategory->products->toArray());return;
		// redirect
		if(is_null($subcategory)) show_404();

		$data = array(
			'page'				=> $this->page,
			'menus'				=> $this->mainMenu(),
			'subcategory'	=> $subcategory,
		);

		if( count($subcategory->relations) > 0 )
		{
			$data['relations'] = Subcategory::productLists('slug', $subcategory->relations[0]['slug'])->first();
		}

		$this->load->view('pages/products/subcategory', $data);
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
/* =========================
 * TEMPORARY
 * ==========================
*/
	// remove space character in code product
	public function img()
	{
		
	}

	public function also()
	{
		$products = Product::find(158)->relations;
		vd($products->toArray());
	}

}





/* End of file Catalog.php */


/* Location: ./application/controllers/Catalog.php */