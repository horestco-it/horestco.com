<?php
include '../../../classes/Db.class.php';

		// echo $_POST['catid'];
		$db = new DB;
		$db->bindMore(array(
			'subcatid' => $_POST['id'],
			'catid' => $_POST['catid'],
			'name' => $_POST['name'],
			'des' => $_POST['des'],
			'status' => $_POST['status']
			));
		$submit = $db->query(" UPDATE subcategory SET 
					catid = :catid,
					name 			= :name, 
					description = :des, 
					status		= :status 
					WHERE subcatid = :subcatid 
					");
		if ( $submit ) {
			echo true;
		}
	?>
