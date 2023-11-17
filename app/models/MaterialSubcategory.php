<?php
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class MaterialSubcategory extends Model
{
	/**
	 * relation materials
	 * one-to-many
	 * @return [type] [description]
	 */
	public function materials()
	{
		return $this->hasMany('Material');
	}

	public function category()
	{
		return $this->belongsTo('MaterialCategory');
	}

}