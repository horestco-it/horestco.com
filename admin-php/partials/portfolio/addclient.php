<?php
	include '../../../classes/Db.class.php';
	include '../../../classes/DB.php';
	include '../../../classes/Helper.php';
	include '../../../config.php';
	ini_set('display_errors', 1);
	/*------------------------------------------------
	| add client
	|-------------------------------------------------
	*/
/*
	{
		category: "12", 
		name: 		"user", 
		location: "Mlaysia", 
		scopes: 	"dining chair,dining table", 
		description: "des"
	}
*/
if (isset($_GET['action']) && $_GET['action'] == 'addclient' ) {
	$db = new DB();
	$db->bind('pageId', $_POST['category']);
	$category = $db->row(" SELECT * FROM pages WHERE id = :pageId ");
	$db->bindMore(array(
		'category'=> $_POST['category'],
		'name'		=> $_POST['name'],
		'address'	=> $_POST['location'],
		'slug'		=> str_slug($_POST['name']),
		'scopes'	=> $_POST['scopes'],
		'des'  		=> $_POST['description'],
		'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
		'updated_at' => \Carbon\Carbon::now('Asia/Jakarta')
		));
	$sql = " INSERT INTO porto_clients(page_id,name,location,slug,scopes,description, created_at, updated_at) 
				VALUES (:category, :name, :address, :slug, :scopes, :des, :created_at, :updated_at) ";
	$clients = $db->query($sql);
	if ( $clients ) {
		$client = array('status' => true, 'lastid' => $db->lastInsertId() );
		echo json_encode($client);
	}
	else{
		$client = array('status' => false );
		echo json_encode($client);
	}
}

/*------------------------------------------------
| upload pdf
|-------------------------------------------------
*/
if ( isset($_GET['uploadpdf']) && $_GET['uploadpdf'] ) {

	$pdf_path = $_SERVER['DOCUMENT_ROOT']."/files/portfolio/";
	$pdf_allowed = 'pdf';
	$ext = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
	
	if( $ext != $pdf_allowed ){
    echo 'Format is not allowed<br>';
    echo 'Make sure the file is PDF format';
    exit;
  }

	$client = PortoClient::find($_GET['clientid']);

	$page = $client->page()->first()->name;

	$name = $page."_".str_slug($client->name)."_v".rand(100, 999).".$ext";

	if( !empty($_FILES["pdf"]["tmp_name"]) && move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdf_path.$name) )
	{
		// update pdf name
		$client->pdf = $name;
		$client->save();

	  header("location:../../portfolio.php");
	}
	else{
		echo "Error";
	}

	return;
}

/*------------------------------------------------
| # upload image
| @param : upload=true&clientid=:any
|-------------------------------------------------
*/
if ( isset($_GET['upload']) && $_GET['upload'] ) {
		$db = new DB();
		$db->bind('clientid', $_GET['clientid']);
		$client = $db->row(" SELECT * FROM porto_clients WHERE id = :clientid ");
		$db->bind('pageId', $client['page_id']);
		$page = $db->row(" SELECT * FROM pages WHERE id = :pageId ");
		
		$path = base_path()."assets/images/portfolio/".$helper->str_slug($page['name'])."/";

		$img_allowed = array('png', 'jpg', 'gif','zip');
		
    // upload images
		foreach ($_FILES['images']['name'] as $f => $name) {
	    $ext = strtolower('.'.pathinfo($name, PATHINFO_EXTENSION));

	    $imageCrumbs = array(
	    	$helper->str_slug($client['name']),
	    	$helper->str_slug($page['name']),
	    	rand(100, 999)
	    );

	    $image_name = implode('-', $imageCrumbs).$ext;

	    if(!in_array(str_replace('.', '',$ext), $img_allowed)){
	        echo '{"status":"error"}';
	        exit;
	    }
	    if ( copy($_FILES['images']['tmp_name'][$f], $path.$image_name) ){
	        include_once '../../../classes/simpleImage.class.php';
          // create instant object from class
          $image = new SimpleImage();
          $image->load($path.$image_name);

	        $db->bind('clientid', $_GET['clientid']);
	        $db->bind('name', $image_name);
	        $db->bind('created_at', timestamps());
	        $db->query(" INSERT INTO porto_images(porto_client_id, name, created_at) VALUES(:clientid, :name, :created_at) ");
	        
	        header("location:../../portfolio.php");
	    }

	  } // end foreach
}
 ?>