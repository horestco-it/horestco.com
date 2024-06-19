<?php
/**
* 
*/
class Google
{
	protected $action = [
		'get' => 'rqStck',
		'update' => 'upStck',
	];

	protected $http;
	protected $url;

	public function __construct()
	{
		$this->http = new GuzzleHttp\Client;

		$this->url = 'https://script.google.com/macros/s/AKfycbz_TB9CKM3M68taPFJp-afB0Q-zTmsBx-l4bbpe331XYK5pqL6d/exec';
	}

	public function stock($code, $material)
	{
		$data = $this->inventory('get', compact('code', 'material'));

		if( isset($data->stock) )
		{
			return $data->stock;
		}
	}

	public function inventory($action, $params)
	{
		$query = [ 'action' => $this->action[$action] ];
		
		$query = array_merge($query, $params);

		$response = $this->http->get($this->url, ['query'=> $query]);

		if( $response->getStatusCode() == 200 )
		{
			$data = json_decode($response->getBody()->getContents());

			return $data;
		}
		
		return false;
	}

}