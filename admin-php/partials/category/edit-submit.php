<?php
include '../../../classes/Db.class.php';

		$db = new DB;
		$db->bindMore(array(
			'catid' => $_POST['id'],
			'name' => $_POST['name'],
			'des' => $_POST['des'],
			'status' => $_POST['status']
			));
		$submit = $db->query(" UPDATE categories SET 
					name 			= :name, 
					description = :des, 
					is_enabled		= :status 
					WHERE id = :catid ");
		if ( $submit ) {
			echo 1;
		}
	?>
