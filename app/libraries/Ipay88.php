<?php

/**
* 
*/
class Ipay88
{

	protected $currency = 'MYR';

	protected $merchantKey = 'SV4gyY9OPz';

	protected $merchantCode = 'M08435';

	public $action = 'https://www.mobile88.com/ePayment/entry.asp';

	protected $responseUrl = 'http://horestco.com/payment/response';

	protected $backendUrl = 'http://horestco.com/payment/response/backend';

	protected $requests = [];

	// daftar error description dari response ipay88 
	protected $errorDesc = [
		'payment fail'
	];
	
	function __construct()
	{
		
	}

	public function set($posts)
	{
		foreach($posts as $key => $value)
		{
			$this->requests[$key] = $value;
		}
	}

	public function get($key = null)
	{
		if( is_null($key) )
		{
			return $this->requests();
		}

		return $this->requests()[$key];
	}
	/**
	 * set post request
	 * @param  array  $posts [description]
	 * @return [type]        [description]
	 */
	protected function requests()
	{
		$default = array(
			'MerchantCode' => $this->merchantCode,
			'Currency' => $this->currency,
			'PaymentId' => 20, // chimb niaga click
			'Lang' => 'UTF-8',
			'ResponseURL' => $this->responseUrl,
			'BackendURL' => $this->backendUrl,
		);

		return array_merge($this->requests, $default);
	}

	public function getMerchantKey()
	{
		return $this->merchantKey;
	}

	public function signature($source)
	{
		return $this->iPay88_signature($source);
	}

	/**
	 * Verify signature is match or not
	 * @param  [String] $signature hash
	 * @param  [String] $source    parameter stringify
	 * @return [Boolean]           true or false
	 */
	public function verifySignature($signature, $source)
	{
		return $this->iPay88_signature($source) == $signature;
	}

	public function setCurrency($currency)
	{
		return $this->currency = $currency;
	}

	public function getCurrency()
	{
		return $this->currency;
	}

	public function hasError($status)
	{
		return in_array($this->errorDesc, $status);
	}

	public function requery($MerchantCode, $RefNo, $Amount)
	{
		$query = "https://www.mobile88.com/epayment/enquiry.asp?MerchantCode=" . $MerchantCode . "&RefNo=" . $RefNo . "&Amount=" . $Amount;

		$url = parse_url($query);
		$host = $url["host"];
		$path = $url["path"] . "?" . $url["query"];
		$timeout = 1;
		$fp = fsockopen ($host, 80, $errno, $errstr, $timeout);

		if ($fp)
		{
			fputs ($fp, "GET $path HTTP/1.0\nHost: " . $host . "\n\n");

			$buf = '';
			while (!feof($fp))
			{
				$buf .= fgets($fp, 128);
			}

			$lines = preg_split("\n", $buf);

			$Result = $lines[count($lines)-1];

			fclose($fp);

		} else {
			echo "Error";
		}

		return $Result;
	}
	
	/**
	 * Default iPay88 signature
	 * @param  String $source
	 * @return String SHA1 algorithm
	 */
	private function iPay88_signature($source)
	{
		return base64_encode(hex2bin(sha1($source)));
	}

	private function hex2bin($hexSource)
	{
		for ($i=0;$i<strlen($hexSource);$i=$i+2)
		{
		  $bin .= chr(hexdec(substr($hexSource,$i,2)));
		}
	  return $bin;
	}
}