<?php
ini_set("display_errors", 1);
  require '../../api/check_session.php';
  require '../../../classes/DB.php';
  require '../../../classes/Db.class.php';
  require '../../../classes/Helper.php';
  require '../../../config.php';

  $pdo = new PDO('mysql:host=localhost;dbname=shuabe_horestco_my', 'shuabe', 'watonklakon1', array(\PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8;SET time_zone = 'Asia/Malaysia'"));

$sql = "INSERT INTO `products` (category_id, subcategory_id, name, code, description, created_at)
                                        VALUES (:category_id, :subcategory_id, :name, :code, :description, :created_at)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":category_id", $category_id);
$stmt->bindParam(":subcategory_id", $subcategory_id);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":code", $code);
$stmt->bindParam(":description", $description);

$stmt->bindParam(":created_at", $created_at);

$form = $_POST;
$category_id = $form[ 'category_id' ];                    
$subcategory_id= $form[ 'subcategory_id' ];                   
$name= $form[ 'name' ];                 
$code= $form[ 'code' ];        
$description= $form[ 'description' ];

$created_at= \Carbon\Carbon::now('Asia/Jakarta');


$stmt->execute();

$result = $stmt->execute();

if($result) {
    echo "Your text has been posted";

    }// end if
else {
    echo '0 results';
    }// end else

?>