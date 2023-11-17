<?php
// ini_set("display_errors", 1);
	include '../../../../classes/DB.php';
	include '../../../../classes/Helper.php';
	include '../../../../app/models/Subcategory.php';

	$subcategories = Models\Subcategory::active()->where('catid', $_GET['catid'])->orderBy('name')->get()->toArray();

	print_r(json_encode($subcategories));

?>