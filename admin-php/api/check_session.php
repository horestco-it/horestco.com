<?php session_start(); 	

  $now  = time();

  if (!isset($_SESSION['expired']) || $now > $_SESSION['expired']) {

    session_destroy();
    // redirect to login page
    header("location:index.php?redirect&url=".urlencode(basename($_SERVER['REQUEST_URI'])) );

  }

 ?>