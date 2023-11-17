<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends HRC_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('cart');

		$this->data['page'] = __class__;
	}

	public function index($version = '')
	{
		// vd($this->cart->contents());return;
		$this->load->view('index', $this->data);
	}

	public function indexBeta()
	{
		$this->load->view('index-beta', $this->data);
	}

	public function information()
	{
		if(is_null($this->session->cart_contents))
		{
			return redirect($this->data['redirectToShop']);
		}

		if ($this->auth->check())
		{
			return redirect('/payment/checkout');
		}

		$this->data['countries'] = Country::lists('name', 'id');

		$this->load->view('information', $this->data);
	}

	public function add()
	{
		if(!check_ajax())
		{
			show_404();
		}
		
		$data['page'] = 'cart';

		if ($this->input->post('qty') < 1)
		{
			echo false;
			return;
		}

		$size = ProductSize::find($this->input->post('size_id'));

		$products = [
			'id'		=> $size->id,
			'name'	=> $size->product->name,
			'code'	=> $size->product->code,
			'dimension'	=> $size->product->dimension,
			'image'	=> is_null($size->product->imageThumb['name']) ? 'not-available.jpg' : $size->product->imageThumb['name'],
			'size'	=> $size->name,
			'qty' 	=> $this->input->post('qty'),
			'price'	=> $size->prices->is_promo ? $size->prices->promo : $size->prices->normal,
		];

		if ($this->cart->insert($products))
		{
			$carts = [];
			$carts['contents'] = $this->cart->contents();
			$carts['total'] = $this->cart->total();
			$carts['total_items'] = $this->cart->total_items();
			echo json_encode($carts);
		}
		
		return false;
	}

	public function addCart()
	{
		if(!check_ajax())
		{
			show_404();
		}
		
		$data['page'] = 'cart';

		$posts = $this->input->post('product');

		$material = $this->input->post('materials');

		$message = [];

		if ($posts['qty'] < 1)
		{
			$message['error'] = 'Quantity min 1 pcs';
			echo json_encode($message);
			return;
		}

		$product = Product::find($posts['id']);
		
		// if any material
		if( in_array('',$material['required']) )
		{
			$message['error'] = "Please Select The Wood Color";
			echo json_encode($message);
			return;
		}
		
		if( isset($material['optional']) && in_array('',$material['optional']) && $this->input->post('isAddOptional') == 'true' )
		{
			$message['error'] = "Please select cushion fabric";
			echo json_encode($message);
			return;
		}


		$size = $product->sizes()->where('id', $posts['size'])->first();

		// get prices
		$subtotalPrice = $prices[strtolower($product->name)] = $size->price->is_promo ? $size->prices->promo : $size->prices->normal;

		$index = null;

		// collect material info
		$materials = [];
		foreach($material['required'] as $key => $id)
		{
			$materials = $this->pushMaterial($id, $materials);
		}

		if( $this->input->post('isAddOptional') == 'true' )
		{
			foreach($material['optional'] as $key => $id)
			{
				$material = Material::find($id);
				$subcategory = strtolower(str_replace(' ', '_',$material->subcategory->name));
				$index = $subcategory.' - '.$material->name;
				$prices[ $index ] = $product->prices[ $subcategory ];
				$subtotalPrice = $subtotalPrice + $product->prices[ $subcategory ];
				$materials = $this->pushMaterial($id, $materials);
			}
		}
	
		$products = [
			'id'		=> $size->id,
			'name'	=> $product->name,
			'code'	=> $product->code,
			'dimension'	=> $size->dimension,
			'image'	=> is_null($product->imageThumb->name) ? 'not-available.jpg' : $product->imageThumb->name,
			'size'	=> $size->name,
			'qty' 	=> $posts['qty'],
			'price'	=> $subtotalPrice,
			'fabric' => $index,
			'data-prices' => $prices,
			'materials' => $materials,
		];

		if ($this->cart->insert($products))
		{
			$carts = [];
			$carts['contents'] = $this->cart->contents();
			$carts['total'] = $this->cart->total();
			$carts['total_items'] = $this->cart->total_items();
			echo json_encode($carts);
		}
		
		return false;
	}

	public function update()
	{
		if(!check_ajax() && $this->input->post('action') != 'update')
		{
			show_404();
		}

		$data = json_decode($this->input->post('data'), true);

		echo $this->cart->update($data);
	}

	public function remove()
	{
		if(!check_ajax() && $this->input->post('action') != 'remove')
		{
			show_404();
		}

		echo $this->cart->remove($this->input->post('id'));
	}

	public function destroy()
	{
		$this->cart->destroy();
	}

	protected function pushMaterial($material, $materials)
	{
		$materials = count($materials) > 0 ? $materials : [];

		if( isset($material) )
		{
			$mat = Material::find($material);

			$materials[ $mat->category->name ] = [
					'code' => $mat->code,
					'name' => $mat->subcategory->name.' - '.$mat->name,
			];

			return $materials;
		}
		return false;
	}

}





/* End of file cart.php */


/* Location: ./application/controllers/cart.php */


