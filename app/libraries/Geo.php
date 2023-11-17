<?php
/**
* 
*/
class Geo
{
	
	public function __construct()
	{
		$this->required('GuzzleHttp\Client');

		$this->http = new GuzzleHttp\Client;

		$this->api = 'http://freegeoip.net/json/';
	}

	public function getLocation()
	{
		$response = $this->http->get($this->api.$_SERVER['REMOTE_ADDR']);

		return json_decode($response->getBody()->getContents());
	}

	private function required($classes)
	{
		try {
			foreach ((array)$classes as $class) {
				if(!class_exists($class))
				{
					throw new Exception("This class is ". $class ." required");
					return false;
				}
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}