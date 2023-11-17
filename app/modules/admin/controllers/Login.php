<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Horestco\My\Model as Model;

class Login extends HRC_Controller {
	// user email db
	protected $user;
	// request user & password login
	protected $request;
	// default dashboard url
	protected $dashboard = '/admin';
	// default template
	protected $template = 'templates/login';

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form'));

		$this->load->library('form_validation');
	}
	public function index()
	{
		if( isset($this->session->userdata['logged_in'] ) )
		{
			redirect($this->dashboard);
		}
		
		$data['redirect'] = $this->redirect_($this->session->userdata('goback'));

		$this->load->view($this->template, $data);
	}
	public function validate()
	{
		if( isset($this->session->userdata['logged_in'] ) )
		{
			redirect($this->dashboard);
		}

		$email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
		$password = filter_var($this->input->post('password'), FILTER_SANITIZE_STRING);
		$this->request = array(
												'email' => $email,
												'password' => $password,
											);
		$this->user = Model\User::where('email', $this->request['email'])->first();
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_db');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		if (!$this->form_validation->run($this))
		{
			$data['redirect'] = $this->redirect_($this->dashboard);

			$this->load->view($this->template, $data);
		}
		else{
			echo 'redirect...';
			redirect($this->input->post('goto'), 'refresh');
		}
	}
	public function check_db($email)
	{
		// get user data from db
		if (!filter_var($this->request['email'], FILTER_VALIDATE_EMAIL))
		{
			$this->form_validation->set_message('check_db', "The <strong>{$this->input->post('email')}</strong> doesn't valid <br> Ensure your email is containing such as <em>.com</em>");
			return false;
		}
		if (is_null($this->user)) {
			$this->form_validation->set_message('check_db', "The <strong>{$this->input->post('email')}</strong> doesn't available <br>");
			return false;
		}
		if (!password_verify($this->request['password'], $this->user->password)) {
			$this->form_validation->set_message('check_db', "Email and Password doesn't match");
			return false;
		}
		$this->rehash();
		$this->session->set_userdata('logged_in', $this->user->toArray());
		return true;
	}

	public function redirect_($url = null)
	{
		return is_null($url) ? $this->dashboard : $url;
	}

	private function rehash()
	{
		$rehash = password_needs_rehash(
								$this->user->password, 
								PASSWORD_DEFAULT,
								array('cost' => 15)
							);
		// update password 
		if($rehash)
		{
			$this->user->password = password_hash(
													$this->request['password'], 
													PASSWORD_DEFAULT, 
													array('cost', 15)
												);
			$this->user->save();
		}
	}
}















/* End of file login.php */







/* Location: ./application/controllers/login.php */