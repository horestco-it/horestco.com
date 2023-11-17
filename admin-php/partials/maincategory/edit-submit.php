<?php
include '../../../classes/Db.class.php';

		// echo $_POST['catid'];
		$db = new DB;
		$db->bindMore(array(
			'maincatid' => $_POST['maincatid'],
			'name' => $_POST['name'],
			'des' => $_POST['des'],
			'status' => $_POST['status']
			));
		$submit = $db->query(" UPDATE main_categories SET 
					name 			= :name, 
					description = :des, 
					is_enabled		= :status 
					WHERE id = :maincatid ");
		if ( $submit ) {
			echo 1;
		}
	?>
