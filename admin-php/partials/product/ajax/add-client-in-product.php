
<?php 
/**
 * AJAX
*/
require '../../../../classes/Db.class.php';

$db = new Db;

// add client
if ( $_GET['action'] == 'add-client-in-product' ) {
  $clientids = explode(',', $_GET['clientId']);
  foreach ($clientids as $client) {
  $db->bind('pid', $_GET['pid']);
  $db->bind('client', $client);
  	$db->query(" INSERT INTO product_client VALUES (:pid, :client) ");
  }
}

if ( $_GET['action'] == 'delete-client-in-product' ) {
	$db->bind('pid', $_GET['pid']);
	$db->bind('client', $_GET['clientId']);
	$db->row(" DELETE FROM product_client WHERE product_id = :pid AND client_id = :client ");
}

 ?>
