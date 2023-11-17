<?php 
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
	use ModelRelationTrait;

	protected $guarded = [];
	
	public $timestamps = false;
	// scope

	// one-to-many
	public function products()
	{
		return $this->hasMany('Product');
	}
	// many-to-many
	public function relations()
	{
		return $this->belongsToMany('Subcategory', 'subcategory_alsos', 'subcategory_id', 'also_id');
	}
	
	public function products_more()
	{
		return $this->belongsToMany('Product', 'product_subcategory', 'subcategory_id', 'product_id');
	}

	// inverse many-to-one
	public function category()
	{
		return $this->belongsTo('Category');
	}


	
}

/* End of file Subcategory.php */
/* Location: ./application/models/Subcategory.php */