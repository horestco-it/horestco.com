<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



use Horestco\My\Model as Model;



class Customer extends HRC_Controller

{



	protected $redirectIfAuth = '/customer/profile';
	
	

	public function __construct()

	{

		parent::__construct();



		$this->load->library(['form_validation', 'Hash']);



		$this->data['page'] = 'customer';



	}



	public function profile($name = null)

	{

		// redirect if has auth

		if(!$this->auth->check())

		{

			return redirect($this->auth->login);

		}



		$this->data['customer'] = Model\Customer::where('email', $this->auth->user('email'))->first();



		$this->load->view('profile', $this->data);



	}



	public function register()

	{

		$this->data['countries'] = Country::lists('name', 'id');



		return $this->load->view('register', $this->data);

	}



	public function login()

	{

		if($this->auth->check())

		{

			return redirect($this->auth->redirectIfAuth);

		}



		$this->data['page'] = 'Customer Login';



		return $this->load->view('login', $this->data);

	}

	public function resetpwd()
	{
	return $this->load->view('resetpassword', $this->data);	
	}



	public function logout()

	{

		$this->auth->logout();

	}



	public function content()

	{

		return $this->load->view('mailer');

	}



	public function resend()

	{

		if (!$this->auth->check())

		{

			return false;

		}



		$customer = Model\Customer::where('email', $this->auth->user('email'))->first();



		if( $customer->verify && $customer->verify->is_verified == 1 )

		{

			echo "error";

			return false;

		}



		$hash_key = $this->hash->create($customer->email.$customer->password.str_random(10));



		// update hash_key in table `customer_verifies`

		$update = $customer->verify->update([

				'hash_key' 		=> $hash_key,

				'updated_at'	=> $this->dateNow(),

			]);



		$send = $this->sendEmailVerification_([

				'email' => $customer->email,

				'name' => $customer->name,

				'password' => $customer->password,

				'hash_key' => $hash_key,

			]);



		if($send)

		{

			$this->session->set_flashdata('message','An email has send to '.$customer->email);

		}

		return redirect('/customer/profile/'.str_slug($customer->name));

	}


	public function cancelreset()

	{
		$customer = Model\Customer::where('email', $this->auth->user('email'))->first();

		$customer->newpassword= '';
		$customer->save();
		$customer->verify->is_reset = 0;
		$customer->verify->hash_key = '';
		$customer->verify->save();
		if( $customer->save() ){

		
		
	$this->session->set_flashdata('message','<span class="red-text">reset password canceled</span> ');
		}
		
		return redirect('/customer/profile/'.str_slug($customer->name));

	}



	//////////////////////

	// Prosses register //

	//////////////////////

	public function reg_process()

	{



		$this->form_validation->set_rules($this->config('register'));



		$this->data['countries'] = Country::lists('name', 'id');

		

		if(!$this->form_validation->run($this))

		{

			return $this->load->view('register', $this->data);

		}



		if( $this->input->post('password') != $this->input->post('password1') )

		{

			$this->session->set_flashdata('errors', 'Passwords doesn\'t match');



			return $this->load->view('register', $this->data);

		}



		$request = [

			'name' 				=> preg_replace('/\s+/',' ', $this->input->post('name')),

			'last_name' 	=> preg_replace('/\s+/',' ', $this->input->post('last_name')),

			'email' 			=> filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL),

			'password'		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),

			'created_at'	=> $this->dateNow(),

