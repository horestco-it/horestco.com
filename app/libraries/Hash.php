<?php

/**
* 
*/
class Hash
{
	/**
	 * Default iPay88 signature
	 * @param  String $source
	 * @return String SHA1 algorithm
	 */
	public function create($source)
	{
		return base64_encode(hex2bin(sha1($source)));
	}

	public function verify($source, $hash)
	{
		return $this->create($source) == $hash;
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