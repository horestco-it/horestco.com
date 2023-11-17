<?php 
sleep(1);
$imageId = $_GET['image'];
$materialId = $_GET['material'];

require '../../../../classes/Db.class.php';

$db = new Db;
$db->bind('material_id', $_GET['material']);
$db->bind('image_id', $_GET['image']);
$rs = $db->query(" UPDATE productimage SET material_id = :material_id WHERE imageId = :image_id ");

echo $rs;

 ?>