			'updated_at'	=> $this->dateNow(),

		];



		$customerId = Model\Customer::insertGetId($request);





		if($customerId)

		{

			$customer = Model\Customer::find($customerId);



			$hash_key = $this->auth->generateKey($request['email'].$request['password'].str_random(10));



			// insert customer contact to table `customer_contacts`

			$contacts = new Model\CustomerContact($this->input->post('customer')['contact']);

			$customer->contact()->save($contacts);



			Model\CustomerVerify::insert([

					'customer_id' => $customerId,

					'hash_key' => $hash_key,

					'created_at' => $this->dateNow(),

					'updated_at' => $this->dateNow(),

				]);

			////////////////

			// send email //

			////////////////

			$this->sendEmailVerification_([

					'email' => $request['email'],

					'name' => $request['name'],

					'password' => $request['password'],

					'hash_key' => $hash_key,

				]);



			// set auth

			$this->auth->setAuth([

					'email' => $request['email'],

					'name' => $request['name'],

					'check' => true,

				]);



			// redirect to profile
			return redirect('/customer/profile/'.str_slug($request['name']));

		}

		else{

			$this->session->set_flashdata('errors', 'register failed, please retry');



			return $this->load->view('register', $this->data);

		}

	}

	//////////////////

	// proses login //

	//////////////////

	public function validate()

	{

		$config = [

			[

				'field' => 'email',

				'label' => 'Email',

				'rules' => 'valid_email|required|callback_is_exists',

				'errors' => [

					'required' => 'Email tidak boleh kosong',

					'valid_email' => 'Email tidak valid',

				]

			],

			[

				'field' => 'password',

				'label' => 'Password',

				'rules' => 'required|callback_match_login',

				'errors' => [

					'required' => 'Password tidak boleh kosong',

				]

			]

		];



		$this->form_validation->set_rules($config);



		if(!$this->form_validation->run($this))

		{

			return $this->load->view('login', $this->data);

		}



		// $backUrl = $this->input->post('referrer') ;



		return redirect( $this->auth->redirectIfAuth );

		

	}



	public function has_exists($email)

	{

		if( Model\Customer::isExists($email) )

		{

			$this->form_validation->set_message('has_exists', " Email {$email} was already registered. Please <a href=\"/customer/login\" style=\"text-decoration:underline\">Login</a>");

			return false;

		}

		return true;

	}



	public function is_exists($email)

	{

		if( !Model\Customer::isExists($email) )

		{

			$this->form_validation->set_message('is_exists', " Email {$email} does not registered. Please <a href=\"/customer/register\" class=\"red-text\">Register</a> first!");

			return false;

		}

		return true;

	}



	public function match_login($email, $password)

	{

		$isMatch = $this->auth->matchLogin($this->input->post('email'), $this->input->post('password'));



		if($isMatch == false)

		{

			$this->form_validation->set_message('match_login', " Email & Password doesn't match ");



			return false;

		}

		return true;

	}



	protected function config($group)

	{

		$config['register'] = [

			[

				'field' => 'name',

				'label' => 'First name',

				'rules' => 'trim|required',

				'errors' => [

					'required' => '%s tidak boleh kosong',

				]

			],

			[

				'field' => 'email',

				'label' => 'Email',

				'rules' => 'valid_email|required|callback_has_exists',

				'errors' => [

					'required' => 'Email tidak boleh kosong',

					'valid_email' => 'Email tidak valid',

				]

			],

			[

				'field' => 'password1',

				'label' => 'Password',

				'rules' => 'required',

				'errors' => [

					'required' => 'Password tidak boleh kosong',

				]

			],

			[

				'field' => 'password',

				'label' => 'Retype Password',

				'rules' => 'required',

				'errors' => [

					'required' => 'Please input %s twice',

				]

			],

			[

				'field' => 'customer[contact][address]',

				'label' => 'Address',

				'rules' => 'required',

				'errors' => [

					'required' => '%s field is required',

				]

			],

			[

				'field' => 'customer[contact][city]',

				'label' => 'City',

				'rules' => 'required',

				'errors' => [

					'required' => 'City field is required',

				]

			],

			[

				'field' => 'customer[contact][zip]',

				'label' => 'Zip',

				'rules' => 'required',

				'errors' => [

					'required' => 'Zip postal field is required',

				]

			],

			[

				'field' => 'customer[contact][telephone]',

				'label' => 'Telephone',

				'rules' => 'required',

				'errors' => [

					'required' => 'Telephone field is required',

				]

			],

		];



		return $config[$group];

	}



	/**
	 * [sendEmailVerification_ description]
	 * @param  Array $request 	[email, name, password]
	 * @return [type]          [description]
	 */

	protected function sendEmailVerification_($request, $resend = null)

	{

		// if $resend null , $hash value dapat dari register user

		$param = $request['hash_key'];



		$this->load->library('mailer');



		$this->mailer->init([

				'to'=>[$request['email'] => $request['name']],

				'subject'=>'Account confirmation for '.$request['email'],

			]);



		$this->mailer->setContent('verify', [

				'customer_name' 	=> $request['name'],

				'customer_email' 	=> $request['email'],

				'response'			=> base_url().$this->mailer->response($param),

			]);



		return $this->mailer->send();

	}


public function rstpwd()
{
	
	return $this->load->view('reset', $this->data);
}


