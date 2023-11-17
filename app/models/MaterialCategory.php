<?php
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class MaterialCategory extends Model
{
	/**
	 * relation subcategories
	 * one-to-many
	 * @return [type] [description]
	 */
	public function subcategories()
	{
		return $this->hasMany('MaterialSubcategory');
	}
	/**
	 * relation materials
	 * one-to-many
	 * @return [type] [description]
	 */
	public function materials()
	{
		return $this->hasManyThrough('Material', 'MaterialSubcategory');
	}

	// make own
	public static function materialLists()
	{
		return self::with([
				'subcategories' => function($query){
					$query->with([
						'materials' => function($query){
							$query
									->orderBy('is_enabled', 'desc')
									->orderBy('name');
						}
					])
					->orderBy('name');
				}
			])
			->orderBy('id', 'desc')
			->get();
	}

	public static function associateWithProduct($productId)
	{
		$product = Product::find($productId);

		$ids = array_unique($product->materials->pluck('id')->toArray());
		$catid = array_unique($product->materials->pluck('material_category_id')->toArray());
		$subcatid = array_unique($product->materials->pluck('material_subcategory_id')->toArray());

		$materials = [];
		foreach (self::materialLists() as $key => $category) {
			if(in_array($category->id, $catid))
			{
				$materials['category'][$key]['name'] = $category->name;

				foreach ($category->subcategories as $i => $sub) {
					if( in_array($sub->id, $subcatid) )
					{
						$materials['category'][$key]['subcategory'][$i]['name'] = $sub->name;
						foreach ($sub->materials as $idx => $material) {
							$materials['category'][$key]['subcategory'][$i]['material'][$idx]['id'] = $material->id;
							$materials['category'][$key]['subcategory'][$i]['material'][$idx]['name'] = $material->name;
							$materials['category'][$key]['subcategory'][$i]['material'][$idx]['is_checked'] = in_array($material->id, $ids) ? 1 : 0;
						}
					}
				}
			}
		}
		return $materials;
	}
	
	public static function associateWithImage($productId)
	{
		$product = Product::find($productId);
		$materialId_image = [];
		foreach ($product->images as $key => $image) {
			$image = Image::find($image->id);
			foreach($image->materials()->pluck('id')->toArray() as $key => $matId){
				$materialId_image[$matId] = ['id'=> $image->id, 'name' => $image->name];
			}
		}
		return $materialId_image;
	}

	public function materialsFindById($id)
	{
		return self::whereId($id)->with([
				'subcategories' => function($query){
					$query->with(['materials']);
				}
			]);
	}
}