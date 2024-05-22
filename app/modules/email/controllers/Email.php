<?php



use Horestco\My\Model as Model;
use Illuminate\Support\Str;

class Email extends HRC_Controller

{

	

	public function __construct()

	{

		parent::__construct();



		$this->data['page'] = __class__;



		$this->load->library(['hash', 'mailer']);

	}



	public function verify()

	{

		// prevent if member was verified

		return $this->load->view('verify', $this->data);

	}
	public function resetpassword()

	{

		// prevent if member was verified

		return $this->load->view('resetpassword', $this->data);

	}



	public function confirmation()

	{

		$url = parse_url($_SERVER['REQUEST_URI'])['query'];



		$key = str_replace($this->mailer->paramKey.'=', '', $url);



		$verify = Model\CustomerVerify::where('hash_key', $key)->first();



		if( is_null($verify) || $verify->is_verified == 1 )

		{

			echo "error";

			return false;

		}

		// update to verified
		$verify->is_verified = 1;

		$verify->hash_key = '';

		$verify->verified_at = $this->dateNow();

		if( $verify->save() )

		{

			$this->session->set_flashdata('message', '<span class="green-text">Your email <strong>'.$verify->customer->email.'</strong> has verified.</span>');

		}

		else{

			$this->session->set_flashdata('message', '<span class="red-text">Verification is failed.</span>');

		}

		// login

		$this->auth->setAuth([

				'name' => $verify->customer->name,

				'email' => $verify->customer->email,

				'check' => true,

			]);



		return redirect('/customer/profile/'.Str::slug($verify->customer->name));



	}
	public function confirmationreset()

	{

		$url = parse_url($_SERVER['REQUEST_URI'])['query'];



		$key = str_replace($this->mailer->paramKey.'=', '', $url);



		$verify = Model\CustomerVerify::where('hash_key', $key)->first();

		// check jika sudah direset (reset click 2x)
		if( is_null($verify) || $verify->is_reset == 0 )
		{
			echo "error";

			return false;
		}
		// update table customers
		$verify->Customer->password = $verify->Customer->newpassword;
		$verify->Customer->newpassword= '';
		$verify->Customer->save();

		// update table customer_VERIFIES
		$verify->is_reset = 0;
		$verify->hash_key = '';

		if( $verify->save() )
		{
			
			$this->session->set_flashdata('message', '<span class="green-text">hello  <strong>'.$verify->customer->name.'</strong>  your password has been reset. <br> Please login with your new password </br></span>');

		}

		else{

			$this->session->set_flashdata('message', '<span class="red-text">reset is failed.</span>');

		}
		return redirect('/customer/login/'.Str::slug($verify->customer->name));
	}

}