<?php
require 'data.php';
$tag = new Pricetag;
$app = new stdClass();
$ids = '{"480":277,"478":209,"628":216,"629":221,"659":245, "572":112}';
// $ids = '{"480":277,"478":209,"628":216,"629":221}';

$json = $ids;

$ids = json_decode($json);
$app->data = $tag->productWithImage($ids);
// vd($app->data->toArray());

// return ;
$css = '';

$html = '';
$html .= '<!DOCTYPE html>';
$html .= '<html>';
$html .= '	<head>';
$html .= '		<meta charset="utf-8">';
$html .= '		<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$html .= '		<meta name="viewport" content="width=device-width, initial-scale=1">';
$html .= '		<title>PRICE TAG</title>';
$html .= '		<link rel="stylesheet" href="'.base_url('admin-php/assets/css/bootstrap-default.min.css').'" >';
$html .= '		<link rel="stylesheet" href="'.base_url('admin-php/assets/css/pricetag2.css').'" >';
$html .= '		<style>@page{margin:10px;margin-top:20px}'.$css.'</style>';
$html .= '	</head>';
$html .= '	<body>';
$html .= '		<div class="container">';
$html .= '			'.$tag->template($tag->productWithImage($ids));
$html .= '		</div>';
$html .= '	</body>';
$html .= '	</html>';

$app->html = $html;
return $app;