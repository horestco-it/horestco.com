<?php 
include '../../../classes/Db.class.php';

$db = new DB;
$db->bindMore(array(
	'catid' => $_POST['id'],
	'name'		=> $_POST['name'],
	'des'			=> $_POST['des'],
	// 'status' => $_POST['status']
	));
$submit = $db->query(" INSERT INTO categories(catid,name,description) VALUES(:id ,:name, :des) ");
if ( $submit ) {
	$category = array();
	$category['id'] = $db->lastInsertId();

	$category['name']= $_POST['name'];
	$category['des']= $_POST['des'];
	$category['status']= 'Active';
	echo json_encode($category);
}

 ?>