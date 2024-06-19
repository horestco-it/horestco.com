
<?php 
  ini_set("display_errors", 'On');

include '../../../classes/Db.class.php';
include '../../../classes/DB.php';
include '../../../classes/Helper.php';

if ( $_GET['action'] == 'search' ) {

	$db = new DB;
	if (isset($_GET['detail']) && $_GET['detail'] == 'client' ) {
		$db->bind('id', $_GET['id']);
		$clients = $db->query(" SELECT * FROM porto_clients WHERE id = :id ");
		
		$db->bind('id', $_GET['id']);
		$images = $db->query(" SELECT * FROM porto_images WHERE porto_client_id = :id ORDER BY is_primary DESC ");
		
		$db->bind('id', $clients[0]['page_id']);
		$page = $db->row("SELECT * FROM pages WHERE id = :id ");
	}
	else{
		// $db->bind('id', $_GET['id']);
		$clients = PortoClient::where('page_id', $_GET['id'])->with('image', 'page')->orderBy('sort_order')->get(); 
		// $db->query(" SELECT * FROM porto_clients WHERE page_id = :id ORDER BY sort_order ");
		// $db->bind('id', $_GET['id']);
		$page = Page::find($_GET['id']);
		//  $db->row("SELECT * FROM pages WHERE id = :id ");
	}

	if ( count($clients) > 0) {
		$i = 0;
		// detail client
		if ( isset($_GET['detail']) && $_GET['detail'] == 'client' ) {
			foreach ($images as $img) {
				$images[$i]['id'] = $img['id'];
				$images[$i]['name'] = $img['name'];
				$images[$i]['primary'] = $img['is_primary'];
				// $db->bind('id', $img['id']);
				// $tooltips = $db->query(" SELECT * FROM portotooltip WHERE idportoimage = :id ");
				// $j = 0;
				// foreach ($tooltips as $t) {
				// 	$images[$i]['tooltip']['id_tooltip'][$j] = $t['idtooltip'];
				// 	$images[$i]['tooltip']['pid'][$j] = $t['pid'];
					
				// 	$db->bind('pid', $t['pid']);
				// 	$prod = $db->single(" SELECT title FROM product WHERE productid = :pid ");
				// 	$images[$i]['tooltip']['title'][] = $prod;

				// 	$coord = $t['coordinate'];
				// 	$coords = explode(",", $coord);
				// 	$images[$i]['tooltip']['coord'][] = $coords;

				// 	$j++;
				// }
				$i = $i + 1;
			}
			for ($j=0; $j < count($clients) ; $j++) { 
				$clients[$j]['images'] = $images;
				$clients[$j]['category'] = $helper->url_slug($page['name']);
			}
		}
		// fetch all clients
		else{
			foreach ($clients as $row) {
				// $clients[$i]['status'] =  $row['is_enabled'];
				// $clients[$i]['category'] = $helper->url_slug($page['name']);
				// $db->bind('clientid', $row['id']);
				// $images = $db->query(" SELECT name FROM porto_images WHERE porto_client_id = :clientid ORDER BY is_primary ASC ");
				// foreach ($images as $img) {
				// 	$clients[$i]['img'] = $img['name'];
				// }
				// $i = $i + 1;
			}
		}
		dj($clients);
	}
	else{
		echo dj("empty");
	}
}
function dj($rs){
	echo json_encode($rs);
}
 ?>
