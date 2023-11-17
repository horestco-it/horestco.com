<?php

class Order {

	/**
	 * [generateRefNo description]
	 * @param  integer $length [description]
	 * @param  string  $column [description]
	 * @return [type]          [description]
	 */
	public function generateRefId($length = 2, $column = 'reference_id')
	{
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXZY';

		do{
			$result = substr(str_shuffle($string), 0, $length++). '000'.rand(10, 9999);
		}
		while( in_array($result, Transaction::lists($column)) );

		return $result;
	}

	public function createRefId($id, $code = 'E', $result = '0000')
	{
		$len = strlen($id);

		if( $len == strlen($result) || $len > 4 )
		{
			return $id . $code;
		}
		return substr($result, -(4-$len) ) . $id . $code;
	}

	public function productDesc($items)
	{
		$names = [];
		foreach($items as $key => $item)
		{
			$names[$key] = str_slug($item['name']);
		}
		return implode(' ', $names);

	}

}