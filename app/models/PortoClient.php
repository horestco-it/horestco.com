<?php

use \Illuminate\Database\Eloquent\Model;

class PortoClient extends Model
{
	protected $appends = ['status'];
	//scope
	public function scopeEnabled($query)
	{
		return $query->where('is_enabled', 1);
	}

	public function scopeSort($query, $sort = 'asc')
	{
		return $query->orderBy('sort_order', $sort);
	}

	// one-to-one
	public function image()
	{
		return $this->hasOne('PortoImage')->where('is_primary', 1);
	}
	// one-to-many
	public function images()
	{
		return $this->hasMany('PortoImage');
	}

	// inverse many-to-one
	public function page()
	{
		return $this->belongsTo('Page');
	}

	// many-to-many
	public function products()
	{
		return $this->belongsToMany('Product');
	}

	public function getStatusAttribute()
	{
		return $this->is_enabled == 1 ? true: false;
	}

}