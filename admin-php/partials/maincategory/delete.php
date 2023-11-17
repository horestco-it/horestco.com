<?php 
include '../../../classes/Db.class.php';

$db = new DB;
$db->bind('id', $_GET['id']);
$delete = $db->row(" DELETE FROM main_categories WHERE id = :id ");
if ( $delete ) {
	echo 1;
}

 ?>