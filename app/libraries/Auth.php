<?php

use Horestco\My\Model as Model;
use League\OAuth2\Client\Provider\Google;

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
    $authData = $this->ci->session->userdata('auth');

    if ($authData === null) {
        return false;
    }

    return isset($authData['check']) && $authData['check'] == 1;
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

	public function google_login()
	{
	  if (session_status() == PHP_SESSION_NONE) {
		  session_start();
	  }
		$provider = new Google([
		  'clientId'     => '9921198422-kvm5h7enn6geggnug0movkpvv2n17mtn.apps.googleusercontent.com',
		  'clientSecret' => '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',
		  'redirectUri'  => 'https://horestco.com/customer/auth/google_login',
		]);
  
		if (!isset($_GET['code'])) {
			
			$authUrl = $provider->getAuthorizationUrl();
			$_SESSION['oauth2state'] = $provider->getState();
			header('Location: ' . $authUrl);
			exit;
		} else {
			
			if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
				unset($_SESSION['oauth2state']);
				die('Invalid state');
			}
  
			try {
			   
				$token = $provider->getAccessToken('authorization_code', [
					'code' => $_GET['code']
				]);
  
			   
				$user = $provider->getResourceOwner($token);
  
				$this->processUser($user);
  
			} catch (Exception $e) {
			   
				die('Error: ' . $e->getMessage());
			}
		}
	}

	private function processUser($user)
  {
	
	  $customer = Model\Customer::where('email', $user->getEmail())->first();

	  if (is_null($customer)) {
		
		  $customer = new Model\Customer();
		  $customer->email = $user->getEmail();
		  $customer->name = $user->getName();
		  
		  $customer->save();
	  }

	  $this->setAuth(array_merge(['check' => true], $customer->toArray()));
	  
	  
	  header('Location: ' . $this->redirectIfAuth);
	  exit;
  }

	public function hasVerified($customer)
	{
		return $customer['is_verified'] == 1 ? true : false;
	}

	public function setAuth($data)
	{
		$this->ci->session->set_userdata(['auth' => $data]);
		$this->ci->session->sess_regenerate(TRUE);
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