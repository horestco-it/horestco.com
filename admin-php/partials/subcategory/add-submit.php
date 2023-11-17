<?php 
include '../../../classes/Db.class.php';

$db = new DB;
$db->bindMore(array(
	'catid'		=> $_POST['catid'],
	'name'		=> $_POST['name'],
	'des'			=> $_POST['des']
	));
$submit = $db->query(" INSERT INTO subcategory(catid,name,description) VALUES(:catid, :name, :des) ");
if ( $submit ) {
	$data = array();
	$data['id'] = $db->lastInsertId();
	$data['name']= $_POST['name'];
	$data['des']= $_POST['des'];
	$data['status']= 'Active';
	echo json_encode($data);
}

 ?>