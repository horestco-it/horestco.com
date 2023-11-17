<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class ProductApprove extends Model
{
	// inverse one-to-one
	public function product()
	{
		return $this->belongsTo('Product');
	}
	// inverse many-to-one
	public function user()
	{
		return $this->belongsTo('Horestco\My\Model\User');
	}
}