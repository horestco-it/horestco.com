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
		$this->load->library('wcstore');

		$this->data['page'] = $this->page;
	}

	/**
	 * Product catalog main lists
	 */
	public function lists()
	{
		$categories = $this->wcstore->getCategories();
		$subcategories = [];

		// Fetch up to 6 categories with their products
		foreach (array_slice($categories, 0, 6) as $cat) {
			if ($cat->count <= 0) continue;
			$products = $this->wcstore->getProducts(['category' => $cat->id, 'per_page' => 8]);
			if (empty($products)) continue;

			$subcategories[] = (object)[
				'id' => $cat->id,
				'name' => $cat->name,
				'slug' => $cat->slug,
				'category' => ['slug' => 'area'],
				'products' => $products,
			];
		}

		$this->data['subcategories'] = $subcategories;
		return $this->load->view('lists', $this->data);
	}

	/**
	 * Product detail page
	 */
	public function detail($name, $id, $version = null)
	{
		// Clean numeric id
		if (!is_numeric($id)) {
			if (preg_match('/-(\d+)$/', $id, $m)) {
				$id = $m[1];
			} elseif (preg_match('/-(\d+)$/', $name, $m)) {
				$id = $m[1];
			}
		}

		$product = $this->wcstore->getProduct($id);

		if (is_null($product)) {
			show_404();
		}

		// Fetch related products from same category
		$product->relations = $this->wcstore->getRelatedProducts($product, 6);

		$data = array(
			'product' => $product,
			'materials' => [
				'id' => [],
				'category_id' => [],
				'subcategory_id' => [],
			],
			'Material' => [
				'required' => [],
				'optional' => [],
			],
			'materialId_image' => [],
			'price' => '', // NO PRICE
			'attr' => [
				'alt' => 'Horestco ' . strtolower($product->name),
				'title' => strtolower($product->name),
				'class' => 'responsive-img'
			],
			'metadata' => [
				'title' => [ucwords(strtolower($product->name)), $product->code, '- Horestco Furniture'],
				'keywords' => [
					ucwords(strtolower($product->name)),
					'item code ' . $product->code,
					'area ' . ($product->category['name'] ?? ''),
					'Horestco Malaysia'
				],
				'description' => [strip_tags($product->short_description ?: $product->description)],
			]
		);

		if ($this->input->get('action') == 'get-sizes') {
			echo json_encode($product->sizes);
			return;
		}

		$version = is_null($version) ? '' : "-$version";
		$this->load->view('detail' . $version, array_merge($this->data, $data));
	}

	/**
	 * Category product listing
	 */
	public function category($slug)
	{
		$category = $this->wcstore->getCategoryBySlug($slug);
		if (is_null($category)) {
			$category = (object)[
				'id' => 0,
				'name' => ucwords(str_replace('-', ' ', $slug)),
				'slug' => $slug
			];
			$products = $this->wcstore->getProducts(['search' => $slug, 'per_page' => 24]);
		} else {
			$products = $this->wcstore->getProducts(['category' => $category->id, 'per_page' => 24]);
		}

		$subcategories = [
			(object)[
				'id' => $category->id,
				'name' => $category->name,
				'slug' => $category->slug,
				'products' => $products
			]
		];

		$data = array(
			'category' => $category,
			'subcategories' => $subcategories,
			'addSubcategory' => '',
			'slugs' => [$category->slug],
			'hasLoadMore' => false,
			'loadMoreSrc' => '',
		);

		$this->load->view('category', array_merge($this->data, $data));
	}

	/**
	 * Subcategory product listing
	 */
	public function subcategory($catName, $slug)
	{
		$subcategory = $this->wcstore->getCategoryBySlug($slug);
		if (is_null($subcategory)) {
			$subcategory = (object)[
				'id' => 0,
				'name' => ucwords(str_replace('-', ' ', $slug)),
				'slug' => $slug
			];
			$products = $this->wcstore->getProducts(['search' => $slug, 'per_page' => 24]);
		} else {
			$products = $this->wcstore->getProducts(['category' => $subcategory->id, 'per_page' => 24]);
		}

		$subcategory->relations = [];

		$this->data['subcategory'] = $subcategory;
		$this->data['products'] = $products;
		$this->data['relation'] = null;
		$this->data['relationProducts'] = [];

		$this->load->view('subcategory', $this->data);
	}

	protected function prices($product)
	{
		return ''; // No price display
	}
}
