<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Horestco\My\Model as Model;

class Payment extends HRC_Controller {

	// $amount 1.00 saat test ke ipay88
	protected $amount = '1.00';

	public function __construct()
	{
		parent::__construct();

		$this->load->library([
			'ipay88', 
			'cart', 
			'session', 
			'order',
		]);
	}

	public function index()
	{
		return redirect('/payment/checkout');
	}

	/**
	 * request URL
	 * ----------------------------------
	 * route : /payment/checkout
	 * fungsi : mengirim request ke ipay88
	 * @return render view
	 */
	public function checkout()
	{
		if(is_null($this->session->cart_contents))
		{
			redirect(base_url('malaysia-furniture-promotions'));
		}
		// post request from route: /cart/information
		if( !is_null($this->input->post('customer')) )
		{
			$this->session->set_userdata('customer', $customer = $this->input->post('customer'));

			// record to customer if doesn exists
			$customer_id = Model\Customer::insertUnique([
					'name' => "$customer[fname] $customer[lname]",
					'email' => $customer['email'],
					'country_id' => $customer['country'],
					'created_at' => $this->dateNow(),
					'updated_at' => $this->dateNow(),
				]);
		}
		$customer = Model\Customer::where('email', $this->session->customer['email'])->with(['country'])->first();

		$this->session->set_userdata('customer_id', isset($customer_id) ? $customer_id : $customer->id);

		$ref = $this->order->generateRefId();

		// merger with default ipay88 data configuration
		$this->ipay88->set([
			// product item
			'ProdDesc' 		=> $this->order->productDesc($this->cart->contents()),
			// customer request
			'UserName' 		=> $this->session->customer['fname'].' '.$this->session->customer['lname'],
			'UserEmail' 	=> $this->session->customer['email'],
			'UserContact' => $this->session->customer['telephone'],
			'Remark' 			=> $this->session->customer['remark'],
			// order
			'RefNo' 			=> $ref,
			// ganti value dengan $this->cart->total()
			'Amount' 			=> $this->amount,
			// system
			'Signature' 	=> $this->generateSignature([
													$this->ipay88->getMerchantKey(),
													$this->ipay88->get('MerchantCode'),
													$ref,
													str_replace(',', '', str_replace('.', '', $this->amount)),
													$this->ipay88->get('Currency'),
												]),
		]);
		/////////////////
		// assign data //
		/////////////////
		
		// basic
		$data['menus'] = $this->mainMenu();
		$data['page'] = __FUNCTION__;
		// hidden inputs to be insert to form
		$data['inputs'] = $this->renderInputs($this->ipay88->get(), 'hidden');
		$data ['action'] = $this->ipay88->action;
		// if get error
		$data['error'] = $this->session->flashdata('error');
		// cart information
		$data['products'] = $this->cart->contents();
		$data['total'] = $this->cart->total();
		// customer
		$data['customers'] = [
			'email' 	=> $customer['email'],
			'name' 		=> $customer['name'],
			'address'	=> "{$this->session->customer['address']}, {$this->session->customer['city']} {$customer->country['name']}, {$this->session->customer['zip']}",
			'telephone' => $this->session->customer['telephone'],
		];

		$this->load->view('pages/payment/checkout', $data);

	}

	/**
	 * response URL
	 * ----------------------------------
	 * route : /payment/response
	 * fungsi : menangkap response dari ipay88
	 * @return render view
	 */
	public function response()
	{
		// vd($_REQUEST);
		// record to transaction table
		$insert = Transaction::insert([
				'reference_id'				=> $_REQUEST['RefNo'], 
				'transaction_id'			=> $_REQUEST['TransId'], 
				'customer_id'					=> (int)$this->session->customer_id,
				'payment_id'					=> $_REQUEST['PaymentId'],
				'amount'							=> $_REQUEST['Currency'].' '.$_REQUEST['Amount'],
				'remark'							=> $_REQUEST['Remark'],
				'product_description'	=> $this->order->productDesc($this->cart->contents()),
				'status'							=> $_REQUEST['Status'],
				'error'								=> $_REQUEST['ErrDesc'],
				'created_at'					=> $this->dateNow(),
			]);
		
		if( (int)$_REQUEST['Status'] == 0 )
		{
			$this->session->set_flashdata('error', "Error : $_REQUEST[ErrDesc]");

			return redirect('/payment/checkout');
		}
		// if response signature is not match
		$matchSignature = [
				$this->ipay88->getMerchantKey(),
				$_REQUEST['MerchantCode'],
				$_REQUEST['PaymentId'],
				$_REQUEST['RefNo'],
				str_replace(',', '', str_replace('.', '', $_REQUEST['Amount'])),
				$_REQUEST['Currency'],
				$_REQUEST['Status'],
			];

		$isMatch = $this->ipay88->verifySignature($_REQUEST['Signature'], implode('', $matchSignature));

		if( !$isMatch )
		{
			$this->session->set_flashdata('error', "Error : something went wrong!");

			return redirect('/payment/checkout');
		}

		// destroy session & cart
		$this->cart->destroy();
		$this->session->unset_userdata('customer');
		$this->session->unset_userdata('customer_id');

		$data['message'] = 'Thank you for purchase.';
		$data['menus'] = $this->mainMenu();
		$data['page'] = __FUNCTION__;

		$this->load->view('pages/payment/response', $data);

	}

	public function responseBackend()
	{
		echo "RECEIVEOK";
	}

	public function requery()
	{
		vd($this->ipay88->requery('M08435', 'ON0002218', 1));
	}

	protected function generateSignature($data, $string = false)
	{
		if($string)
		{
			return implode('', $data);
		}
		return $this->ipay88->signature(implode('', $data));
	}

	protected function renderInputs($data, $type = 'text')
	{
		$result = '';
		foreach( $data as $key => $value )
		{
			$result .= "<input type=\"{$type}\" name=\"{$key}\" value=\"{$value}\"/>";
		}
		return $result;
	}

}