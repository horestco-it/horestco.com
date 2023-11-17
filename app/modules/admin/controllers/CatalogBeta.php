<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Base.php';

class CatalogBeta extends Base {

	// global data store
	protected $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('image');
		// store categories
		$this->data['categories'] = $this->getCategories();
		// store all products
		$this->data['products'] = $this->getAllProduct();
	}

	public function products($page = 'list')
	{
		// AJAX retrieve products populate
		if ($page == 'ajax')
		{
			return $this->getProducts('json');
		}

		$data['page'] = __FUNCTION__.'/'.$page;

		$data['products'] = $this->getProducts();

		$this->load->view($this->template, $data);
	}

	public function add()
	{
		if($this->input->post('name'))
		{
			$id = Product::insertGetId($this->input->post());

			if($id)
			{
				// add prices field
				$this->addPrices($id);
				redirect('/admin/catalog/edit/'.$id, 'refresh');
			}

		}

		$data['page'] = 'products/add';

		$data['categories'] = $this->getCategories();

		$this->load->view($this->template, $data);
	}

	public function edit($id)
	{
		
		$this->load->helper('image');
		$data['page'] = 'products/edit-beta';
		$data['categories'] = $this->categories();
		$data['products'] = $this->getAllProduct();

		if($this->auth('type') != 'A')
		{
			$product = $this->getProductApprove($id);
			$categoryId = $product->category_id;
			$data['prices'] = (array)$product->prices;
			$data['relations'] = $this->relations(Product::whereIn('id', $product->relations)->get());
			$data['relationIds'] = $product->relations;
		}
		else{
			$product = $this->product(null, $id);
			$categoryId = $product->category['id'];
			$data['prices'] = $product->prices->toArray();
			$data['relations'] = $this->relations($product->relations);
			$data['relationIds'] = $product->relations->lists('id');
		}

		$data['product'] = $product;
		$data['subcategories'] = Subcategory::where('category_id', $categoryId)->enabled()->get();

		$this->load->view($this->template, $data);
	}


	public function update()
	{
		// $json = '{"id":"927","category_id":"9","subcategory_id":"10","name":"Test Bed","code":"ZZZ123","description":"description basic","dimension":"123546","is_enabled":"1","is_promo":"0","prices":{"id":"35","normal":"1.00","promo":"2.00","project":"12.00","export":"21.00","promo_description":"description ","promo_note":"not"},"images":[{"id":"3107","is_verified":0,"is_enabled":"0","sort_order":"1","name":"test-bed-927-205.jpg","alt":"horestco image - bedroom "},{"id":"3103","is_verified":0,"is_enabled":"0","sort_order":"2","name":"test-bed-927-501.jpg","alt":"test bed - Horestco furniture fdasfdsa"},{"id":"3114","is_verified":0,"is_enabled":"0","sort_order":"3","name":"test-bed-927-2236.jpg","alt":"test bed - Horestco furniture"}],"relations":["794","608"]}';

		$json = $this->input->post('data');

		$data = json_decode($json);

		// update product
		if ($this->auth('type') != 'A')
		{
			echo $this->needApprove($data);
			return;
		}

		echo $this->approve($data);

	}

	protected function getProductApprove($id)
	{
		$product = ProductApprove::where('product_id', $id)->first();
		if (is_null($product))
		{
			return false;
		}

		return json_decode($product->data);
	}

	/*
	 * update database pending
	 * @param $product =  stdObject
	 */
	protected function needApprove($data)
	{
		$p = ProductApprove::where('product_id', $data->id)->first();

		if (!is_null($p))
		{
			// update
			$p->data = json_encode($data);
			$p->updated_at = \Carbon\Carbon::now('Asia/Jakarta');
			return $p->save();
		}
		else{
			// insert
			$data = [
				'product_id'=>$data->id,
				'data'=>json_encode($data),
				'created_at' => \Carbon\Carbon::now('Asia/Jakarta')
			];
			return ProductApprove::insert($data);
		}

	}

	/*
	 * update database directly
	 * @param $product =  stdObject
	 */
	protected function approve($product)
	{
		// Prices
		ProductPrice::where('product_id', $product->id)->update((array)$product->prices);
		// Images
		foreach ($product->images as $key => $images) {
			Image::where('id', $images->id)->update((array)$images);
		}
		// related items
		$this->addRelated($product->id, $product->relations);
		// product
		$p = Product::find($product->id);
		$p->category_id = $product->category_id;
		$p->subcategory_id = $product->subcategory_id;
		$p->name = $product->name;
		$p->code = $product->code;
		$p->description = $product->description;
		$p->dimension = $product->dimension;
		$p->is_enabled = $product->is_enabled;
		$p->is_promo = $product->is_promo;

		return $p->save();
	}

	// syncronized many to many product table
	protected function addRelated($productId, $data)
	{
		$product = Product::find($productId);

		if($data == '')
		{
			return $product->relations()->detach();
		}
		return $product->relations()->sync($data);
	}

	protected function objectToArray($object)
	{
		$data = [];
		foreach($object as $key => $value){
			if($key != 'id')
			{
				$data[$key] = $value;
			}
		}
		return (array)$data;
	}

	private function set_upload_option()
	{
		$config = array();
		$config['upload_path']          = './assets/images/products/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_ext_tolower']			= TRUE;
    $config['max_size']             = 300000; // 300kb
    $config['max_width']            = 800; // px
    $config['max_height']           = 600; // px
    return $config;
	}

	protected function folder_exist($folder)
	{
		$path = realpath($folder);
		return ($path != FALSE && is_dir($path)) ? $path.'/' : FALSE;
	}

	public function upload()
	{
		$errors = [];
		$option = $this->set_upload_option();
  	$folder = $this->folder_exist($option['upload_path']);
  	if (!$folder){
  		echo "Target folder does not exist";
  		return;
  	}
		$product = Product::find($this->input->get('pid'));
    foreach($_FILES['file']['name'] as $index => $file)
    {
    	$size = getimagesize($_FILES['file']['tmp_name'][$index]);
    	$ext = explode('.', $file);
    	$ext = $option['file_ext_tolower'] ? strtolower(end($ext)) : end($ext);
    	if (!in_array($ext, explode('|', $option['allowed_types'])))
    	{
    		$errors[][$index] = "$file is Not Allowed Type";
    	}
    	elseif ($size[0] != $option['max_width'] || $size[1] != 600)
    	{
    		$errors[][$index] = "$file : Dimension must 800w x 600h pixel";
    	}
    	elseif($_FILES['file']['size'][$index] > $option['max_size'])
	    {
	    	$errors[][$index] = "$file is too large, min 200kb";
    	}
    	else{
  			$filename = str_slug($product->name)."-{$product->id}-".rand(1000, 9999).".$ext";
  			// upload file
  			switch ($this->auth('type')) {
  				case 'A':
	  				$upload = move_uploaded_file($_FILES['file']['tmp_name'][$index], $image = $folder.$filename);
	  				if($upload)
	  				{
			  			// insert to db
			  			$imageId = Image::insertGetId([
				    		'name' 	=> $filename,
				    		'alt'		=> strtolower(trim($product->name))." - Horestco furniture",
				    		'is_primary' => 0,
				    		'is_verified' => 0,
				    		'product_id' => $product->id,
				    		'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
				    	]);
				    	echo $imageId;
			  			// $data = [
				    // 		'name' 	=> $filename,
				    // 		'alt'		=> strtolower(trim($product->name))." - Horestco furniture",
				    // 		'is_primary' => 0,
				    // 		'is_verified' => 0,
				    // 		'product_id' => $this->input->get('pid'),
				    // 		'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
				    // 	];
	  					// print_r($data);
	  				}
	  				return false;
  				break;

  				case 'U':
	  				move_uploaded_file($_FILES['file']['tmp_name'][$index], $image = $folder.'temp/'.$filename);
  				break;
  			}

  		}
    }
    print_r($errors);
	}

	public function categories($req = null)
	{
		return $this->getCategories($req);
	}

	public function subcategories($req = null)
	{
		if($this->input->post('act') != 'subcategories')
		{
			show_404();
		}
		
		return $this->getSubcategories($req);
	}

	public function code()
	{
		if(!$this->input->post('code'))
		{
			show_404();
		}
		echo !in_array($this->input->post('code'), $this->getProducts('code'));
	}

		/*
	 * Param $config['id'] id image
	 * Param $config['name'] = optional name of image
	 * Param $config['path'] = path image
	 */
	protected function deleteImage($config = array())
	{
		try{
			$image = Image::find($config['id']);

			$config['name'] = isset($config['name']) ? $config['name'] : $image->name;

			$delete = $image->delete();

			if(!$delete)
			{
				throw new Exception("Row id {$config['id']} gagal dihapus", 1);
				return;
			}

			// delete image file
			if(file_exists($config['path'].$config['name']))
			{
				$unlink = unlink($config['path'].$config['name']);
			}

			return $delete;
		}

		catch(Exception $e) {
    	echo $e->getMessage();
		}
	}


}