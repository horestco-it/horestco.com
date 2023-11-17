<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class ProductCopy extends Model
{
	protected $table = 'products_copy';

	// scope
	public function scopeEnabled($query)
	{
		return $query->where('is_enabled', 1);
	}

	public function scopeSort($query, $sort = 'asc')
	{
		return $query->orderBy('sort_order', $sort);
	}

	// one-to-many
	public function images()
	{
		return $this->hasMany('Image');
	}
	
}

/* End of file Product.php */
/* Location: ./application/models/Product.php */