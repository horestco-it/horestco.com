<?php

// used for model
// - Subcategory
// - Product
// namespace Horestco\My\Model;

trait ModelRelationTrait
{
	public function scopeEnabled($query)
	{
		return $query->where('is_enabled', 1);
	}

	public function scopeSort($query, $by = 'sort_order', $sort = 'asc')
	{
		return $query->orderBy($by, $sort)->orderBy('name');
	}

	// make own custom
	public static function productLists($key, $value)
	{
		$clause = !is_array($value) ? self::where($key, $value) : self::whereIn($key, (array)$value);

		return $clause->enabled()
								->with([
									'category',
									'relations',
									'products' => function($query){
										$query->enabled()
													->sort()
													->with([
											'images' => function($query){
												$query->enabled()->sort('sort_order', 'desc');
											},
											'imageThumb' => function($query){
												$query->where('is_primary', 1);
											},
											'sizes' => function($query){
												$query->sort('sort_order');
											}
										]);
									}
								]);
	}
}