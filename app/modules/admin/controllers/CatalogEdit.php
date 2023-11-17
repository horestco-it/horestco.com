<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Base.php';

class CatalogEdit extends Base {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('image');
	}

	public function edit($id)
	{
		$this->load->helper('image');
		$data['page'] = 'products/edit-beta';
		$data['categories'] = $this->categories();
		$data['products'] = $this->getAllProduct();
		if($this->auth('type') != 'A' && $product = $this->getProductApprove($id))
		{
			$categoryId = $product->category_id;
			$data['prices'] = (array)$product->prices;
			$data['relations'] = $this->relations(Product::whereIn('id', $product->relations)->get());
			$data['relationIds'] = $product->relations;
		}
		else{
			$product = $this->product(null, $id);
			$categoryId = $product->category['id'];
			// insert new row in prices table if null
			if(is_null($product->prices))
			{
				$this->addPrices($product->id);
			}
			$data['prices'] = $product->prices->toArray();
			$data['relations'] = $this->relations($product->relations);
			$data['relationIds'] = $product->relations->lists('id');
		}

		$data['product'] = $product;
		$data['subcategories'] = Subcategory::where('category_id', $categoryId)->enabled()->get();

		if($this->input->get('action') == 'do_upload')
		{
			$this->do_upload();
		}

		$this->load->view($this->template, $data);
	}


	public function update()
	{
		$posts = $this->input->post('posts');

		$posts['relations'] = Product::whereIn('id', $posts['product-also'])->get()->toArray();
		// vd(json_encode($posts));
		vd($posts);
	}

	protected function getProductApprove($id)
	{
		$product = ProductApprove::where('product_id', $id)->where('is_approved', 0)->first();
		if (is_null($product))
		{
			return false;
		}

		return json_decode($product->data);
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
		$config['upload_path']          = $this->pathImage;
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_ext_tolower']			= TRUE;
    $config['max_size']             = 300000; // 300kb
    $config['max_width']            = 800; // px
    $config['max_height']           = 600; // px
    return $config;
	}
	/*
	 * @Return folder
	 */
	protected function folderExistOrNew($folder)
	{
		if(file_exists($folder))
		{
			return $folder;
		}

		if (!mkdir($folder, 0777, true)) {
		    die('Failed to create folders...');
		}
		return $folder;
	}

	public function do_upload()
  {
  	$upload_path_url = base_url().'files/';

        $config['upload_path'] = FCPATH.'files/';
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = '30000';

        $this->load->library('upload', $config);

        $data = array();

        if ( ! $this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view($this->template, $error);

        } else {
            $data = $this->upload->data();
            /*
                    // to re-size for thumbnail images un-comment and set path here and in json array   
            $config = array(
                'source_image' => $data['full_path'],
                'new_image' => $this->$upload_path_url '/thumbs',
                'maintain_ration' => true,
                'width' => 80,
                'height' => 80
            );

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            */
            //set the data for the json array   
            $info->name = $data['file_name'];
                $info->size = $data['file_size'];
            $info->type = $data['file_type'];
                $info->url = $upload_path_url .$data['file_name'];
            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            $info->thumbnail_url = $upload_path_url .$data['file_name'];
                $info->delete_url = base_url().'upload/deleteImage/'.$data['file_name'];
                $info->delete_type = 'DELETE';

            //this is why we put this in the constants to pass only json data
            if ($this->input->is_ajax_request()) {
                echo json_encode(array($info));
                //this has to be the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)

            // so that this will still work if javascript is not enabled
            } else {
                $file_data['upload_data'] = $this->upload->data();
                $this->load->view('admin/upload_success', $file_data);
            }
        }
  }

	public function upload()
	{
		if ($this->input->get('ajax'))
		{
			vd($_FILES['file']);
		}
		return;
		$errors = [];
		$option = $this->set_upload_option();
		$product = $this->product(null, $this->input->get('id'));
  	$folder = $this->folderExistOrNew($option['upload_path']);

  	if (!$folder){
  		echo "Target folder does not exist";
  		return;
  	}
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
  				case 'U':
	  				$upload = move_uploaded_file($_FILES['file']['tmp_name'][$index], $image = $folder.$filename);
	  				if($upload)
	  				{
			  			// insert to db
			  			$imageId = Image::insertGetId([
				    		'name' 	=> $filename,
				    		'alt'		=> "teak furniture malaysia {$product->subcatgory['name']} ".strtolower(trim($product->name)),
				    		'is_primary' => 0,
				    		'is_verified' => 0,
				    		'product_id' => $product->id,
				    		'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
				    	]);
				    	if($imageId)
				    		header("Location:/".$this->uri->segment(1)."/".$this->uri->segment(2)."/edit/".$product->id);
	  				}
	  				return false;
  				break;

  				case 'A':
  					vd($_FILES['file']);return;
	  				// $upload = move_uploaded_file($_FILES['file']['tmp_name'][$index], $image = $folder.$filename);
  					$upload = true;
	  				if($upload)
	  				{
	  					$pa = ProductApprove::where('product_id', $product->id)->first();
	  					vd($product->id);return;
	  					$data = json_decode($pa->data);
	  					$images = $data->images;
	  				}
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

}