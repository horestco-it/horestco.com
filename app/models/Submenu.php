<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
	public function getUrlAttribute($value)
	{
		if( in_array($this->menu_id, [1,2,3,4]) )
		{
			return base_url('furniture/'.$value);
		}
		return base_url($value);
	}
	public static function getSubcatIds()
	{
		return self::where('id', '<', 31)
												->orderBy('id')
												->whereNotNull('subcategory_id')
												->pluck('subcategory_id')->toArray();
	}
}

/* End of file Submenu.php */
/* Location: ./application/models/Submenu.php */