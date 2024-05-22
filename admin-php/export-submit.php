<?php

use Illuminate\Support\Str;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'api/check_session.php';

if (!isset($_SESSION['type']) || $_SESSION['type'] != 'A' ){
  echo "Access Denied. <br/>";
  echo "<a href='/admin-php/dashboard.php'>Dashboard</a>";
  return;
}

require '../config.php';
require '../classes/Helper.php';
require '../classes/DB.php';

$helper = new Helper;
$db = $capsule;


function exportCsv ($data, $header = [], $filename = 'export.csv', $delimiter = ';') {
  header('Content-Type: application/csv');
  header('Content-Disposition: attachment; filename="'.$filename.'";');
  // open the "output" stream
  // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
  $f = fopen('php://output', 'w');
  
  if(count($header)) {
  	fputcsv($f, $header, $delimiter);
  }

  foreach ($data as $line) {
    fputcsv($f, $line, $delimiter);
  }
  
}

function getProducts($subcatid)
{
  $select = [
    'id',
    'name',
    'code as sku',
    'category_id',
    'subcategory_id',
  ];
  $products = Product::active()->sort()
//  			->select($select)
        ->with([
        	'subcategory', 'category', 'sizes', 
        	'images' => function($query){
        		$query->orderBy('sort_order', 'asc')->orderBy('is_primary', 'desc');
        	}
        ])
        ->where('subcategory_id', $subcatid)
        ->get();

  return $products;
}

function imageUrl($images) {
	return collect($images)->map(function($item){
		return BASE_URL.'/assets/images/furniture/'.$item['name'];
	})->implode(', ');
}


$subcatid = $_POST['subcategory'];
$catid = $_POST['category'];
$products = getProducts($subcatid);

// $also = 'HTC36,HOD94,HOD95';
// echo strtok($also, ',');die();



  	
$data = [];
$header = ['ID', 'Type', 'Allow customer reviews?', 'SKU', 'Name', 'Reguler price', 'Tags', 'Categories', 'Cross-sells', 'Upsells', 'Short Description', 'Images'];

if( count($products)){
	foreach($products as $product){
		$cross = $product->also_like;
		$upsells = $product->also_like ? strtok($product->also_like, ',') : '';
		$row = [
			$product->id,
			'simple',
			"0",
			$product->code,
			strtoupper($product->name),
			(int)$product->price,
			Str::slug($product->category->name) .','. Str::slug($product->subcategory->name),
			$product->category->name .','. $product->category->name .'>'. $product->subcategory->name,
			$cross,
			$upsells,
			$product->description,
			imageUrl($product->images)
		];
		$data[] = $row;
	}

	// echo "<pre>";
	// echo count($products) ." products<br/>";
	// print_r($products->toArray());
	// echo "</br>";
	
	$filename = 'export-'.Str::slug($products[0]->category->name).'--'.Str::slug($products[0]->subcategory->name).'.csv';
	exportCsv($data, $header, $filename, ';');
}

//$helper->printr($data, true);


