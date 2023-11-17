<?php
require 'data.php';
$tag = new Pricetag;
$app = new stdClass();
// $ids = [480,478,628,629,659];

// $ids = [
// 	480 => 277,
// 	478 => 209,
// 	628 => 216,
// 	629 => 221,
// 	659 => 245,
// ];
$json = isset($_POST['_s']) && $_POST['_s'] != '' ? $_POST['_s'] : '{"480":277,"478":209,"628":216,"629":221,"659":245}';

$ids = json_decode($json);

$app->data = collect($tag->productWithImage($ids));


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
$html .= '		<style>@page{margin:10px;margin-top:20px}</style>';
$html .= '	</head>';
$html .= '	<body>';
$html .= '		<div class="container">';
$html .= '			'.$tag->template($tag->productWithImage($ids));
$html .= '		</div>';
$html .= '	</body>';
$html .= '	</html>';

$app->html = $html;
return $app;