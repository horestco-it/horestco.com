<?php 

use \Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use \ModelRelationTrait;

	public $timestamps = false;

	// one-to-many
	public function subcategories()
	{
		return $this->hasMany('Subcategory');
	}

	// has many through
	public function products()
	{
		return $this->hasManyThrough('Product', 'Subcategory');
	}

	
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */