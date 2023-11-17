<?php 
$url = $_SERVER[ 'DOCUMENT_ROOT' ];
echo $url."<br>";
$urls = explode("/", $url);
var_dump($urls);
var_dump(dirname(__FILE__));
 ?>