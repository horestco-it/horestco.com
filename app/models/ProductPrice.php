<?php 
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
	protected $fillable = [
		'normal', 
		'promo', 
		'project', 
		'export', 
		'is_promo', 
		'promo_description', 
		'promo_note',
		'sunbrella',
		'sunproof',
		'genuine_leather',
		'synthetic_leather',
	];

	protected $appends = [
		'retail',
		'current',
	];

	protected $casts = [
		'is_promo' => 'boolean',
	];

	private function label()
	{
		$label  = "<span class=\"grey-text hide-on-small-only\">";
		$label .= 	"	<i class=\"fa fa-tags grey-text text-darken-1 left hide-on-print gap gap-5\"></i> ";
		$label .= "</span>";
		return $label;
	}

	public function getRetailAttribute()
	{
		if( $this->normal == '' || $this->normal == 0.00  )
		{
			return null;
		}

		return $this->normal;
	}

	public function getCurrentAttribute()
	{
		if(!$this->is_promo || $this->promo == '' || $this->promo == 0.00)
		{
			return $this->retail;
		}
		return $this->promo;
	}

	public function getPromoAttribute($value)
	{
		if($value == '' || $value == 0.00) return null;

		return $value;
	}

	public function scopePromotion($query)
	{
		return $query->where('is_promo', 1)->whereNotIn('promo', [0.00])->whereNotIn('normal', [0.00]);
	}
	
	public function product()
	{
		return $this->belongsTo('Product');
	}
}