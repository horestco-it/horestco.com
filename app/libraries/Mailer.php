<?php



/**
* 
*/

class Mailer

{

	/**
	 * Email connection configuration
	 * @var [type]
	 */

	protected $params = [

		'host' 			=> 'smtp.gmail.com',

		'port' 			=> 587,

		'security' 	=> 'tls',

		'username' 	=> 'irnovi@horestco.com',

		'password' 	=> 'wahid@satu@siji',



		'from' 			=> 'info@horestco.com',

		'subject' 	=> '[No Subject]',

	];



	/**
	 * URL confirmasi response dari user email
	 */

	protected $response = 'email/confirmation?';



	/**
	 * Parameter key url dari url response
	 * email/confirmation?_v=1&_mifta=[hash]
	 */

	public $paramKey = '_mifta';



	protected $css = null;

	protected $content = '';



	public function __construct()

	{

		// Create the Transport

		$this->transport = Swift_SmtpTransport::newInstance($this->params['host'], $this->params['port'], $this->params['security'])

		  ->setUsername($this->params['username'])

		  ->setPassword($this->params['password'])

		  ;

	}



	public function init($params)

	{

		foreach ($params as $key => $param) {

			$this->params[$key] = $param;

		}

	}



	public function setCss($file)

	{

		$this->css = file_get_contents($file);

	}



	public function setContent($content, $param)

	{

		$this->content = $this->callable_($content, $param);

	}



	public function send()

	{

		$message = Swift_Message::newInstance( $this->params['subject'] )

		  ->setFrom($this->params['from'])

		  ->setTo($this->params['to'])

		  ->setBody( $this->template($this->content) , 'text/html' )

		  ;

		return Swift_Mailer::newInstance($this->transport)->send($message);

	}

	public function setResponseUrl($url)
	{
		$this->response = $url;
	}

	public function response($paramValue)

	{

		return $this->response.$this->paramKey."=".$paramValue;

	}
	


	protected function template($body)

	{

		$content   = '<html>';

		$content   = '<head><style>hr{border:none;height:1px;background:#ddd}</style></head>';

		$content  .= '<body>';

		$content  .= '<table style="width:100%;border:none;background:#f2f2f2;padding:40px 20px" cellspacing="0" cellpadding="0">';

		$content  .= '<tr>';

		$content  .= '<td align="center" valing="top" colspan="2">';

		$content  .= '<table style="background:#fff;width:650px;border:1px solid #e0e0e0;padding:20px" cellspacing="0" cellpadding="0" >';

		$content  .= '<tr valing="top" style="padding:10px">';

		$content 	.= '<a href="http://www.horestco.com">';

		$content 	.= '<img src="http://www.horestco.com/assets/images/horestco-logo.png" alt="horestco.com">';

		$content 	.= '</a></tr>';

		$content  .= '<tr><hr>';

		$content  .= '</tr>';

		$content  .= 	$body;

		$content  .= '</table>';

		$content  .= '</td>';

		$content  .= '</tr>';

		$content  .= '</table>';

		$content  .= '</body>';

		$content  .= '</html>';



		return $content;

	}



	protected function callable_($func, $param = null)

	{

		if( !method_exists(new self, $func) )

		{

			throw new Exception("Method {$func} doesn't exists", 1);



			return;

		}

		return $this->$func($param);

	}



	protected function verify($params)

	{

		$content = '<tr><h1>Dear '.$params['customer_name'].'</h1>';

		$content .= '<p>Your e-mail '.$params['customer_email'].' must be confirmed before using it to log in to our store.</p>';

		$content .= '<p>To confirm the e-mail and instantly log in, please, use <a href="'.$params['response'].'">this confirmation link</a>. This link is valid only once.</p>';

		$content .= '</tr>';



		return $content;

	}
	protected function resetpassword($params)

	{

		$content = '<tr><h1>Dear '.$params['customer_email'].'</h1>';

		$content .= '<p>Your Password has been updated</p>';

		$content .= '<p>To confirm your new password please, use <a href="'.$params['response'].'">this confirmation link</a>. This link is valid only once.</p>';

		$content .= '</tr>';



		return $content;
	}
	protected function editpassword($params)

	{

		$content = '<tr><h1>Dear '.$params['customer_name'].'</h1>';

		$content .= '<p>Your Password has been changed</p>';

		$content .= '<p>Thank you for being our partner</p>';

		$content .= '</tr>';



		return $content;
	}



}