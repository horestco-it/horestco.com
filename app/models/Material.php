<?php
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	public function scopeEnabled($query)
	{
		return $query->where('is_enabled', 1);
	}

	public function images()
	{
		return $this->belongsToMany('Image', 'material_image');
	}

	public function subcategory()
	{
		return $this->belongsTo('MaterialSubcategory', 'material_subcategory_id');
	}

	public function category()
	{
		return $this->belongsTo('MaterialCategory', 'material_category_id');
	}
}