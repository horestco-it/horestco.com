<?php
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
	use ModelRelationTrait;

	protected $fillable = ['product_id', 'name', 'is_primary'];

	// update timestamp updated_at product table
	protected $touches = ['product'];

	public function scopePrimary($query)
	{
		return $query->where('sort_order', 1);
	}

	public function scopeEnabled($query)
	{
		return $query->where('is_enabled', 1);
	}
	/**
	 * get material 
	 * many-to-many
	 * @return (mix) associate with materials table
	 */
	public function materials()
	{
		return $this->belongsToMany('Material', 'material_image');
	}
	// inverse many-to-one
	public function product()
	{
		return $this->belongsTo('Product');
	}
}

/* End of file Image.php */
/* Location: ./application/models/Image.php */