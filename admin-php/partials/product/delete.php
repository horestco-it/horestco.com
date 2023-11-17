<?php
	$db->bind('id', $_GET['id']);
	$delete = $db->query(" DELETE FROM products WHERE id = :id "); // 1 : 0

	if ($delete > 0) {
		//================
		// delete file images
		$db->bind('id', $_GET['id']);
		$images = $db->query(" SELECT * FROM images WHERE product_id = :id");

		$path = $_SERVER[ 'DOCUMENT_ROOT' ].'/resources/theme/2016/assets/images/products/';
		foreach ($images as $key => $image) {
			// delete original image
			unlink($path.$image['name']);
			// delete medium image
			unlink($path.'tmp/m/'.$image['name']);
		}

		$db->bind('id', $_GET['id']);
		$imgdelete = $db->query(" DELETE FROM images WHERE product_id = :id ");

		
		//================
		$db->bind('id', $_GET['id']);
		$pricedelete = $db->query(" DELETE FROM productprice WHERE productid = :id ");

		echo "Deleting";
	}else{
		echo "other";
	}

 ?>