public function validateres()

	{

		$config = [

			[

				'field' => 'email',

				'label' => 'Email',

				'rules' => 'valid_email|required|callback_is_exists',

				'errors' => [

					'required' => 'Email tidak boleh kosong',

					'valid_email' => 'Email tidak valid',

				]

			],
			[

				'field' => 'newpassword',

				'label' => 'newpassword',

				

				'errors' => [

					'required' => 'Password tidak boleh kosong',

				]

			]

		];


		$this->form_validation->set_rules($config);



		if(!$this->form_validation->run($this))

			{

				return $this->load->view('register', $this->data);

			}
			
		if($this->form_validation->run($this))
			{

			$request = [

			'email' 			=> filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL),

			'newpassword'		=> password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT),

			'created_at'	=> $this->dateNow(),

			'updated_at'	=> $this->dateNow(),

						];
		
		$customer = Model\Customer::where('email',$request['email'])->first();
			
		if($customer)

		{
			$customer->newpassword = $request['newpassword'];
			$customer->save();

			$hash_key = $this->hash->create($request['email'].$request['newpassword'].str_random(10));

			$customer->verify->is_reset = '1';
			$customer->verify->hash_key = $hash_key;
			$customer->verify->save();
			////////////////

			// send email //

			////////////////

			$this->sendreset([

					'email' => $request['email'],

					'name' => $request['name'],

					'newpassword' => $request['newpassword'],

					'hash_key' => $hash_key,

				]);


		
			// $this->logout();

			return redirect('/customer/rstpwd');


		
			}

	}

	
}
protected function sendreset($request, $resend = null)

	{

		// if $resend null , $hash value dapat dari register user

		$param = $request['hash_key'];



		$this->load->library('mailer');



		$this->mailer->init([

				'to'=>[$request['email'] => $request['name']],

				'subject'=>'Password reset confirmation for '.$request['email'],

			]);


		$this->mailer->setResponseUrl('email/confirmationreset?');

		$this->mailer->setContent('resetpassword', [

				'customer_name' 	=> $request['name'],

				'customer_email' 	=> $request['email'],

				'response'			=> base_url().$this->mailer->response($param),

			]);



		return $this->mailer->send();
		

	}

	function editvalidation()
	{
		$config = [

				[

					'field' => 'password',

					'label' => 'password',

					'rules' => 'required',

					'errors' => [

						'required' => 'Email tidak boleh kosong',

					]

				],
				[

					'field' => 'newpassword',

					'label' => 'newpassword',

					'rules' =>'required',

					'errors' => [

						'required' => 'Password tidak boleh kosong',

					]

				],
				[

					'field' => 'confirmpassword',

					'label' => 'confirmpassword',

					'rules' =>'required',

					'errors' => [

						'required' => 'Please input %s twice',

					]

				]

			];
			
		$this->form_validation->set_rules($config);



		if(!$this->form_validation->run($this))

			{

				echo('gagal');

			}
		
				

		if($this->form_validation->run($this))
			{

					$request = [
					'password'		=> $this->input->post('password'),

					'newpassword'		=> password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT),
								];
				
				$Customer = Model\Customer::where('email', $this->auth->user('email'))->first();

				if(password_verify($request['password'] , $Customer->password) )


				{
					$Customer->newpassword = $request['newpassword'];
					$Customer->password = $Customer->newpassword;
					$Customer->newpassword = '';
					$Customer->save();
					////////////////

					// send email //

					////////////////

					$this->sendedit([

							'email' =>$this->auth->user('email'),

							'name' =>$this->auth->user('name'),
							]);
					$this->session->set_flashdata('message', 'Thank You, Your Password Has Been Changed');
					$this->load->view('editpwd', $this->data);
				}
				else
				{
					
				$this->session->set_flashdata('message', 'Invalid Current Password');
				$this->load->view('editpassword', $this->data);
				}

				
			}
			
		}

	function editpwd()
	{

		return $this->load->view('editpassword', $this->data);
	}


	protected function sendedit($request, $resend = null)

	{

		$this->load->library('mailer');
		$this->mailer->init([

				'to'=>[$request['email'] => $request['name']],

				'subject'=>'Password reset confirmation for '.$request['email'],

			]);

		$this->mailer->setContent('editpassword', [

				'customer_name' 	=> $request['name'],

				'customer_email' 	=> $request['email'],
			]);

		return $this->mailer->send();
		

	}





}