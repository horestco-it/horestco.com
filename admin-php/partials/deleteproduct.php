<?php
	$db->bind('id', GET_ID);
	$delete = $db->query(" DELETE FROM product WHERE productId = :id ");
	$db->bind('id', GET_ID);
	$imgdelete = $db->query(" DELETE FROM productimage WHERE productId = :id ");
	$db->bind('id', GET_ID);
	$pdfdelete = $db->query(" DELETE FROM productpdf WHERE productId = :id ");
	$db->bind('id', GET_ID);
	$pricedelete = $db->query(" DELETE FROM productprice WHERE productId = :id ");
	if ($delete > 0) {
		echo "Deleting";
	}
 ?>