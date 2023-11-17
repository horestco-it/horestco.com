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
			'google',
		]);

		$this->data['page'] = __CLASS__;
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
		if( is_null($this->session->cart_contents) )
		{
			return redirect($this->data['redirectToShop']);
		}

		// vd($this->input->post('customer'));return;
		$this->session->set_flashdata('error', '');

		// post request from route: /cart/information
		if( !is_null($customer = $this->input->post('customer')) )
		{
			// only delivery to Malaysia
			if( $customer['contact']['country_id'] != 129 )
			{
				$this->session->set_flashdata('error', 'Sorry we only receive delivery to Malaysia only');

				$this->data['countries'] = Country::lists('name', 'id');

				return $this->load->view('cart/information', $this->data);
			}

			$this->auth->setAuth( array_merge(['check'=>false], $customer) );
		}

		if ( is_null($this->auth->check()) )
		{
			return redirect(base_url('cart/information'));
		}

		$ref = $this->order->createRefId( Transaction::orderBy('id', 'desc')->first()->id );

		$customerName = $this->auth->user('name').' '.$this->auth->user('last_name');

		$contact = $this->auth->user('contact');

		$amount = [ 
			'actual' 	=> $this->cart->total(),
			'testing'	=> $this->amount,
		];

		// merger with default ipay88 data configuration
		$this->ipay88->set([
			// product item
			'ProdDesc' 		=> $this->order->productDesc($this->cart->contents()),
			// customer request
			'UserName' 		=> $this->auth->user('name').' '.$this->auth->user('last_name'),
			'UserEmail' 	=> $this->auth->user('email'),
			'UserContact' => $contact['telephone'],
			'Remark' 			=> '',
			// order
			'RefNo' 			=> $ref,
			'Amount'			=> $amount['actual'],
			// system
			'Signature' 	=> $this->generateSignature([
													$this->ipay88->getMerchantKey(),
													$this->ipay88->get('MerchantCode'),
													$ref,
													// str_replace(',', '', str_replace('.', '', $this->amount)),
													$amount['actual'],
													$this->ipay88->get('Currency'),
												]),
		]);
		/////////////////
		// assign data //
		/////////////////
		// basic
		$this->data['page'] = __FUNCTION__;
		// hidden inputs to be insert to form
		$this->data['inputs'] = $this->renderInputs($this->ipay88->get(), 'hidden');
		// if get error
		$this->data['error'] = $this->session->flashdata('error');
		// customer
		$this->data['customers'] = [
			'email' 	=> $this->auth->user('email'),
			'name' 		=> $customerName,
			'address'	=> implode(', ', [
												$contact['address'], 
												$contact['city']." ".Country::find($contact['country_id'])->name,
												$contact['zip']
											]),
			'telephone' => $contact['telephone'],
		];
		//////////////////////
		// update inventory //
		//////////////////////
		
		// vd($this->cart->contents());return;

		// foreach ($this->cart->contents() as $key => $product)
		// {
		// 	foreach ( $product['materials'] as $key => $material)
		// 	{
		// 		if( $material != '' )
		// 		{
		// 			$this->google->inventory('update', [
		// 																				'code' => $product['code'], 
		// 																				'material' => $material['code'],
		// 																				'purchased' => $product['qty'], 
		// 																				'noRef' => $ref,
		// 																				'customer' => $customerName
		// 																			]);
		// 		}
		// 	}
		// }

		return $this->load->view('checkout', $this->data);

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
		$customerId = (int)$this->session->customer_id;

		$customer = Model\Customer::find($customerId);

		$customerName = $customer->name.' '.$customer->last_name;


		/////////////////////////////////
		// record to transaction table //
		/////////////////////////////////
		$refId = Transaction::insertGetId([
				'reference_id'				=> $_REQUEST['RefNo'], 
				'transaction_id'			=> $_REQUEST['TransId'], 
				'customer_id'					=> $customerId,
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

		$ref = $this->order->createRefId( $refId );

		//////////////////////
		// update inventory //
		//////////////////////
		foreach ($this->cart->contents() as $key => $product)
		{
			foreach ( $product['materials'] as $key => $material)
			{
				if( $material != '' )
				{
					$this->google->inventory('update', [
																						'code' => $product['code'], 
																						'material' => $material['code'],
																						'purchased' => $product['qty'], 
																						'noRef' => $ref,
																						'customer' => $customerName,
																					]);
				}
			}
		}


		////////////////////////////
		// destroy session & cart //
		////////////////////////////
		$this->cart->destroy();
		$this->auth->destroy();

		$this->data['page'] = __FUNCTION__;

		$this->load->view('payment/response', $this->data);

	}

	public function responseBackend()
	{
		echo "RECEIVEOK";
	}

	public function requery()
	{
		vd($this->ipay88->requery('M08435', 'ON0002218', 1));
	}

	/**
	 * Generate Signarue
	 * @param  Array  $data   [description]
	 * @param  boolean $string [description]
	 * @return [type]          [description]
	 */
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