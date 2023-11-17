<?php
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
	use ModelRelationTrait;
	
	protected $fillable = ['name', 'dimension', 'is_enabled', 'sort_order'];

	public $timestamps = false;

	public function prices()
	{
		return $this->hasOne('ProductPrice');
	}

	public function price()
	{
		return $this->hasOne('ProductPrice');
	}

	public function product()
	{
		return $this->belongsTo('Product');
	}
}