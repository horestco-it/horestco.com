<?php
  
  require_once(dirname(__FILE__).'/../../classes/Db.class.php');

  $username = $_POST['name'];
  $password = $_POST['password'];
  $submit   = $_POST['submit'];

  $msg = "";
  if ( isset($username) && isset($password) ) {
    $db = new Db();
    $db->bind("username", $username);
    $db->bind("password", $password); 
    $row = $db->query(" SELECT * FROM users WHERE name = :username AND password = :password ");

    if($username == $row[0]['name']) {
      session_start();
      $_SESSION['username']       = $username;
      $_SESSION['type']           = $row[0]['type'];
      $_SESSION['displayname']    = $row[0]['name'];
      $_SESSION['start']          = time();
      $_SESSION['expired']        = $_SESSION['start'] + ( 60 * 120 ); // 60 menit

      if ( $_GET['redirect'] ) {
        header("location:../".$_GET['url']);
      }
      else{
        header("location:../dashboard.php");
      }
      
    }else{
      $msg = "Wrong+Username+or+Password";
      header("location:../index.php?error=1&msg=$msg");
    }

  }else{
    echo "please insert username and password";
  }
?>