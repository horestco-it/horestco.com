<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Horestco\My\Model as Model;

class Base extends HRC_Controller {

	// theme
	protected $template = 'templates/default';
	// login page if not auth
	protected $login = 'admin/login';
	// dashboard page if logged
	protected $dashboard = 'dashboard';
	// path product image file
	protected $pathImage = './assets/images/furniture/';
	// enable login switch
	protected $is_enable = 1;

	public function __construct()
	{
		parent::__construct();

		/**
		 * SEMENTARA DIALIHKAN KE /admin-php/
		 |
		 |
		 */
		redirect('/admin-php');
		

		if($this->is_enable)
		{
			$this->is_logged();
		}
	}
	// Login
	public function index()
	{
		$data['user'] = $this->session->user;
		$data['page'] = $this->dashboard;
		$data['products'] = $this->getProductApp();
		$this->load->view($this->template, $data);
	}

	public function getProductApp()
	{
		return ProductApprove::with(['user', 'product'])->orderBy('is_approved', 'desc')->get();
	}

	public function productApprove($segment)
	{
		if( $this->input->post('jqxhr') )
		{
			$id = $this->input->post('id');

			$product = ProductApprove::find($id);
			// segment approve changes
			if($segment == 'approve')
			{
				// update product table
				if( $this->approve(json_decode($product->data)) )
				{
					// approve sign
					$product->is_approved = 1;
					echo $product->save();
				}
			}
			// segment ajax delete
			if($segment == 'delete')
			{
				echo $product->delete();
			}
		}
	}

	protected function is_logged()
	{
		if($this->session->has_userdata('logged_in'))
		{
			$session = $this->session->userdata('logged_in');
			$this->session->set_flashdata('user', $session);
		}
		else{
			$this->session->set_flashdata('goback', current_url());
			redirect($this->login);
		}
	}

	protected function decodeImage($json)
	{
		$data = array();
		if(!is_null($json))
		{
			foreach (json_decode($json) as $key => $image) {
				$data[$key]['id'] = $image->id;
				$data[$key]['name'] = $image->name;
				$data[$key]['alt'] = $image->alt;
				$data[$key]['is_enabled'] = $image->is_enabled;
			}
			return $data;
		}
	}

	protected function auth($field = null)
	{
		$auth = $this->session->userdata('logged_in');

		if(!is_null($field))
		{
			return $auth[$field];
		}
		return $auth;
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
			$p->is_approved = 0;
			$p->user_id = $this->auth('id');
			$p->updated_at = \Carbon\Carbon::now('Asia/Jakarta');
			return $p->save();
		}
		else{
			// insert
			$data = [
				'product_id'=>$data->id,
				'data'=>json_encode($data),
				'is_approved'=>0,
				'user_id'=>$this->auth('id'),
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
		if (count($product->images) > 0)
		{
			$ids = [];
			foreach ($product->images as $key => $images) {
				Image::where('id', $images->id)->update((array)$images);
				// store id images
				$ids[$key] = $images->id;
			}
			// sync images
			$this->syncImage($product->id, $ids);
		}
		// related items
		if(!is_null($product->relations)) $this->addRelated($product->id, $product->relations);
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

	/**
	 * syncronized many to many product table
	 * @param int $productId product id
	 * @param array $data    $model->belongsToMany->sync($data)
	 */
	protected function addRelated($productId, $data)
	{
		$product = Product::find($productId);

		if($data == '')
		{
			return $product->relations()->detach();
		}
		return $product->relations()->sync($data);
	}

	/**
	 * [syncImage description]
	 * @param  int $id     				product_id
	 * @param  int[array] $ids    image id that NOT to be delete
	 * @param  array  $config 		$config['path'] image path
	 * @return boolean         		true if success deleted
	 */
	protected function syncImage($id, $ids, $config = array())
	{
		try{
			$images = Image::where('product_id', $id)->whereNotIn('id', (array)$ids);

			$names = $images->lists('name');

			$delete = $images->delete();

			$path = isset($config['path']) ? $config['path'] : $this->pathImage;

			foreach ($names as $name) {
				// delete image file
				if(file_exists($path.$name))
				{
					$unlink = unlink($path.$name);
				}
			}

			return $delete;
		}

		catch(Exception $e) {
    	echo $e->getMessage();
		}
	}


}
/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */