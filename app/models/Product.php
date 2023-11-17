<?php
// comment for access admin-php
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use ModelRelationTrait;

	protected $appends = [
		'image',				// primary image
		'route', 
		'admin_route', 
		'label', 
		'price',
		'price_normal', 
		'price_current',
		'desc',
	];

	public function scopePromotion($query)
	{
		return $query->where('is_promo', 1);
	}
	
	public function scopeActive($query)
	{
		return $query->where('is_enabled', 1);
	}

	public function getRouteAttribute()
	{
		return "/furniture/".str_slug($this->name)."-".$this->id;
	}

	public function getAdminRouteAttribute()
	{
		return "dashboard.php?action=edit&id=$this->id";
	}

	public function getImageAttribute()
	{
		if($this->images->count() == 0) return false;

		$primary = $this->images()->where('is_primary', 1)->first();

		if(is_null($primary))
		{
			$primary = $this->images[0];
		}

		return $primary->name;
	}

	public function getLabelAttribute()
	{
		$label  = "<span class=\"grey-text hide-on-small-only\">";
		$label .= 	"	<i class=\"fa fa-tags grey-text text-darken-1 left hide-on-print gap gap-5\"></i> ";
		$label .= "</span>";
		return $label;
	}

	public function getPriceAttribute()
	{
		if(!$this->sizes || !count($this->sizes)) {
			return 0;
		}
		return $this->sizes[0]->prices['normal'];
	}

	public function getPriceNormalAttribute()
	{
		$result = '';

		$normal = $this->sizes[0]->prices['normal'];

		if( $normal  != '' || $normal != 0.00 )
		{
			$result = $this->label.'<span class="price-label grey-text text-darken-2" style="margin-right:5px">MYR '.$normal.'</span>';
		}
		return $result;
	}

	public function getPriceCurrentAttribute()
	{
		$result = '';

		$promo = $this->sizes[0]->prices['promo'];
		$normal = $this->sizes[0]->prices['normal'];

		$result = ( $promo  != '' || $promo != 0.00 ) ? $this->price_normal : $this->label.'<span class="price-label grey-text text-darken-2" style="margin-right:5px">MYR '.$promo.'</span>';

		return $result;
	}

	/**
	 * potong description antara 190 sampai ketemu titik
	 * @return [type] [description]
	 */
	public function getDescAttribute()
	{
		$point = 190;
		$len = strlen($this->description);

		if($len < $point)
		{
			return $this->description;
		}

		do{
			$desc = substr($this->description, $point, $len);

			$point++;
		}while(strpos($desc, '.') != false);

		return substr($this->description, 0, $point);
	}

	private function lastChar($str)
	{
		$len = strlen($str);
		return substr($str, $len-1, $len);
	}

	// one-to-one
	public function prices()
	{
		return $this->hasOne('ProductPrice');
	}
	public function imageThumb()
	{
		return $this->hasOne('Image');
	}
	public function approve()
	{
		return $this->hasOne('ProductApprove');
	}

	// one-to-many
	public function images()
	{
		return $this->hasMany('Image');
	}
	public function sizes()
	{
		return $this->hasMany('ProductSize');
	}

	// inverse many-to-one
	public function subcategory()
	{
		return $this->belongsTo('Subcategory', 'subcategory_id');
	}

	// inverse many-to-one
	public function category()
	{
		return $this->belongsTo('Category', 'category_id');
	}

	// many-to-many
	public function subcategories()
	{
		return $this->belongsToMany('Subcategory');
	}

	public function clients()
	{
		return $this->belongsToMany('PortoClient');
	}

	public function relations()
	{
		return $this->belongsToMany('Product', 'product_alsos', 'product_id', 'also_id');
	}

	public function materials()
	{
		return $this->belongsToMany('Material');
	}

	// make own
	public static function findBy($key, $value = null)
	{
		// if $value is null, default to Model::whereId($key)
		// else Model::where($key, $value)
		$clause = !is_null($value) ? self::where($key, $value) : self::whereId($key);

		return $clause->with([
							'category',
							'subcategory',
							'prices',
							'relations',
							'images' => function($query){
								$query->orderBy('sort_order');
							}
						]);
	}

}



/* End of file Product.php */

/* Location: ./application/models/Product.php */
