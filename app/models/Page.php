<?php

use \Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	// scope
	public function scopeSlug($query, $slug = '/')
	{
		return $query->where('slug', $slug);
	}

	public function scopeEnabled($query)
	{
		return $query->where('is_enabled', 1);
	}

	public function scopeCategoy($query, $category)
	{
		return $query->where('category', $category);
	}

	public function scopeEn($query)
	{
		return $query->where('country', 'en');
	}

	// one-to-one
	public function metas()
	{
		return $this->hasOne('Meta');
	}

	// one-to-many

	public function clients()

	{

		return $this->hasMany('PortoClient');

	}

}