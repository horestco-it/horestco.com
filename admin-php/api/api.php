<?php
require '../../classes/DB.php';
require '../../config.php';

ini_set("display_errors", 1);

if ( !isset($_GET['_s']) || $_GET['_s'] == '' ) return false;

$section = $_GET['_s'];

// COMMON
if($section == 'prdList')
{
	$products =  Product::enabled()->orderBy('name')->lists('name', 'id');
	$result = [];
	foreach($products as $id => $name){
		$result[] = ['id'=>$id, 'name'=>$name];
	}
	echo json_encode($result);
	return;
}

if($section == 'product')
{
	$product = Product::whereId($_GET['pid'])
											->with([
													'images' => function($q){
														$q->enabled();
													},
													'sizes',
												])
											->first();
	// $images = Product::find($_GET['pid'])->images()->enabled()->get();
	echo json_encode($product);
	return;
}

if($section == 'prdImgSize')
{
	$with = [
		'sizes' => function($q){
			$q->where('id', $_GET['size']);
		}
	];
	$product = Product::whereId($_GET['pid'])->with($with)->first();
	$product->images = $product->images()->where('id', $_GET['image'])->first();
	echo $product;
	return;
}

// PRICE TAG
if($section == 'pricetag')
{
	$products = Product::find($_GET['pid']);
	vd($products->toArray());
	return false;
}

?>