<?php

use Horestco\My\Model as Model;
#[\AllowDynamicProperties]
class Auth
{
	public $login = '/customer/login';

	public $redirectIfAuth = '/customer/profile/';

	public function __construct()
	{
		$this->ci = get_instance();

		$this->ci->load->library(['session', 'form_validation', 'hash']);
	}

	public function check()
	{
		return isset($this->ci->session->auth) && $this->ci->session->auth['check'] ;
	}

	public function user($param = null)
	{
		if( !is_null($param) )
		{
			return $this->ci->session->auth[$param];
		}

		return $this->ci->session->auth;
	}

	public function logout()
	{
		$this->destroy();

		return redirect($this->login);
	}

	public function matchLogin($email, $password)
	{
		$customer = Model\Customer::where('email', $email)->with(['contact'])->first();

		if( is_null($customer) )
		{
			return false;
		}

		if( !password_verify($password, $customer->password) )
		{
			return false;
		}

		$this->setAuth( array_merge(['check'=>true], $customer->toArray()) );
		
		return true;
	}

	public function hasVerified($customer)
	{
		return $customer['is_verified'] == 1 ? true : false;
	}

	public function setAuth($data)
	{
		return $this->ci->session->set_userdata(['auth'=>$data]);
	}

	public function destroy()
	{
		return $this->ci->session->unset_userdata('auth');
	}

	public function generateKey($source)
	{
		$hash = '';
		do {
			$hash = $this->ci->hash->create($source);
		} while ( in_array($hash, Model\CustomerVerify::lists('hash_key')) );

		return $hash;
	}

}