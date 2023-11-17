<?php 
include '../classes/Db.class.php';

$db = new DB;

for ($i=1; $i < 26 ; $i++) { 
	$client = $db->query(" SELECT clientid, images FROM portoclient WHERE clientid = ".$i." ");
	$images = explode(",", $client[0]['images']);
	for ($j=0; $j < count($images) ; $j++) {
		$db->bind('id', $client[0]['clientid']);
		$db->bind('name', $images[$j].".jpg");
		$insert  = $db->query(" INSERT INTO portoimage(clientid,name) VALUES(:id,:name) ");
	}
	if ($insert > 0) {
		echo "success";
	}
	//dd($arr);
}

// dd($client);

function dd($rs){
	echo "<pre>";
	var_dump($rs);
	echo "</pre>";
}

function dj($rs){
	echo json_encode($rs);
}
 ?>