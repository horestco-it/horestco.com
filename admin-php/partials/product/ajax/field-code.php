<?php

require '../../../../classes/Db.class.php';

$request = $_GET['code'];

echo json_encode(hasCode($request));

function hasCode($code)
{
	$db = new Db;
	$db->bind('code', $code);
	$check = $db->row(" SELECT code FROM products WHERE code = :code ");
	return ($check > 0) ? true : false;
}
?>