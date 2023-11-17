<?php 
include '../../../classes/Db.class.php';

$db = new DB;
$db->bind('id', $_GET['id']);
$delete = $db->row(" DELETE FROM subcategory WHERE subcatid = :id ");
if ( $delete ) {
	echo 1;
}

 ?>