<?php 
include '../../../classes/Db.class.php';

$db = new DB;
$db->bindMore(array(
	'name'		=> $_POST['name'],
	'des'			=> $_POST['des']
	));
$submit = $db->query(" INSERT INTO main_categories(name,description) VALUES(:name, :des) ");
if ( $submit ) {
	$maincategory = array();
	$maincategory['id'] = $db->lastInsertId();
	$maincategory['name']= $_POST['name'];
	$maincategory['des']= $_POST['des'];
	$maincategory['status']= 'Active';
	echo json_encode($maincategory);
}
 ?>